<?php

namespace App\Http\Controllers;

use App\Models\SchoolShift;
use App\Models\SchoolShiftHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SchoolShiftController extends Controller
{
    public function getIndex()
    {
        return view('school-shift.index');
    }

    public function getData(Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');

        $search = $request->get('search')['value'];

        $columns = SchoolShift::COLUMNS;

        $data = SchoolShift::query()
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
        $count = SchoolShift::query()
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
        $data = SchoolShift::query()
            ->with('school_shift_hours')
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
            'shift_name'     => 'required|max:255',
            'time_tolerance'     => 'required|numeric',
            'shift_hours.*.day'     =>'required',
            'shift_hours.*.day'     =>'required',
            'shift_hours.*.time_in'     =>'required',
            'shift_hours.*.time_out'     =>'required',
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

        $days = [1=> 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];

        DB::beginTransaction();

        $school_id = Auth::user()->school_id;

        $data = SchoolShift::findOrFail($id);
        if($data->school_id !== $school_id) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'User anda tidak memiliki akses untuk mengubah data ini'
            ], 422);
        }

        $update = $data->update([
            'school_id' => $school_id,
            'shift_name' => $request->shift_name,
            'time_tolerance' => $request->time_tolerance,
        ]);

        $h = $request->school_shift;
        $shift_hour = [];
        foreach ($days as $day_in => $days) {
            $shift_hour[] = [
                'school_shift_id' => $id,
                'school_id' => $school_id,
                'day_in'    => $day_in,
                'day'       => $h['day'][($day_in-1)],
                'hour_in'   => $h['hour_in'][($day_in-1)],
                'hour_out'  => $h['hour_out'][($day_in-1)],
            ];
        }
        foreach ($shift_hour as $s) {
            SchoolShiftHour::where([
                'school_shift_id' => $s['school_shift_id'],
                'school_id' => $s['school_id'],
                'day_in' => $s['day_in'],
                'day' => $s['day'],
            ])->update([
                'hour_in' => $s['hour_in'],
                'hour_out' => $s['hour_out'],
            ]);
        }

        DB::commit();

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
            'shift_name'     => 'required|max:255',
            'time_tolerance'     => 'required|numeric',
            'shift_hours.*.day'     =>'required',
            'shift_hours.*.day'     =>'required',
            'shift_hours.*.time_in'     =>'required',
            'shift_hours.*.time_out'     =>'required',
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

        $days = [1=> 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
        
        DB::beginTransaction();

        $school_id = Auth::user()->school_id;
        $store = SchoolShift::create([
            'school_id' => $school_id,
            'shift_name' => $request->shift_name,
            'time_tolerance' => $request->time_tolerance,
        ]);

        $h = $request->school_shift;
        $shift_hour = [];
        foreach ($days as $day_in => $days) {
            $shift_hour[] = [
                'school_shift_id' => $store->id,
                'school_id' => $school_id,
                'day_in'    => $day_in,
                'day'       => $h['day'][($day_in-1)],
                'hour_in'   => $h['hour_in'][($day_in-1)],
                'hour_out'  => $h['hour_out'][($day_in-1)],
            ];
        }
        SchoolShiftHour::insert($shift_hour);

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

        SchoolShift::query()
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
        SchoolShift::query()
            ->where('school_id', Auth::user()->school_id)
            ->whereIn('id', $ids)
            ->delete();

        return response()->json([
          'status' =>'sukses',
          'message' => 'Data berhasil dihapus',
        ], 200);
    }
}
