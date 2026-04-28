<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Section 5.2 — Continuous Evaluation System
     *
     * Evaluation cycles define recurring assessment windows.
     * The Laravel scheduler reads active cycles and auto-generates
     * assessments for all eligible employees before each cycle starts.
     *
     * target_scope / target_scope_id: optionally restrict the cycle
     * to a specific department or team instead of the whole org.
     */
    public function up(): void
    {
        Schema::create('evaluation_cycles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class, 'created_by_user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');                            // e.g. "Q1 2026 Monthly Cycle"
            $table->text('description')->nullable();
            $table->enum('frequency', ['weekly', 'biweekly', 'monthly', 'quarterly', 'annual']);
            $table->date('starts_at');
            $table->date('ends_at')->nullable();

            // Optional scoping: restrict cycle to a sub-group
            $table->enum('target_scope', ['org', 'department', 'team'])->default('org');
            $table->unsignedBigInteger('target_scope_id')->nullable(); // dept_id or team_id

            // Assessment configuration for auto-generated assessments
            $table->unsignedTinyInteger('assessment_level')->default(1);      // 1, 2, or 3
            $table->unsignedSmallInteger('duration_minutes')->default(30);    // 30, 45, 60
            $table->unsignedSmallInteger('due_days_after_start')->default(7); // deadline window

            $table->enum('status', ['draft', 'scheduled', 'active', 'completed', 'cancelled'])->default('draft');
            $table->boolean('auto_generate')->default(true);   // trigger via scheduler

            // Execution metadata
            $table->unsignedInteger('assessments_generated')->default(0);
            $table->timestamp('last_generated_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['organization_id', 'status']);
            $table->index(['organization_id', 'starts_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluation_cycles');
    }
};
