<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Section 5.3 — Employee Ranking System
     * Section 8.3 — Talent Leaderboard
     *
     * Cached ranking records rebuilt after every evaluation cycle completes.
     * Orders employees within a given scope (team / department / org)
     * by their current MQ score.
     *
     * scope_id interpretation:
     *   team         → teams.id
     *   department   → departments.id
     *   org → null (org-wide ranking)
     */
    public function up(): void
    {
        Schema::create('employee_rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\EvaluationCycle::class)->nullable()->constrained()->nullOnDelete();

            $table->enum('scope', ['team', 'department', 'org']);
            $table->unsignedBigInteger('scope_id')->nullable(); // team_id or dept_id; null = org-wide

            $table->unsignedInteger('rank');                   // position within scope (1 = top)
            $table->unsignedInteger('total_in_scope');         // total ranked employees in this scope
            $table->decimal('mq_score', 5, 2);
            $table->decimal('percentile', 5, 2)->nullable();   // e.g. 90.5 = top 9.5%
            $table->enum('performance_band', ['excellent', 'good', 'average', 'below_average', 'poor'])->nullable();
            $table->date('ranked_on');

            $table->timestamps();

            // Primary lookup: load rankings for a scope at a given date
            $table->index(['organization_id', 'scope', 'scope_id', 'ranked_on']);
            // Employee-centric lookup: all ranking history for one user
            $table->index(['user_id', 'scope', 'ranked_on']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_rankings');
    }
};
