<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\User::class, 'owner_user_id')->nullable()->constrained('users')->nullOnDelete();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum('user_type', ['org', 'employee'])->default('employee')->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_type');
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('owner_user_id');
        });
    }
};
