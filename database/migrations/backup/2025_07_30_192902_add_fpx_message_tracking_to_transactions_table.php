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
            // AR (Authorization Request) Message Tracking
            $table->json('fpx_ar_message_data')->nullable()->after('paynet_response_data');
            $table->timestamp('fpx_ar_sent_at')->nullable()->after('fpx_ar_message_data');
            $table->string('fpx_ar_status')->nullable()->after('fpx_ar_sent_at'); // 'sent', 'failed', 'success'
            
            // AC (Acknowledgement) Message Tracking
            $table->json('fpx_ac_message_data')->nullable()->after('fpx_ar_status');
            $table->timestamp('fpx_ac_received_at')->nullable()->after('fpx_ac_message_data');
            $table->string('fpx_ac_status')->nullable()->after('fpx_ac_received_at'); // 'received', 'processed', 'failed'
            $table->string('fpx_ac_response_code')->nullable()->after('fpx_ac_status'); // '00', 'FE', etc.
            
            // BE (Bank Enquiry) Message Tracking
            $table->json('fpx_be_message_data')->nullable()->after('fpx_ac_response_code');
            $table->timestamp('fpx_be_sent_at')->nullable()->after('fpx_be_message_data');
            $table->string('fpx_be_status')->nullable()->after('fpx_be_sent_at'); // 'sent', 'failed', 'success'
            
            // AE (Acknowledgement Enquiry) Message Tracking
            $table->json('fpx_ae_message_data')->nullable()->after('fpx_be_status');
            $table->timestamp('fpx_ae_sent_at')->nullable()->after('fpx_ae_message_data');
            $table->string('fpx_ae_status')->nullable()->after('fpx_ae_sent_at'); // 'sent', 'failed', 'success'
            $table->string('fpx_ae_response_code')->nullable()->after('fpx_ae_status'); // '00', 'FE', etc.
            
            // General FPX Message Tracking
            $table->string('fpx_message_sequence')->nullable()->after('fpx_ae_response_code'); // Track message flow: AR->AC, BE, AE
            $table->text('fpx_error_log')->nullable()->after('fpx_message_sequence'); // Store error details
            $table->string('fpx_last_message_type')->nullable()->after('fpx_error_log'); // Last message type sent/received
            $table->timestamp('fpx_last_message_at')->nullable()->after('fpx_last_message_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'fpx_ar_message_data',
                'fpx_ar_sent_at',
                'fpx_ar_status',
                'fpx_ac_message_data',
                'fpx_ac_received_at',
                'fpx_ac_status',
                'fpx_ac_response_code',
                'fpx_be_message_data',
                'fpx_be_sent_at',
                'fpx_be_status',
                'fpx_ae_message_data',
                'fpx_ae_sent_at',
                'fpx_ae_status',
                'fpx_ae_response_code',
                'fpx_message_sequence',
                'fpx_error_log',
                'fpx_last_message_type',
                'fpx_last_message_at'
            ]);
        });
    }
};
