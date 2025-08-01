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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique(); // Cardzone's MPI_TRXN_ID
            $table->string('merchant_id');
            $table->decimal('amount', 10, 2); // Stored as decimal (e.g., 150.00)
            $table->string('currency'); // e.g., MYR
            $table->string('payment_method'); // 'card', 'obw', 'qr'
            $table->string('status')->default('pending'); // 'pending', 'authenticated', 'authorized', 'failed', 'cancelled'
            $table->string('card_number_masked')->nullable(); // Store masked card number
            $table->string('card_expiry')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('obw_bank_code')->nullable();
            $table->text('qr_code_data')->nullable(); // Store QR string or URL
            $table->text('auth_value')->nullable(); // CAVV/AAV from 3DS
            $table->string('eci')->nullable(); // ECI from 3DS
            $table->text('cardzone_response_data')->nullable(); // Store raw JSON response from Cardzone
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
