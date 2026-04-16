<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::view('/', 'welcome');

Route::get('dashboard', function () {
    $users = \App\Models\User::with('assessments')->get();
    return view('dashboard', compact('users'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('assessment', 'assessment-room')
    ->middleware(['auth', 'verified'])
    ->name('assessment');

Route::get('hub', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    return view('hub', compact('user'));
})->middleware(['auth', 'verified'])->name('hub');

Route::get('cycles', function () {
    $users = \App\Models\User::with('assessments')->get();
    return view('cycles', compact('users'));
})->middleware(['auth', 'verified'])->name('cycles');

Route::view('goals', 'goals')
    ->middleware(['auth', 'verified'])
    ->name('goals');

require __DIR__.'/auth.php';
