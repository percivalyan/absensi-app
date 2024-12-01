<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectUserController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\NotificationController;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


Route::middleware('auth')->group(function () {
    Route::middleware('role:admin,operator')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        // positions
        Route::resource('/positions', PositionController::class)->only(['index', 'create']);
        Route::get('/positions/edit', [PositionController::class, 'edit'])->name('positions.edit');
        // employees
        Route::resource('/employees', EmployeeController::class)->only(['index', 'create']);
        Route::get('/employees/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        // holidays (hari libur)
        Route::resource('/holidays', HolidayController::class)->only(['index', 'create']);
        Route::get('/holidays/edit', [HolidayController::class, 'edit'])->name('holidays.edit');
        // attendances (absensi)
        Route::resource('/attendances', AttendanceController::class)->only(['index', 'create']);
        Route::get('/attendances/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');

        // presences (kehadiran)
        Route::resource('/presences', PresenceController::class)->only(['index']);
        Route::get('/presences/qrcode', [PresenceController::class, 'showQrcode'])->name('presences.qrcode');
        Route::get('/presences/qrcode/download-pdf', [PresenceController::class, 'downloadQrCodePDF'])->name('presences.qrcode.download-pdf');
        Route::get('/presences/{attendance}', [PresenceController::class, 'show'])->name('presences.show');
        // not present data
        Route::get('/presences/{attendance}/not-present', [PresenceController::class, 'notPresent'])->name('presences.not-present');
        Route::post('/presences/{attendance}/not-present', [PresenceController::class, 'notPresent']);
        // present (url untuk menambahkan/mengubah user yang tidak hadir menjadi hadir)
        Route::post('/presences/{attendance}/present', [PresenceController::class, 'presentUser'])->name('presences.present');
        Route::post('/presences/{attendance}/acceptPermission', [PresenceController::class, 'acceptPermission'])->name('presences.acceptPermission');
        // employees permissions

        Route::get('/presences/{attendance}/permissions', [PresenceController::class, 'permissions'])->name('presences.permissions');


        Route::resource('subjects', SubjectController::class);

        Route::get('subject-user', [SubjectUserController::class, 'index'])->name('subject_user.index');
        Route::get('subject-user/create', [SubjectUserController::class, 'create'])->name('subject_user.create');
        Route::post('subject-user', [SubjectUserController::class, 'store'])->name('subject_user.store');
        Route::get('subject-user/{id}/edit', [SubjectUserController::class, 'edit'])->name('subject_user.edit');
        Route::put('subject-user/{id}', [SubjectUserController::class, 'update'])->name('subject_user.update');
        Route::delete('subject-user/{id}', [SubjectUserController::class, 'destroy'])->name('subject_user.destroy');
        Route::get('subject-user/{id}', [SubjectUserController::class, 'show'])->name('subject_user.show');

        Route::view('/dashboard/notification', 'dashboard.notification');
        Route::view('/dashboard/account', 'dashboard.account');
    });

    Route::middleware('role:user')->name('home.')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::post('/absensi/qrcode', [HomeController::class, 'sendEnterPresenceUsingQRCode'])->name('sendEnterPresenceUsingQRCode');
        Route::post('/absensi/qrcode/out', [HomeController::class, 'sendOutPresenceUsingQRCode'])->name('sendOutPresenceUsingQRCode');

        Route::get('/absensi/{attendance}', [HomeController::class, 'show'])->name('show');
        Route::get('/absensi/{attendance}/permission', [HomeController::class, 'permission'])->name('permission');
        Route::get('/employees/password', [EmployeeController::class, 'editPassword'])->name('employees.editPassword');
        Route::post('/employees/password', [EmployeeController::class, 'updatePassword'])->name('employees.updatePassword');
        Route::view('/home/notification', 'home.notification');
        Route::view('/home/account', 'home.account');
        Route::view('/home/absensi', 'home.absensi');
    });


    Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware('guest')->group(function () {
    // auth
    Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::get('/subject-users2', [SubjectUserController::class, 'index2'])->name('subject_user.index2');
// PresensiController
Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
Route::get('/manajemen', [ManajemenController::class, 'index'])->name('manajemen.index');
