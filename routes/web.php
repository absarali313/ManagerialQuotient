<?php

use App\Http\Controllers\Marketing\FeaturesController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('features', [FeaturesController::class, 'index'])->name('marketing.features');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
