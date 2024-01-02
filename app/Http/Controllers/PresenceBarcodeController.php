<?php

namespace App\Http\Controllers;

use App\Models\PresenceBarcode;
use App\Models\PresenceBarcodeSchoolUser;
use App\Models\SchoolPosition;
use App\Models\SchoolUser;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PresenceBarcodeController extends Controller
{
    public function getIndex()
    {
        $data = [];
        $data['school_positions'] = SchoolPosition::get();

        return view('presence-barcode.index', $data);
    }

    public function getData(Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');

        $search = $request->get('search')['value'];

        $columns = PresenceBarcode::COLUMNS;

        $data = PresenceBarcode::query()
            ->when(!is_null($search), function ($query) use ($columns, $search) {
                foreach ($columns as $key => $column) {
                    if($key === 0) $query->where($column, 'like', '%'. $search. '%');
                    else $query->orWhere($column, 'like', '%'. $search. '%');
                }
                return $query;
            })
            ->skip($start)
            ->take($length)
            ->get();
        $count = PresenceBarcode::query()
            ->when(!is_null($search), function ($query) use ($columns, $search) {
                foreach ($columns as $key => $column) {
                    if($key === 0) $query->where($column, 'like', '%'. $search. '%');
                    else $query->orWhere($column, 'like', '%'. $search. '%');
                }
                return $query;
            })
            ->count();

        return response()->json([
            'data' => $data,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
        ]);
    }

    public function getDataDetail(Request $request)
    {
        $data = PresenceBarcode::query()
            ->where('id', $request->get('id'))
            ->first();

        return response()->json([
            'message' => 'Berhasil',
            'data' => $data,
        ]);
    }

    public function postUpdate(Request $request, $id) {
        $validation = Validator::make($request->all(), [
            // 'school_id'         => 'required',
            'title'             => 'required|max:255',
            'description'       => '',
            'date'              => 'required|date',
            'actual_hour_in'    => 'required',
            'actual_hour_out'   => 'required',
            'actual_duration'   => '',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  $validation->errors()->first()
            ], 422);
        }

        if (!Auth::user() || (Auth::user() && !Auth::user()->school_id)) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'User anda tidak tertaut pada sekolah manapun. Hubungi Admin untuk informasi lebih lanjut'
            ], 422);
        }

        $school_id = Auth::user()->school_id;

        $data = PresenceBarcode::findOrFail($id);
        if($data->school_id !== $school_id) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'User anda tidak memiliki akses untuk mengubah data ini'
            ], 422);
        }

        $carbon_hour_in = Carbon::createFromTimeString($request->actual_hour_in);
        $carbon_hour_out = Carbon::createFromTimeString($request->actual_hour_out);
        $duration = $carbon_hour_out->diffInMinutes($carbon_hour_in);

        $payload = $request->all();

        $payload['service_id'] = Service::where('code', 'PRS-BRC')->first()->id;
        $payload['qr_code'] = PresenceBarcode::createQRCode();
        $payload['actual_duration'] = $duration;
        $payload['day'] = Carbon::parse($request->date)->locale('id')->format('l');

        $update = $data->update($request->all());

        if(!$update) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'Data tidak berhasil ditambahkan'
            ], 422);
        }

        return response()->json([
          'status' =>'sukses',
          'message' => 'Data berhasil diperbarui',
        ], 200);
    }

    public function postStore(Request $request) {
        $validation = Validator::make($request->all(), [
            // 'school_id'         => 'required',
            'title'             => 'required|max:255',
            'description'       => '',
            'date'              => 'required|date',
            'actual_hour_in'    => 'required',
            'actual_hour_out'   => 'required',
            'actual_duration'   => '',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  $validation->errors()->first()
            ], 422);
        }

        if (!Auth::user() || (Auth::user() && !Auth::user()->school_id)) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'User anda tidak tertaut pada sekolah manapun. Hubungi Admin untuk informasi lebih lanjut'
            ], 422);
        }

        DB::beginTransaction();

        $carbon_hour_in = Carbon::createFromTimeString($request->actual_hour_in);
        $carbon_hour_out = Carbon::createFromTimeString($request->actual_hour_out);
        $duration = $carbon_hour_out->diffInMinutes($carbon_hour_in);

        $payload = $request->all();
        $payload['school_id'] = Auth::user()->school_id;
        $payload['service_id'] = Service::where('code', 'PRS-BRC')->first()->id;
        $payload['qr_code'] = PresenceBarcode::createQRCode();
        $payload['actual_duration'] = $duration;
        $payload['day'] = Carbon::parse($request->date)->locale('id')->format('l');
        // dd($payload);

        $store = PresenceBarcode::create($payload);

        $payload_users = SchoolUser::where('school_position_id', '=', $store->school_position_id)->get()->map(function($map) use ($store) {
            return [
                'presence_barcode_id' => $store->id,
                'school_user_id' => $map->id,
            ];
        })->toArray();
        PresenceBarcodeSchoolUser::insert($payload_users);

        DB::commit();

        if(!$store) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'Data tidak berhasil ditambahkan'
            ], 422);
        }

        return response()->json([
          'status' =>'sukses',
          'message' => 'Data berhasil ditambahkan',
          'data' => $store
        ], 200);
    }

    public function postDelete(Request $request) {
        if (!Auth::user() || (Auth::user() && !Auth::user()->school_id)) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'User anda tidak tertaut pada sekolah manapun. Hubungi Admin untuk informasi lebih lanjut'
            ], 422);
        }

        PresenceBarcode::query()
            ->where('school_id', Auth::user()->school_id)
            ->where('id', $request->id)
            ->delete();

        return response()->json([
            'status' =>'sukses',
            'message' => 'Data berhasil dihapus',
            ], 200);
    }

    public function postBulkDelete(Request $request) {
        if (!Auth::user() || (Auth::user() && !Auth::user()->school_id)) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'User anda tidak tertaut pada sekolah manapun. Hubungi Admin untuk informasi lebih lanjut'
            ], 422);
        }

        $ids = $request->ids;
        PresenceBarcode::query()
            ->where('school_id', Auth::user()->school_id)
            ->whereIn('id', $ids)
            ->delete();

        return response()->json([
          'status' =>'sukses',
          'message' => 'Data berhasil dihapus',
        ], 200);
    }
}
