<?php

namespace App\Http\Controllers;

use App\Models\PresenceBarcodeSchoolUser;
use App\Models\PresenceDaily;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getIndex()
    {
        $data = [];
        // dd('cel');
        $data['presence_daily_today_count'] = PresenceDaily::whereDate('presence_date', Carbon::today())->whereIn('state', [ 'masuk', 'pulang' ])->count();
        $data['presence_barcode_today_count'] = PresenceBarcodeSchoolUser::whereHas('presence_barcode', function($q) {
            return $q->whereDate('date', Carbon::today());
        })->count();

        $data['presence_daily_today_monthly'] = PresenceDaily::whereMonth('presence_date', Carbon::now()->format('m'))
            ->whereYear('presence_date', Carbon::now()->format('Y'))
            ->whereIn('state', [ 'masuk', 'pulang' ])
            ->count();

        $data['presence_barcode_today_monthly'] = PresenceBarcodeSchoolUser::whereHas('presence_barcode', function($q) {
            return $q->whereMonth('date', Carbon::now()->format('m'))
            ->whereYear('date', Carbon::now()->format('Y'));
        })->count();

        // dd($data);
        return view('dashboard.dashboard', $data);
    }
}
