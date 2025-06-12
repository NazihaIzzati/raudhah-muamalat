@extends('layouts.admin')

@section('title', 'User Details - Admin Dashboard')
@section('page-title', 'User Details')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000]">Account Status</h3>
                        <p class="text-2xl font-bold">{{ ucfirst($user->status) }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000]">Total Donations</h3>
                        <p class="text-2xl font-bold">{{ $donationStats['total'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000]">Member Since</h3>
                        <p class="text-2xl font-bold">{{ $user->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000]">Donation Amount</h3>
                        <p class="text-xl font-bold">RM {{ number_format($donationStats['total_amount'], 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <!-- Enhanced Header Section -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-16 w-16 rounded-xl overflow-hidden border-2 border-[#fe5000]/30 shadow-lg">
                            @if($user->profile_photo)
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-[#fe5000]">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">{{ $user->name }}</h3>
                        <p class="text-sm text-[#fe5000] mt-1 flex items-center">
                            <svg class="h-4 w-4 mr-1 text-[#fe5000]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Member since {{ $user->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit User
                    </a>
                    
                    @if($user->id !== Auth::id())
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete User
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Status Banner -->
        <div class="px-6 py-4 flex items-center
            @if($user->status === 'active') bg-gradient-to-r from-green-50 to-green-100 border-b border-green-200
            @elseif($user->status === 'inactive') bg-gradient-to-r from-yellow-50 to-yellow-100 border-b border-yellow-200
            @else bg-gradient-to-r from-red-50 to-red-100 border-b border-red-200
            @endif">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-lg flex items-center justify-center
                    @if($user->status === 'active') bg-green-500
                    @elseif($user->status === 'inactive') bg-yellow-500
                    @else bg-red-500
                    @endif">
                    @if($user->status === 'active')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @elseif($user->status === 'inactive')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    @else
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @endif
                </div>
            </div>
            <div class="ml-4">
                <h4 class="text-lg font-semibold 
                    @if($user->status === 'active') text-green-900
                    @elseif($user->status === 'inactive') text-yellow-900
                    @else text-red-900
                    @endif">
                    Account Status: {{ ucfirst($user->status) }}
                </h4>
                <p class="text-sm 
                    @if($user->status === 'active') text-green-700
                    @elseif($user->status === 'inactive') text-yellow-700
                    @else text-red-700
                    @endif">
                    @if($user->status === 'active')
                        This user can log in and access the system.
                    @elseif($user->status === 'inactive')
                        This user cannot log in to the system.
                    @else
                        This user's account has been suspended.
                    @endif
                </p>
            </div>
        </div>
        
        <!-- User Details Grid -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Profile Information -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profile Summary -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-blue-900">Profile Summary</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Email Address</p>
                                    <p class="text-sm text-gray-900">{{ $user->email }}</p>
                                </div>
                            </div>
                            
                            @if($user->phone)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Phone Number</p>
                                    <p class="text-sm text-gray-900">{{ $user->phone }}</p>
                                </div>
                            </div>
                            @endif
                            
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Member Since</p>
                                    <p class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            @if($user->last_login_at)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Last Login</p>
                                    <p class="text-sm text-gray-900">{{ $user->last_login_at->format('M d, Y H:i') }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->last_login_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Role & Status -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-[#fe5000]/10 to-orange-50 border-b border-[#fe5000]/20">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-[#fe5000] rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-[#fe5000]">Role & Permissions</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="text-center">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold shadow-sm
                                    @if($user->role === 'admin') bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-200
                                    @else bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                                    @endif">
                                    @if($user->role === 'admin')
                                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9.385 2.667l.615-1.333L10.615 2.667A1.001 1.001 0 0011 3.001h2a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V5.001a2 2 0 012-2h2c.183 0 .366-.05.512-.144.173-.112.288-.272.288-.446 0-.174-.115-.334-.288-.446A.999.999 0 019 2.001H8a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                    {{ ucfirst($user->role) }}
                                </span>
                                <p class="text-xs text-gray-500 mt-2">
                                    @if($user->role === 'admin')
                                        Full system access and management permissions
                                    @else
                                        Standard user access with limited permissions
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Donation Information -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Donation Statistics -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-[#fe5000]/10 to-orange-100 border-b border-orange-200">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-[#fe5000] rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-[#fe5000]">Donation History</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 text-center border border-blue-200">
                                    <div class="h-12 w-12 bg-blue-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-blue-700">Total Donations</p>
                                    <p class="text-3xl font-bold text-blue-900">{{ $donationStats['total'] }}</p>
                                    <p class="text-xs text-blue-600 mt-1">All time</p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-[#fe5000]/10 to-orange-100 rounded-xl p-6 text-center border border-orange-200">
                                    <div class="h-12 w-12 bg-[#fe5000] rounded-lg flex items-center justify-center mx-auto mb-3">
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-[#fe5000]">Total Amount</p>
                                    <p class="text-3xl font-bold text-[#fe5000]">RM {{ number_format($donationStats['total_amount'], 2) }}</p>
                                    <p class="text-xs text-orange-600 mt-1">Lifetime contributions</p>
                                </div>
                            </div>
                            
                            @if($donationStats['total'] > 0)
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <p class="text-sm text-gray-600 text-center">
                                        <svg class="h-4 w-4 inline mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Thank you for your generous contributions!
                                    </p>
                                </div>
                            @else
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <p class="text-sm text-gray-500 text-center">
                                        <svg class="h-4 w-4 inline mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        No donations recorded yet
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Account Timeline -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-green-100 border-b border-green-200">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-green-900">Account Timeline</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center p-3 bg-green-50 rounded-lg border border-green-200">
                                <div class="h-3 w-3 bg-green-500 rounded-full mr-4"></div>
                                <div>
                                    <p class="text-sm font-medium text-green-800">Account Created</p>
                                    <p class="text-xs text-green-600">{{ $user->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                            
                            @if($user->last_login_at)
                                <div class="flex items-center p-3 bg-blue-50 rounded-lg border border-blue-200">
                                    <div class="h-3 w-3 bg-blue-500 rounded-full mr-4"></div>
                                    <div>
                                        <p class="text-sm font-medium text-blue-800">Last Login</p>
                                        <p class="text-xs text-blue-600">{{ $user->last_login_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="h-3 w-3 bg-gray-400 rounded-full mr-4"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Last Updated</p>
                                    <p class="text-xs text-gray-500">{{ $user->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 