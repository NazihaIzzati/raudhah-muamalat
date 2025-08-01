@extends('layouts.admin')

@section('title', $event->title . ' - Event Details')
@section('page-title', 'Event Details')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards with Consistent Design -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Event Status Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            @if($event->status === 'published')
                                <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @elseif($event->status === 'ongoing')
                                <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @elseif($event->status === 'completed')
                                <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @elseif($event->status === 'draft')
                                <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            @else
                                <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Event Status</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ ucfirst($event->status) }}</p>
                        <div class="flex items-center mt-1">
                            @if($event->status === 'published')
                                <div class="h-2 w-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                            @elseif($event->status === 'ongoing')
                                <div class="h-2 w-2 bg-blue-500 rounded-full mr-2 animate-pulse"></div>
                            @elseif($event->status === 'completed')
                                <div class="h-2 w-2 bg-gray-500 rounded-full mr-2"></div>
                            @endif
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">Active</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Category</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ $event->category ? ucfirst($event->category) : 'General' }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">Type</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Date Card -->
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
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Event Date</h3>
                        <p class="text-2xl font-bold tracking-tight">{{ $event->start_date->format('M j, Y') }}</p>
                        <div class="flex items-center mt-1">
                            @if($event->start_time)
                                <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">{{ $event->start_time->format('g:i A') }}</span>
                            @else
                                <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">All Day</span>
                            @endif
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Created</h3>
                        <p class="text-2xl font-bold tracking-tight">{{ $event->created_at->format('M j, Y') }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">{{ $event->created_at->diffForHumans() }}</span>
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
                            @if($event->featured_image)
                                <img src="{{ asset('storage/' . $event->featured_image) }}" alt="{{ $event->title }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center">
                                    <svg class="h-8 w-8 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">{{ $event->title }}</h3>
                        <p class="text-sm text-[#fe5000] mt-1 flex items-center">
                            <svg class="h-4 w-4 mr-1 text-[#fe5000]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Event since {{ $event->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.events.edit', $event) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Event
                    </a>
                    
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Event
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.events.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
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
            @if($event->status === 'published') bg-gradient-to-r from-green-50 to-green-100 border-b border-green-200
            @elseif($event->status === 'draft') bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200
            @elseif($event->status === 'ongoing') bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200
            @elseif($event->status === 'completed') bg-gradient-to-r from-purple-50 to-purple-100 border-b border-purple-200
            @else bg-gradient-to-r from-red-50 to-red-100 border-b border-red-200
            @endif">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-lg flex items-center justify-center
                    @if($event->status === 'published') bg-green-500
                    @elseif($event->status === 'draft') bg-gray-500
                    @elseif($event->status === 'ongoing') bg-blue-500
                    @elseif($event->status === 'completed') bg-purple-500
                    @else bg-red-500
                    @endif">
                    @if($event->status === 'published')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @elseif($event->status === 'draft')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    @elseif($event->status === 'ongoing')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @elseif($event->status === 'completed')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
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
                    @if($event->status === 'published') text-green-900
                    @elseif($event->status === 'draft') text-gray-900
                    @elseif($event->status === 'ongoing') text-blue-900
                    @elseif($event->status === 'completed') text-purple-900
                    @else text-red-900
                    @endif">
                    Event Status: {{ ucfirst($event->status) }}
                </h4>
                <p class="text-sm 
                    @if($event->status === 'published') text-green-700
                    @elseif($event->status === 'draft') text-gray-700
                    @elseif($event->status === 'ongoing') text-blue-700
                    @elseif($event->status === 'completed') text-purple-700
                    @else text-red-700
                    @endif">
                    @if($event->status === 'published')
                        This event is published and visible to users.
                    @elseif($event->status === 'draft')
                        This event is in draft mode and not visible to users.
                    @elseif($event->status === 'ongoing')
                        This event is currently ongoing.
                    @elseif($event->status === 'completed')
                        This event has been completed.
                    @else
                        This event has been cancelled.
                    @endif
                </p>
            </div>
        </div>
        
        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-6">
            <!-- Main Content (2/3) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Event Image Section -->
                @if($event->featured_image)
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Event Image
                        </h4>
                        <div class="rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                            <img src="{{ asset('storage/' . $event->featured_image) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover">
                        </div>
                    </div>
                @endif
                
                <!-- Description Section -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="h-5 w-5 mr-2 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        Description
                    </h4>
                    <div class="prose prose-sm max-w-none text-gray-700">
                        <p class="leading-relaxed">{{ $event->description }}</p>
                    </div>
                </div>
                
                <!-- Detailed Content Section -->
                @if($event->content)
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Detailed Content
                        </h4>
                        <div class="prose prose-sm max-w-none text-gray-700">
                            <div class="whitespace-pre-wrap leading-relaxed">{{ $event->content }}</div>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Sidebar (1/3) -->
            <div class="space-y-6">
                <!-- Event Details -->
                <div class="bg-gradient-to-br from-[#fe5000]/5 to-orange-50 rounded-xl p-6 border border-[#fe5000]/20">
                    <h4 class="text-lg font-semibold text-[#fe5000] mb-4 flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Event Details
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                            <span class="text-sm font-medium text-gray-600">Status</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($event->status === 'published') bg-green-100 text-green-800
                                @elseif($event->status === 'draft') bg-gray-100 text-gray-800
                                @elseif($event->status === 'ongoing') bg-blue-100 text-blue-800
                                @elseif($event->status === 'completed') bg-purple-100 text-purple-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                        
                        @if($event->category)
                            <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                                <span class="text-sm font-medium text-gray-600">Category</span>
                                <span class="text-sm text-gray-900 font-medium">{{ ucfirst($event->category) }}</span>
                            </div>
                        @endif
                        
                        <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                            <span class="text-sm font-medium text-gray-600">Start Date</span>
                            <span class="text-sm text-gray-900 font-medium">{{ $event->start_date->format('M j, Y') }}</span>
                        </div>
                        
                        @if($event->end_date)
                            <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                                <span class="text-sm font-medium text-gray-600">End Date</span>
                                <span class="text-sm text-gray-900 font-medium">{{ $event->end_date->format('M j, Y') }}</span>
                            </div>
                        @endif
                        
                        @if($event->start_time)
                            <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                                <span class="text-sm font-medium text-gray-600">Start Time</span>
                                <span class="text-sm text-gray-900 font-medium">{{ $event->start_time->format('g:i A') }}</span>
                            </div>
                        @endif
                        
                        @if($event->end_time)
                            <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                                <span class="text-sm font-medium text-gray-600">End Time</span>
                                <span class="text-sm text-gray-900 font-medium">{{ $event->end_time->format('g:i A') }}</span>
                            </div>
                        @endif
                        
                        @if($event->is_featured)
                            <div class="flex justify-between items-center py-2 border-b border-[#fe5000]/10">
                                <span class="text-sm font-medium text-gray-600">Featured</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    Yes
                                </span>
                            </div>
                        @endif
                        
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm font-medium text-gray-600">Created</span>
                            <span class="text-sm text-gray-900 font-medium">{{ $event->created_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="h-5 w-5 mr-2 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Quick Actions
                    </h4>
                    <div class="space-y-3">
                        <a href="{{ route('admin.events.edit', $event) }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Event
                        </a>
                        
                        <a href="{{ route('admin.events.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#fe5000] hover:bg-[#fe5000]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                            All Events
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 