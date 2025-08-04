<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Staff;
use App\Models\Donor;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        $currentMonth = Carbon::now()->startOfMonth();
        
        $stats = [
            'total_users' => User::count(),
            'total_staff' => Staff::count(),
            'total_donors' => Donor::count(),
            'recent_users' => User::with(['staff', 'donor'])->latest()->take(5)->get(),
            'current_month_users' => User::where('created_at', '>=', $currentMonth)->with(['staff', 'donor'])->latest()->get(),
            'total_campaigns' => Campaign::count(),
            'active_campaigns' => Campaign::where('status', 'active')->count(),
            'total_donations' => Donation::count(),
            'total_raised' => Donation::where('payment_status', 'completed')->sum('amount'),
            'current_month_donations' => Donation::where('created_at', '>=', $currentMonth)
                ->with(['campaign', 'donor.user'])
                ->latest()
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }


    /**
     * Show settings
     */
    public function settings()
    {
        $settings = \App\Models\Setting::getSettings();
        return view('admin.settings', compact('settings'));
    }

    /**
     * Update settings
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email|max:255',
            'site_phone' => 'nullable|string|max:20',
            'site_description' => 'nullable|string',
            'currency' => 'required|string|max:3',
            'min_donation' => 'required|numeric|min:0',
            'duitnow_qr_enabled' => 'boolean',
            'fpx_banking_enabled' => 'boolean',
            'card_payment_enabled' => 'boolean',
            'registration_type' => 'required|in:open,approval,closed',
            'session_timeout' => 'required|integer|min:30|max:480',
            'max_login_attempts' => 'required|integer|min:1|max:10',
            'email_new_donations' => 'boolean',
            'email_new_registrations' => 'boolean',
            'email_campaign_updates' => 'boolean',
            'admin_email' => 'required|email|max:255',
        ]);

        // Handle boolean fields
        $validated['duitnow_qr_enabled'] = $request->has('duitnow_qr_enabled');
        $validated['fpx_banking_enabled'] = $request->has('fpx_banking_enabled');
        $validated['card_payment_enabled'] = $request->has('card_payment_enabled');
        $validated['email_new_donations'] = $request->has('email_new_donations');
        $validated['email_new_registrations'] = $request->has('email_new_registrations');
        $validated['email_campaign_updates'] = $request->has('email_campaign_updates');

        \App\Models\Setting::updateSettings($validated);

        return redirect()->route('admin.settings')
            ->with('success', 'Settings updated successfully!');
    }
}