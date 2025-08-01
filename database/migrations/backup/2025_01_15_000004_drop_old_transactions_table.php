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
        // Drop the old transactions table since we now have separate tables
        if (Schema::hasTable('transactions')) {
            Schema::dropIfExists('transactions');
            \Log::info('Old transactions table dropped successfully');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate the old transactions table if needed for rollback
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->string('merchant_id');
            $table->decimal('amount', 10, 2);
            $table->string('currency');
            $table->string('payment_method');
            $table->string('status')->default('pending');
            $table->string('card_number_masked')->nullable();
            $table->string('card_expiry')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('obw_bank_code')->nullable();
            $table->text('qr_code_data')->nullable();
            $table->text('auth_value')->nullable();
            $table->string('eci')->nullable();
            $table->text('cardzone_response_data')->nullable();
            $table->text('paynet_response_data')->nullable();
            $table->unsignedBigInteger('donation_id')->nullable();
            $table->timestamps();
        });
    }
}; 