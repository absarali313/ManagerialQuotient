<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Section 7.1 — AI Performance Summary
     * Section 7.3 — AI Skill Gap Detection
     * Section 7.4 — AI Risk Detection
     *
     * ai_insights: stores AI-generated analysis outputs per employee per cycle.
     *
     * insight_type:
     *   performance_summary → natural-language MQ score interpretation
     *   skill_gap           → identified missing competencies vs role requirements
     *   risk_flag           → early warning of underperformance trajectory
     *   development_plan    → AI-suggested training / improvement actions
     *
     * Section 8.2 — Benchmark Reports
     * benchmark_reports: stores internal or cross-org performance comparisons.
     *
     * Section 8.6 — Shareable Reports
     * shareable_report_tokens: secure, time-limited links for external sharing.
     */
    public function up(): void
    {
        // AI Insights (Sections 7.1, 7.3, 7.4)
        Schema::create('ai_insights', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\AssessmentResult::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\EvaluationCycle::class)->nullable()->constrained()->nullOnDelete();

            $table->enum('insight_type', [
                'performance_summary',
                'skill_gap',
                'risk_flag',
                'development_plan',
            ]);
            $table->longText('content');                       // the AI-generated text
            $table->json('structured_data')->nullable();       // machine-readable findings
            $table->decimal('confidence_score', 5, 2)->nullable(); // 0–100
            $table->string('model_version')->nullable();       // which AI model was used
            $table->boolean('is_reviewed')->default(false);    // HR confirmed the insight
            $table->foreignIdFor(\App\Models\User::class, 'reviewed_by_user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'insight_type', 'created_at']);
            $table->index(['organization_id', 'insight_type']);
        });

        // Benchmark Reports (Section 8.2)
        Schema::create('benchmark_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\EvaluationCycle::class)->nullable()->constrained()->nullOnDelete();

            $table->enum('benchmark_type', ['internal', 'industry', 'cross_cohort']);
            $table->string('scope_label');                     // e.g. "Engineering Dept vs Org Average"

            // Org-side metrics
            $table->decimal('org_avg_score', 5, 2);
            $table->decimal('org_top_quartile', 5, 2)->nullable();
            $table->decimal('org_bottom_quartile', 5, 2)->nullable();

            // Benchmark reference metrics
            $table->decimal('benchmark_avg_score', 5, 2)->nullable();
            $table->decimal('benchmark_top_quartile', 5, 2)->nullable();
            $table->json('kpi_benchmarks')->nullable();        // per-KPI comparison data

            $table->date('period_start');
            $table->date('period_end');
            $table->timestamps();

            $table->index(['organization_id', 'created_at']);
        });

        // Shareable Report Tokens (Section 8.6)
        Schema::create('shareable_report_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\ReportExport::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class, 'created_by_user_id')->constrained()->cascadeOnDelete();

            $table->string('token', 64)->unique();             // the secret URL token
            $table->string('recipient_email')->nullable();     // who it was shared with
            $table->string('recipient_name')->nullable();
            $table->boolean('password_protected')->default(false);
            $table->string('password_hash')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->unsignedInteger('view_count')->default(0);
            $table->timestamp('last_viewed_at')->nullable();
            $table->boolean('is_revoked')->default(false);

            $table->timestamps();

            $table->index(['token']);
            $table->index(['organization_id', 'is_revoked']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shareable_report_tokens');
        Schema::dropIfExists('benchmark_reports');
        Schema::dropIfExists('ai_insights');
    }
};
