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

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/home', function () {
    return redirect()->route('dashboard');
});

Auth::routes();



Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    routeController('school-location', 'SchoolLocationController');
    routeController('school-position', 'SchoolPositionController');
    routeController('school-group', 'SchoolGroupController');
    routeController('school-shift', 'SchoolShiftController');
    routeController('school-calendar', 'SchoolCalendarController');
    
    routeController('presence-daily', 'PresenceDailyController');
    routeController('presence-class', 'PresenceClassController');
    
    routeController('billing-invoice', 'BillingInvoiceController');
    routeController('billing-history', 'BillingHistoryController');
    
    routeController('school', 'SchoolController');
    routeController('services', 'ServicesController');
    routeController('packages', 'PackagesController');
    
    routeController('user', 'UserController');
    routeController('role', 'RoleController');
    routeController('school-role-group', 'SchoolRoleGroupController'); // Akhir Aja

});