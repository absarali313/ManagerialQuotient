<?php

use App\Livewire\Org\AssessmentsIndex;
use App\Http\Controllers\OrgDashboardController;
use App\Http\Controllers\ComingSoonController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'organization'])->group(function () {

    // ── Dashboard ────────────────────────────────────────────────────────────
    Route::get('org-dashboard', [OrgDashboardController::class, 'index'])
        ->name('org-dashboard');

    // ── Main ─────────────────────────────────────────────────────────────────
    Route::get('org-employees', [\App\Http\Controllers\OrgEmployeeController::class, 'index'])
        ->name('org-employees');
    Route::get('org-departments', ComingSoonController::class)->name('org-departments');

    // ── Intelligence ─────────────────────────────────────────────────────────
    Route::get('org-assessments', AssessmentsIndex::class)->name('org-assessments');
    Route::get('org-rankings', ComingSoonController::class)->name('org-rankings');
    Route::get('org-ai-insights', ComingSoonController::class)->name('org-ai-insights');

    // ── System ───────────────────────────────────────────────────────────────
    Route::get('org-reports', ComingSoonController::class)->name('org-reports');
    Route::get('org-notifications', ComingSoonController::class)->name('org-notifications');
    Route::get('org-settings', ComingSoonController::class)->name('org-settings');
});
