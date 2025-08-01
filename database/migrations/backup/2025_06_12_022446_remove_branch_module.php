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
        // Remove branch_id column from donations table if it exists
        if (Schema::hasColumn('donations', 'branch_id')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->dropForeign(['branch_id']);
                $table->dropColumn('branch_id');
            });
        }
        
        // Drop branches table
        Schema::dropIfExists('branches');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate branches table
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('Malaysia');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('manager_name')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('description')->nullable();
            $table->string('opening_hours')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
        
        // Add branch_id column back to donations table
        Schema::table('donations', function (Blueprint $table) {
            $table->foreignId('branch_id')->nullable()->after('campaign_id')->constrained()->nullOnDelete();
        });
    }
};
