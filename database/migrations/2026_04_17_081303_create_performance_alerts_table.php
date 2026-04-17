<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Section 5.6 — Performance Alert System
     *
     * Alerts are created by Laravel Events fired after every assessment result.
     * Each alert has a recipient — alerts can be targeted at the employee's
     * manager, HR, or the employee themselves.
     *
     * Alert types:
     *   score_drop         → significant score decrease detected
     *   score_improvement  → significant score increase detected
     *   at_risk            → employee score below risk threshold for N cycles
     *   promotion_eligible → promotion readiness = ready
     *   cycle_missed       → employee did not complete assessment by due date
     *   kpi_critical       → a single KPI score dropped below critical threshold
     *
     * severity: info | warning | critical
     *   Drives notification urgency and UI badge colour.
     */
    public function up(): void
    {
        Schema::create('performance_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();        // employee this alert is about
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\AssessmentResult::class, 'triggered_by_result_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\User::class, 'recipient_user_id')->nullable()->constrained()->nullOnDelete(); // who should see it

            $table->enum('alert_type', [
                'score_drop',
                'score_improvement',
                'at_risk',
                'promotion_eligible',
                'cycle_missed',
                'kpi_critical',
            ]);
            $table->enum('severity', ['info', 'warning', 'critical'])->default('info');

            $table->decimal('previous_score', 5, 2)->nullable();
            $table->decimal('current_score', 5, 2)->nullable();
            $table->decimal('delta', 5, 2)->nullable();         // positive = improvement
            $table->text('message');
            $table->json('metadata')->nullable();               // e.g. {kpi_id, threshold, cycles_at_risk}

            $table->boolean('is_read')->default(false);
            $table->foreignIdFor(\App\Models\User::class, 'read_by_user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('read_at')->nullable();

            $table->boolean('is_actioned')->default(false);     // HR/manager has taken action
            $table->timestamp('actioned_at')->nullable();

            $table->timestamps();

            $table->index(['organization_id', 'severity', 'is_read']);
            $table->index(['user_id', 'created_at']);
            $table->index(['recipient_user_id', 'is_read']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_alerts');
    }
};
