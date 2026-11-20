<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/detail/{tour:slug}', [WelcomeController::class, 'show'])->name('tours.detail');
Route::post('/booking', [BookingController::class, 'storePublic'])->name('booking.store');
Route::get('/booking/success/{bookingCode}', [BookingController::class, 'success'])->name('booking.success');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');
    
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('tours')->group(function () { 
        Route::get('/', [TourController::class, 'index'])->name('tours.index');
        Route::get('/create', [TourController::class, 'create'])->name('tours.create');
        Route::post('/', [TourController::class, 'store'])->name('tours.store');
        Route::get('/{tour}', [TourController::class, 'show'])->name('tours.show');
        Route::get('/{tour}/edit', [TourController::class, 'edit'])->name('tours.edit');
        Route::put('/{tour}', [TourController::class, 'update'])->name('tours.update');
        Route::delete('/{tour}', [TourController::class, 'destroy'])->name('tours.destroy');
    });

    Route::prefix('bookings')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('/{booking}', [BookingController::class, 'show'])->name('bookings.show');
        Route::get('/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::put('/{booking}', [BookingController::class, 'update'])->name('bookings.update');
        Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });
});

require __DIR__.'/auth.php';
