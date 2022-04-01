<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ConsultingRoomController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\MedicalServiceController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\HealthInsuranceCardController;
use App\Http\Controllers\HealthCertificationController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ServiceVoucherController;
use App\Http\Controllers\ServiceVoucherDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CashierHealthCertificationController;
use App\Http\Controllers\CashierServiceVoucherController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WebController::class, 'index'])->name('home');


Route::middleware(['website'])->group(function () {
	Route::post('/dat-thue-phong/{id}', [WebController::class, 'booking'])->name('web.booking');
	Route::post('/dang-xuat', [WebController::class, 'logout'])->name('web.logout');
	Route::get('/thong-tin-ca-nhan', [WebController::class, 'profile'])->name('web.profile');
	Route::get('/cap-nhat-thong-tin-ca-nhan', [WebController::class, 'changeProfile'])->name('web.change-profile');
	Route::post('/cap-nhat-thong-tin-ca-nhan/{id}', [WebController::class, 'postChangeProfile'])->name('web.post-change-profile');
	Route::get('/doi-mat-khau', [WebController::class, 'changePassword'])->name('web.change-password');
	Route::post('/doi-mat-khau/{id}', [WebController::class, 'postChangePassword'])->name('web.post-change-password');
	Route::get('/thong-tin-dat-thue-phong', [WebController::class, 'infoBooking'])->name('web.info-booking');
	Route::post('/huy-dat-thue-phong/{id}', [WebController::class, 'cancelAppointment'])->name('web.cancel-appointment');
});
	Route::get('/chi-tiet-phong/{id}', [WebController::class, 'roomDetail'])->name('web.room-detail');

Route::middleware(['guest_website'])->group(function () {
	Route::get('/dang-nhap', [WebController::class, 'login'])->name('web.login');
	Route::post('/dang-nhap', [WebController::class, 'postLogin'])->name('web.post-login');
	Route::get('/dang-ky', [WebController::class, 'register'])->name('web.register');
	Route::post('/dang-ky', [WebController::class, 'postRegister'])->name('web.post-register');
});







// Admin
Route::prefix('admin')->group(function () {
	Route::get('/', function () {
	    return redirect()->route('login');
	});
	Route::middleware(['auth'])->group(function () {
		Route::resource('rooms', RoomController::class);
		Route::resource('customers', CustomerController::class);
		Route::resource('bookings', BookingController::class);
		Route::post('/bookings/approve-booking/{id}', [BookingController::class, 'approveBooking'])->name('bookings.approve-booking');
		Route::post('/bookings/cancel-appointment/{id}', [BookingController::class, 'cancelAppointment'])->name('bookings.cancel-appointment');

		Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

		Route::resource('users', UserController::class);
		Route::get('/users/view-change-password/{user}', [UserController::class, 'viewChangePassword'])->name('users.view-change-password');
		Route::post('/users/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');

		Route::resource('roles', RoleController::class);
		Route::resource('permissions', PermissionController::class);
	});
	require __DIR__.'/auth.php';
});

