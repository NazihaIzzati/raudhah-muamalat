<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Setting;
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
            'total_admins' => User::where('role', 'admin')->count(),
            'total_regular_users' => User::where('role', 'user')->count(),
            'recent_users' => User::latest()->take(5)->get(),
            'total_campaigns' => Campaign::count(),
            'active_campaigns' => Campaign::where('status', 'active')->count(),
            'total_donations' => Donation::count(),
            'total_raised' => Donation::where('payment_status', 'completed')->sum('amount'),
        ];

        // Get paginated new users (latest 10 per page)
        $newUsers = User::latest()->paginate(10);

        // Get paginated recent donations (latest 10 per page)
        $newDonors = Donation::with(['user', 'campaign'])
            ->latest()
            ->paginate(10);

        return view('admin.dashboard', compact('stats', 'newUsers', 'newDonors'));
    }


    /**
     * Show settings
     */
    public function settings()
    {
        $settings = Setting::getSettings();
        return view('admin.settings', compact('settings'));
    }

    /**
     * Update settings
     */
    public function updateSettings(Request $request)
    {
        // Debug: Log the request data
        \Log::info('Settings update request:', $request->all());
        
        // Get the submitted data
        $data = $request->all();
        
        // Define validation rules based on what's being submitted
        $validationRules = [];
        
        // General Settings validation
        if ($request->has('site_name')) {
            $validationRules['site_name'] = 'required|string|max:255';
            $validationRules['site_email'] = 'required|email|max:255';
            $validationRules['site_phone'] = 'required|string|max:20';
            $validationRules['site_description'] = 'nullable|string|max:1000';
        }
        
        // Payment Settings validation
        if ($request->has('currency')) {
            $validationRules['currency'] = 'required|in:MYR,USD,EUR,GBP';
            $validationRules['min_donation'] = 'required|numeric|min:0';
            // Always validate payment checkboxes if currency is present
            $validationRules['duitnow_qr_enabled'] = 'nullable|boolean';
            $validationRules['fpx_banking_enabled'] = 'nullable|boolean';
            $validationRules['card_payment_enabled'] = 'nullable|boolean';
        }
        
        // Security Settings validation
        if ($request->has('registration_type')) {
            $validationRules['registration_type'] = 'required|in:open,approval,closed';
            $validationRules['session_timeout'] = 'required|integer|min:5|max:1440';
            $validationRules['max_login_attempts'] = 'required|integer|min:1|max:20';
        }
        
        // Notification Settings validation
        if ($request->has('admin_email')) {
            $validationRules['email_new_donations'] = 'nullable|boolean';
            $validationRules['email_new_registrations'] = 'nullable|boolean';
            $validationRules['email_campaign_updates'] = 'nullable|boolean';
            $validationRules['admin_email'] = 'required|email|max:255';
        }

        // Debug: Log validation rules
        \Log::info('Validation rules:', $validationRules);

        // Validate the submitted data
        $request->validate($validationRules);

        // Convert checkbox values to boolean
        $booleanFields = [
            'duitnow_qr_enabled',
            'fpx_banking_enabled', 
            'card_payment_enabled',
            'email_new_donations',
            'email_new_registrations',
            'email_campaign_updates'
        ];

        foreach ($booleanFields as $field) {
            // Always process boolean fields if they exist in the request
            $data[$field] = $request->has($field);
            // Debug: Log checkbox processing
            \Log::info("Checkbox {$field}: " . ($request->has($field) ? 'true' : 'false'));
        }

        // Debug: Log processed data
        \Log::info('Processed data for update:', $data);

        try {
            Setting::updateSettings($data);
            
            // Debug: Log success
            \Log::info('Settings updated successfully');
            
            return redirect()->route('admin.settings')
                ->with('success', 'Settings updated successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Settings update failed: ' . $e->getMessage());
            
            return redirect()->route('admin.settings')
                ->with('error', 'Failed to update settings. Please try again.');
        }
    }
}