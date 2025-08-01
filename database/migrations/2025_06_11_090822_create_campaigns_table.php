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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->decimal('goal_amount', 10, 2);
            $table->decimal('raised_amount', 10, 2)->default(0.00);
            $table->string('currency')->default('USD');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('status')->default('draft'); // draft, active, completed, cancelled
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
