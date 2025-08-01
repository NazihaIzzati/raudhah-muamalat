<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
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