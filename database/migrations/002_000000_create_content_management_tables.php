<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create content management tables
     * 
     * This migration creates all the content management tables:
     * - campaigns: Fundraising campaigns
     * - donations: Donation records
     * - news: News articles
     * - events: Events management
     * - partners: Partner organizations
     * - faqs: Frequently asked questions
     * - contacts: Contact form submissions
     * - posters: Promotional posters
     */
    public function up(): void
    {
        // Campaigns table
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('qr_code_image')->nullable()->comment('QR code image for payment/donation');
            $table->decimal('goal_amount', 10, 2);
            $table->decimal('raised_amount', 10, 2)->default(0.00);
            $table->string('currency')->default('MYR');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('status')->default('draft'); // draft, active, completed, cancelled
            $table->foreignId('created_by')->constrained('staff')->cascadeOnDelete()->comment('Link to staff who created this');
            $table->timestamps();
            $table->softDeletes();
        });

        // Donations table
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->nullable()->constrained()->nullOnDelete()->comment('Link to donors table');
            $table->foreignId('campaign_id')->nullable()->constrained()->nullOnDelete();
            $table->string('donor_name');
            $table->string('donor_email');
            $table->string('donor_phone')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('MYR');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('transaction_id')->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // News table
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->string('featured_image')->nullable();
            $table->string('author')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->string('status')->default('draft'); // draft, published, archived
            $table->foreignId('created_by')->constrained('staff')->cascadeOnDelete()->comment('Link to staff who created this');
            $table->timestamps();
            $table->softDeletes();
        });

        // Events table
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('location')->nullable();
            $table->string('status')->default('draft'); // draft, active, completed, cancelled
            $table->foreignId('created_by')->constrained('staff')->cascadeOnDelete()->comment('Link to staff who created this');
            $table->timestamps();
            $table->softDeletes();
        });

        // Partners table
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('status')->default('active'); // active, inactive
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // FAQs table
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->string('category')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Contacts table
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->string('status')->default('unread'); // unread, read, replied
            $table->text('admin_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Posters table
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('status')->default('active'); // active, inactive
            $table->integer('sort_order')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Notifications table
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('message');
            $table->string('type')->default('info'); // info, success, warning, error
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('posters');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('partners');
        Schema::dropIfExists('events');
        Schema::dropIfExists('news');
        Schema::dropIfExists('donations');
        Schema::dropIfExists('campaigns');
    }
}; 