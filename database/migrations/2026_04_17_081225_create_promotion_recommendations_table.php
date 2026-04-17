<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Section 5.5 — Promotion Recommendation Engine
     * Section 7.2 — AI Promotion Prediction
     * Section 8.5 — Promotion Readiness Score
     *
     * Rule-based engine evaluates three gates per cycle:
     *   1. threshold_met    → employee's score >= configured threshold for current role
     *   2. consistency_met  → score has been above threshold for N consecutive cycles
     *   3. trend_positive   → latest trend is "improving" or "stable"
     *
     * readiness values map directly to Section 8.5:
     *   ready        → all 3 gates passed
     *   potential    → 2/3 gates passed
     *   not_ready    → 1 or fewer gates passed
     *
     * The AI layer (Section 7.2) can optionally override or supplement the
     * rule-based result, writing ai_reasoning and ai_confidence.
     */
    public function up(): void
    {
        Schema::create('promotion_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\EvaluationCycle::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\JobRole::class, 'current_job_role_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\JobRole::class, 'target_job_role_id')->nullable()->constrained()->nullOnDelete();

            // Rule engine output
            $table->enum('readiness', ['ready', 'potential', 'not_ready']);
            $table->decimal('score_at_evaluation', 5, 2);
            $table->enum('trend', ['improving', 'stable', 'declining']);
            $table->boolean('consistency_met');
            $table->boolean('threshold_met');
            $table->json('rule_results')->nullable();           // {gate: passed, detail: ...}[]

            // AI layer (Section 7.2)
            $table->boolean('is_ai_generated')->default(false);
            $table->text('ai_reasoning')->nullable();
            $table->decimal('ai_confidence', 5, 2)->nullable(); // 0–100

            // HR decision
            $table->enum('hr_decision', ['approved', 'rejected', 'pending'])->default('pending');
            $table->foreignIdFor(\App\Models\User::class, 'reviewed_by_user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->text('hr_notes')->nullable();               // reviewer's comments

            $table->timestamps();

            $table->index(['user_id', 'readiness']);
            $table->index(['organization_id', 'readiness', 'hr_decision'], 'promo_recs_org_readiness_hr_idx');
            $table->index(['evaluation_cycle_id', 'readiness']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotion_recommendations');
    }
};
