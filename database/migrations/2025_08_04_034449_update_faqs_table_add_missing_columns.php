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
        Schema::table('faqs', function (Blueprint $table) {
            // Add missing columns that the FAQ controller and views expect
            $table->string('status')->default('active')->after('category'); // active, inactive
            $table->boolean('featured')->default(false)->after('status');
            $table->integer('display_order')->default(0)->after('featured');
            $table->unsignedBigInteger('created_by')->nullable()->after('display_order');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
            
            // Add foreign key constraints
            $table->foreign('created_by')->references('id')->on('staff')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('staff')->onDelete('set null');
            
            // Drop the old columns that are no longer needed
            $table->dropColumn(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            // Drop the new columns
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['status', 'featured', 'display_order', 'created_by', 'updated_by']);
            
            // Restore the old columns
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
        });
    }
};
