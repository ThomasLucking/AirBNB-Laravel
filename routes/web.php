<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/apartments', function () {
    return view('apartments');
})->name('apartment.create');

Route::get('/allapartments', [ApartmentController::class, 'index'])->name('apartment.all');


Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartment.show');


Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroySession'])->name('logout');
    Route::post('/apartments', [ApartmentController::class, 'store'])->name('apartment.store');
    Route::post('/storebooking/{apartment}', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('booking.cancel');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
});

