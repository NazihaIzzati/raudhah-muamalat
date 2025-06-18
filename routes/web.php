<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\PosterController as AdminPosterController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\AdminTestController;

// Language switcher route
Route::get('/language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/partners', function () {
    return view('partners');
});

Route::get('/campaigns', function () {
    return view('campaigns');
});

Route::get('/all-campaigns', function () {
    return view('all-campaigns');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/donate', function () {
    return view('donate');
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
    
    // FAQ management routes
    Route::get('/faqs', [AdminFaqController::class, 'index'])->name('admin.faqs.index');
    Route::get('/faqs/create', [AdminFaqController::class, 'create'])->name('admin.faqs.create');
    Route::post('/faqs', [AdminFaqController::class, 'store'])->name('admin.faqs.store');
    Route::get('/faqs/{faq}', [AdminFaqController::class, 'show'])->name('admin.faqs.show');
    Route::get('/faqs/{faq}/edit', [AdminFaqController::class, 'edit'])->name('admin.faqs.edit');
    Route::put('/faqs/{faq}', [AdminFaqController::class, 'update'])->name('admin.faqs.update');
    Route::delete('/faqs/{faq}', [AdminFaqController::class, 'destroy'])->name('admin.faqs.destroy');
});