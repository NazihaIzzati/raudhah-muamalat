<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Set the remember_web cookie if remember is checked
            if ($remember) {
                $this->setRememberMeCookie();
            }
            $request->session()->regenerate();

            $user = Auth::user();
            
            // Redirect based on user role
            if ($user->isAdmin()) {
                return redirect()->intended('/admin/dashboard');
            }
            
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput();
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
    /**
     * Set the remember_web cookie for remember me functionality
     */
    protected function setRememberMeCookie()
    {
        Cookie::queue('remember_web', 'remembered', 60 * 24 * 30); // 30 days
    }
}