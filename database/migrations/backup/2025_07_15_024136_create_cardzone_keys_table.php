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
        Schema::create('cardzone_keys', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id')->unique(); // Link to your merchant
            $table->text('merchant_private_key'); // Your merchant's RSA private key (PEM format)
            $table->text('cardzone_public_key')->nullable(); // Cardzone's RSA public key (Base64Url)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cardzone_keys');
    }
};
