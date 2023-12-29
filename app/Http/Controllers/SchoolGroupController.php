<?php

namespace App\Http\Controllers;

use App\Models\SchoolGroup;
use App\Models\SchoolShift;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SchoolGroupController extends Controller
{
    public function getIndex()
    {
        $data = [];
        $data['school_shifts'] = SchoolShift::get();
        $data['services'] = Service::get();

        return view('school-group.index', $data);
    }

    public function getData(Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');

        $search = $request->get('search')['value'];

        $columns = SchoolGroup::COLUMNS;

        $data = SchoolGroup::query()
            ->when(!is_null($search), function ($query) use ($columns, $search) {
                foreach ($columns as $key => $column) {
                    if($key === 0) $query->where($column, 'like', '%'. $search. '%');
                    else $query->orWhere($column, 'like', '%'. $search. '%');
                }
                return $query;
            })
            ->with('school_shift', 'daily_presence_service')
            ->skip($start)
            ->take($length)
            ->get();
        $count = SchoolGroup::query()
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
        $data = SchoolGroup::query()
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
            'group_code'     => 'required|max:255',
            'group_name'     => 'required|max:255',
            'school_shift_id'=> 'required|exists:school_shifts,id',
            'daily_presence_service_id' => 'required|exists:services,id',
            // 'is_can_create_presence' => 'required',
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

        $data = SchoolGroup::findOrFail($id);
        if($data->school_id !== $school_id) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'User anda tidak memiliki akses untuk mengubah data ini'
            ], 422);
        }

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
            'group_code'     => 'required|max:255',
            'group_name'     => 'required|max:255',
            'school_shift_id'=> 'required|exists:school_shifts,id',
            'daily_presence_service_id' => 'required|exists:services,id',
            // 'is_can_create_presence' => '',
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

        $data = $request->all();
        $data['school_id'] = Auth::user()->school_id;
        $store = SchoolGroup::create($data);

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

        SchoolGroup::query()
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
        SchoolGroup::query()
            ->where('school_id', Auth::user()->school_id)
            ->whereIn('id', $ids)
            ->delete();

        return response()->json([
          'status' =>'sukses',
          'message' => 'Data berhasil dihapus',
        ], 200);
    }
}
