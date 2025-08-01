<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create core Laravel system tables
     * 
     * This migration creates the foundational tables for the Laravel application:
     * - users: Main user accounts table with authentication (for staff and donors)
     * - staff: Staff member profiles and details
     * - donors: Donor profiles and details
     * - password_reset_tokens: For password reset functionality
     * - sessions: For session management
     * - cache: For application caching
     * - jobs: For queue job processing
     */
    public function up(): void
    {
        // Users table - Core authentication (for both staff and donors)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('user_type', ['staff', 'donor'])->comment('Type of user: staff or donor');
            $table->boolean('is_active')->default(true)->comment('Whether user account is active');
            $table->timestamp('last_login_at')->nullable()->comment('Last login timestamp');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        // Staff table - Staff member profiles
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->comment('Link to users table');
            $table->string('employee_id')->unique()->comment('Employee ID number');
            $table->string('position')->comment('Job position/title');
            $table->string('department')->nullable()->comment('Department/division');
            $table->string('phone')->nullable()->comment('Contact phone number');
            $table->text('address')->nullable()->comment('Full address');
            $table->string('profile_picture')->nullable()->comment('Profile image path');
            $table->enum('role', ['hq', 'admin', 'manager', 'staff'])->default('staff')->comment('Staff role level');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->comment('Staff status');
            $table->date('hire_date')->nullable()->comment('Date hired');
            $table->date('termination_date')->nullable()->comment('Date terminated (if applicable)');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->timestamps();
            $table->softDeletes();
        });

        // Donors table - Donor profiles
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->comment('Link to users table');
            $table->string('donor_id')->unique()->comment('Donor ID number');
            $table->string('identification_number')->nullable()->comment('IC/Passport/Company registration number');
            $table->string('phone')->nullable()->comment('Contact phone number');
            $table->text('address')->nullable()->comment('Full address');
            $table->string('profile_picture')->nullable()->comment('Profile image path');
            $table->enum('donor_type', ['individual', 'corporate', 'anonymous'])->default('individual')->comment('Type of donor');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->comment('Donor status');
            $table->date('registration_date')->comment('Date registered as donor');
            $table->decimal('total_donated', 12, 2)->default(0.00)->comment('Total amount donated');
            $table->integer('donation_count')->default(0)->comment('Number of donations made');
            $table->date('last_donation_date')->nullable()->comment('Date of last donation');
            $table->boolean('newsletter_subscribed')->default(false)->comment('Newsletter subscription status');
            $table->text('preferences')->nullable()->comment('Donor preferences (JSON)');
            $table->text('notes')->nullable()->comment('Additional notes');
            $table->timestamps();
            $table->softDeletes();
        });

        // Password reset tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // Cache table
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        // Jobs table for queue processing
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        // Failed jobs table
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('failed_jobs');
    }
}; 