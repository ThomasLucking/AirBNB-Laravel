<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');


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

Route::post('/logout', [LoginController::class, 'destroySession'])->middleware('auth')->name('logout');


