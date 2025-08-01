@extends('layouts.admin')

@section('title', 'Campaign Details - Admin Dashboard')
@section('page-title', 'Campaign Details')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards with Consistent Design -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Goal Amount Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Goal Amount</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ number_format($campaign->goal_amount, 0) }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">{{ $campaign->currency }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Raised Amount Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Raised Amount</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ number_format($campaign->raised_amount, 0) }}</p>
                        <div class="flex items-center mt-1">
                            @if($campaign->raised_amount > 0)
                                <div class="h-2 w-2 bg-[#fe5000]/60 rounded-full mr-2 animate-pulse"></div>
                            @endif
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">{{ $campaign->currency }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Progress</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ $campaign->percentageReached() }}%</p>
                        <div class="flex items-center mt-1">
                            @if($campaign->percentageReached() >= 100)
                                <svg class="h-3 w-3 text-[#fe5000]/60 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Donations Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Total Donations</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ $totalDonations }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">Contributions</span>
                        </div>
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
                            @if($campaign->featured_image)
                                <img src="{{ asset('storage/' . $campaign->featured_image) }}" alt="{{ $campaign->title }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center">
                                    <svg class="h-8 w-8 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">{{ $campaign->title }}</h3>
                        <p class="text-sm text-[#fe5000] mt-1 flex items-center">
                            <svg class="h-4 w-4 mr-1 text-[#fe5000]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Campaign since {{ $campaign->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.campaigns.edit', $campaign) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Campaign
                    </a>
                    
                    <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this campaign? This action cannot be undone.');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Campaign
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.campaigns.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
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
            @if($campaign->status === 'active') bg-gradient-to-r from-green-50 to-green-100 border-b border-green-200
            @elseif($campaign->status === 'draft') bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200
            @elseif($campaign->status === 'completed') bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200
            @else bg-gradient-to-r from-red-50 to-red-100 border-b border-red-200
            @endif">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-lg flex items-center justify-center
                    @if($campaign->status === 'active') bg-green-500
                    @elseif($campaign->status === 'draft') bg-gray-500
                    @elseif($campaign->status === 'completed') bg-blue-500
                    @else bg-red-500
                    @endif">
                    @if($campaign->status === 'active')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @elseif($campaign->status === 'draft')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    @elseif($campaign->status === 'completed')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                    @if($campaign->status === 'active') text-green-900
                    @elseif($campaign->status === 'draft') text-gray-900
                    @elseif($campaign->status === 'completed') text-blue-900
                    @else text-red-900
                    @endif">
                    Campaign Status: {{ ucfirst($campaign->status) }}
                </h4>
                <p class="text-sm 
                    @if($campaign->status === 'active') text-green-700
                    @elseif($campaign->status === 'draft') text-gray-700
                    @elseif($campaign->status === 'completed') text-blue-700
                    @else text-red-700
                    @endif">
                    @if($campaign->status === 'active')
                        This campaign is currently active and accepting donations.
                    @elseif($campaign->status === 'draft')
                        This campaign is in draft mode and not visible to the public.
                    @elseif($campaign->status === 'completed')
                        This campaign has been completed successfully.
                    @else
                        This campaign has been cancelled.
                    @endif
                </p>
            </div>
        </div>
        
        <!-- Campaign Details Grid -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Campaign Information -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Campaign Summary -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-blue-900">Campaign Summary</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Goal Amount</p>
                                    <p class="text-sm text-gray-900">{{ number_format($campaign->goal_amount, 2) }} {{ $campaign->currency }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Raised Amount</p>
                                    <p class="text-sm text-gray-900">{{ number_format($campaign->raised_amount, 2) }} {{ $campaign->currency }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Created Date</p>
                                    <p class="text-sm text-gray-900">{{ $campaign->created_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $campaign->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            @if($campaign->start_date)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Start Date</p>
                                    <p class="text-sm text-gray-900">{{ $campaign->start_date->format('M d, Y') }}</p>
                                    @if($campaign->end_date)
                                        <p class="text-xs text-gray-500">Ends {{ $campaign->end_date->format('M d, Y') }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Progress & Statistics -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-[#fe5000]/10 to-orange-50 border-b border-[#fe5000]/20">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-[#fe5000] rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-[#fe5000]">Progress & Statistics</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-[#fe5000] mb-2">{{ $campaign->percentageReached() }}%</div>
                                <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                                    <div class="bg-gradient-to-r from-[#fe5000] to-orange-600 h-3 rounded-full transition-all duration-300" style="width: {{ min($campaign->percentageReached(), 100) }}%"></div>
                                </div>
                                <p class="text-sm text-gray-600">
                                    {{ number_format($campaign->raised_amount, 2) }} of {{ number_format($campaign->goal_amount, 2) }} {{ $campaign->currency }}
                                </p>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 pt-4">
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <p class="text-xs text-gray-500">Total Donations</p>
                                    <p class="text-lg font-bold text-[#fe5000]">{{ $totalDonations }}</p>
                                </div>
                                <div class="text-center p-3 bg-gray-50 rounded-lg">
                                    <p class="text-xs text-gray-500">Remaining</p>
                                    <p class="text-lg font-bold text-gray-600">{{ number_format($campaign->goal_amount - $campaign->raised_amount, 0) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Campaign Content & Donations -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Campaign Description -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-purple-100 border-b border-purple-200">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-purple-900">Campaign Description</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            @if($campaign->featured_image)
                                <div class="mb-6">
                                    <img src="{{ asset('storage/' . $campaign->featured_image) }}" alt="{{ $campaign->title }}" class="w-full h-64 object-cover rounded-xl border border-gray-200">
                                </div>
                            @endif
                            
                            <div class="prose max-w-none">
                                <p class="text-gray-700 leading-relaxed mb-4">{{ $campaign->description }}</p>
                                
                                @if($campaign->content)
                                    <div class="mt-6 pt-6 border-t border-gray-200">
                                        <h4 class="text-lg font-semibold text-gray-900 mb-3">Detailed Information</h4>
                                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $campaign->content }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Donations -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-green-100 border-b border-green-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-green-900">Recent Donations</h3>
                                </div>
                                <a href="{{ route('admin.donations.index', ['campaign_id' => $campaign->id]) }}" 
                                   class="text-sm font-medium text-green-600 hover:text-green-700 transition-colors duration-200">
                                    View All Donations
                                </a>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto">
                            @if($recentDonations && $recentDonations->count() > 0)
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Donor</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Amount</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($recentDonations as $donation)
                                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <div class="h-10 w-10 rounded-full bg-[#fe5000]/10 flex items-center justify-center">
                                                                <span class="text-sm font-medium text-[#fe5000]">{{ substr($donation->donor_name, 0, 1) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $donation->donor_name }}</div>
                                                            @if($donation->donor_email)
                                                                <div class="text-sm text-gray-500">{{ $donation->donor_email }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-semibold text-gray-900">{{ number_format($donation->amount, 2) }} {{ $donation->currency }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        @if($donation->status === 'completed') bg-green-100 text-green-800
                                                        @elseif($donation->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @else bg-red-100 text-red-800
                                                        @endif">
                                                        {{ ucfirst($donation->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $donation->created_at->format('M d, Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="p-8 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No donations yet</h3>
                                    <p class="mt-1 text-sm text-gray-500">This campaign hasn't received any donations yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 