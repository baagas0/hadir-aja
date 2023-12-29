<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SchoolUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Image;

class ProfileController extends Controller
{
    public function postSelfieImage(Request $request)
    {

        $png_url = "selfie-".time().".png";
        $path = public_path().'/image/selfie/' . $png_url;

        $success = file_put_contents($path, base64_decode($request->selfie_image_base64));
        
        $school_user_id = Auth::guard('api')->user()->id;
        SchoolUser::findOrFail($school_user_id)
            ->update([
                'selfie_img' => $png_url
            ]);

        return rApi(200, Auth::guard('api')->user());
    }
}
