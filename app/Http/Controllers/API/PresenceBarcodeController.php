<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PresenceBarcode;
use App\Models\PresenceBarcodeSchoolUser;
use App\Models\SchoolBillingQuota;
use App\Models\SchoolBillingQuotaTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresenceBarcodeController extends Controller
{
    public function getIndex() {
        $data = PresenceBarcode::with('school_position', 'barcode_user', 'barcode_user.school_user')->orderBy('date', 'desc')->get();

        $data->map( function ($map) {
            $map->mangkir = $map->barcode_user->where('status', 'mangkir')->count();
            $map->hadir = $map->barcode_user->where('status', 'hadir')->count();
        });

        return rApi(200, $data, 'Berhasil');
    }

    public function postReGenerateQrCode($id) {
        $qr_code = PresenceBarcode::createQRCode();

        PresenceBarcode::find($id)
            ->update([
                'qr_code' => $qr_code
            ]);

        $data = PresenceBarcode::with('school_position', 'barcode_user', 'barcode_user.school_user')->find($id);
        $data->mangkir = $data->barcode_user->where('status', 'mangkir')->count();
        $data->hadir = $data->barcode_user->where('status', 'hadir')->count();

        return rApi(200, $data, 'Berhasil');
    }

    public function getDetail($id) {
        $data = PresenceBarcode::with('school_position', 'barcode_user')->find($id);

        return rApi(200, $data, 'Berhasil');
    }

    public function postDoPresence(Request $request) {
        try {
            DB::beginTransaction();

            $user = Auth::guard('api')->user();

            // CEK PRESENCE_BARCODE
            $presence_barcode = PresenceBarcode::where('qr_code', $request->qr_code)->first();
            if(!$presence_barcode) return rApi(500, [], 'Presensi tidak valid. (ERR001)');

            // CEK PRESENCE BARCODE SCHOOL USER
            $barcode_user = PresenceBarcodeSchoolUser::where([
                'school_user_id' => $user->id,
                'presence_barcode_id' => $presence_barcode->id
            ])->first();
            if(!$barcode_user) return rApi(500, [], 'Presensi tidak valid. (ERR002)');
            $mode = is_null($barcode_user->hour_in) ? 'in' : 'out';

            if ($barcode_user->state === 'pulang') return rApi(500, [], 'Anda sudah melakukan presensi');

            // FIND BILLING
            $billing = $presence_barcode->school->billing;
            if(Carbon::now() > Carbon::parse($billing->end_date)) return rApi(500, (object)[], "Paket layanan anda telah usai, segera perpanjang paket anda.");

            $quota = SchoolBillingQuota::where([
                'school_billing_id' => $billing->id,
                'service_id' => $presence_barcode->service_id,
            ])->first();
            if($quota->remaining_quota < 1) return rApi(500, (object)[], "Kuota untuk presensi ini telah habis, segera perbarui paket layanan anda.");

            // PREPARE DATA QUOTA TRANSACTION
            $data_quota_transaction = [
                'school_id' => $user->school_id,
                'school_billing_id' => $billing->id,
                'school_billing_quota_id' => $quota->id,
                'school_user_id' => $user->id,
                'service_id' => $presence_barcode->service_id,
                'datetime' => Carbon::now(),
                'ref_table' => 'presence_barcode_school_users',
                'ref_id' => $barcode_user->id,
                'type' => $mode,
            ];

            $data = [];
            if($mode === 'in') {
                $data = [
                    'hour_in' => Carbon::now()->format('H:i:s'),
                    'state'     => 'masuk',
                    'status'    => 'hadir'
                ];
            } else if($mode === 'out') {
                $carbon_hour_in = Carbon::createFromTimeString($barcode_user->hour_in);
                $carbon_hour_out = Carbon::now();
                $duration = $carbon_hour_out->diffInMinutes($carbon_hour_in);

                $data = [
                    'hour_out' => Carbon::now()->format('H:i:s'),
                    'duration' => $duration,
                    'state'     => 'pulang',
                ];
            }

            $barcode_user->update($data);

            $used_quota = (int) $quota->used_quota + 1;
            $remaining_quota = (int) $quota->remaining_quota - 1;

            $quota->update([
                'used_quota' => $used_quota,
                'remaining_quota' => $remaining_quota,
            ]);

            SchoolBillingQuotaTransaction::create($data_quota_transaction);

            DB::commit();
            return rApi(200, [], 'Presensi '. ($mode === 'in' ? 'masuk' : 'pulang') .' telah berhasil.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return rApi(500, (object) [], 'Terjadi kegagalan saat memproses presensi anda.');
            // throw $th;
        }
    }
}
