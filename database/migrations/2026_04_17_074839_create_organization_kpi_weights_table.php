<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Section 5.1 — Dynamic KPI Weighting System
     *
     * Allows organizations to assign different KPI weights per role.
     * Weight is a percentage (1–100); weights for a role should ideally sum to 100.
     *
     * Scope hierarchy:
     *   job_role  → most specific (takes precedence)
     *   department → fallback if no role-level weight exists
     *   organization → global fallback
     *
     * The weighted scoring formula applied during evaluation:
     *   weighted_kpi_score = (raw_score / max_score) * weight
     *   total_mq_score = SUM(weighted_kpi_scores) / SUM(active_weights) * 100
     */
    public function up(): void
    {
        Schema::create('kpi_weights', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Kpi::class)->constrained()->cascadeOnDelete();

            // Scope: which entity does this weight apply to?
            $table->enum('scope', ['organization', 'department', 'job_role']);
            $table->unsignedBigInteger('scope_id')->nullable(); // dept_id or job_role_id; null = org-wide

            $table->unsignedTinyInteger('weight');             // 1–100
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // One weight entry per KPI per scope target
            $table->unique(['organization_id', 'kpi_id', 'scope', 'scope_id']);
            $table->index(['organization_id', 'scope', 'scope_id']);
            $table->index(['organization_id', 'kpi_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpi_weights');
    }
};
