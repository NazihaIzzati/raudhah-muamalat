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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->text('values')->nullable();
            $table->text('bank_muamalat_title')->nullable();
            $table->text('bank_muamalat_description')->nullable();
            $table->text('payment_section_title')->nullable();
            $table->text('payment_section_description')->nullable();
            $table->text('fpx_description')->nullable();
            $table->text('duitnow_description')->nullable();
            $table->string('hero_badge_text')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->text('hero_description')->nullable();
            $table->json('hero_highlights')->nullable();
            $table->json('hero_pills')->nullable();
            $table->json('hero_cta_buttons')->nullable();
            $table->string('status')->default('active');
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('created_by')->references('id')->on('staff')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('staff')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
