@extends('layouts.admin')

@section('title', 'Settings - Admin Dashboard')
@section('page-title', 'Settings')

@section('content')
<div class="space-y-6">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Header Section -->
    <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-bold text-[#fe5000]">System Settings</h3>
                    <p class="text-sm text-gray-600 mt-1">Configure your platform settings and preferences</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- General Settings -->
        <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200 transform hover:shadow-lg transition-all duration-200">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-lg font-semibold text-blue-900">General Settings</h4>
                        <p class="text-sm text-blue-700">Basic platform configuration</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Site Name
                                </span>
                            </label>
                            <input type="text" id="site_name" name="site_name" value="{{ $settings->site_name }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        
                        <div>
                            <label for="site_email" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Contact Email
                                </span>
                            </label>
                            <input type="email" id="site_email" name="site_email" value="{{ $settings->site_email }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <div>
                            <label for="site_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    Contact Phone
                                </span>
                            </label>
                            <input type="tel" id="site_phone" name="site_phone" value="{{ $settings->site_phone }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        
                        <div>
                            <label for="site_description" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                    </svg>
                                    Site Description
                                </span>
                            </label>
                            <textarea id="site_description" name="site_description" rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ $settings->site_description }}</textarea>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-200">
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            <span class="flex items-center justify-center">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save General Settings
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Payment Settings -->
        <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200 transform hover:shadow-lg transition-all duration-200">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-green-50 to-green-100">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-green-500 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-lg font-semibold text-green-900">Payment Settings</h4>
                        <p class="text-sm text-green-700">Configure payment options</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        Default Currency
                                    </span>
                                </label>
                                <select id="currency" name="currency" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                                    <option value="MYR" {{ $settings->currency == 'MYR' ? 'selected' : '' }}>Malaysian Ringgit (MYR)</option>
                                    <option value="USD" {{ $settings->currency == 'USD' ? 'selected' : '' }}>US Dollar (USD)</option>
                                    <option value="EUR" {{ $settings->currency == 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                                    <option value="GBP" {{ $settings->currency == 'GBP' ? 'selected' : '' }}>British Pound (GBP)</option>
                                </select>
                            </div>
                            <div>
                                <label for="min_donation" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        Min. Donation ({{ $settings->currency }})
                                    </span>
                                </label>
                                <input type="number" id="min_donation" name="min_donation" value="{{ $settings->min_donation }}" min="1" step="0.01"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Payment Methods
                                </span>
                            </label>
                            <div class="space-y-3">
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <input type="checkbox" name="duitnow_qr_enabled" value="1" {{ $settings->duitnow_qr_enabled == true ? 'checked' : '' }} class="rounded border-gray-300 text-green-500 focus:ring-green-500 h-4 w-4">
                                    <div class="ml-3 flex items-center">
                                        <div class="h-8 w-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                                <path d="M2 8h20v2H2z" fill="white"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-900">DuitNow QR</span>
                                            <p class="text-xs text-gray-500">Instant Malaysian QR payments</p>
                                        </div>
                                    </div>
                                </label>
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <input type="checkbox" name="fpx_banking_enabled" value="1" {{ $settings->fpx_banking_enabled == true ? 'checked' : '' }} class="rounded border-gray-300 text-green-500 focus:ring-green-500 h-4 w-4">
                                    <div class="ml-3 flex items-center">
                                        <div class="h-8 w-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1zM10 6a2 2 0 0 1 4 0v1h-4V6zm6 16H8a1 1 0 0 1-1-1V9h2v1a1 1 0 0 0 2 0V9h2v1a1 1 0 0 0 2 0V9h2v12a1 1 0 0 1-1 1z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-900">FPX Online Banking</span>
                                            <p class="text-xs text-gray-500">Direct bank transfers</p>
                                        </div>
                                    </div>
                                </label>
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <input type="checkbox" name="card_payment_enabled" value="1" {{ $settings->card_payment_enabled == true ? 'checked' : '' }} class="rounded border-gray-300 text-green-500 focus:ring-green-500 h-4 w-4">
                                    <div class="ml-3 flex items-center">
                                        <div class="h-8 w-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="h-4 w-4 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-900">Credit/Debit Card</span>
                                            <p class="text-xs text-gray-500">Visa, Mastercard, AMEX</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-200">
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            <span class="flex items-center justify-center">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Payment Settings
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200 transform hover:shadow-lg transition-all duration-200">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-red-50 to-red-100">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-red-500 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-lg font-semibold text-red-900">Security Settings</h4>
                        <p class="text-sm text-red-700">Platform security configuration</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    User Registration
                                </span>
                            </label>
                            <div class="space-y-3">
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <input type="radio" name="registration_type" value="open" {{ $settings->registration_type == 'open' ? 'checked' : '' }} class="border-gray-300 text-red-500 focus:ring-red-500 h-4 w-4">
                                    <div class="ml-3">
                                        <span class="text-sm font-medium text-gray-900">Open registration</span>
                                        <p class="text-xs text-gray-500">Anyone can register immediately</p>
                                    </div>
                                </label>
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <input type="radio" name="registration_type" value="approval" {{ $settings->registration_type == 'approval' ? 'checked' : '' }} class="border-gray-300 text-red-500 focus:ring-red-500 h-4 w-4">
                                    <div class="ml-3">
                                        <span class="text-sm font-medium text-gray-900">Require admin approval</span>
                                        <p class="text-xs text-gray-500">New users need admin verification</p>
                                    </div>
                                </label>
                                <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer">
                                    <input type="radio" name="registration_type" value="closed" {{ $settings->registration_type == 'closed' ? 'checked' : '' }} class="border-gray-300 text-red-500 focus:ring-red-500 h-4 w-4">
                                    <div class="ml-3">
                                        <span class="text-sm font-medium text-gray-900">Closed registration</span>
                                        <p class="text-xs text-gray-500">No new registrations allowed</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="session_timeout" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Session Timeout
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" id="session_timeout" name="session_timeout" value="{{ $settings->session_timeout }}" min="5" max="1440"
                                           class="w-full px-4 py-3 pr-16 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                    <span class="absolute right-3 top-3 text-sm text-gray-500">min</span>
                                </div>
                            </div>
                            <div>
                                <label for="max_login_attempts" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        Max Login Attempts
                                    </span>
                                </label>
                                <input type="number" id="max_login_attempts" name="max_login_attempts" value="{{ $settings->max_login_attempts }}" min="1" max="20"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-200">
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            <span class="flex items-center justify-center">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Security Settings
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Notification Settings -->
        <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200 transform hover:shadow-lg transition-all duration-200">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-purple-100">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-purple-500 rounded-lg flex items-center justify-center">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 17h5l-5 5v-5zM20 7l-5-5v5h5zM4 7l5-5v5H4z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="text-lg font-semibold text-purple-900">Notification Settings</h4>
                        <p class="text-sm text-purple-700">Configure system notifications</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Email Notifications
                                </span>
                            </label>
                            <div class="space-y-3">
                                <label class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="email_new_donations" value="1" {{ $settings->email_new_donations == true ? 'checked' : '' }} class="rounded border-gray-300 text-purple-500 focus:ring-purple-500 h-4 w-4">
                                        <div class="ml-3">
                                            <span class="text-sm font-medium text-gray-900">New Donations</span>
                                            <p class="text-xs text-gray-500">When donations are received</p>
                                        </div>
                                    </div>
                                </label>
                                <label class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="email_new_registrations" value="1" {{ $settings->email_new_registrations == true ? 'checked' : '' }} class="rounded border-gray-300 text-purple-500 focus:ring-purple-500 h-4 w-4">
                                        <div class="ml-3">
                                            <span class="text-sm font-medium text-gray-900">New User Registration</span>
                                            <p class="text-xs text-gray-500">When users sign up</p>
                                        </div>
                                    </div>
                                </label>
                                <label class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="email_campaign_updates" value="1" {{ $settings->email_campaign_updates == true ? 'checked' : '' }} class="rounded border-gray-300 text-purple-500 focus:ring-purple-500 h-4 w-4">
                                        <div class="ml-3">
                                            <span class="text-sm font-medium text-gray-900">Campaign Updates</span>
                                            <p class="text-xs text-gray-500">When campaigns are modified</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Admin Notification Email
                                </span>
                            </label>
                            <input type="email" id="admin_email" name="admin_email" value="{{ $settings->admin_email }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-200">
                        <button type="submit" class="w-full bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            <span class="flex items-center justify-center">
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Notification Settings
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- System Information -->
    <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex items-center">
                <div class="h-10 w-10 bg-gray-500 rounded-lg flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h4 class="text-lg font-semibold text-gray-900">System Information</h4>
                    <p class="text-sm text-gray-600">Platform details and status</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-4 bg-blue-50 rounded-xl">
                    <div class="text-2xl font-bold text-blue-600">{{ PHP_VERSION }}</div>
                    <div class="text-sm text-blue-700 mt-1">PHP Version</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-xl">
                    <div class="text-2xl font-bold text-green-600">{{ app()->version() }}</div>
                    <div class="text-sm text-green-700 mt-1">Laravel Version</div>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-xl">
                    <div class="text-2xl font-bold text-purple-600">{{ config('database.default') }}</div>
                    <div class="text-sm text-purple-700 mt-1">Database</div>
                </div>
                <div class="text-center p-4 bg-orange-50 rounded-xl">
                    <div class="text-2xl font-bold text-orange-600">v1.0.0</div>
                    <div class="text-sm text-orange-700 mt-1">Application Version</div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.space-y-6 > * {
    animation: fadeInUp 0.5s ease-out;
}

.space-y-6 > *:nth-child(2) { animation-delay: 0.1s; }
.space-y-6 > *:nth-child(3) { animation-delay: 0.2s; }
.space-y-6 > *:nth-child(4) { animation-delay: 0.3s; }

/* Smooth focus transitions */
input:focus, select:focus, textarea:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Enhanced hover effects */
.transform:hover {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}
</style>
@endsection