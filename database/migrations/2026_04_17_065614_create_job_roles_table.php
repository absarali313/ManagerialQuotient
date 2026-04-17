<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Job Roles: role definitions per organization.
     * KPI weights are assigned at the role level (Section 5.1).
     * Each role can belong to a department and has a seniority level.
     */
    public function up(): void
    {
        Schema::create('job_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Department::class)->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('code')->nullable();               // e.g. "MGR-L2", "ENG-SR"
            $table->enum('level', ['junior', 'mid', 'senior', 'lead', 'manager', 'director', 'executive'])
                  ->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['organization_id', 'code']);
            $table->index(['organization_id', 'department_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_roles');
    }
};
