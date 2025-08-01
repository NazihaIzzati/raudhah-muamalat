<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\CardzoneDebugController;
use App\Http\Controllers\AdminTestController;
use App\Http\Controllers\PartnersController;

// Language switcher route
Route::get('/language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/partners', [PartnersController::class, 'index'])->name('partners');

Route::get('/campaigns', function () {
    return view('campaigns');
});

Route::get('/all-campaigns', function () {
    return view('all-campaigns');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index']);
Route::get('/news', [App\Http\Controllers\NewsController::class, 'index']);

// Donation routes
Route::get('/donate/{campaignId?}', [DonationController::class, 'showForm'])->name('donate.form');
Route::post('/donate/confirm', [DonationController::class, 'showConfirmation'])->name('donate.confirm');
Route::post('/donate', [DonationController::class, 'processDonation'])->name('donate.process');

// Payment routes
Route::prefix('payment')->group(function () {
    // Cardzone 3DS payment routes
    Route::get('/pay', [PaymentController::class, 'showPaymentPage'])->name('payment.show');
    Route::get('/page', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
    Route::get('/debug', [PaymentController::class, 'showPaymentPage'])->name('payment.debug');
    Route::post('/api/initiate-payment', [PaymentController::class, 'initiatePayment'])->name('api.payment.initiate');
    Route::post('/api/key-exchange', [PaymentController::class, 'performKeyExchange'])->name('api.payment.key-exchange');
    Route::get('/redirect', [PaymentController::class, 'showRedirectPage'])->name('payment.redirect');
    Route::post('/cardzone/callback', [PaymentController::class, 'handleCardzoneCallback'])->name('cardzone.callback');
    Route::get('/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');
    
    // Test endpoint for Cardzone connectivity
    Route::get('/test-cardzone', [PaymentController::class, 'testCardzoneConnection'])->name('payment.test-cardzone');
});

// API routes for frontend
Route::prefix('api')->group(function () {
    // Bank list API
    Route::get('/banks', [PaymentController::class, 'getBankList'])->name('api.banks.list');
    
    // Payment processing API
    Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('api.payment.process');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/example', function () {
    return view('example-page');
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// User dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/settings', [AdminDashboardController::class, 'settings'])->name('admin.settings');
    // Profile page route
    Route::view('/profile', 'admin.profile')->name('admin.profile');
    
    // Notification routes
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('/notifications/all', [AdminNotificationController::class, 'show'])->name('admin.notifications.show');
    Route::post('/notifications/{notificationId}/read', [AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.read');
    Route::post('/notifications/mark-all-read', [AdminNotificationController::class, 'markAllAsRead'])->name('admin.notifications.mark-all-read');
    Route::delete('/notifications/{notification}', [AdminNotificationController::class, 'destroy'])->name('admin.notifications.destroy');
    Route::post('/notifications/bulk-action', [AdminNotificationController::class, 'bulkAction'])->name('admin.notifications.bulk-action');
    
    // User management routes
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Event management routes
    Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}', [AdminEventController::class, 'show'])->name('admin.events.show');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');
    
    // Donation management routes
    Route::get('/donations', [AdminDonationController::class, 'index'])->name('admin.donations.index');
    Route::get('/donations/create', [AdminDonationController::class, 'create'])->name('admin.donations.create');
    Route::post('/donations', [AdminDonationController::class, 'store'])->name('admin.donations.store');
    Route::get('/donations/{donation}', [AdminDonationController::class, 'show'])->name('admin.donations.show');
    Route::get('/donations/{donation}/edit', [AdminDonationController::class, 'edit'])->name('admin.donations.edit');
    Route::put('/donations/{donation}', [AdminDonationController::class, 'update'])->name('admin.donations.update');
    Route::post('/donations/{donation}/status', [AdminDonationController::class, 'updateStatus'])->name('admin.donations.update-status');
    Route::delete('/donations/{donation}', [AdminDonationController::class, 'destroy'])->name('admin.donations.destroy');
    Route::get('/donations-export', [AdminDonationController::class, 'export'])->name('admin.donations.export');
    
    // Campaign management routes
    Route::get('/campaigns', [AdminCampaignController::class, 'index'])->name('admin.campaigns.index');
    Route::get('/campaigns/create', [AdminCampaignController::class, 'create'])->name('admin.campaigns.create');
    Route::post('/campaigns', [AdminCampaignController::class, 'store'])->name('admin.campaigns.store');
    Route::get('/campaigns/{campaign}', [AdminCampaignController::class, 'show'])->name('admin.campaigns.show');
    Route::get('/campaigns/{campaign}/edit', [AdminCampaignController::class, 'edit'])->name('admin.campaigns.edit');
    Route::put('/campaigns/{campaign}', [AdminCampaignController::class, 'update'])->name('admin.campaigns.update');
    Route::delete('/campaigns/{campaign}', [AdminCampaignController::class, 'destroy'])->name('admin.campaigns.destroy');
    
    // News management routes (replaced posters)
Route::get('/news', [AdminNewsController::class, 'index'])->name('admin.news.index');
Route::get('/news/create', [AdminNewsController::class, 'create'])->name('admin.news.create');
Route::post('/news', [AdminNewsController::class, 'store'])->name('admin.news.store');
Route::get('/news/{news}', [AdminNewsController::class, 'show'])->name('admin.news.show');
Route::get('/news/{news}/edit', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
Route::put('/news/{news}', [AdminNewsController::class, 'update'])->name('admin.news.update');
Route::delete('/news/{news}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');
Route::patch('/news/{id}/restore', [AdminNewsController::class, 'restore'])->name('admin.news.restore');
Route::delete('/news/{id}/force-delete', [AdminNewsController::class, 'forceDelete'])->name('admin.news.force-delete');
Route::get('/news/trashed', [AdminNewsController::class, 'trashed'])->name('admin.news.trashed');
    
    // Partner management routes
    Route::get('/partners', [AdminPartnerController::class, 'index'])->name('admin.partners.index');
    Route::get('/partners/create', [AdminPartnerController::class, 'create'])->name('admin.partners.create');
    Route::post('/partners', [AdminPartnerController::class, 'store'])->name('admin.partners.store');
    Route::get('/partners/{partner}', [AdminPartnerController::class, 'show'])->name('admin.partners.show');
    Route::get('/partners/{partner}/edit', [AdminPartnerController::class, 'edit'])->name('admin.partners.edit');
    Route::put('/partners/{partner}', [AdminPartnerController::class, 'update'])->name('admin.partners.update');
    Route::delete('/partners/{partner}', [AdminPartnerController::class, 'destroy'])->name('admin.partners.destroy');
    Route::patch('/partners/{id}/restore', [AdminPartnerController::class, 'restore'])->name('admin.partners.restore');
    Route::delete('/partners/{id}/force-delete', [AdminPartnerController::class, 'forceDelete'])->name('admin.partners.force-delete');
    Route::get('/partners/trashed', [AdminPartnerController::class, 'trashed'])->name('admin.partners.trashed');
    

    
    // FAQ management routes
    Route::get('/faqs', [AdminFaqController::class, 'index'])->name('admin.faqs.index');
    Route::get('/faqs/create', [AdminFaqController::class, 'create'])->name('admin.faqs.create');
    Route::post('/faqs', [AdminFaqController::class, 'store'])->name('admin.faqs.store');
    Route::get('/faqs/{faq}', [AdminFaqController::class, 'show'])->name('admin.faqs.show');
    Route::get('/faqs/{faq}/edit', [AdminFaqController::class, 'edit'])->name('admin.faqs.edit');
    Route::put('/faqs/{faq}', [AdminFaqController::class, 'update'])->name('admin.faqs.update');
    Route::delete('/faqs/{faq}', [AdminFaqController::class, 'destroy'])->name('admin.faqs.destroy');
Route::patch('/faqs/{id}/restore', [AdminFaqController::class, 'restore'])->name('admin.faqs.restore');
Route::delete('/faqs/{id}/force-delete', [AdminFaqController::class, 'forceDelete'])->name('admin.faqs.force-delete');
Route::get('/faqs/trashed', [AdminFaqController::class, 'trashed'])->name('admin.faqs.trashed');


    
    // Contact management routes
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/trashed', [AdminContactController::class, 'trashed'])->name('admin.contacts.trashed');
    Route::patch('/contacts/{id}/restore', [AdminContactController::class, 'restore'])->name('admin.contacts.restore');
    Route::delete('/contacts/{id}/force-delete', [AdminContactController::class, 'forceDelete'])->name('admin.contacts.force-delete');
    Route::patch('/contacts/{contact}/mark-urgent', [AdminContactController::class, 'markUrgent'])->name('admin.contacts.mark-urgent');
    Route::patch('/contacts/{contact}/remove-urgent', [AdminContactController::class, 'removeUrgent'])->name('admin.contacts.remove-urgent');
    Route::patch('/contacts/{contact}/mark-replied', [AdminContactController::class, 'markReplied'])->name('admin.contacts.mark-replied');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
    Route::get('/contacts/{contact}/edit', [AdminContactController::class, 'edit'])->name('admin.contacts.edit');
    Route::put('/contacts/{contact}', [AdminContactController::class, 'update'])->name('admin.contacts.update');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');
    
    // Cardzone Debug routes
                Route::prefix('cardzone')->group(function () {
                Route::get('/debug', [CardzoneDebugController::class, 'index'])->name('admin.cardzone.debug');
                Route::get('/debug/logs', [CardzoneDebugController::class, 'logs'])->name('admin.cardzone.debug.logs');
                Route::post('/debug/clear-logs', [CardzoneDebugController::class, 'clearLogs'])->name('admin.cardzone.debug.clear-logs');
                Route::post('/debug/test-payment', [CardzoneDebugController::class, 'testPayment'])->name('admin.cardzone.debug.test-payment');
                Route::post('/debug/test-key-exchange', [CardzoneDebugController::class, 'testKeyExchange'])->name('admin.cardzone.debug.test-key-exchange');
                Route::post('/debug/test-environment', [CardzoneDebugController::class, 'testEnvironment'])->name('admin.cardzone.debug.test-environment');
                Route::post('/debug/test-mac-verification', [CardzoneDebugController::class, 'testMACVerification'])->name('admin.cardzone.debug.test-mac-verification');
                Route::get('/debug/transactions', [CardzoneDebugController::class, 'transactions'])->name('admin.cardzone.debug.transactions');
                Route::get('/debug/transactions/{transaction}', [CardzoneDebugController::class, 'showTransaction'])->name('admin.cardzone.debug.transaction.show');
                Route::get('/debug/get-stats', [CardzoneDebugController::class, 'getStats'])->name('admin.cardzone.debug.get-stats');
                Route::get('/debug/download', [CardzoneDebugController::class, 'downloadLogs'])->name('admin.cardzone.debug.download');
            });
    
    // Temporary test route without admin middleware
    Route::get('/cardzone-test', [CardzoneDebugController::class, 'index'])->name('cardzone.test');
    
    // Payment flow test route
    Route::get('/cardzone-payment-test', function() {
        include base_path('test_payment_form_display.php');
    })->name('cardzone.payment-test');
});

Route::get('/payment/success', function (\Illuminate\Http\Request $request) {
    $donation = \App\Models\Donation::find($request->donation_id);
    return view('payment_status', ['status' => 'success', 'donation' => $donation]);
})->name('payment.success');

Route::get('/payment/failure', function (\Illuminate\Http\Request $request) {
    $donation = \App\Models\Donation::find($request->donation_id);
    $message = $request->message;
    return view('payment_status', ['status' => 'failure', 'donation' => $donation, 'message' => $message]);
})->name('payment.failure');