@extends('layouts.admin')

@section('title', 'Settings - Admin Dashboard')
@section('page-title', 'Settings')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold text-gray-900">System Settings</h1>
                        <p class="text-gray-600">Configure your platform settings</p>
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    Last updated: {{ $settings->updated_at ? $settings->updated_at->diffForHumans() : 'Never' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Form -->
    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf
        
        <!-- Quick Settings -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Quick Settings</h2>
                <p class="text-sm text-gray-600 mt-1">Most commonly used settings</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                        <input type="text" id="site_name" name="site_name" value="{{ $settings->site_name ?? 'Raudhah Muamalat' }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                        <select id="currency" name="currency" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="MYR" {{ ($settings->currency ?? 'MYR') === 'MYR' ? 'selected' : '' }}>MYR</option>
                            <option value="USD" {{ ($settings->currency ?? 'MYR') === 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="SGD" {{ ($settings->currency ?? 'MYR') === 'SGD' ? 'selected' : '' }}>SGD</option>
                        </select>
                    </div>
                    <div>
                        <label for="registration_type" class="block text-sm font-medium text-gray-700 mb-2">Registration</label>
                        <select id="registration_type" name="registration_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="open" {{ ($settings->registration_type ?? 'open') === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="approval" {{ ($settings->registration_type ?? 'open') === 'approval' ? 'selected' : '' }}>Require Approval</option>
                            <option value="closed" {{ ($settings->registration_type ?? 'open') === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                    <div>
                        <label for="min_donation" class="block text-sm font-medium text-gray-700 mb-2">Min Donation</label>
                        <div class="relative">
                            <input type="number" id="min_donation" name="min_donation" value="{{ $settings->min_donation ?? '10' }}" min="1"
                                   class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <span class="absolute right-3 top-3 text-sm text-gray-500">{{ $settings->currency ?? 'MYR' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Settings Tabs -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button type="button" onclick="showTab('general')" id="tab-general" class="tab-button active border-b-2 py-4 px-1 text-sm font-medium border-[#fe5000] text-[#fe5000]">
                        General
                    </button>
                    <button type="button" onclick="showTab('payment')" id="tab-payment" class="tab-button border-b-2 py-4 px-1 text-sm font-medium border-transparent text-gray-500 hover:text-gray-700">
                        Payment
                    </button>
                    <button type="button" onclick="showTab('security')" id="tab-security" class="tab-button border-b-2 py-4 px-1 text-sm font-medium border-transparent text-gray-500 hover:text-gray-700">
                        Security
                    </button>
                    <button type="button" onclick="showTab('notifications')" id="tab-notifications" class="tab-button border-b-2 py-4 px-1 text-sm font-medium border-transparent text-gray-500 hover:text-gray-700">
                        Notifications
                    </button>
                </nav>
            </div>

            <div class="p-6">
                <!-- General Tab -->
                <div id="tab-content-general" class="tab-content active">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="site_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                                <input type="email" id="site_email" name="site_email" value="{{ $settings->site_email ?? 'info@raudhahmuamalat.com' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="site_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                                <input type="tel" id="site_phone" name="site_phone" value="{{ $settings->site_phone ?? '+60 3-1234 5678' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div>
                            <label for="site_description" class="block text-sm font-medium text-gray-700 mb-2">Site Description</label>
                            <textarea id="site_description" name="site_description" rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none">{{ $settings->site_description ?? 'A trusted Islamic crowdfunding platform dedicated to helping the underprivileged and supporting community development through Sharia-compliant financial solutions.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Tab -->
                <div id="tab-content-payment" class="tab-content hidden">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                            </svg>
                                        </div>
                                        <span class="ml-3 text-sm font-medium">DuitNow QR</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="duitnow_qr_enabled" name="duitnow_qr_enabled" 
                                               {{ ($settings->duitnow_qr_enabled ?? true) ? 'checked' : '' }}
                                               class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 bg-green-100 rounded-lg flex items-center justify-center">
                                            <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V8a1 1 0 0 0-1-1z"/>
                                            </svg>
                                        </div>
                                        <span class="ml-3 text-sm font-medium">FPX Banking</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="fpx_banking_enabled" name="fpx_banking_enabled" 
                                               {{ ($settings->fpx_banking_enabled ?? true) ? 'checked' : '' }}
                                               class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <svg class="h-4 w-4 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2z"/>
                                            </svg>
                                        </div>
                                        <span class="ml-3 text-sm font-medium">Card Payment</span>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="card_payment_enabled" name="card_payment_enabled" 
                                               {{ ($settings->card_payment_enabled ?? true) ? 'checked' : '' }}
                                               class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Tab -->
                <div id="tab-content-security" class="tab-content hidden">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="session_timeout" class="block text-sm font-medium text-gray-700 mb-2">Session Timeout (minutes)</label>
                                <input type="number" id="session_timeout" name="session_timeout" value="{{ $settings->session_timeout ?? '120' }}" min="5" max="480"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label for="max_login_attempts" class="block text-sm font-medium text-gray-700 mb-2">Max Login Attempts</label>
                                <input type="number" id="max_login_attempts" name="max_login_attempts" value="{{ $settings->max_login_attempts ?? '5' }}" min="1" max="10"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifications Tab -->
                <div id="tab-content-notifications" class="tab-content hidden">
                    <div class="space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium">New Donations</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="email_new_donations" name="email_new_donations" 
                                           {{ ($settings->email_new_donations ?? true) ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                </label>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium">New Registrations</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="email_new_registrations" name="email_new_registrations" 
                                           {{ ($settings->email_new_registrations ?? true) ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium">Campaign Updates</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="email_campaign_updates" name="email_campaign_updates" 
                                           {{ ($settings->email_campaign_updates ?? false) ? 'checked' : '' }}
                                           class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                                </label>
                            </div>
                        </div>
                        
                        <div>
                            <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-2">Admin Notification Email</label>
                            <input type="email" id="admin_email" name="admin_email" value="{{ $settings->admin_email ?? 'admin@raudhahmuamalat.com' }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Save All Settings
            </button>
        </div>
    </form>

    <!-- System Info -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">System Information</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">{{ PHP_VERSION }}</div>
                    <div class="text-sm text-blue-700 mt-1">PHP Version</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">{{ app()->version() }}</div>
                    <div class="text-sm text-green-700 mt-1">Laravel Version</div>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600">{{ config('database.default') }}</div>
                    <div class="text-sm text-purple-700 mt-1">Database</div>
                </div>
                <div class="text-center p-4 bg-orange-50 rounded-lg">
                    <div class="text-2xl font-bold text-orange-600">v1.0.0</div>
                    <div class="text-sm text-orange-700 mt-1">App Version</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => content.classList.add('hidden'));
    
    // Remove active class from all tab buttons
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('border-[#fe5000]', 'text-[#fe5000]');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById(`tab-content-${tabName}`).classList.remove('hidden');
    
    // Add active class to selected tab button
    document.getElementById(`tab-${tabName}`).classList.remove('border-transparent', 'text-gray-500');
    document.getElementById(`tab-${tabName}`).classList.add('border-[#fe5000]', 'text-[#fe5000]');
}
</script>

<style>
.tab-content {
    transition: all 0.3s ease-in-out;
}

.tab-button {
    transition: all 0.2s ease-in-out;
}

input:focus, select:focus, textarea:focus {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}
</style>
@endsection