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
        Schema::create('fpx_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_id', 10)->unique()->comment('FPX Bank ID (e.g., MB2U0227)');
            $table->string('bank_name', 100)->comment('Full bank name');
            $table->string('display_name', 100)->comment('Display name for UI');
            $table->boolean('bank_status')->default(true)->comment('Bank availability status');
            $table->string('bank_type', 20)->default('commercial')->comment('Bank type (commercial, islamic, etc.)');
            $table->timestamp('last_updated')->nullable()->comment('Last status update time');
            $table->boolean('is_active')->default(true)->comment('Whether bank is active in system');
            $table->timestamps();
            
            // Indexes
            $table->index('bank_id');
            $table->index('bank_status');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fpx_banks');
    }
};
