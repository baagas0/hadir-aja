<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SchoolUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'student_number' => 'required|string',
            'password' => 'required|string',
            'device_id' => 'required|string',
        ]);
        
        $credentials = $request->only('student_number', 'password', 'device_id');

        $user = SchoolUser::where('student_number', $credentials['student_number'])
            ->where('student_number', $credentials['student_number'])
            ->first();
        
        if (
            $user->device_id !== $credentials['device_id'] && 
            !is_null($user->device_id)
        ) {
            return response()->json([
                'status' => 'gagal',
                'message' => 'Perangkat tidak valid!',
            ], 401);
        }
        
        if(!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'gagal',
                'message' => 'Kata sandi anda tidak valid!',
            ], 401);
        }

        $jwt = Auth::guard('api')->login($user);
        // dd($jwt);

        if (!$jwt) {
            return response()->json([
                'status' => 'gagal',
                'message' => 'Tidak dapat membuat otorisasi untuk anda.',
            ], 401);
        }
        
        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $jwt,
                'type' => 'bearer',
            ]
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'user' => Auth::guard('api')->user(),
            'authorisation' => [
                'token' => Auth::guard('api')->refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function me()
    {
        return response()->json([
            'status' => 'berhasil',
            'data' => Auth::guard('api')->user()
        ]);
    }
}
