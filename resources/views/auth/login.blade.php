@extends('layouts.master')

@section('title', 'Sign In - Jariah Fund')
@section('description', 'Sign in to your Jariah Fund account to access your dashboard and manage your donations.')

@section('content')
<div class="bg-gradient-to-br from-primary-50 to-primary-100 min-h-screen flex items-center justify-center py-8 px-4">
    <div class="bg-white shadow-xl rounded-3xl border border-primary-200 p-10 w-full max-w-md mx-auto">
        <!-- Brand Icon -->
        <div class="bg-gradient-to-r from-primary-500 to-primary-400 rounded-2xl w-14 h-14 flex items-center justify-center mx-auto mb-6 shadow-lg shadow-primary-500/20">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>
        
        <!-- Header -->
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">Sign in to Jariah Fund</h2>
        <p class="text-center text-gray-500 mb-6">Continue your journey of giving</p>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm mb-6 flex items-center">
                <svg class="w-5 h-5 flex-shrink-0 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ url('/login') }}" method="POST" autocomplete="off" class="space-y-6">
            @csrf
            
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email address</label>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    required 
                    value="{{ old('email') }}" 
                    class="w-full px-4 py-3 border border-primary-200 rounded-xl bg-primary-50/50 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200"
                    placeholder="Enter your email"
                />
            </div>
            
            <!-- Password Field -->
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                <input 
                    id="password" 
                    name="password" 
                    type="password" 
                    required 
                    class="w-full px-4 py-3 pr-12 border border-primary-200 rounded-xl bg-primary-50/50 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200"
                    placeholder="Enter your password"
                />
                <button 
                    type="button" 
                    onclick="togglePassword()" 
                    tabindex="-1" 
                    aria-label="Show password"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 mt-3 text-primary-500 hover:text-primary-400 hover:bg-primary-100 p-1 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                >
                    <span id="eye-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        </svg>
                    </span>
                </button>
            </div>
            
            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        class="mr-2 rounded border-gray-300 text-primary-500 focus:ring-primary-500 focus:ring-offset-0"
                    />
                    Remember me
                </label>
                <a href="#" class="text-sm text-primary-500 hover:text-primary-600 font-medium transition-colors duration-200">
                    Forgot password?
                </a>
            </div>
            
            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-primary-500 to-primary-400 text-white font-semibold py-3 px-4 rounded-xl hover:from-primary-600 hover:to-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transform hover:scale-[1.02] transition-all duration-200 shadow-lg shadow-primary-500/25"
            >
                Sign In
            </button>
        </form>
        
        <!-- Register Link -->
        <div class="mt-6 text-center text-sm text-gray-500">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-primary-500 hover:text-primary-600 font-medium transition-colors duration-200">
                Create one
            </a>
        </div>
    </div>
</div>
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    const toggleButton = eyeIcon.parentElement;
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.setAttribute('aria-label', 'Hide password');
        eyeIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 002.25 12s3.75 7.5 9.75 7.5c2.042 0 3.82-.393 5.304-1.05M6.228 6.228A10.477 10.477 0 0112 4.5c6 0 9.75 7.5 9.75 7.5a10.478 10.478 0 01-1.272 2.011M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
            </svg>
        `;
    } else {
        passwordInput.type = 'password';
        toggleButton.setAttribute('aria-label', 'Show password');
        eyeIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
            </svg>
        `;
    }
}
</script>
@endsection
