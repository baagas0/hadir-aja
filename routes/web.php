<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('', function () {
    dd('route kosong');
    return redirect()->route('presence-dashboard');
});

Route::get('/', function () {
    // dd('route /');
    return redirect()->route('presence-dashboard');
});
Route::get('/home', function () {
    // dd('route home');
    return redirect()->route('presence-dashboard');
});

Route::get('/tes', function () {
    dd('tttttttessss');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    // Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    routeController('presence-dashboard', 'DashboardController');

    routeController('school-location', 'SchoolLocationController');
    routeController('school-position', 'SchoolPositionController');
    routeController('school-group', 'SchoolGroupController');
    routeController('school-shift', 'SchoolShiftController');
    routeController('school-calendar', 'SchoolCalendarController');

    routeController('school-users', 'SchoolUserController');

    routeController('presence-daily', 'PresenceDailyController');
    routeController('presence-barcode', 'PresenceBarcodeController');

    routeController('billing-invoice', 'BillingInvoiceController');
    routeController('billing-history', 'BillingHistoryController');

    routeController('school', 'SchoolController');
    routeController('services', 'ServicesController');
    routeController('packages', 'PackagesController');

    routeController('user', 'UserController');
    routeController('role', 'RoleController');
    routeController('school-role-group', 'SchoolRoleGroupController'); // Akhir Aja

    routeController('payment', 'PaymentController');
    routeController('checkout', 'CheckoutController');
});
