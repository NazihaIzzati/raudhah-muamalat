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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('location');
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('max_participants')->nullable();
            $table->integer('registered_participants')->default(0);
            $table->decimal('registration_fee', 8, 2)->default(0.00);
            $table->string('currency')->default('USD');
            $table->string('category')->nullable(); // conference, workshop, seminar, charity, etc.
            $table->string('status')->default('draft'); // draft, published, ongoing, completed, cancelled
            $table->boolean('is_featured')->default(false);
            $table->boolean('registration_required')->default(true);
            $table->dateTime('registration_deadline')->nullable();
            $table->json('contact_info')->nullable(); // phone, email, website
            $table->json('social_links')->nullable(); // facebook, twitter, instagram
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
