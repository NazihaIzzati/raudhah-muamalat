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
        Schema::create('cardzone_transactions', function (Blueprint $table) {
            $table->id();
            
            // =============================================================================
            // CORE TRANSACTION FIELDS (Cardzone-specific)
            // =============================================================================
            $table->string('cz_transaction_id')->unique()->comment('Cardzone MPI_TRXN_ID format: 10 digits');
            $table->string('cz_merchant_id')->comment('Cardzone merchant ID: 600000000000001');
            $table->decimal('cz_amount', 10, 2)->comment('Transaction amount in MYR');
            $table->string('cz_currency', 3)->default('MYR')->comment('Currency code');
            $table->string('cz_payment_method')->comment('card, obw, qr');
            $table->string('cz_status')->default('pending')->comment('pending, authenticated, authorized, failed, cancelled');
            
            // =============================================================================
            // CARD PAYMENT FIELDS (3DS)
            // =============================================================================
            $table->string('cz_card_number_masked')->nullable()->comment('Masked card number');
            $table->string('cz_card_expiry')->nullable()->comment('Card expiry MM/YY');
            $table->string('cz_card_holder_name')->nullable()->comment('Cardholder name');
            $table->text('cz_auth_value')->nullable()->comment('CAVV/AAV from 3DS');
            $table->string('cz_eci')->nullable()->comment('ECI from 3DS');
            
            // =============================================================================
            // ONLINE BANKING FIELDS (OBW)
            // =============================================================================
            $table->string('cz_obw_bank_code')->nullable()->comment('Online banking bank code');
            
            // =============================================================================
            // QR PAYMENT FIELDS
            // =============================================================================
            $table->text('cz_qr_code_data')->nullable()->comment('QR string or URL');
            
            // =============================================================================
            // CARDZONE RESPONSE DATA
            // =============================================================================
            $table->json('cz_response_data')->nullable()->comment('Raw JSON response from Cardzone');
            $table->string('cz_response_code')->nullable()->comment('Cardzone response code');
            $table->string('cz_response_message')->nullable()->comment('Cardzone response message');
            $table->timestamp('cz_response_received_at')->nullable()->comment('When response was received');
            
            // =============================================================================
            // TRANSACTION TRACKING
            // =============================================================================
            $table->string('cz_session_id')->nullable()->comment('Cardzone session ID');
            $table->string('cz_order_id')->nullable()->comment('Cardzone order ID');
            $table->timestamp('cz_created_at')->nullable()->comment('Transaction creation time');
            $table->timestamp('cz_updated_at')->nullable()->comment('Transaction update time');
            
            // =============================================================================
            // RELATIONSHIP FIELDS
            // =============================================================================
            $table->unsignedBigInteger('donation_id')->nullable()->comment('Link to donation');
            
            // =============================================================================
            // LARAVEL TIMESTAMPS
            // =============================================================================
            $table->timestamps();
            
            // =============================================================================
            // INDEXES FOR PERFORMANCE
            // =============================================================================
            $table->index(['cz_transaction_id'], 'idx_cz_transaction_id');
            $table->index(['cz_merchant_id'], 'idx_cz_merchant_id');
            $table->index(['cz_status'], 'idx_cz_status');
            $table->index(['cz_payment_method'], 'idx_cz_payment_method');
            $table->index(['donation_id'], 'idx_cz_donation_id');
            $table->index(['cz_created_at'], 'idx_cz_created_at');
            $table->index(['cz_response_code'], 'idx_cz_response_code');
            $table->index(['cz_session_id'], 'idx_cz_session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cardzone_transactions');
    }
}; 