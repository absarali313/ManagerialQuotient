<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Master KPI definitions
        // Seeded with: Attitude, Communication Skills, Decision Making,
        // Creativity, Innovation, Discipline, Commitment, Leadership, Delegation
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_system')->default(true); // system-defined vs org-custom
            $table->foreignId('organization_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kpis');
    }
};
