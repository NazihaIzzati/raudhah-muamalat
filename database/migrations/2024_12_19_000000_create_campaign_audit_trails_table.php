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
        Schema::create('campaign_audit_trails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->cascadeOnDelete();
            $table->string('action'); // created, updated, status_changed, featured_toggled, etc.
            $table->text('description');
            $table->json('old_values')->nullable(); // Store old values before change
            $table->json('new_values')->nullable(); // Store new values after change
            $table->foreignId('performed_by')->nullable()->constrained('staff')->nullOnDelete();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index(['campaign_id', 'created_at']);
            $table->index('action');
            $table->index('performed_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_audit_trails');
    }
}; 