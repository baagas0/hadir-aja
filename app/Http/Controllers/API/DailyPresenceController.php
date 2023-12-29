<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PresenceDaily;
use Carbon\Carbon;
use CURLFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        
        if(!$presence) return rApi(400, (object) [], 'Data presensi hari ini tidak ditemukan.');

        return rApi(200, $presence, 'Data presensi ditemukan');
    }

    public function postIn(Request $request) {
        $presence_daily_id = $request->presence_daily_id;
        $base64_selfie_img = base64_decode($request->base64_selfie_img);

        $presence = PresenceDaily::findOrFail($presence_daily_id);
        $user = Auth::guard('api')->user();

        // CEK LOKASI

        // post request with attachment
        $saved_selfie_img = public_path().'/image/selfie/'.$user->selfie_img;

        // NEW SELFIE
        $new_selfie_img = time()." $presence_daily_id in base64_selfie_img.png";
        $path_new_selfie_img = public_path().'/image/selfie-presence/' . $new_selfie_img;
        file_put_contents($path_new_selfie_img, $base64_selfie_img);

        $face_matching = $this->face_matching($saved_selfie_img, $path_new_selfie_img);
        if(!isset($face_matching->data->match) || $face_matching->data->match === false) return rApi(500, (object)[], "Wajah tidak sama! {$face_matching->data->error_procentage}");
        
        $presence->update([
            'attachment_in' => $new_selfie_img,
            'face_match_in_response' => $face_matching,
            'hour_in' => Carbon::now()->format('H:i:s'),
            'lat_in' => $request->lat,
            'long_in' => $request->lng,
        ]);

        return rApi(200, PresenceDaily::findOrFail($presence_daily_id), 'Presensi masuk telah berhasil.');
    }

    public function face_matching ($relative_path_file_1, $relative_path_file_2) {
        // TO RUN SERVER *python flask_server.py*
        $url = 'http://192.168.100.150:8080';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/face_match",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('file1'=> new CURLFILE($relative_path_file_1),'file2'=> new CURLFILE($relative_path_file_2)),
            CURLOPT_HTTPHEADER => array(
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
}
