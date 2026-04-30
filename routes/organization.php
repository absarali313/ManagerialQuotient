<?php

use App\Http\Controllers\ComingSoonController;
use App\Http\Controllers\OrgDashboardController;
use App\Http\Controllers\OrgDepartmentController;
use App\Http\Controllers\OrgEmployeeController;
use App\Http\Controllers\OrgEmployeeRankingController;
use App\Http\Controllers\OrgTeamController;
use App\Livewire\Org\AssessmentsIndex;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {

    // ── Dashboard ────────────────────────────────────────────────────────────
    Route::get('org-dashboard', [OrgDashboardController::class, 'index'])
        ->name('org-dashboard');

    // ── Main ─────────────────────────────────────────────────────────────────
    Route::controller(OrgEmployeeController::class)->group(function () {
        Route::get('org-employees', 'index')->name('org-employees');
        Route::get('org-employees/create', 'create')->name('org_employees_create');
        Route::get('org-employees/{employee}/edit', 'edit')->name('org_employees_edit');
    });
    Route::get('org-rankings', [OrgEmployeeRankingController::class, 'index'])
        ->name('org-rankings');
    Route::controller(OrgDepartmentController::class)->group(function () {
        Route::get('org-departments', 'index')->name('org_departments');
        Route::get('org-departments/create', 'create')->name('org_departments_create');
        Route::get('org-departments/{department}/edit', 'edit')->name('org_departments_edit');
    });
    Route::controller(OrgTeamController::class)->group(function () {
        Route::get('org-teams', 'index')->name('org_teams');
        Route::get('org-teams/create', 'create')->name('org_teams_create');
        Route::get('org-teams/{team}/edit', 'edit')->name('org_teams_edit');
    });

    // ── Intelligence ─────────────────────────────────────────────────────────
    Route::get('org-assessments', AssessmentsIndex::class)->name('org-assessments');
    //    Route::get('org-employees', ComingSoonController::class)->name('org-employees');
    Route::get('org-ai-insights', ComingSoonController::class)->name('org-ai-insights');

    // ── System ───────────────────────────────────────────────────────────────
    Route::get('org-reports', ComingSoonController::class)->name('org-reports');
    Route::get('org-notifications', ComingSoonController::class)->name('org-notifications');
    Route::get('org-settings', ComingSoonController::class)->name('org-settings');
});
