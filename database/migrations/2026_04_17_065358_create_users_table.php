<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Users: all platform actors — super admins, org admins, HR, managers, employees.
     * Also creates password_reset_tokens and sessions (framework standard).
     *
     * NOTE: department_id, team_id, job_role_id are stored as plain indexed columns here.
     * MySQL enforces FK constraints immediately, so these cannot reference tables that
     * don't exist yet. The actual foreign key constraints for these three columns are
     * added in: 2026_04_17_065615_add_user_structure_foreign_keys.php
     * which runs after departments, teams, and job_roles are created.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class)->nullable()->constrained()->nullOnDelete();
            // Deferred FKs — constrained after departments/teams/job_roles are created
            $table->unsignedBigInteger('department_id')->nullable()->index();
            $table->unsignedBigInteger('team_id')->nullable()->index();
            $table->unsignedBigInteger('job_role_id')->nullable()->index();

            // Self-referencing: who does this user report to?
            $table->foreignId('reports_to_user_id')->nullable()->constrained('users')->nullOnDelete();

            // Identity
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // Profile
            $table->string('phone')->nullable();
            $table->string('employee_id')->nullable();          // HR system ID
            $table->string('avatar_path')->nullable();
            $table->date('joined_at')->nullable();

            // Platform role (single role per user; scoped permissions enforced in code)
            $table->enum('system_role', ['super_admin', 'org_admin', 'hr', 'manager', 'employee'])
                  ->default('employee');

            // Denormalized performance cache (updated after each evaluation)
            $table->decimal('current_mq_score', 5, 2)->nullable();
            $table->enum('promotion_readiness', ['ready', 'potential', 'not_ready'])->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Composite indexes for common query patterns
            $table->index(['organization_id', 'system_role']);
            $table->index(['organization_id', 'department_id']);
            $table->index(['organization_id', 'is_active']);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignIdFor(\App\Models\User::class)->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
