@extends('layouts.admin')

@section('title', 'Dashboard - Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
                        <p class="text-gray-600">Overview of your fundraising platform activities</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="text-sm text-gray-500 bg-gray-100 px-4 py-2 rounded-lg">
                        <span class="text-[#fe5000] font-semibold">{{ now()->format('M d, Y') }}</span>
                    </div>
                    <a href="{{ route('admin.campaigns.create') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Campaign
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
            <p class="text-sm text-gray-600 mt-1">Frequently used management tools</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('admin.campaigns.index') }}" class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-[#fe5000]/30 hover:bg-[#fe5000]/5 transition-all duration-200 transform hover:scale-105">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-lg flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-900">Manage Campaigns</p>
                        <p class="text-xs text-gray-500">View and edit campaigns</p>
                    </div>
                </a>

                <a href="{{ route('admin.donations.index') }}" class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all duration-200 transform hover:scale-105">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-900">View Donations</p>
                        <p class="text-xs text-gray-500">Track all donations</p>
                    </div>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 transform hover:scale-105">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-900">Manage Users</p>
                        <p class="text-xs text-gray-500">User administration</p>
                    </div>
                </a>

                <a href="{{ route('admin.events.index') }}" class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 transform hover:scale-105">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 bg-gradient-to-br from-purple-500 to-violet-600 rounded-lg flex items-center justify-center">
                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-900">Manage Events</p>
                        <p class="text-xs text-gray-500">Event administration</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Statistics Overview</h2>
            <p class="text-sm text-gray-600 mt-1">Key metrics and performance indicators</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Campaigns Card -->
                <div class="text-center p-6 bg-gradient-to-br from-[#fe5000]/5 to-orange-50 rounded-lg border border-[#fe5000]/10">
                    <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-[#fe5000] mb-2">{{ $stats['total_campaigns'] ?? 0 }}</div>
                    <div class="text-sm text-[#fe5000]/70 font-medium">Total Campaigns</div>
                </div>

                <!-- Active Campaigns Card -->
                <div class="text-center p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg border border-green-200/30">
                    <div class="h-12 w-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-green-700 mb-2">{{ $stats['active_campaigns'] ?? 0 }}</div>
                    <div class="text-sm text-green-600/70 font-medium">Active Campaigns</div>
                </div>

                <!-- Total Donations Card -->
                <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg border border-blue-200/30">
                    <div class="h-12 w-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-blue-700 mb-2">{{ $stats['total_donations'] ?? 0 }}</div>
                    <div class="text-sm text-blue-600/70 font-medium">Total Donations</div>
                </div>

                <!-- Total Raised Card -->
                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-violet-50 rounded-lg border border-purple-200/30">
                    <div class="h-12 w-12 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <div class="text-3xl font-bold text-purple-700 mb-2">${{ number_format($stats['total_raised'] ?? 0, 0) }}</div>
                    <div class="text-sm text-purple-600/70 font-medium">Total Raised</div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Activity -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">New Users This Month</h2>
                    <p class="text-sm text-gray-600 mt-1">Users registered in {{ now()->format('F Y') }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-lg">
                        <span class="text-[#fe5000] font-semibold">{{ $stats['current_month_users']->count() }}</span> new users
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View All Users
                    </a>
                </div>
            </div>
        </div>
        <div class="p-6">
            @if($stats['current_month_users']->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">User</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Joined</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($stats['current_month_users'] as $user)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($user->profile_photo)
                                                    <img class="h-10 w-10 rounded-lg object-cover border border-gray-200" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center border border-gray-200">
                                                        <span class="text-sm font-bold text-[#fe5000]">{{ substr($user->name, 0, 1) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">{{ Str::limit($user->name, 25) }}</div>
                                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                                            @if($user->user_type === 'staff') bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 border border-blue-200
                                            @else bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                                            @endif">
                                            @if($user->user_type === 'staff')
                                                <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9.385 2.667l.615-1.333L10.615 2.667A1.001 1.001 0 0011 3.001h2a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V5.001a2 2 0 012-2h2c.183 0 .366-.05.512-.144.173-.112.288-.272.288-.446 0-.174-.115-.334-.288-.446A.999.999 0 009 2.001H8a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                            {{ ucfirst($user->user_type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                                            @if($user->is_active) bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                                            @else bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-200
                                            @endif">
                                            @if($user->is_active)
                                                <span class="h-2 w-2 rounded-full mr-1 bg-green-400 animate-pulse"></span>
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>{{ $user->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.users.show', $user) }}" 
                                           class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                            <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mx-auto h-24 w-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No new users this month</h3>
                    <p class="text-gray-500 mb-6">No users have registered in {{ now()->format('F Y') }} yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Donation Activity -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">New Donations This Month</h2>
                    <p class="text-sm text-gray-600 mt-1">Donations made in {{ now()->format('F Y') }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-lg">
                        <span class="text-[#fe5000] font-semibold">{{ $stats['current_month_donations']->count() }}</span> new donations
                    </div>
                    <a href="{{ route('admin.donations.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View All Donations
                    </a>
                </div>
            </div>
        </div>
        <div class="p-6">
            @if($stats['current_month_donations']->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Donor</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Campaign</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($stats['current_month_donations'] as $donation)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($donation->user && $donation->user->profile_photo)
                                                    <img class="h-10 w-10 rounded-lg object-cover border border-gray-200" src="{{ $donation->user->profile_photo_url }}" alt="{{ $donation->donor_name }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center border border-gray-200">
                                                        <span class="text-sm font-bold text-green-600">{{ substr($donation->donor_name, 0, 1) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">{{ Str::limit($donation->donor_name, 25) }}</div>
                                                <div class="text-sm text-gray-500">{{ $donation->donor_email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">{{ Str::limit($donation->campaign->title ?? 'N/A', 30) }}</div>
                                        @if($donation->campaign)
                                            <div class="text-sm text-gray-500">{{ $donation->campaign->category ?? 'General' }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-green-600">${{ number_format($donation->amount, 2) }}</div>
                                        <div class="text-sm text-gray-500">{{ $donation->currency ?? 'USD' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                                            @if($donation->payment_status === 'completed') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                                            @elseif($donation->payment_status === 'pending') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-200
                                            @elseif($donation->payment_status === 'failed') bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-200
                                            @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-200
                                            @endif">
                                            @if($donation->payment_status === 'completed')
                                                <span class="h-2 w-2 rounded-full mr-1 bg-green-400"></span>
                                            @elseif($donation->payment_status === 'pending')
                                                <span class="h-2 w-2 rounded-full mr-1 bg-yellow-400 animate-pulse"></span>
                                            @endif
                                            {{ ucfirst($donation->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>{{ $donation->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $donation->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.donations.show', $donation) }}" 
                                           class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                            <svg class="-ml-1 mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mx-auto h-24 w-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No new donations this month</h3>
                    <p class="text-gray-500 mb-6">No donations have been made in {{ now()->format('F Y') }} yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Add your Chart.js initialization here if needed
</script>
@endpush