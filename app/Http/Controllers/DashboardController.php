<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // If admin, redirect to admin dashboard
        if ($user->isAdmin()) {
            return redirect('/admin/dashboard');
        }

        return view('dashboard', compact('user'));
    }
}