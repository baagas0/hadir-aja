<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('me', 'me');
});

Route::group(['as' => 'api.', 'prefix' => '', 'middleware' => 'auth:api'], function () {
    routeController('profile', 'API\ProfileController');
    routeController('daily-presence', 'API\DailyPresenceController');
    routeController('presence', 'API\PresenceController');

    routeController('presence-barcode', 'API\PresenceBarcodeController');
});

routeController('tripay', 'API\CallbackController');
// Route::post('tripay/callback', 'API\CallbackController');
