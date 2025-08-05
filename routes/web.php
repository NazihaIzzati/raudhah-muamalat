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
use App\Http\Controllers\Admin\PosterController as AdminPosterController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CardzoneDebugController;


// Language switcher route
Route::get('/language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/partners', [PartnersController::class, 'index'])->name('partners.index');

Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');

Route::get('/all-campaigns', [CampaignController::class, 'allCampaigns'])->name('campaigns.all');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

// Donation routes
Route::get('/donate', function() {
    return redirect()->route('donate.form');
})->name('donate');
Route::get('/donate/{campaignId?}', [DonationController::class, 'showForm'])->name('donate.form');
Route::post('/donate/confirm', [DonationController::class, 'showConfirmation'])->name('donate.confirm');
Route::post('/donate', [DonationController::class, 'processDonation'])->name('donate.process');

// Payment routes
Route::prefix('payment')->group(function () {
    // =============================================================================
    // CARDZONE 3DS PAYMENT FLOW ROUTES
    // =============================================================================
    
    // Step 1: Payment Initiation & Processing
    Route::prefix('cardzone')->group(function () {
        // Payment page display
        Route::get('/page', [PaymentController::class, 'showPaymentPage'])->name('cardzone.page');
        Route::get('/pay', [PaymentController::class, 'showPaymentPage'])->name('cardzone.pay');
        Route::get('/debug', [PaymentController::class, 'showPaymentPage'])->name('cardzone.debug');
        
        // Payment processing
        Route::post('/initiate', [PaymentController::class, 'initiatePayment'])->name('cardzone.initiate');
        Route::post('/key-exchange', [PaymentController::class, 'performKeyExchange'])->name('cardzone.key-exchange');
        

    });
    
    // Step 2: Payment Gateway Redirection
    Route::prefix('cardzone')->group(function () {
        // Redirect to 3DS gateway
        Route::get('/redirect', [PaymentController::class, 'showRedirectPage'])->name('cardzone.redirect');
    });
    
    // Step 3: Payment Callback Processing
    Route::prefix('cardzone')->group(function () {
        // Cardzone callback
        Route::post('/callback', [PaymentController::class, 'handleCardzoneCallback'])->name('cardzone.callback');
    });
    
    // Step 4: Payment Results & Receipts
    Route::prefix('cardzone')->group(function () {
        // Payment success page
        Route::get('/success', [PaymentController::class, 'paymentSuccess'])->name('cardzone.success');
        
        // Payment failure page
        Route::get('/failure', [PaymentController::class, 'paymentFailure'])->name('cardzone.failure');
    });
    
    // =============================================================================
    // PAYNET FPX PAYMENT FLOW ROUTES
    // =============================================================================
    
    // Step 1: Payment Initiation & Processing
    Route::prefix('fpx')->group(function () {
        // Payment processing (AR message)
        Route::post('/process', [PaymentController::class, 'processFpxPayment'])->name('fpx.process');
        
        // Payment page display
        Route::get('/page', [PaymentController::class, 'showPaymentPage'])->name('fpx.page');
        
        // Bank list API
        Route::get('/banks', [PaymentController::class, 'getFpxBankList'])->name('fpx.banks.list');
        Route::get('/banks/active', [PaymentController::class, 'getActiveFpxBanks'])->name('fpx.banks.active');
        Route::post('/banks/update-status', [PaymentController::class, 'updateFpxBankStatus'])->name('fpx.banks.update-status');
        Route::get('/banks/status-summary', [PaymentController::class, 'getFpxBankStatusSummary'])->name('fpx.banks.status-summary');
    });
    
    // Step 2: Payment Gateway Redirection (AR → Gateway)
    Route::prefix('fpx')->group(function () {
        // Redirect to FPX gateway
        Route::get('/redirect', [PaymentController::class, 'showFpxRedirect'])->name('fpx.redirect');
        

    });
    
    // Step 3: Payment Callback Processing (AC message)
    Route::prefix('fpx')->group(function () {
        // Paynet callback (AC message)
        Route::post('/callback', [PaymentController::class, 'handlePaynetCallback'])->name('fpx.callback');
        
        // Manual status enquiry (AE message)
        Route::post('/enquiry', [PaymentController::class, 'handleAcknowledgementEnquiry'])->name('fpx.enquiry');
        
        // Message history
        Route::get('/history/{transaction_id}', [PaymentController::class, 'showFpxMessageHistory'])->name('fpx.history');
    });
    
    // Step 4: Payment Results & Receipts
    Route::prefix('fpx')->group(function () {
        // Payment success page
        Route::get('/success', [PaymentController::class, 'paymentSuccess'])->name('fpx.success');
        
        // Payment failure page
        Route::get('/failure', [PaymentController::class, 'paymentFailure'])->name('fpx.failure');
        
        // Payment receipt
        Route::get('/receipt', [PaymentController::class, 'showReceipt'])->name('fpx.receipt');
    });
    

});

// =============================================================================
// API ROUTES FOR FRONTEND
// =============================================================================
Route::prefix('api')->group(function () {
    // =============================================================================
    // CARDZONE API ROUTES
    // =============================================================================
    Route::prefix('cardzone')->group(function () {
        // Bank list API
        Route::get('/banks', [PaymentController::class, 'getBankList'])->name('api.cardzone.banks.list');
        
        // Payment processing API
        Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('api.cardzone.payment.process');
        Route::post('/payment/initiate', [PaymentController::class, 'initiatePayment'])->name('api.cardzone.payment.initiate');
        Route::post('/payment/key-exchange', [PaymentController::class, 'performKeyExchange'])->name('api.cardzone.payment.key-exchange');
    });
    
    // =============================================================================
    // FPX API ROUTES (Paynet)
    // =============================================================================
    Route::prefix('fpx')->group(function () {
        // Bank management
        Route::get('/banks', [PaymentController::class, 'getFpxBankList'])->name('api.fpx.banks.list');
        Route::get('/banks/active', [PaymentController::class, 'getActiveFpxBanks'])->name('api.fpx.banks.active');
        Route::post('/banks/update-status', [PaymentController::class, 'updateFpxBankStatus'])->name('api.fpx.banks.update-status');
        Route::get('/banks/status-summary', [PaymentController::class, 'getFpxBankStatusSummary'])->name('api.fpx.banks.status-summary');
    });
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/example', function () {
    return view('example-page');
});

// Test route for image preview
Route::get('/test-image-preview', function() {
    return view('test-image-preview');
});

Route::get('/test-sweetalert', function() {
    return view('test-sweetalert');
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
    Route::post('/settings', [AdminDashboardController::class, 'updateSettings'])->name('admin.settings.update');
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
                Route::patch('/campaigns/{campaign}/restore', [AdminCampaignController::class, 'restore'])->name('admin.campaigns.restore');
                Route::delete('/campaigns/{campaign}/force-delete', [AdminCampaignController::class, 'forceDelete'])->name('admin.campaigns.force-delete');
                Route::get('/campaigns/trashed', [AdminCampaignController::class, 'trashed'])->name('admin.campaigns.trashed');
    
    // Poster management routes
    Route::get('/posters', [AdminPosterController::class, 'index'])->name('admin.posters.index');
    Route::get('/posters/create', [AdminPosterController::class, 'create'])->name('admin.posters.create');
    Route::post('/posters', [AdminPosterController::class, 'store'])->name('admin.posters.store');
    Route::get('/posters/{poster}', [AdminPosterController::class, 'show'])->name('admin.posters.show');
    Route::get('/posters/{poster}/edit', [AdminPosterController::class, 'edit'])->name('admin.posters.edit');
    Route::put('/posters/{poster}', [AdminPosterController::class, 'update'])->name('admin.posters.update');
    Route::delete('/posters/{poster}', [AdminPosterController::class, 'destroy'])->name('admin.posters.destroy');
    
    // Partner management routes
    Route::get('/partners', [AdminPartnerController::class, 'index'])->name('admin.partners.index');
    Route::get('/partners/create', [AdminPartnerController::class, 'create'])->name('admin.partners.create');
    Route::post('/partners', [AdminPartnerController::class, 'store'])->name('admin.partners.store');
    Route::get('/partners/{partner}', [AdminPartnerController::class, 'show'])->name('admin.partners.show');
    Route::get('/partners/{partner}/edit', [AdminPartnerController::class, 'edit'])->name('admin.partners.edit');
    Route::put('/partners/{partner}', [AdminPartnerController::class, 'update'])->name('admin.partners.update');
    Route::delete('/partners/{partner}', [AdminPartnerController::class, 'destroy'])->name('admin.partners.destroy');
    Route::patch('/partners/{partner}/restore', [AdminPartnerController::class, 'restore'])->name('admin.partners.restore');
    Route::delete('/partners/{partner}/force-delete', [AdminPartnerController::class, 'forceDelete'])->name('admin.partners.force-delete');
    Route::get('/partners/trashed', [AdminPartnerController::class, 'trashed'])->name('admin.partners.trashed');
    
    // About management routes
    Route::get('/abouts', [AdminAboutController::class, 'index'])->name('admin.abouts.index');
    Route::get('/abouts/create', [AdminAboutController::class, 'create'])->name('admin.abouts.create');
    Route::post('/abouts', [AdminAboutController::class, 'store'])->name('admin.abouts.store');
    Route::get('/abouts/trashed', [AdminAboutController::class, 'trashed'])->name('admin.abouts.trashed');
    Route::get('/abouts/{about}', [AdminAboutController::class, 'show'])->name('admin.abouts.show');
    Route::get('/abouts/{about}/edit', [AdminAboutController::class, 'edit'])->name('admin.abouts.edit');
    Route::put('/abouts/{about}', [AdminAboutController::class, 'update'])->name('admin.abouts.update');
    Route::delete('/abouts/{about}', [AdminAboutController::class, 'destroy'])->name('admin.abouts.destroy');
    Route::patch('/abouts/{about}/restore', [AdminAboutController::class, 'restore'])->name('admin.abouts.restore');
    Route::delete('/abouts/{about}/force-delete', [AdminAboutController::class, 'forceDelete'])->name('admin.abouts.force-delete');
    
    // FAQ management routes
    Route::get('/faqs', [AdminFaqController::class, 'index'])->name('admin.faqs.index');
    Route::get('/faqs/create', [AdminFaqController::class, 'create'])->name('admin.faqs.create');
    Route::post('/faqs', [AdminFaqController::class, 'store'])->name('admin.faqs.store');
    Route::get('/faqs/{faq}', [AdminFaqController::class, 'show'])->name('admin.faqs.show');
    Route::get('/faqs/{faq}/edit', [AdminFaqController::class, 'edit'])->name('admin.faqs.edit');
    Route::put('/faqs/{faq}', [AdminFaqController::class, 'update'])->name('admin.faqs.update');
    Route::delete('/faqs/{faq}', [AdminFaqController::class, 'destroy'])->name('admin.faqs.destroy');
    Route::patch('/faqs/{faq}/restore', [AdminFaqController::class, 'restore'])->name('admin.faqs.restore');
    Route::delete('/faqs/{faq}/force-delete', [AdminFaqController::class, 'forceDelete'])->name('admin.faqs.force-delete');
    Route::get('/faqs/trashed', [AdminFaqController::class, 'trashed'])->name('admin.faqs.trashed');
    
    // News management routes
    Route::get('/news', [AdminNewsController::class, 'index'])->name('admin.news.index');
    Route::get('/news/create', [AdminNewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [AdminNewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{news}', [AdminNewsController::class, 'show'])->name('admin.news.show');
    Route::get('/news/{news}/edit', [AdminNewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{news}', [AdminNewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}', [AdminNewsController::class, 'destroy'])->name('admin.news.destroy');
    Route::patch('/news/{news}/restore', [AdminNewsController::class, 'restore'])->name('admin.news.restore');
    Route::delete('/news/{news}/force-delete', [AdminNewsController::class, 'forceDelete'])->name('admin.news.force-delete');
    Route::get('/news/trashed', [AdminNewsController::class, 'trashed'])->name('admin.news.trashed');
    
    // Contact management routes
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/contacts/trashed', [AdminContactController::class, 'trashed'])->name('admin.contacts.trashed');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('admin.contacts.show');
    Route::get('/contacts/{contact}/edit', [AdminContactController::class, 'edit'])->name('admin.contacts.edit');
    Route::put('/contacts/{contact}', [AdminContactController::class, 'update'])->name('admin.contacts.update');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('admin.contacts.destroy');
    Route::patch('/contacts/{contact}/mark-replied', [AdminContactController::class, 'markReplied'])->name('admin.contacts.mark-replied');
    Route::patch('/contacts/{contact}/mark-urgent', [AdminContactController::class, 'markUrgent'])->name('admin.contacts.mark-urgent');
    Route::patch('/contacts/{contact}/restore', [AdminContactController::class, 'restore'])->name('admin.contacts.restore');
    Route::delete('/contacts/{contact}/force-delete', [AdminContactController::class, 'forceDelete'])->name('admin.contacts.force-delete');
    
    // =============================================================================
    // CARDZONE DEBUG & ADMIN ROUTES
    // =============================================================================
    
    // Cardzone Debug Dashboard
    Route::prefix('cardzone')->group(function () {
        // Main debug dashboard
        Route::get('/debug', [CardzoneDebugController::class, 'index'])->name('admin.cardzone.debug');
        
        // Log management
        Route::get('/debug/logs', [CardzoneDebugController::class, 'logs'])->name('admin.cardzone.debug.logs');
        Route::post('/debug/clear-logs', [CardzoneDebugController::class, 'clearLogs'])->name('admin.cardzone.debug.clear-logs');
        Route::get('/debug/download', [CardzoneDebugController::class, 'downloadLogs'])->name('admin.cardzone.debug.download');
        
        // Transaction management
        Route::get('/debug/transactions', [CardzoneDebugController::class, 'transactions'])->name('admin.cardzone.debug.transactions');
        Route::get('/debug/transactions/{transaction}', [CardzoneDebugController::class, 'showTransaction'])->name('admin.cardzone.debug.transaction.show');
        Route::get('/debug/get-stats', [CardzoneDebugController::class, 'getStats'])->name('admin.cardzone.debug.get-stats');
    });

    // Cardzone Logs routes (new dedicated logs system)
    Route::prefix('cardzone')->group(function () {
        Route::get('/logs', [App\Http\Controllers\CardzoneLogController::class, 'logs'])->name('admin.cardzone.logs');
        Route::post('/logs/clear', [App\Http\Controllers\CardzoneLogController::class, 'clearLogs'])->name('admin.cardzone.logs.clear');
        Route::get('/logs/download', [App\Http\Controllers\CardzoneLogController::class, 'downloadLogs'])->name('admin.cardzone.logs.download');
        Route::get('/logs/live', [App\Http\Controllers\CardzoneLogController::class, 'getLiveLogs'])->name('admin.cardzone.logs.live');
    });

    // Paynet Debug routes
    Route::prefix('paynet')->group(function () {
        Route::get('/logs', [App\Http\Controllers\PaynetLogController::class, 'logs'])->name('admin.paynet.logs');
        Route::post('/logs/clear', [App\Http\Controllers\PaynetLogController::class, 'clearLogs'])->name('admin.paynet.logs.clear');
        Route::get('/logs/download', [App\Http\Controllers\PaynetLogController::class, 'downloadLogs'])->name('admin.paynet.logs.download');
        Route::get('/logs/live', [App\Http\Controllers\PaynetLogController::class, 'getLiveLogs'])->name('admin.paynet.logs.live');
    });
    

});

