<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Deferred FK constraints for the users table.
     *
     * department_id, team_id, and job_role_id could not be added as FK constraints
     * in the users migration because departments, teams, and job_roles did not exist
     * at that point. MySQL enforces FK constraints immediately — unlike SQLite.
     *
     * This migration runs after all three referenced tables are created,
     * making it safe to add the constraints now. Timestamp 065615 puts it
     * one second after job_roles (065614).
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('department_id')
                  ->references('id')->on('departments')
                  ->nullOnDelete();

            $table->foreign('team_id')
                  ->references('id')->on('teams')
                  ->nullOnDelete();

            $table->foreign('job_role_id')
                  ->references('id')->on('job_roles')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['team_id']);
            $table->dropForeign(['job_role_id']);
        });
    }
};
