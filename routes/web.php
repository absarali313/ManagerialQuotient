<?php

use App\Http\Controllers\FeaturesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('features', [FeaturesController::class, 'index'])->name('features_page');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
