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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('profile_photo')->nullable()->after('role');
            $table->text('address')->nullable()->after('profile_photo');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('address');
            $table->text('bio')->nullable()->after('status');
            $table->timestamp('last_login_at')->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'profile_photo',
                'address',
                'status',
                'bio',
                'last_login_at'
            ]);
        });
    }
};
