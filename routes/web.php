<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('assessment', 'assessment-room')
    ->middleware(['auth', 'verified'])
    ->name('assessment');

Route::view('hub', 'hub')
    ->middleware(['auth', 'verified'])
    ->name('hub');

Route::view('cycles', 'cycles')
    ->middleware(['auth', 'verified'])
    ->name('cycles');

Route::view('goals', 'goals')
    ->middleware(['auth', 'verified'])
    ->name('goals');

require __DIR__.'/auth.php';
