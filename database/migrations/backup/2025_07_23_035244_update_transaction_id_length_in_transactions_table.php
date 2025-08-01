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
        Schema::table('transactions', function (Blueprint $table) {
            // Drop the existing unique index first
            $table->dropUnique(['transaction_id']);
        });
        
        Schema::table('transactions', function (Blueprint $table) {
            // Change the column length
            $table->string('transaction_id', 50)->change();
        });
        
        Schema::table('transactions', function (Blueprint $table) {
            // Recreate the unique index
            $table->unique('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Drop the unique index
            $table->dropUnique(['transaction_id']);
        });
        
        Schema::table('transactions', function (Blueprint $table) {
            // Revert column length
            $table->string('transaction_id')->change();
        });
        
        Schema::table('transactions', function (Blueprint $table) {
            // Recreate the unique index
            $table->unique('transaction_id');
        });
    }
};
