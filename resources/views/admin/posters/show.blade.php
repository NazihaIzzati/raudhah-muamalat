@extends('layouts.admin')

@section('title', 'Poster Details - Admin Dashboard')
@section('page-title', 'Poster Details')

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
                            @if($poster->status === 'active')
                                <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @else
                                <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Status</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ ucfirst($poster->status) }}</p>
                        <div class="flex items-center mt-1">
                            @if($poster->status === 'active')
                                <div class="h-2 w-2 bg-[#fe5000]/60 rounded-full mr-2 animate-pulse"></div>
                            @endif
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">{{ $poster->status === 'active' ? 'Live' : 'Inactive' }}</span>
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
                        <p class="text-3xl font-bold tracking-tight">{{ $poster->display_order ?? 0 }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">Priority</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Campaign Card -->
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
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Campaign</h3>
                        <p class="text-lg font-bold tracking-tight truncate">{{ $poster->campaign ? $poster->campaign->title : 'No Campaign' }}</p>
                        <div class="flex items-center mt-1">
                            @if($poster->campaign)
                                <svg class="h-3 w-3 text-[#fe5000]/60 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">{{ $poster->campaign ? 'Linked' : 'Standalone' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Created Date Card -->
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
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Created</h3>
                        <p class="text-lg font-bold tracking-tight">{{ $poster->created_at->format('M d, Y') }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">{{ $poster->created_at->diffForHumans() }}</span>
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
                            @if($poster->image_path)
                                <img src="{{ asset('storage/' . $poster->image_path) }}" alt="{{ $poster->title }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center">
                                    <svg class="h-8 w-8 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">{{ $poster->title }}</h3>
                        <p class="text-sm text-[#fe5000] mt-1 flex items-center">
                            <svg class="h-4 w-4 mr-1 text-[#fe5000]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Poster since {{ $poster->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.posters.edit', $poster) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Poster
                    </a>
                    
                    <form action="{{ route('admin.posters.destroy', $poster) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this poster? This action cannot be undone.');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Poster
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.posters.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
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
            @if($poster->status === 'active') bg-gradient-to-r from-green-50 to-green-100 border-b border-green-200
            @else bg-gradient-to-r from-red-50 to-red-100 border-b border-red-200
            @endif">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-lg flex items-center justify-center
                    @if($poster->status === 'active') bg-green-500
                    @else bg-red-500
                    @endif">
                    @if($poster->status === 'active')
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
                    @if($poster->status === 'active') text-green-800
                    @else text-red-800
                    @endif">
                    Poster is {{ ucfirst($poster->status) }}
                </h4>
                <p class="text-sm 
                    @if($poster->status === 'active') text-green-600
                    @else text-red-600
                    @endif">
                    @if($poster->status === 'active')
                        This poster is currently visible and active in the system.
                    @else
                        This poster is currently hidden and inactive in the system.
                    @endif
                </p>
            </div>
        </div>
        
        <!-- Content Grid -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (2/3) -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Poster Image Section -->
                    <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-[#fe5000] rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-semibold text-gray-900">Poster Image</h3>
                                <p class="text-sm text-gray-500">Visual representation of the poster</p>
                            </div>
                        </div>
                        
                        @if($poster->image_path)
                            <div class="bg-gray-100 p-4 rounded-xl">
                                <img src="{{ asset('storage/' . $poster->image_path) }}" alt="{{ $poster->title }}" class="w-full h-auto rounded-lg shadow-sm">
                            </div>
                        @else
                            <div class="bg-orange-100 p-12 rounded-xl flex flex-col items-center justify-center">
                                <svg class="h-24 w-24 text-orange-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="text-orange-800 font-medium">No image uploaded</p>
                                <p class="text-orange-600 text-sm">This poster doesn't have an associated image</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Description Section -->
                    @if($poster->description)
                        <div class="bg-gradient-to-r from-blue-50 to-white rounded-xl p-6 border border-blue-200">
                            <div class="flex items-center mb-4">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-semibold text-gray-900">Description</h3>
                                    <p class="text-sm text-gray-500">Additional information about the poster</p>
                                </div>
                            </div>
                            <div class="prose prose-sm max-w-none">
                                <p class="text-gray-700 leading-relaxed">{{ $poster->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Sidebar (1/3) -->
                <div class="space-y-6">
                    <!-- Poster Details -->
                    <div class="bg-gradient-to-r from-[#fe5000]/5 to-orange-50 rounded-xl p-6 border border-[#fe5000]/20">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-[#fe5000] rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-semibold text-[#fe5000]">Poster Details</h3>
                                <p class="text-sm text-[#fe5000]/70">Key information</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                                <span class="text-sm font-medium text-gray-600">Status</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($poster->status === 'active') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($poster->status) }}
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                                <span class="text-sm font-medium text-gray-600">Display Order</span>
                                <span class="text-sm text-gray-900 font-semibold">{{ $poster->display_order ?? 0 }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                                <span class="text-sm font-medium text-gray-600">Display From</span>
                                <span class="text-sm text-gray-900">
                                    @if($poster->display_from)
                                        {{ $poster->display_from->format('M d, Y') }}
                                    @else
                                        No start date
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                                <span class="text-sm font-medium text-gray-600">Display Until</span>
                                <span class="text-sm text-gray-900">
                                    @if($poster->display_until)
                                        {{ $poster->display_until->format('M d, Y') }}
                                    @else
                                        No end date
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center py-2">
                                <span class="text-sm font-medium text-gray-600">Created By</span>
                                <span class="text-sm text-gray-900">{{ $poster->creator->name ?? 'Unknown' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campaign Information -->
                    <div class="bg-gradient-to-r from-purple-50 to-white rounded-xl p-6 border border-purple-200">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-semibold text-gray-900">Campaign Link</h3>
                                <p class="text-sm text-gray-500">Associated campaign</p>
                            </div>
                        </div>
                        
                        @if($poster->campaign)
                            <div class="space-y-3">
                                <div class="p-4 bg-white rounded-lg border border-purple-100">
                                    <h4 class="font-semibold text-gray-900">{{ $poster->campaign->title }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($poster->campaign->description, 100) }}</p>
                                    <div class="mt-3 flex items-center justify-between">
                                        <span class="text-xs text-purple-600 bg-purple-100 px-2 py-1 rounded-full">
                                            {{ ucfirst($poster->campaign->status) }}
                                        </span>
                                        <a href="{{ route('admin.campaigns.show', $poster->campaign) }}" class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                                            View Campaign →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-6">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">No associated campaign</p>
                                <p class="text-xs text-gray-400">This poster is standalone</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 bg-gray-600 rounded-lg flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                                <p class="text-sm text-gray-500">Manage this poster</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <a href="{{ route('admin.posters.edit', $poster) }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit Poster
                            </a>
                            
                            <form action="{{ route('admin.posters.destroy', $poster) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this poster?');" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete Poster
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection