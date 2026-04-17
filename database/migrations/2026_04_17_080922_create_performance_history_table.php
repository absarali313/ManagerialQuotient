<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Section 5.4 — Performance Timeline Tracking
     *
     * A snapshot is written here after every completed assessment result.
     * This table is the source of truth for the Chart.js timeline visualization
     * on both the Employee Growth Dashboard (6.1) and Manager Dashboard (6.2).
     *
     * score_delta: change vs the employee's previous snapshot — used by the
     * alert system (Section 5.6) and trend engine.
     *
     * kpi_snapshot: JSON map of {kpi_slug: weighted_score} at this point in time.
     * Stored here so timeline charts don't need to re-join result_kpi_scores.
     */
    public function up(): void
    {
        Schema::create('performance_history', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\AssessmentResult::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\EvaluationCycle::class)->nullable()->constrained()->nullOnDelete();

            $table->decimal('mq_score', 5, 2);                // MQ score at this point in time
            $table->decimal('score_delta', 5, 2)->default(0); // change vs previous snapshot
            $table->json('kpi_snapshot')->nullable();          // {kpi_slug: weighted_score, ...}
            $table->enum('trend', ['improving', 'declining', 'stable'])->nullable();
            $table->enum('performance_band', ['excellent', 'good', 'average', 'below_average', 'poor'])->nullable();
            $table->date('recorded_on');                       // date the snapshot was taken

            $table->timestamps();

            $table->index(['user_id', 'recorded_on']);
            $table->index(['organization_id', 'recorded_on']);
            $table->index(['user_id', 'trend']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_history');
    }
};
