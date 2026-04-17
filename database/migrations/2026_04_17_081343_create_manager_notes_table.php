<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Section 6.3 — Manager Notes System
     *
     * Qualitative feedback a manager writes about an employee.
     * Optionally anchored to a specific assessment or a specific KPI
     * for fine-grained context.
     *
     * is_visible_to_employee: controls whether the note appears on
     * the Employee Growth Dashboard (Section 6.1).
     */
    public function up(): void
    {
        Schema::create('manager_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Organization::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class, 'employee_user_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class, 'manager_user_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Assessment::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(\App\Models\Kpi::class)->nullable()->constrained()->nullOnDelete();

            $table->enum('note_type', ['general', 'positive', 'concern', 'action_item', 'development'])
                  ->default('general');
            $table->text('content');
            $table->boolean('is_visible_to_employee')->default(false);
            $table->boolean('requires_followup')->default(false);
            $table->date('followup_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['employee_user_id', 'created_at']);
            $table->index(['manager_user_id', 'created_at']);
            $table->index(['organization_id', 'note_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manager_notes');
    }
};
