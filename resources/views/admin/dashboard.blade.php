@extends('layouts.admin')

@section('title', 'Dashboard - Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-bold text-[#fe5000]">Admin Dashboard</h3>
                    <p class="text-sm text-gray-600 mt-1">Overview of your fundraising platform activities</p>
                </div>
            </div>
        </div>
    </div>

                <!-- Quick Actions Section -->
    <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
            <div class="flex items-center">
                <div class="h-10 w-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h4 class="text-lg font-semibold text-blue-900">Quick Actions</h4>
                    <p class="text-sm text-blue-700">Frequently used management tools</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.campaigns.index') }}" class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-[#fe5000]/30 hover:bg-[#fe5000]/5 transition-all duration-200 transform hover:scale-105">
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

                <a href="{{ route('admin.donations.index') }}" class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all duration-200 transform hover:scale-105">
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

                <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 transform hover:scale-105">
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

                <a href="{{ route('admin.events.index') }}" class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 transform hover:scale-105">
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

    <!-- Statistics Cards -->
    <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-green-50 to-green-100">
            <div class="flex items-center">
                <div class="h-10 w-10 bg-green-500 rounded-lg flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h4 class="text-lg font-semibold text-green-900">Platform Statistics</h4>
                    <p class="text-sm text-green-700">Key metrics and performance indicators</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Campaigns Card -->
                <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-gradient-to-br from-[#fe5000]/5 to-orange-50">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Total Campaigns</h3>
                                <p class="text-3xl font-bold tracking-tight text-[#fe5000]">{{ $stats['total_campaigns'] ?? 0 }}</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-[#fe5000]/70 bg-white/50 px-2 py-1 rounded-full">All campaigns</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Campaigns Card -->
                <div class="overflow-hidden rounded-xl border border-green-200/50 bg-gradient-to-br from-green-50 to-emerald-50">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-sm font-medium text-green-700 opacity-90">Active Campaigns</h3>
                                <p class="text-3xl font-bold tracking-tight text-green-700">{{ $stats['active_campaigns'] ?? 0 }}</p>
                                <div class="flex items-center mt-1">
                                    <div class="h-2 w-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                    <span class="text-xs text-green-600/70 bg-white/50 px-2 py-1 rounded-full">Currently active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Donations Card -->
                <div class="overflow-hidden rounded-xl border border-blue-200/50 bg-gradient-to-br from-blue-50 to-indigo-50">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-sm font-medium text-blue-700 opacity-90">Total Donations</h3>
                                <p class="text-3xl font-bold tracking-tight text-blue-700">{{ $stats['total_donations'] ?? 0 }}</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-blue-600/70 bg-white/50 px-2 py-1 rounded-full">All donations</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Raised Card -->
                <div class="overflow-hidden rounded-xl border border-purple-200/50 bg-gradient-to-br from-purple-50 to-violet-50">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-sm font-medium text-purple-700 opacity-90">Total Raised</h3>
                                <p class="text-3xl font-bold tracking-tight text-purple-700">${{ number_format($stats['total_raised'] ?? 0, 0) }}</p>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-purple-600/70 bg-white/50 px-2 py-1 rounded-full">USD raised</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Users Card -->
    <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-blue-100">
            <div class="flex items-center">
                <div class="h-10 w-10 bg-blue-500 rounded-lg flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h4 class="text-lg font-semibold text-blue-900">New Users</h4>
                    <p class="text-sm text-blue-700">Recently registered users</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-xl">
                    <span class="text-[#fe5000] font-semibold">{{ $newUsers->total() }}</span> total users
                </div>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View All Users
                </a>
            </div>

            @if($newUsers->count() > 0)
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/3">User</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/6">Role</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/6">Status</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/4">Joined</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider w-1/6">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                                                                                                         @foreach($newUsers as $user)
                             <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                @if($user->profile_photo)
                                                    <img class="h-8 w-8 rounded-lg object-cover border border-gray-200" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                                @else
                                                    <div class="h-8 w-8 rounded-lg bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center border border-gray-200">
                                                        <span class="text-xs font-bold text-[#fe5000]">{{ substr($user->name, 0, 1) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-3 min-w-0 flex-1">
                                                <div class="text-sm font-semibold text-gray-900 truncate">{{ Str::limit($user->name, 20) }}</div>
                                                <div class="text-xs text-gray-500 truncate">{{ Str::limit($user->email, 25) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                            @if($user->role === 'admin') bg-red-100 text-red-800
                                            @else bg-blue-100 text-blue-800
                                            @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                            @if($user->status === 'active') bg-green-100 text-green-800
                                            @elseif($user->status === 'inactive') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            @if($user->status === 'active')
                                                <span class="h-1.5 w-1.5 rounded-full mr-1 bg-green-400"></span>
                                            @endif
                                            {{ ucfirst($user->status ?? 'active') }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        <div class="text-xs">{{ $user->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-right text-sm font-medium">
                                        <a href="{{ route('admin.users.show', $user) }}" 
                                        class="inline-flex items-center px-2 py-1 border border-gray-300 rounded text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                            <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                <!-- Pagination for New Users -->
                <div class="mt-4">
                    {{ $newUsers->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="mx-auto h-24 w-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No users found</h3>
                    <p class="text-gray-500 mb-6">No users have registered yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- New Donors Card -->
    <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200">
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-green-50 to-green-100">
            <div class="flex items-center">
                <div class="h-10 w-10 bg-green-500 rounded-lg flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h4 class="text-lg font-semibold text-green-900">Recent Donors</h4>
                    <p class="text-sm text-green-700">Latest donation activities</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm text-gray-600 bg-gray-100 px-4 py-2 rounded-xl">
                    <span class="text-[#fe5000] font-semibold">{{ $newDonors->total() }}</span> total donations
                </div>
                <a href="{{ route('admin.donations.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View All Donations
                </a>
            </div>

        @if($newDonors->count() > 0)
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/4">Donor</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/3">Campaign</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/6">Amount</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/6">Status</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/6">Date</th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider w-1/6">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($newDonors as $donation)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            @if($donation->user && $donation->user->profile_photo)
                                                <img class="h-8 w-8 rounded-lg object-cover border border-gray-200" src="{{ $donation->user->profile_photo_url }}" alt="{{ $donation->donor_name }}">
                                            @else
                                                <div class="h-8 w-8 rounded-lg bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center border border-gray-200">
                                                    <span class="text-xs font-bold text-green-600">{{ substr($donation->donor_name, 0, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3 min-w-0 flex-1">
                                            <div class="text-sm font-semibold text-gray-900 truncate">{{ Str::limit($donation->donor_name, 20) }}</div>
                                            <div class="text-xs text-gray-500 truncate">{{ Str::limit($donation->donor_email, 25) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-semibold text-gray-900 truncate">{{ Str::limit($donation->campaign->title ?? 'N/A', 25) }}</div>
                                    @if($donation->campaign)
                                        <div class="text-sm text-gray-500">{{ $donation->campaign->category ?? 'General' }}</div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-semibold text-green-600">${{ number_format($donation->amount, 2) }}</div>
                                    <div class="text-xs text-gray-500">{{ $donation->currency ?? 'USD' }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                        @if($donation->payment_status === 'completed') bg-green-100 text-green-800
                                        @elseif($donation->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($donation->payment_status === 'failed') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        @if($donation->payment_status === 'completed')
                                            <span class="h-1.5 w-1.5 rounded-full mr-1 bg-green-400"></span>
                                        @elseif($donation->payment_status === 'pending')
                                            <span class="h-1.5 w-1.5 rounded-full mr-1 bg-yellow-400"></span>
                                        @endif
                                        {{ ucfirst($donation->payment_status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    <div class="text-xs">{{ $donation->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $donation->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-4 py-3 text-right text-sm font-medium">
                                    <a href="{{ route('admin.donations.show', $donation) }}" 
                                       class="inline-flex items-center px-2 py-1 border border-gray-300 rounded text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                        <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

            <!-- Pagination for New Donors -->
            <div class="mt-4">
                {{ $newDonors->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mx-auto h-24 w-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mb-6">
                    <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No donations found</h3>
                <p class="text-gray-500 mb-6">No donations have been made yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Add your Chart.js initialization here if needed
</script>
@endpush

@push('styles')
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
.space-y-6 > *:nth-child(5) { animation-delay: 0.4s; }

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
@endpush