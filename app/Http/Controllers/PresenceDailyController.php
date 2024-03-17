<?php

namespace App\Http\Controllers;

use App\Models\PresenceDaily;
use Illuminate\Http\Request;

class PresenceDailyController extends Controller
{
    public function getIndex()
    {
        return view('presence-daily.index');
    }

    public function getData(Request $request)
    {
        $start = $request->get('start');
        $length = $request->get('length');

        $search = $request->get('search')['value'];

        $columns = PresenceDaily::COLUMNS;

        $data = PresenceDaily::query()
            ->when(!is_null($search), function ($query) use ($columns, $search) {
                foreach ($columns as $key => $column) {
                    if($key === 0) $query->where($column, 'like', '%'. $search. '%');
                    else $query->orWhere($column, 'like', '%'. $search. '%');
                }
                return $query;
            })
            ->with('school_user')
            ->orderBy('presence_date', 'desc')
            ->skip($start)
            ->take($length)
            ->get();
        $count = PresenceDaily::query()
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

    public function postPermit(Request $request)
    {
        $id = $request->id;

        PresenceDaily::find($id)
            ->update([
                'status' => 'izin',
            ]);

        return true;
    }
}
