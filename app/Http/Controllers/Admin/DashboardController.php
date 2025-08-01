<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'total_admins' => User::where('role', 'admin')->count(),
            'total_regular_users' => User::where('role', 'user')->count(),
            'recent_users' => User::latest()->take(5)->get(),
            'current_month_users' => User::where('created_at', '>=', $currentMonth)->latest()->get(),
            'total_campaigns' => Campaign::count(),
            'active_campaigns' => Campaign::where('status', 'active')->count(),
            'total_donations' => Donation::count(),
            'total_raised' => Donation::where('payment_status', 'completed')->sum('amount'),
            'current_month_donations' => Donation::where('created_at', '>=', $currentMonth)
                ->with(['user', 'campaign'])
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
        return view('admin.settings');
    }
}