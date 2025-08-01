<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the old transactions table exists
        if (!Schema::hasTable('transactions')) {
            \Log::info('No existing transactions table found. Skipping data migration.');
            return;
        }

        // Migrate Cardzone transactions
        $cardzoneTransactions = DB::table('transactions')
            ->where('payment_method', 'card')
            ->orWhere('payment_method', 'obw')
            ->orWhere('payment_method', 'qr')
            ->get();

        foreach ($cardzoneTransactions as $transaction) {
            DB::table('cardzone_transactions')->insert([
                'id' => $transaction->id,
                'cz_transaction_id' => $transaction->transaction_id,
                'cz_merchant_id' => $transaction->merchant_id,
                'cz_amount' => $transaction->amount,
                'cz_currency' => $transaction->currency ?? 'MYR',
                'cz_payment_method' => $transaction->payment_method,
                'cz_status' => $transaction->status,
                'cz_card_number_masked' => $transaction->card_number_masked,
                'cz_card_expiry' => $transaction->card_expiry,
                'cz_card_holder_name' => $transaction->card_holder_name,
                'cz_obw_bank_code' => $transaction->obw_bank_code,
                'cz_qr_code_data' => $transaction->qr_code_data,
                'cz_auth_value' => $transaction->auth_value,
                'cz_eci' => $transaction->eci,
                'cz_response_data' => $transaction->cardzone_response_data,
                'cz_response_code' => null, // Will be extracted from response_data if needed
                'cz_response_message' => null, // Will be extracted from response_data if needed
                'cz_response_received_at' => null, // Will be set when response is received
                'cz_session_id' => null, // Will be set when session is created
                'cz_order_id' => null, // Will be set when order is created
                'cz_created_at' => $transaction->created_at,
                'cz_updated_at' => $transaction->updated_at,
                'donation_id' => $transaction->donation_id,
                'created_at' => $transaction->created_at,
                'updated_at' => $transaction->updated_at,
            ]);
        }

        // Migrate Paynet transactions
        $paynetTransactions = DB::table('transactions')
            ->where('payment_method', 'fpx')
            ->orWhere('payment_method', 'fpx_system')
            ->orWhereNotNull('paynet_response_data')
            ->orWhereNotNull('fpx_ar_message_data')
            ->orWhereNotNull('fpx_ac_message_data')
            ->orWhereNotNull('fpx_be_message_data')
            ->orWhereNotNull('fpx_ae_message_data')
            ->get();

        foreach ($paynetTransactions as $transaction) {
            DB::table('paynet_transactions')->insert([
                'id' => $transaction->id,
                'pn_transaction_id' => $transaction->transaction_id,
                'pn_merchant_id' => $transaction->merchant_id,
                'pn_amount' => $transaction->amount,
                'pn_currency' => $transaction->currency ?? 'MYR',
                'pn_payment_method' => $transaction->payment_method,
                'pn_status' => $transaction->status,
                'pn_response_data' => $transaction->paynet_response_data,
                'pn_response_code' => null, // Will be extracted from response_data if needed
                'pn_response_message' => null, // Will be extracted from response_data if needed
                'pn_response_received_at' => null, // Will be set when response is received
                
                // FPX Message Tracking
                'pn_fpx_ar_message_data' => $transaction->fpx_ar_message_data,
                'pn_fpx_ar_sent_at' => $transaction->fpx_ar_sent_at,
                'pn_fpx_ar_status' => $transaction->fpx_ar_status,
                'pn_fpx_ar_response_code' => null, // Will be set when AR response is received
                
                'pn_fpx_ac_message_data' => $transaction->fpx_ac_message_data,
                'pn_fpx_ac_received_at' => $transaction->fpx_ac_received_at,
                'pn_fpx_ac_status' => $transaction->fpx_ac_status,
                'pn_fpx_ac_response_code' => $transaction->fpx_ac_response_code,
                'pn_fpx_ac_debit_auth_code' => null, // Will be extracted from AC message if available
                'pn_fpx_ac_fpx_txn_id' => null, // Will be extracted from AC message if available
                
                'pn_fpx_be_message_data' => $transaction->fpx_be_message_data,
                'pn_fpx_be_sent_at' => $transaction->fpx_be_sent_at,
                'pn_fpx_be_status' => $transaction->fpx_be_status,
                'pn_fpx_be_response_code' => null, // Will be set when BE response is received
                'pn_fpx_be_bank_list' => null, // Will be extracted from BE response if available
                
                'pn_fpx_ae_message_data' => $transaction->fpx_ae_message_data,
                'pn_fpx_ae_sent_at' => $transaction->fpx_ae_sent_at,
                'pn_fpx_ae_status' => $transaction->fpx_ae_status,
                'pn_fpx_ae_response_code' => $transaction->fpx_ae_response_code,
                'pn_fpx_ae_txn_status' => null, // Will be extracted from AE response if available
                
                'pn_fpx_message_sequence' => $transaction->fpx_message_sequence,
                'pn_fpx_last_message_type' => $transaction->fpx_last_message_type,
                'pn_fpx_last_message_at' => $transaction->fpx_last_message_at,
                'pn_fpx_error_log' => $transaction->fpx_error_log,
                
                // FPX Transaction Details (will be extracted from message data if available)
                'pn_fpx_seller_ex_id' => null,
                'pn_fpx_seller_ex_order_no' => null,
                'pn_fpx_seller_order_no' => null,
                'pn_fpx_seller_id' => null,
                'pn_fpx_seller_bank_code' => null,
                'pn_fpx_buyer_bank_id' => null,
                'pn_fpx_buyer_bank_branch' => null,
                'pn_fpx_buyer_acc_no' => null,
                'pn_fpx_buyer_id' => null,
                'pn_fpx_buyer_name' => null,
                'pn_fpx_buyer_email' => null,
                'pn_fpx_buyer_iban' => null,
                'pn_fpx_maker_name' => null,
                'pn_fpx_product_desc' => null,
                'pn_fpx_version' => null,
                
                'pn_session_id' => null, // Will be set when session is created
                'pn_order_id' => null, // Will be set when order is created
                'pn_created_at' => $transaction->created_at,
                'pn_updated_at' => $transaction->updated_at,
                'donation_id' => $transaction->donation_id,
                'created_at' => $transaction->created_at,
                'updated_at' => $transaction->updated_at,
            ]);
        }

        // Log migration results
        \Log::info('Transaction migration completed', [
            'cardzone_transactions_migrated' => $cardzoneTransactions->count(),
            'paynet_transactions_migrated' => $paynetTransactions->count(),
            'total_transactions_processed' => $cardzoneTransactions->count() + $paynetTransactions->count(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the new tables
        Schema::dropIfExists('cardzone_transactions');
        Schema::dropIfExists('paynet_transactions');
    }
}; 