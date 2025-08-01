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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // donation, user_registration, campaign_created, etc.
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // Additional data like user_id, donation_id, etc.
            $table->timestamp('read_at')->nullable();
            $table->string('icon')->nullable(); // Icon class or name
            $table->string('color')->default('gray'); // Color theme: green, blue, orange, red
            $table->string('action_url')->nullable(); // URL to redirect when clicked
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['type', 'created_at']);
            $table->index(['read_at', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
