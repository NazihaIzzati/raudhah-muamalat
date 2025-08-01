@extends('layouts.admin')

@section('title', 'Partner Details - Admin Dashboard')
@section('page-title', 'Partner Details')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards with Consistent Design -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Status Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($partner->status === 'active')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                @endif
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Partnership Status</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ ucfirst($partner->status) }}</p>
                        <div class="flex items-center mt-1">
                            @if($partner->status === 'active')
                                <div class="h-2 w-2 bg-[#fe5000]/60 rounded-full mr-2 animate-pulse"></div>
                            @endif
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">Partner</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Status Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Featured Partner</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ $partner->featured ? 'Yes' : 'No' }}</p>
                        <div class="flex items-center mt-1">
                            @if($partner->featured)
                                <svg class="h-3 w-3 text-[#fe5000]/60 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">Highlight</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display Order Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Display Order</h3>
                        <p class="text-3xl font-bold tracking-tight">#{{ $partner->display_order }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">Position</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partnership Duration Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Partnership Since</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ $partner->created_at->format('Y') }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">{{ $partner->created_at->diffForHumans() }}</span>
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
                            @if($partner->logo)
                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center">
                                    <svg class="h-8 w-8 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">{{ $partner->name }}</h3>
                        <p class="text-sm text-[#fe5000] mt-1 flex items-center">
                            <svg class="h-4 w-4 mr-1 text-[#fe5000]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Partner since {{ $partner->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.partners.edit', $partner) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Partner
                    </a>
                    
                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this partner? This action cannot be undone.');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Partner
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.partners.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
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
            @if($partner->status === 'active') bg-gradient-to-r from-green-50 to-green-100 border-b border-green-200
            @else bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200
            @endif">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-lg flex items-center justify-center
                    @if($partner->status === 'active') bg-green-500
                    @else bg-gray-500
                    @endif">
                    @if($partner->status === 'active')
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
                    @if($partner->status === 'active') text-green-900
                    @else text-gray-900
                    @endif">
                    Partner Status: {{ ucfirst($partner->status) }}
                </h4>
                <p class="text-sm 
                    @if($partner->status === 'active') text-green-700
                    @else text-gray-700
                    @endif">
                    @if($partner->status === 'active')
                        This partner is currently active and visible to the public.
                    @else
                        This partner is inactive and not visible to the public.
                    @endif
                </p>
            </div>
            @if($partner->featured)
                <div class="ml-auto">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-200 shadow-sm">
                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        Featured Partner
                    </span>
                </div>
            @endif
        </div>
        
        <!-- Partner Details Grid -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Partner Information -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Partner Summary -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-blue-900">Partner Summary</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-2m-2 0H7m14 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v12m14 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v12"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Partner Name</p>
                                    <p class="text-sm text-gray-900">{{ $partner->name }}</p>
                                </div>
                            </div>
                            
                            @if($partner->url)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Website URL</p>
                                    <a href="{{ $partner->url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                        {{ $partner->url }}
                                        <svg class="inline h-3 w-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @endif
                            
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Created Date</p>
                                    <p class="text-sm text-gray-900">{{ $partner->created_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $partner->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Last Updated</p>
                                    <p class="text-sm text-gray-900">{{ $partner->updated_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $partner->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Partner Logo -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-[#fe5000]/10 to-orange-50 border-b border-[#fe5000]/20">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-[#fe5000] rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-[#fe5000]">Partner Logo</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            @if($partner->logo)
                                <div class="text-center">
                                    <div class="inline-block p-4 bg-white rounded-xl shadow-sm border border-gray-200">
                                        <img class="h-32 w-32 object-contain" src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}">
                                    </div>
                                    <p class="mt-3 text-sm text-gray-500">{{ basename($partner->logo) }}</p>
                                </div>
                            @else
                                <div class="text-center">
                                    <div class="mx-auto h-32 w-32 bg-gradient-to-br from-[#fe5000]/10 to-orange-100 rounded-xl flex items-center justify-center border border-gray-200">
                                        <svg class="h-16 w-16 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="mt-3 text-sm text-gray-500">No logo uploaded</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Partner Content & Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Partner Description -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-purple-100 border-b border-purple-200">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-purple-900">Partner Description</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            @if($partner->description)
                                <div class="prose max-w-none">
                                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $partner->description }}</p>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No description available</h3>
                                    <p class="mt-1 text-sm text-gray-500">This partner hasn't provided a description yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Additional Partner Details -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-green-100 border-b border-green-200">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-green-900">Partnership Details</h3>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0 h-10 w-10 bg-[#fe5000]/10 rounded-lg flex items-center justify-center">
                                            <svg class="h-5 w-5 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-600">Status</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ ucfirst($partner->status) }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0 h-10 w-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                            <svg class="h-5 w-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-600">Featured</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $partner->featured ? 'Yes' : 'No' }}</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-600">Display Order</p>
                                            <p class="text-lg font-semibold text-gray-900">#{{ $partner->display_order }}</p>
                                        </div>
                                    </div>
                                    
                                    @if($partner->creator)
                                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-600">Created By</p>
                                            <p class="text-lg font-semibold text-gray-900">{{ $partner->creator->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $partner->creator->email }}</p>
                                        </div>
                                    </div>
                                    @endif
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