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
        Schema::table('news', function (Blueprint $table) {
            // Add missing columns that the News controller and model expect
            $table->string('image_path')->nullable()->after('content'); // Add image_path column (different from featured_image)
            $table->text('excerpt')->nullable()->after('image_path');
            $table->string('category')->nullable()->after('excerpt');
            $table->boolean('featured')->default(false)->after('category');
            $table->integer('display_order')->default(0)->after('featured');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
            
            // Add foreign key constraint for updated_by
            $table->foreign('updated_by')->references('id')->on('staff')->onDelete('set null');
            
            // Drop the old column that is no longer needed
            $table->dropColumn(['featured_image']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Drop the new columns
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['image_path', 'excerpt', 'category', 'featured', 'display_order', 'updated_by']);
            
            // Restore the old column
            $table->string('featured_image')->nullable();
        });
    }
};
