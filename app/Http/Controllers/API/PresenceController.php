<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PresenceDaily;
use App\Models\SchoolBillingQuotaTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function getHistory(Request $request) {
        $limit = $request->get('limit') ?? 10;

        $user = Auth::guard('api')->user();
        // $month_year = Carbon::parse($request->get('month_year'));
        // return rApi(200, [$month_year->format('m'),  $month_year->format('Y')]);

        $data = SchoolBillingQuotaTransaction::where('school_user_id', $user->id)
        ->when($request->get('month_year'), function($q) use ($request) {
            $month_year = Carbon::parse($request->get('month_year'));

            return $q->whereMonth('datetime', $month_year->format('m'))
            ->whereYear('datetime', $month_year->format('Y'));
        })
        ->with('daily_presence', 'barcode_presence', 'barcode_presence.presence_barcode')
        ->limit($limit)
        ->orderBy('datetime', 'DESC')
        ->get()
        ->map(function($map) {
            if ($map->ref_table == 'presence_dailies') {
                $map->presence = (object) [
                    'day' => $map->daily_presence->day,
                    'actual_hour_in' => $map->daily_presence->actual_hour_in,
                    'actual_hour_out' => $map->daily_presence->actual_hour_out,
                    'actual_duration' => $map->daily_presence->actual_duration,
                    'presence_date' => $map->daily_presence->presence_date,
    
                    'attachment' => $map->daily_presence["attachment_{$map->type}"],
                    'face_match_response' => $map->daily_presence["face_match_{$map->type}_response"],
                    'hour' => $map->daily_presence["hour_{$map->type}"],
                    'lat' => $map->daily_presence["lat_{$map->type}"],
                    'long' => $map->daily_presence["long_{$map->type}"],
                ];
            } else if ($map->ref_table == 'presence_barcode_school_users') {
                $map->presence = (object) [
                    'day' => $map->barcode_presence->presence_barcode->day,
                    'actual_hour_in' => $map->barcode_presence->presence_barcode->actual_hour_in,
                    'actual_hour_out' => $map->barcode_presence->presence_barcode->actual_hour_out,
                    'actual_duration' => $map->barcode_presence->presence_barcode->actual_duration,
                    'presence_date' => $map->barcode_presence->presence_barcode->date,
    
                    'attachment' => '',
                    'face_match_response' => '',
                    'hour' => $map->barcode_presence["hour_{$map->type}"],
                    'lat' => '',
                    'long' => '',
                ];
            }

            return $map;
        });

        return rApi(200, $data, 'Berhasil');

    }
}
