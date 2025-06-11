@extends('layouts.admin')

@section('title', 'Profile - Admin Dashboard')
@section('page-title', 'Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Profile Overview -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="px-8 py-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Profile Overview</h2>
        </div>
        <div class="px-8 py-6">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <div class="flex-shrink-0">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-full bg-orange-100 flex items-center justify-center">
                            <span class="text-4xl font-bold text-orange-600">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <button type="button" 
                                class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex-1 text-center sm:text-left">
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-500 mb-4">{{ Auth::user()->email }}</p>
                    <div class="flex flex-wrap gap-3 justify-center sm:justify-start">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 text-orange-600 text-sm font-medium">
                            <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span> Administrator
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Active
                        </span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="{{ route('admin.settings') }}" 
                       class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-lg font-medium hover:bg-orange-600 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Information -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Personal Details -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Personal Details</h3>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Full Name</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Email</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ Auth::user()->email }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Role</dt>
                        <dd class="text-sm font-medium text-gray-900 capitalize">{{ Auth::user()->role }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">Member Since</dt>
                        <dd class="text-sm font-medium text-gray-900">{{ Auth::user()->created_at->format('M d, Y') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Profile Updated</p>
                            <p class="text-sm text-gray-500">You updated your profile information</p>
                            <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <span class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Campaign Approved</p>
                            <p class="text-sm text-gray-500">Approved new campaign: "Emergency Food Relief"</p>
                            <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <span class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">User Management</p>
                            <p class="text-sm text-gray-500">Added new administrator account</p>
                            <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings & Security -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Security Settings -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Security Settings</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Two-factor Authentication</p>
                            <p class="text-sm text-gray-500">Add an extra layer of security to your account</p>
                        </div>
                        <button type="button" class="px-3 py-1.5 text-sm font-medium text-orange-600 hover:text-orange-700">
                            Enable
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Password</p>
                            <p class="text-sm text-gray-500">Last changed 3 months ago</p>
                        </div>
                        <button type="button" class="px-3 py-1.5 text-sm font-medium text-orange-600 hover:text-orange-700">
                            Change
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Active Sessions</p>
                            <p class="text-sm text-gray-500">Currently active on 2 devices</p>
                        </div>
                        <button type="button" class="px-3 py-1.5 text-sm font-medium text-orange-600 hover:text-orange-700">
                            Manage
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preferences -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-900">Preferences</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Email Notifications</p>
                            <p class="text-sm text-gray-500">Get notified about important updates</p>
                        </div>
                        <button type="button" class="px-3 py-1.5 text-sm font-medium text-orange-600 hover:text-orange-700">
                            Configure
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Language</p>
                            <p class="text-sm text-gray-500">English (US)</p>
                        </div>
                        <button type="button" class="px-3 py-1.5 text-sm font-medium text-orange-600 hover:text-orange-700">
                            Change
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Time Zone</p>
                            <p class="text-sm text-gray-500">UTC +8:00</p>
                        </div>
                        <button type="button" class="px-3 py-1.5 text-sm font-medium text-orange-600 hover:text-orange-700">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
