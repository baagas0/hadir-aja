<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PresenceDaily;
use App\Models\SchoolBillingQuota;
use App\Models\SchoolBillingQuotaTransaction;
use Carbon\Carbon;
use CURLFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DailyPresenceController extends Controller
{
    public function getFind() {
        $user = Auth::guard('api')->user();

        $presence = PresenceDaily::where([
            'school_user_id' => $user->id,
            'school_id' => $user->school_id,
        ])
        ->whereDate('presence_date', Carbon::now())
        ->first();

        $recap = PresenceDaily::where([
                'school_user_id' => $user->id,
                'school_id' => $user->school_id,
            ])
        ->whereBetween('presence_date',
            [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
        ->groupBy('status')
        ->select(DB::raw('count(*) as count'), 'status')
        ->get();

        $r = (object) [
            'hadir' => $recap->where('status', 'hadir')->first()->count ?? 0,
            'izin' => $recap->where('status', 'izin')->first()->count ?? 0,
            'mangkir' => $recap->where('status', 'mangkir')->first()->count ?? 0,
        ];

        if(!$presence) return rApi(400, (object) [ 'recap' => $r ], 'Data presensi hari ini tidak ditemukan.');

        $presence->recap = $r;

        return rApi(200, $presence, 'Data presensi ditemukan');
    }

    public function postIn(Request $request) {
        /**
         * presence_daily_id
         * base64_selfie_img
         * lat
         * long
         */
        try {
            DB::beginTransaction();

            $presence_daily_id = $request->presence_daily_id;
            $base64_selfie_img = base64_decode($request->base64_selfie_img);

            $presence = PresenceDaily::findOrFail($presence_daily_id);
            $user = Auth::guard('api')->user();

            // CEK ABSEN
            if($presence->hour_in) return rApi(500, (object)[], "Anda sudah melakukan presensi masuk");

            // FIND BILLING
            $billing = $presence->school->billing;
            if(Carbon::now() > Carbon::parse($billing->end_date)) return rApi(500, (object)[], "Paket layanan anda telah usai, segera perpanjang paket anda.");

            $quota = SchoolBillingQuota::where([
                'school_billing_id' => $billing->id,
                'service_id' => $presence->service_id,
            ])->first();
            if($quota->remaining_quota < 1) return rApi(500, (object)[], "Kuota untuk presensi ini telah habis, segera perbarui paket layanan anda.");

            // PREPARE DATA QUOTA TRANSACTION
            $data_quota_transaction = [
                'school_id' => $user->school_id,
                'school_billing_id' => $billing->id,
                'school_billing_quota_id' => $quota->id,
                'school_user_id' => $user->id,
                'service_id' => $presence->service_id,
                'datetime' => Carbon::now(),
                'ref_table' => 'presence_dailies',
                'ref_id' => $presence_daily_id,
                'type' => 'in',
            ];

            // CEK LOKASI
            if ($user->is_all_location_presence) {
                $radius_distance = $user->school_location->radius_distance;

                $lat1 = $user->school_location->lat;
                $lng1 = $user->school_location->long;

                $lat2 = $request->lat;
                $lng2 = $request->lng;
                $distance = $this->distance($lat1, $lng1, $lat2, $lng2);

                if ($distance > $radius_distance) {
                    return rApi(500, (object)[], "Anda diluar jarak radius! {$radius_distance}");
                }
            }

            // post request with attachment
            $saved_selfie_img = public_path().'/image/selfie/'.$user->selfie_img;

            // NEW SELFIE
            $new_selfie_img = time()." $presence_daily_id in base64_selfie_img.png";
            $path_new_selfie_img = public_path().'/image/selfie-presence/' . $new_selfie_img;
            file_put_contents($path_new_selfie_img, $base64_selfie_img);

            $face_matching = $this->face_matching($saved_selfie_img, $path_new_selfie_img);
            dd($face_matching);
            if(is_null($face_matching)) return rApi(500, (object)[], "Server face recognition terkendala!");
            if(!isset($face_matching->data->match) || $face_matching->data->match === false) return rApi(500, (object)[], "Wajah tidak sama! {$face_matching->data->error_procentage}");

            $data = [
                'attachment_in' => $new_selfie_img,
                'face_match_in_response' => collect($face_matching),
                'hour_in' => Carbon::now()->format('H:i:s'),
                'lat_in' => $request->lat,
                'long_in' => $request->lng,
                'state'    => 'masuk',
                'status'    => 'hadir',
            ];
            $presence->update($data);


            $used_quota = (int) $quota->used_quota + 1;
            $remaining_quota = (int) $quota->remaining_quota - 1;

            $quota->update([
                'used_quota' => $used_quota,
                'remaining_quota' => $remaining_quota,
            ]);

            SchoolBillingQuotaTransaction::create($data_quota_transaction);

            DB::commit();

            return rApi(200, PresenceDaily::findOrFail($presence_daily_id), 'Presensi masuk telah berhasil.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return rApi(500, (object) [], 'Terjadi kegagalan saat memproses presensi anda.');
            // throw $th;
        }
    }

    public function postOut(Request $request) {
        /**
         * presence_daily_id
         * base64_selfie_img
         * lat
         * long
         */
        try {
            DB::beginTransaction();

            $presence_daily_id = $request->presence_daily_id;
            $base64_selfie_img = base64_decode($request->base64_selfie_img);

            $presence = PresenceDaily::findOrFail($presence_daily_id);
            $user = Auth::guard('api')->user();

            // CEK ABSEN
            if(is_null($presence->hour_in)) return rApi(500, (object)[], "Anda belum melakukan presensi masuk");
            if($presence->hour_out) return rApi(500, (object)[], "Anda sudah melakukan presensi keluar");

            // FIND BILLING
            $billing = $presence->school->billing;
            if(Carbon::now() > Carbon::parse($billing->end_date)) return rApi(500, (object)[], "Paket layanan anda telah usai, segera perpanjang paket anda.");

            $quota = SchoolBillingQuota::where([
                'school_billing_id' => $billing->id,
                'service_id' => $presence->service_id,
            ])->first();
            if($quota->remaining_quota < 1) return rApi(500, (object)[], "Kuota untuk presensi ini telah habis, segera perbarui paket layanan anda.");

            // PREPARE DATA QUOTA TRANSACTION
            $data_quota_transaction = [
                'school_id' => $user->school_id,
                'school_billing_id' => $billing->id,
                'school_billing_quota_id' => $quota->id,
                'school_user_id' => $user->id,
                'service_id' => $presence->service_id,
                'datetime' => Carbon::now(),
                'ref_table' => 'presence_dailies',
                'ref_id' => $presence_daily_id,
                'type' => 'out',
            ];

            // CEK LOKASI
            if ($user->is_all_location_presence) {
                $radius_distance = $user->school_location->radius_distance;

                $lat1 = $user->school_location->lat;
                $lng1 = $user->school_location->long;

                $lat2 = $request->lat;
                $lng2 = $request->lng;
                $distance = $this->distance($lat1, $lng1, $lat2, $lng2);

                if ($distance > $radius_distance) {
                    return rApi(500, (object)[], "Anda diluar jarak radius! {$radius_distance}");
                }
            }

            // post request with attachment
            $saved_selfie_img = public_path().'/image/selfie/'.$user->selfie_img;

            // NEW SELFIE
            $new_selfie_img = time()." $presence_daily_id out base64_selfie_img.png";
            $path_new_selfie_img = public_path().'/image/selfie-presence/' . $new_selfie_img;
            file_put_contents($path_new_selfie_img, $base64_selfie_img);

            $face_matching = $this->face_matching($saved_selfie_img, $path_new_selfie_img);
            // dd($face_matching);
            if(isset($face_matching->detail)) return rApi(500, (object)[], "Server face recognition terkendala!");
            if(!isset($face_matching->data->match) || $face_matching->data->match === false) return rApi(500, (object)[], "Wajah tidak sama! {$face_matching->data->error_procentage}");

            $carbon_hour_in = Carbon::createFromTimeString($presence->hour_in);
            $carbon_hour_out = Carbon::now();
            $duration = $carbon_hour_out->diffInMinutes($carbon_hour_in);

            $data = [
                'attachment_out' => $new_selfie_img,
                'face_match_out_response' => collect($face_matching),
                'hour_out' => Carbon::now()->format('H:i:s'),
                'lat_out' => $request->lat,
                'long_out' => $request->lng,
                'duration' => $duration,
                'state'    => 'pulang'
            ];
            $presence->update($data);

            $used_quota = (int) $quota->used_quota + 1;
            $remaining_quota = (int) $quota->remaining_quota - 1;

            $quota->update([
                'used_quota' => $used_quota,
                'remaining_quota' => $remaining_quota,
            ]);

            SchoolBillingQuotaTransaction::create($data_quota_transaction);

            DB::commit();
            return rApi(200, PresenceDaily::findOrFail($presence_daily_id), 'Presensi masuk telah berhasil.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return rApi(500, (object) [], 'Terjadi kegagalan saat memproses presensi anda.');
            // throw $th;
        }

    }

    public function distance($lat1, $lng1, $lat2, $lng2) {
        // Konversi latitude dan longitude ke radian
        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        // Hitung jarak antara dua titik
        $d = 6371.01 * acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($lng2 - $lng1));

        // Konversi jarak ke meter
        $jarak = $d * 1000;

        return $jarak;
    }

    public function face_matching ($relative_path_file_1, $relative_path_file_2) {
        // TO RUN SERVER *python flask_server.py*
        $url = 'https://baagas0-ssim-face-compare.hf.space';
        // dd($relative_path_file_1, $relative_path_file_2);
        $curl = curl_init();
        // $relative_path_file_2 = '/home/ditya/Documents/www/hadir-aja/public/image/selfie/selfie-1706146248.png';

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/compare",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('image1'=> new CURLFILE($relative_path_file_1),'image2'=> new CURLFILE($relative_path_file_2)),
            CURLOPT_HTTPHEADER => array(
            ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            dd(curl_error($curl), curl_errno($curl), $curl, $response, $relative_path_file_1, $relative_path_file_2);
        }

        // dd();
        curl_close($curl);
        return json_decode($response);
    }
}
