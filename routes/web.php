<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('vehicles', VehicleController::class);
        Route::resource('booking', BookingController::class);
    });
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/{booking}/approve', [BookingController::class, 'approve'])->name('booking.approve');
    Route::get('/booking/{booking}/reject', [BookingController::class, 'reject'])->name('booking.reject');
    Route::resource('drivers', DriverController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //autocomplete
    Route::prefix('autocomplete')->group(function () {
        Route::get('vehicles', [VehicleController::class, 'autocomplete'])->name('autocomplete.vehicles');
        Route::get('drivers', [DriverController::class, 'autocomplete'])->name('autocomplete.drivers');
        Route::get('users', [UserController::class, 'autocomplete'])->name('autocomplete.users');
    });
});

require __DIR__ . '/auth.php';
