<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Section 6.7 — Audit Log System
     *
     * Immutable log of every meaningful state change in the system.
     * Tracks who changed what, on which record, and when.
     * Never deleted — use archiving for old records if needed.
     *
     * event column examples:
     *   assessment.completed, result.created, promotion.approved,
     *   kpi_weight.updated, user.role_changed, cycle.activated
     *
     * old_values / new_values: JSON snapshots of changed fields only.
     */
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\User::class, 'actor_user_id')->nullable()->constrained()->nullOnDelete();

            // What model was affected?
            $table->string('auditable_type');                  // e.g. "App\Models\Assessment"
            $table->unsignedBigInteger('auditable_id');

            $table->string('event');                           // e.g. "assessment.completed"
            $table->json('old_values')->nullable();            // before state
            $table->json('new_values')->nullable();            // after state
            $table->json('metadata')->nullable();              // extra context (ip, user_agent, etc.)

            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('created_at');                   // no updated_at — logs are immutable

            $table->index(['auditable_type', 'auditable_id']);
            $table->index(['organization_id', 'event', 'created_at']);
            $table->index(['actor_user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
