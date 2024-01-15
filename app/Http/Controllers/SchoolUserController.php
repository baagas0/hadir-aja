<?php

namespace App\Http\Controllers;

use App\Models\SchoolGroup;
use App\Models\SchoolLocation;
use App\Models\SchoolPosition;
use App\Models\SchoolUser;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SchoolUserController extends Controller
{
    public function getIndex()
    {
        $data = [];
        $data['school_groups'] = SchoolGroup::get();
        $data['school_positions'] = SchoolPosition::get();
        $data['school_locations'] = SchoolLocation::get();

        return view('school-user.index', $data);
    }

    public function getData(Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');

        $search = $request->get('search')['value'];

        $columns = SchoolUser::COLUMNS;

        $data = SchoolUser::query()
            ->when(!is_null($search), function ($query) use ($columns, $search) {
                foreach ($columns as $key => $column) {
                    if($key === 0) $query->where($column, 'like', '%'. $search. '%');
                    else $query->orWhere($column, 'like', '%'. $search. '%');
                }
                return $query;
            })
            ->with('school_group', 'school_position', 'school_location')
            ->skip($start)
            ->take($length)
            ->get();
        $count = SchoolUser::query()
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
        $data = SchoolUser::query()
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
            'student_number'     => 'required|max:255',
            'student_name'     => 'required|max:255',
            'gender'     => 'required|max:255',
            'email'     => 'required|max:255',
            'phone_number'     => 'required|max:255',
            'birth_date'     => 'required|max:255',
            'school_group_id'=> 'required|exists:school_groups,id',
            'school_position_id'=> 'required|exists:school_positions,id',
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

        $data = SchoolUser::findOrFail($id);
        if($data->school_id !== $school_id) {
            return response()->json([
                'status' => 'gagal',
                'message' =>  'User anda tidak memiliki akses untuk mengubah data ini'
            ], 422);
        }

        $payload = $request->all();
        if ($request->is_all_location_presence) $payload['is_all_location_presence'] = 1;
        else $payload['is_all_location_presence'] = 0;

        if($request->password) {
            $payload['password'] = bcrypt($request->password);
        } else {
            unset($payload['password']);
        }

        $update = $data->update($payload);

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
            'student_number'     => 'required|max:255',
            'student_name'     => 'required|max:255',
            'gender'     => 'required|max:255',
            'email'     => 'required|max:255',
            'phone_number'     => 'required|max:255',
            'birth_date'     => 'required|max:255',
            'password'     => 'required|max:255',
            'school_group_id'=> 'required|exists:school_groups,id',
            'school_position_id'=> 'required|exists:school_positions,id',
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
        $data['password'] = bcrypt($request->password ?? 123456);
        $store = SchoolUser::create($data);

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

        SchoolUser::query()
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
        SchoolUser::query()
            ->where('school_id', Auth::user()->school_id)
            ->whereIn('id', $ids)
            ->delete();

        return response()->json([
          'status' =>'sukses',
          'message' => 'Data berhasil dihapus',
        ], 200);
    }
}
