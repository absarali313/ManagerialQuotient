<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('login');
    
    // Unified login component handles register and forgot password through state,
    // so we can optionally route everything here or just use /login.
    Route::get('register', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('register');

    // Google Socialite endpoints
    Route::get('auth/google', [\App\Http\Controllers\Auth\GoogleLoginController::class, 'redirect'])->name('auth_google');
    Route::get('auth/google/callback', [\App\Http\Controllers\Auth\GoogleLoginController::class, 'callback'])->name('auth_google_callback');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification_notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification_verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password_confirm');
});
