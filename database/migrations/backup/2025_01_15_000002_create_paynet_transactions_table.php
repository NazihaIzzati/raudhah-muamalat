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
        Schema::create('paynet_transactions', function (Blueprint $table) {
            $table->id();
            
            // =============================================================================
            // CORE TRANSACTION FIELDS (Paynet-specific)
            // =============================================================================
            $table->string('pn_transaction_id')->unique()->comment('Paynet transaction ID format: PNT + timestamp + random + donation_id');
            $table->string('pn_merchant_id')->comment('Paynet merchant ID: EX00010946');
            $table->decimal('pn_amount', 10, 2)->comment('Transaction amount in MYR');
            $table->string('pn_currency', 3)->default('MYR')->comment('Currency code');
            $table->string('pn_payment_method')->comment('fpx, fpx_system');
            $table->string('pn_status')->default('pending')->comment('pending, completed, failed, cancelled');
            
            // =============================================================================
            // PAYNET RESPONSE DATA
            // =============================================================================
            $table->json('pn_response_data')->nullable()->comment('Raw JSON response from Paynet');
            $table->string('pn_response_code')->nullable()->comment('Paynet response code');
            $table->string('pn_response_message')->nullable()->comment('Paynet response message');
            $table->timestamp('pn_response_received_at')->nullable()->comment('When response was received');
            
            // =============================================================================
            // FPX MESSAGE TRACKING - AR (Authorization Request)
            // =============================================================================
            $table->json('pn_fpx_ar_message_data')->nullable()->comment('AR message payload sent to FPX');
            $table->timestamp('pn_fpx_ar_sent_at')->nullable()->comment('When AR message was sent');
            $table->string('pn_fpx_ar_status')->nullable()->comment('sent, failed, success');
            $table->string('pn_fpx_ar_response_code')->nullable()->comment('AR response code from FPX');
            
            // =============================================================================
            // FPX MESSAGE TRACKING - AC (Acknowledgement)
            // =============================================================================
            $table->json('pn_fpx_ac_message_data')->nullable()->comment('AC message payload received from FPX');
            $table->timestamp('pn_fpx_ac_received_at')->nullable()->comment('When AC message was received');
            $table->string('pn_fpx_ac_status')->nullable()->comment('received, processed, failed');
            $table->string('pn_fpx_ac_response_code')->nullable()->comment('AC response code: 00, FE, etc.');
            $table->string('pn_fpx_ac_debit_auth_code')->nullable()->comment('Debit authorization code');
            $table->string('pn_fpx_ac_fpx_txn_id')->nullable()->comment('FPX transaction ID');
            
            // =============================================================================
            // FPX MESSAGE TRACKING - BE (Bank Enquiry)
            // =============================================================================
            $table->json('pn_fpx_be_message_data')->nullable()->comment('BE message payload sent to FPX');
            $table->timestamp('pn_fpx_be_sent_at')->nullable()->comment('When BE message was sent');
            $table->string('pn_fpx_be_status')->nullable()->comment('sent, failed, success');
            $table->string('pn_fpx_be_response_code')->nullable()->comment('BE response code from FPX');
            $table->text('pn_fpx_be_bank_list')->nullable()->comment('Bank list response from FPX');
            
            // =============================================================================
            // FPX MESSAGE TRACKING - AE (Acknowledgement Enquiry)
            // =============================================================================
            $table->json('pn_fpx_ae_message_data')->nullable()->comment('AE message payload sent to FPX');
            $table->timestamp('pn_fpx_ae_sent_at')->nullable()->comment('When AE message was sent');
            $table->string('pn_fpx_ae_status')->nullable()->comment('sent, failed, success');
            $table->string('pn_fpx_ae_response_code')->nullable()->comment('AE response code: 00, FE, etc.');
            $table->string('pn_fpx_ae_txn_status')->nullable()->comment('Transaction status from AE response');
            
            // =============================================================================
            // FPX MESSAGE SEQUENCE TRACKING
            // =============================================================================
            $table->string('pn_fpx_message_sequence')->nullable()->comment('Track message flow: AR->AC, BE, AE');
            $table->string('pn_fpx_last_message_type')->nullable()->comment('Last message type sent/received');
            $table->timestamp('pn_fpx_last_message_at')->nullable()->comment('Last message timestamp');
            $table->text('pn_fpx_error_log')->nullable()->comment('Store error details');
            
            // =============================================================================
            // FPX TRANSACTION DETAILS
            // =============================================================================
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
            
            // =============================================================================
            // TRANSACTION TRACKING
            // =============================================================================
            $table->string('pn_session_id')->nullable()->comment('Paynet session ID');
            $table->string('pn_order_id')->nullable()->comment('Paynet order ID');
            $table->timestamp('pn_created_at')->nullable()->comment('Transaction creation time');
            $table->timestamp('pn_updated_at')->nullable()->comment('Transaction update time');
            
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paynet_transactions');
    }
}; 