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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            
            // General Settings
            $table->string('site_name')->default('Raudhah Muamalat');
            $table->string('site_email')->default('info@raudhahmuamalat.com');
            $table->string('site_phone')->default('+60 3-1234 5678');
            $table->text('site_description')->nullable();
            
            // Payment Settings
            $table->string('currency')->default('MYR');
            $table->decimal('min_donation', 10, 2)->default(10.00);
            $table->boolean('duitnow_qr_enabled')->default(true);
            $table->boolean('fpx_banking_enabled')->default(true);
            $table->boolean('card_payment_enabled')->default(true);
            
            // Security Settings
            $table->enum('registration_type', ['open', 'approval', 'closed'])->default('open');
            $table->integer('session_timeout')->default(120); // in minutes
            $table->integer('max_login_attempts')->default(5);
            
            // Notification Settings
            $table->boolean('email_new_donations')->default(true);
            $table->boolean('email_new_registrations')->default(true);
            $table->boolean('email_campaign_updates')->default(false);
            $table->string('admin_email')->default('admin@raudhahmuamalat.com');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
