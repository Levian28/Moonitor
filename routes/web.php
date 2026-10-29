<?php

use App\Http\Controllers\Auth\ForgotPinController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/forgot-pin', [ForgotPinController::class, 'showRequestForm'])->name('pin.forgot');
    Route::post('/forgot-pin', [ForgotPinController::class, 'sendLink'])
        ->middleware('throttle:5,1')->name('pin.email');

    Route::get('/reset-pin/{token}', [ForgotPinController::class, 'showResetForm'])->name('pin.reset');
    Route::post('/reset-pin', [ForgotPinController::class, 'reset'])
        ->middleware('throttle:5,1')->name('pin.update');
});

Route::middleware('auth')->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
