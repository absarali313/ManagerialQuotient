<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Organizations: top-level tenants in the multi-org licensing model.
     * Each org has its own license, branding, and isolated data.
     */
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('industry')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->enum('license_type', ['trial', 'standard', 'professional', 'enterprise'])->default('standard');
            $table->unsignedInteger('max_users')->nullable();   // seat cap per license
            $table->date('license_starts_at')->nullable();
            $table->date('license_expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
