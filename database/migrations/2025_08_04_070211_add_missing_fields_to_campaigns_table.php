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
            $table->string('organization_name')->nullable()->after('title');
            $table->string('organization_logo')->nullable()->after('organization_name');
            $table->integer('donor_count')->default(0)->after('raised_amount');
            $table->boolean('featured')->default(false)->after('status');
            $table->integer('display_order')->default(0)->after('featured');
            $table->string('category')->default('general')->after('display_order');
            $table->text('short_description')->nullable()->after('description');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn([
                'organization_name',
                'organization_logo',
                'donor_count',
                'featured',
                'display_order',
                'category',
                'short_description',
                'updated_by'
            ]);
        });
    }
};
