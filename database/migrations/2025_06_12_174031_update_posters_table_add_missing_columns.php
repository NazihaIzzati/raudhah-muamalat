<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add new columns only if they don't exist
        Schema::table('posters', function (Blueprint $table) {
            if (!Schema::hasColumn('posters', 'category')) {
                $table->string('category')->nullable()->after('description');
            }
            if (!Schema::hasColumn('posters', 'featured')) {
                $table->boolean('featured')->default(false)->after('category');
            }
            if (!Schema::hasColumn('posters', 'file_size')) {
                $table->integer('file_size')->nullable()->after('featured'); // File size in KB
            }
        });
        
        // Update existing status values from 'active'/'inactive' to new values
        DB::table('posters')->where('status', 'active')->update(['status' => 'published']);
        DB::table('posters')->where('status', 'inactive')->update(['status' => 'draft']);
        
        // For SQLite, we need to recreate the table to change the ENUM constraint
        // Since Laravel doesn't really use ENUMs in SQLite (they're just strings),
        // we can just update the validation in the model/controller instead
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert status values back to original
        DB::table('posters')->where('status', 'published')->update(['status' => 'active']);
        DB::table('posters')->where('status', 'draft')->update(['status' => 'inactive']);
        DB::table('posters')->where('status', 'archived')->update(['status' => 'inactive']);
        
        Schema::table('posters', function (Blueprint $table) {
            // Remove the added columns if they exist
            if (Schema::hasColumn('posters', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('posters', 'featured')) {
                $table->dropColumn('featured');
            }
            if (Schema::hasColumn('posters', 'file_size')) {
                $table->dropColumn('file_size');
            }
        });
    }
};
