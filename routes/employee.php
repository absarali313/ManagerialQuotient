<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComingSoonController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'employee'])->group(function () {

    // ── Dashboard ────────────────────────────────────────────────────────────
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ── Main ─────────────────────────────────────────────────────────────────
    Route::get('employees', ComingSoonController::class)->name('employees');
    Route::get('departments', ComingSoonController::class)->name('departments');

    // ── Intelligence ─────────────────────────────────────────────────────────
    Route::get('assessments', ComingSoonController::class)->name('assessments');
    Route::get('rankings', ComingSoonController::class)->name('rankings');
    Route::get('ai-insights', ComingSoonController::class)->name('ai-insights');

    // ── System ───────────────────────────────────────────────────────────────
    Route::get('reports', ComingSoonController::class)->name('reports');
    Route::get('notifications', ComingSoonController::class)->name('notifications');
    Route::get('settings', ComingSoonController::class)->name('settings');
});
