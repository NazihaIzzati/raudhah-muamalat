<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donor;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'donor', // Default to donor
            'is_active' => true,
        ]);

        // Create donor profile
        $user->donor()->create([
            'donor_id' => 'DON' . strtoupper(Str::random(8)),
            'donor_type' => 'individual',
            'registration_date' => now(),
            'status' => 'active',
            'newsletter_subscribed' => false,
        ]);

        // Create notification for new donor registration
        try {
            Notification::createUserRegistrationNotification($user);
        } catch (\Exception $e) {
            // Log error but don't fail the registration
            \Log::error('Failed to create donor registration notification: ' . $e->getMessage());
        }

        Auth::login($user);

        return redirect('/dashboard');
    }
}