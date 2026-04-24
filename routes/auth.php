<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('login');
    Route::get('register', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('register');
    Route::get('forgot-password', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('password.request');
    Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('password.reset');

    // Google Socialite endpoints
    Route::get('auth/google', [\App\Http\Controllers\Auth\GoogleLoginController::class, 'redirect'])->name('auth_google');
    Route::get('auth/google/callback', [\App\Http\Controllers\Auth\GoogleLoginController::class, 'callback'])->name('auth_google_callback');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('logout', [\App\Http\Controllers\Auth\LogoutController::class, 'destroy'])
        ->name('logout');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});
