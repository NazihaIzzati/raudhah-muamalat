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
        Schema::table('campaigns', function (Blueprint $table) {
            // Add partner_id column
            $table->unsignedBigInteger('partner_id')->nullable()->after('organization_name');
            
            // Add foreign key constraint
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('set null');
            
            // Drop organization_logo column
            $table->dropColumn('organization_logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            // Add back organization_logo column
            $table->string('organization_logo')->nullable()->after('organization_name');
            
            // Drop partner_id column and foreign key
            $table->dropForeign(['partner_id']);
            $table->dropColumn('partner_id');
        });
    }
};
