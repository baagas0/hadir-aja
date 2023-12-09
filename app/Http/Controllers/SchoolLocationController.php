<?php

namespace App\Http\Controllers;

use App\Models\SchoolLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SchoolLocationController extends Controller
{
    public function getIndex()
    {
        return view('school-location.index');
    }

    public function getData(Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');

        $search = $request->get('search')['value'];

        $columns = SchoolLocation::COLUMNS;

        $data = SchoolLocation::query()
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
        $count = SchoolLocation::query()
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
        $data = SchoolLocation::query()
            ->where('id', $request->get('id'))
            ->first();

        return response()->json([
            'message' => 'Berhasil',
            'data' => $data,
        ]);
    }

    public function postUpdate(Request $request, $id) {

    }

    public function postStore(Request $request) {
        $validation = Validator::make($request->all(), [
            // 'school_id'         => 'required',
            'title'             => 'required|max:255',
            'address'           => 'required',
            'lat'               => 'required|numeric',
            'long'              => 'required|numeric',
            'radius_distance'   => 'required|numeric',
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
        $store = SchoolLocation::create($data);

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

        SchoolLocation::query()
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
        SchoolLocation::query()
            ->where('school_id', Auth::user()->school_id)
            ->whereIn('id', $ids)
            ->delete();

        return response()->json([
          'status' =>'sukses',
          'message' => 'Data berhasil dihapus',
        ], 200);
    }
}
