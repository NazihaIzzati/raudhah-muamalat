@extends('layouts.admin')

@section('title', 'Settings - Admin Dashboard')
@section('page-title', 'Settings')

@section('content')
<div class="space-y-6">
    <!-- General Settings -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">General Settings</h3>
        </div>
        <div class="p-6">
            <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                        <input type="text" id="site_name" name="site_name" value="Jariah Fund" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label for="site_email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                        <input type="email" id="site_email" name="site_email" value="info@jariahfund.com"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>
                
                <div>
                    <label for="site_description" class="block text-sm font-medium text-gray-700">Site Description</label>
                    <textarea id="site_description" name="site_description" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">A trusted crowdfunding platform to help the underprivileged. Contributing to society with Islamic values.</textarea>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Payment Settings -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Payment Settings</h3>
        </div>
        <div class="p-6">
            <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-700">Default Currency</label>
                        <select id="currency" name="currency" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                            <option value="MYR" selected>Malaysian Ringgit (MYR)</option>
                            <option value="USD">US Dollar (USD)</option>
                            <option value="EUR">Euro (EUR)</option>
                        </select>
                    </div>
                    <div>
                        <label for="min_donation" class="block text-sm font-medium text-gray-700">Minimum Donation Amount</label>
                        <input type="number" id="min_donation" name="min_donation" value="10" min="1"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>
                
                <div class="space-y-4">
                    <h4 class="text-sm font-medium text-gray-900">Payment Methods</h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded border-gray-300 text-orange-500 focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-700">DuitNow QR</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded border-gray-300 text-orange-500 focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-700">FPX Online Banking</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded border-gray-300 text-orange-500 focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-700">Credit/Debit Card</span>
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Security Settings -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Security Settings</h3>
        </div>
        <div class="p-6">
            <form class="space-y-6">
                <div class="space-y-4">
                    <h4 class="text-sm font-medium text-gray-900">User Registration</h4>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="registration" value="open" checked class="border-gray-300 text-orange-500 focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-700">Open registration</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="registration" value="approval" class="border-gray-300 text-orange-500 focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-700">Require admin approval</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="registration" value="closed" class="border-gray-300 text-orange-500 focus:ring-orange-500">
                            <span class="ml-2 text-sm text-gray-700">Closed registration</span>
                        </label>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="session_timeout" class="block text-sm font-medium text-gray-700">Session Timeout (minutes)</label>
                        <input type="number" id="session_timeout" name="session_timeout" value="120" min="5"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label for="max_login_attempts" class="block text-sm font-medium text-gray-700">Max Login Attempts</label>
                        <input type="number" id="max_login_attempts" name="max_login_attempts" value="5" min="1"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection