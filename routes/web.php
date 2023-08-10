<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DashboardController;

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
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
        Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
        Route::get('booking/create', [BookingController::class, 'create'])->name('booking.create');
        Route::post('booking', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/drivers', [DriverController::class, 'index'])->name('drivers.index');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::prefix('autocomplete')->group(function () {
            Route::get('vehicles', [VehicleController::class, 'autocomplete'])->name('autocomplete.vehicles');
            Route::get('drivers', [DriverController::class, 'autocomplete'])->name('autocomplete.drivers');
            Route::get('users', [UserController::class, 'autocomplete'])->name('autocomplete.users');
        });
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::middleware(['role:employee,supervisor'])->group(function () {
        Route::get('/booking/{booking}/approve', [BookingController::class, 'approve'])->name('booking.approve');
        Route::get('/booking/{booking}/reject', [BookingController::class, 'reject'])->name('booking.reject');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
