<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * KPIs: master list of Key Performance Indicators.
     * System KPIs (is_system = true) are seeded globally.
     * Organizations can add custom KPIs (is_system = false).
     *
     * Seeded KPIs: Attitude, Communication Skills, Decision Making,
     * Creativity, Innovation, Discipline, Commitment, Leadership, Delegation.
     */
    public function up(): void
    {
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();                  // machine-readable identifier
            $table->text('description')->nullable();
            $table->string('category')->nullable();            // grouping e.g. "Interpersonal", "Cognitive"
            $table->boolean('is_system')->default(true);       // system-defined vs org-custom KPI
            $table->foreignIdFor(\App\Models\Organization::class)->nullable()->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_system', 'is_active']);
            $table->index(['organization_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpis');
    }
};
