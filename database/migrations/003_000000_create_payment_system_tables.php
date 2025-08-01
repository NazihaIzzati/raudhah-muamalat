<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create payment system tables
     * 
     * This migration creates all payment-related tables:
     * - cardzone_keys: Cardzone API keys and configuration
     * - cardzone_transactions: Cardzone payment transactions
     * - paynet_transactions: Paynet/FPX payment transactions
     * - fpx_banks: FPX bank list and status
     */
    public function up(): void
    {
        // Cardzone Keys table
        Schema::create('cardzone_keys', function (Blueprint $table) {
            $table->id();
            $table->string('environment')->comment('sandbox, production');
            $table->string('merchant_id')->comment('Cardzone merchant ID');
            $table->text('public_key')->comment('Cardzone public key');
            $table->text('private_key')->comment('Cardzone private key');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Cardzone Transactions table
        Schema::create('cardzone_transactions', function (Blueprint $table) {
            $table->id();
            
            // Core transaction fields
            $table->string('cz_transaction_id')->unique()->comment('Cardzone MPI_TRXN_ID format: 10 digits');
            $table->string('cz_merchant_id')->comment('Cardzone merchant ID: 600000000000001');
            $table->decimal('cz_amount', 10, 2)->comment('Transaction amount in MYR');
            $table->string('cz_currency', 3)->default('MYR')->comment('Currency code');
            $table->string('cz_payment_method')->comment('card, obw, qr');
            $table->string('cz_status')->default('pending')->comment('pending, authenticated, authorized, failed, cancelled');
            
            // Card payment fields (3DS)
            $table->string('cz_card_number_masked')->nullable()->comment('Masked card number');
            $table->string('cz_card_expiry')->nullable()->comment('Card expiry MM/YY');
            $table->string('cz_card_holder_name')->nullable()->comment('Cardholder name');
            $table->text('cz_auth_value')->nullable()->comment('CAVV/AAV from 3DS');
            $table->string('cz_eci')->nullable()->comment('ECI from 3DS');
            
            // Online banking fields (OBW)
            $table->string('cz_obw_bank_code')->nullable()->comment('Online banking bank code');
            
            // QR payment fields
            $table->text('cz_qr_code_data')->nullable()->comment('QR string or URL');
            
            // Cardzone response data
            $table->json('cz_response_data')->nullable()->comment('Raw JSON response from Cardzone');
            $table->string('cz_response_code')->nullable()->comment('Cardzone response code');
            $table->string('cz_response_message')->nullable()->comment('Cardzone response message');
            $table->timestamp('cz_response_received_at')->nullable()->comment('When response was received');
            
            // Transaction tracking
            $table->string('cz_session_id')->nullable()->comment('Cardzone session ID');
            $table->string('cz_order_id')->nullable()->comment('Cardzone order ID');
            $table->timestamp('cz_created_at')->nullable()->comment('Transaction creation time');
            $table->timestamp('cz_updated_at')->nullable()->comment('Transaction update time');
            
            // Relationship fields
            $table->unsignedBigInteger('donation_id')->nullable()->comment('Link to donation');
            
            // Laravel timestamps
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for performance
            $table->index(['cz_transaction_id'], 'idx_cz_transaction_id');
            $table->index(['cz_merchant_id'], 'idx_cz_merchant_id');
            $table->index(['cz_status'], 'idx_cz_status');
            $table->index(['cz_payment_method'], 'idx_cz_payment_method');
            $table->index(['donation_id'], 'idx_cz_donation_id');
            $table->index(['cz_created_at'], 'idx_cz_created_at');
            $table->index(['cz_response_code'], 'idx_cz_response_code');
            $table->index(['cz_session_id'], 'idx_cz_session_id');
        });

        // Paynet Transactions table
        Schema::create('paynet_transactions', function (Blueprint $table) {
            $table->id();
            
            // Core transaction fields
            $table->string('pn_transaction_id')->unique()->comment('Paynet transaction ID format: PNT + timestamp + random + donation_id');
            $table->string('pn_merchant_id')->comment('Paynet merchant ID: EX00010946');
            $table->decimal('pn_amount', 10, 2)->comment('Transaction amount in MYR');
            $table->string('pn_currency', 3)->default('MYR')->comment('Currency code');
            $table->string('pn_payment_method')->comment('fpx, fpx_system');
            $table->string('pn_status')->default('pending')->comment('pending, completed, failed, cancelled');
            
            // Paynet response data
            $table->json('pn_response_data')->nullable()->comment('Raw JSON response from Paynet');
            $table->string('pn_response_code')->nullable()->comment('Paynet response code');
            $table->string('pn_response_message')->nullable()->comment('Paynet response message');
            $table->timestamp('pn_response_received_at')->nullable()->comment('When response was received');
            
            // FPX Message tracking - AR (Authorization Request)
            $table->json('pn_fpx_ar_message_data')->nullable()->comment('AR message payload sent to FPX');
            $table->timestamp('pn_fpx_ar_sent_at')->nullable()->comment('When AR message was sent');
            $table->string('pn_fpx_ar_status')->nullable()->comment('sent, failed, success');
            $table->string('pn_fpx_ar_response_code')->nullable()->comment('AR response code from FPX');
            
            // FPX Message tracking - AC (Acknowledgement)
            $table->json('pn_fpx_ac_message_data')->nullable()->comment('AC message payload received from FPX');
            $table->timestamp('pn_fpx_ac_received_at')->nullable()->comment('When AC message was received');
            $table->string('pn_fpx_ac_status')->nullable()->comment('received, processed, failed');
            $table->string('pn_fpx_ac_response_code')->nullable()->comment('AC response code: 00, FE, etc.');
            $table->string('pn_fpx_ac_debit_auth_code')->nullable()->comment('Debit authorization code');
            $table->string('pn_fpx_ac_fpx_txn_id')->nullable()->comment('FPX transaction ID');
            
            // FPX Message tracking - BE (Bank Enquiry)
            $table->json('pn_fpx_be_message_data')->nullable()->comment('BE message payload sent to FPX');
            $table->timestamp('pn_fpx_be_sent_at')->nullable()->comment('When BE message was sent');
            $table->string('pn_fpx_be_status')->nullable()->comment('sent, failed, success');
            $table->string('pn_fpx_be_response_code')->nullable()->comment('BE response code from FPX');
            $table->text('pn_fpx_be_bank_list')->nullable()->comment('Bank list response from FPX');
            
            // FPX Message tracking - AE (Acknowledgement Enquiry)
            $table->json('pn_fpx_ae_message_data')->nullable()->comment('AE message payload sent to FPX');
            $table->timestamp('pn_fpx_ae_sent_at')->nullable()->comment('When AE message was sent');
            $table->string('pn_fpx_ae_status')->nullable()->comment('sent, failed, success');
            $table->string('pn_fpx_ae_response_code')->nullable()->comment('AE response code: 00, FE, etc.');
            $table->string('pn_fpx_ae_txn_status')->nullable()->comment('Transaction status from AE response');
            
            // FPX Message sequence tracking
            $table->string('pn_fpx_message_sequence')->nullable()->comment('Track message flow: AR->AC, BE, AE');
            $table->string('pn_fpx_last_message_type')->nullable()->comment('Last message type sent/received');
            $table->timestamp('pn_fpx_last_message_at')->nullable()->comment('Last message timestamp');
            $table->text('pn_fpx_error_log')->nullable()->comment('Store error details');
            
            // FPX Transaction details
            $table->string('pn_fpx_seller_ex_id')->nullable()->comment('Seller exchange ID');
            $table->string('pn_fpx_seller_ex_order_no')->nullable()->comment('Seller exchange order number');
            $table->string('pn_fpx_seller_order_no')->nullable()->comment('Seller order number');
            $table->string('pn_fpx_seller_id')->nullable()->comment('Seller ID');
            $table->string('pn_fpx_seller_bank_code')->nullable()->comment('Seller bank code');
            $table->string('pn_fpx_buyer_bank_id')->nullable()->comment('Buyer bank ID');
            $table->string('pn_fpx_buyer_bank_branch')->nullable()->comment('Buyer bank branch');
            $table->string('pn_fpx_buyer_acc_no')->nullable()->comment('Buyer account number');
            $table->string('pn_fpx_buyer_id')->nullable()->comment('Buyer ID');
            $table->string('pn_fpx_buyer_name')->nullable()->comment('Buyer name');
            $table->string('pn_fpx_buyer_email')->nullable()->comment('Buyer email');
            $table->string('pn_fpx_buyer_iban')->nullable()->comment('Buyer IBAN');
            $table->string('pn_fpx_maker_name')->nullable()->comment('Maker name');
            $table->string('pn_fpx_product_desc')->nullable()->comment('Product description');
            $table->string('pn_fpx_version')->nullable()->comment('FPX version');
            
            // Transaction tracking
            $table->string('pn_session_id')->nullable()->comment('Paynet session ID');
            $table->string('pn_order_id')->nullable()->comment('Paynet order ID');
            $table->timestamp('pn_created_at')->nullable()->comment('Transaction creation time');
            $table->timestamp('pn_updated_at')->nullable()->comment('Transaction update time');
            
            // Relationship fields
            $table->unsignedBigInteger('donation_id')->nullable()->comment('Link to donation');
            
            // Laravel timestamps
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for performance
            $table->index(['pn_transaction_id'], 'idx_pn_transaction_id');
            $table->index(['pn_merchant_id'], 'idx_pn_merchant_id');
            $table->index(['pn_status'], 'idx_pn_status');
            $table->index(['pn_payment_method'], 'idx_pn_payment_method');
            $table->index(['donation_id'], 'idx_pn_donation_id');
            $table->index(['pn_created_at'], 'idx_pn_created_at');
            $table->index(['pn_response_code'], 'idx_pn_response_code');
            $table->index(['pn_fpx_last_message_type'], 'idx_pn_fpx_last_message_type');
            $table->index(['pn_fpx_ar_status'], 'idx_pn_fpx_ar_status');
            $table->index(['pn_fpx_ac_status'], 'idx_pn_fpx_ac_status');
            $table->index(['pn_fpx_be_status'], 'idx_pn_fpx_be_status');
            $table->index(['pn_fpx_ae_status'], 'idx_pn_fpx_ae_status');
            $table->index(['pn_fpx_ac_response_code'], 'idx_pn_fpx_ac_response_code');
            $table->index(['pn_fpx_ae_response_code'], 'idx_pn_fpx_ae_response_code');
        });

        // FPX Banks table
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
            $table->softDeletes();
            
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
        Schema::dropIfExists('paynet_transactions');
        Schema::dropIfExists('cardzone_transactions');
        Schema::dropIfExists('cardzone_keys');
    }
}; 