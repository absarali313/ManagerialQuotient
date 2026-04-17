<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Section 6.4 — Notification System
     * Section 6.5 — Export Center (report_exports)
     *
     * notifications: in-app notification inbox.
     *   Complements Laravel's built-in notification system.
     *   Used for: assessment reminders, performance updates, monthly summaries,
     *   alert dispatches, cycle start/end notices.
     *
     * notification_preferences: per-user opt-in/out + channel config.
     *   Lets employees and managers control what they receive and how.
     *
     * report_exports: Section 6.5 Export Center
     *   Tracks all generated report downloads (PDF, CSV etc.)
     *   including historical access. Reports are stored in object storage;
     *   this table holds the metadata + signed URL expiry.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Organization::class)->nullable()->constrained()->nullOnDelete();

            $table->string('type');                            // notification class name
            $table->enum('channel', ['database', 'email', 'sms'])->default('database');
            $table->string('title');
            $table->text('body');
            $table->json('data')->nullable();                  // structured payload
            $table->string('action_url')->nullable();          // deep link

            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'read_at']);
            $table->index(['user_id', 'created_at']);
        });

        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->unique()->constrained()->cascadeOnDelete();

            // Email channels
            $table->boolean('email_assessment_reminder')->default(true);
            $table->boolean('email_cycle_start')->default(true);
            $table->boolean('email_monthly_summary')->default(true);
            $table->boolean('email_performance_alert')->default(true);
            $table->boolean('email_promotion_update')->default(true);

            // In-app channels
            $table->boolean('inapp_assessment_reminder')->default(true);
            $table->boolean('inapp_performance_alert')->default(true);
            $table->boolean('inapp_promotion_update')->default(true);
            $table->boolean('inapp_manager_note')->default(true);

            $table->timestamps();
        });

        // Section 6.5 — Export Center
        Schema::create('report_exports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class, 'generated_by_user_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class)->nullable()->constrained()->nullOnDelete(); // subject (null = org-wide)

            $table->enum('report_type', [
                'kpi_performance',
                'competency_analysis',
                'tna',                 // Training Needs Analysis
                'batch_comparison',
                'department_health',
                'executive_summary',   // Section 8.4
                'benchmark',           // Section 8.2
                'before_after_impact', // Section 8.7
                'promotion_readiness', // Section 8.5
            ]);
            $table->enum('format', ['pdf', 'csv', 'xlsx'])->default('pdf');
            $table->enum('status', ['queued', 'generating', 'ready', 'failed'])->default('queued');

            $table->string('file_path')->nullable();           // storage path
            $table->string('file_name')->nullable();
            $table->unsignedInteger('file_size_bytes')->nullable();
            $table->timestamp('expires_at')->nullable();       // signed URL expiry
            $table->json('filters')->nullable();               // report parameters snapshot

            $table->timestamps();

            $table->index(['organization_id', 'report_type', 'created_at']);
            $table->index(['generated_by_user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_exports');
        Schema::dropIfExists('notification_preferences');
        Schema::dropIfExists('notifications');
    }
};
