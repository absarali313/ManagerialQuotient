<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Assessment Results: computed output of a completed assessment.
     *
     * assessment_results: one record per completed assessment.
     *   - total_score: weighted MQ score (0–100) using role/dept KPI weights.
     *   - raw_score: unweighted score for comparison.
     *   - performance_band: computed tier (excellent/good/average/below_average/poor).
     *
     * result_kpi_scores: per-KPI breakdown within a result.
     *   - Snapshot of the weight used at evaluation time — essential for audit integrity.
     *   - Powers the KPI breakdown charts (Section 6.1, 6.2).
     */
    public function up(): void
    {
        Schema::create('assessment_results', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Assessment::class)->unique()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\EvaluationCycle::class)->nullable()->constrained()->nullOnDelete();

            $table->decimal('total_score', 5, 2);              // weighted final MQ score 0–100
            $table->decimal('raw_score', 5, 2);                // unweighted raw score
            $table->decimal('benchmark_score', 5, 2)->nullable(); // org/industry benchmark at time of eval
            $table->enum('performance_band', ['excellent', 'good', 'average', 'below_average', 'poor'])->nullable();

            // AI-generated summary (Section 7.1 — AI Performance Summary)
            $table->text('ai_summary')->nullable();
            $table->decimal('ai_confidence', 5, 2)->nullable();

            $table->timestamps();

            $table->index(['user_id', 'created_at']);
            $table->index(['organization_id', 'evaluation_cycle_id']);
            $table->index(['organization_id', 'performance_band']);
        });

        Schema::create('result_kpi_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\AssessmentResult::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Kpi::class)->constrained()->cascadeOnDelete();
            $table->decimal('raw_score', 5, 2);
            $table->decimal('weighted_score', 5, 2);
            $table->unsignedTinyInteger('weight_applied');     // snapshot of weight at evaluation time
            $table->unsignedTinyInteger('max_score');          // snapshot of max possible score
            $table->timestamps();

            $table->unique(['assessment_result_id', 'kpi_id']);
            $table->index(['assessment_result_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('result_kpi_scores');
        Schema::dropIfExists('assessment_results');
    }
};
