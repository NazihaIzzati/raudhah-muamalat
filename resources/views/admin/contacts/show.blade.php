@extends('layouts.admin')

@section('title', 'Contact Details - Admin Dashboard')
@section('page-title', 'Contact Details')

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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Status</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ ucfirst($contact->status) }}</p>
                        <div class="flex items-center mt-1">
                            @if($contact->status === 'new')
                                <div class="h-2 w-2 bg-[#fe5000]/60 rounded-full mr-2 animate-pulse"></div>
                            @endif
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">
                                @if($contact->status === 'new') New Message
                                @elseif($contact->status === 'read') Viewed
                                @elseif($contact->status === 'replied') Responded
                                @else Resolved
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Priority Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Priority</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ $contact->is_urgent ? 'Urgent' : 'Normal' }}</p>
                        <div class="flex items-center mt-1">
                            @if($contact->is_urgent)
                                <div class="h-2 w-2 bg-red-500 rounded-full mr-2 animate-pulse"></div>
                            @endif
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">
                                {{ $contact->is_urgent ? 'High Priority' : 'Standard' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Info Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Contact Info</h3>
                        <p class="text-lg font-bold tracking-tight">{{ $contact->full_name }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">{{ $contact->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Received Date Card -->
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Received</h3>
                        <p class="text-lg font-bold tracking-tight">{{ $contact->created_at->format('M d') }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">{{ $contact->created_at->diffForHumans() }}</span>
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
                            <div class="h-full w-full bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center">
                                <svg class="h-8 w-8 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-[#fe5000]">{{ $contact->full_name }}</h3>
                        <p class="text-sm text-[#fe5000] mt-1 flex items-center">
                            <svg class="h-4 w-4 mr-1 text-[#fe5000]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Contact since {{ $contact->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.contacts.edit', $contact) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Contact
                    </a>
                    
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                       class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Reply via Email
                    </a>
                    
                    <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
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
            @if($contact->status === 'new') bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200
            @elseif($contact->status === 'read') bg-gradient-to-r from-yellow-50 to-yellow-100 border-b border-yellow-200
            @elseif($contact->status === 'replied') bg-gradient-to-r from-green-50 to-green-100 border-b border-green-200
            @else bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200
            @endif">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 rounded-lg flex items-center justify-center
                    @if($contact->status === 'new') bg-blue-500
                    @elseif($contact->status === 'read') bg-yellow-500
                    @elseif($contact->status === 'replied') bg-green-500
                    @else bg-gray-500
                    @endif">
                    @if($contact->status === 'new')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    @elseif($contact->status === 'read')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    @elseif($contact->status === 'replied')
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @else
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    @endif
                </div>
            </div>
            <div class="ml-4">
                <h4 class="text-lg font-semibold 
                    @if($contact->status === 'new') text-blue-800
                    @elseif($contact->status === 'read') text-yellow-800
                    @elseif($contact->status === 'replied') text-green-800
                    @else text-gray-800
                    @endif">
                    Contact Status: {{ ucfirst($contact->status) }}
                    @if($contact->is_urgent)
                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                            <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            URGENT
                        </span>
                    @endif
                </h4>
                <p class="text-sm 
                    @if($contact->status === 'new') text-blue-600
                    @elseif($contact->status === 'read') text-yellow-600
                    @elseif($contact->status === 'replied') text-green-600
                    @else text-gray-600
                    @endif">
                    @if($contact->status === 'new')
                        This contact message is new and requires attention.
                    @elseif($contact->status === 'read')
                        This contact message has been viewed but not yet responded to.
                    @elseif($contact->status === 'replied')
                        This contact has been responded to{{ $contact->repliedBy ? ' by ' . $contact->repliedBy->name : '' }}{{ $contact->replied_at ? ' on ' . $contact->replied_at->format('M d, Y') : '' }}.
                    @else
                        This contact inquiry has been resolved and closed.
                    @endif
                </p>
            </div>
        </div>
        
        <!-- Contact Details Grid -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Contact Information -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Contact Summary -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-blue-900">Contact Summary</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Full Name</p>
                                    <p class="text-sm text-gray-900">{{ $contact->full_name }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Email Address</p>
                                    <p class="text-sm text-gray-900">
                                        <a href="mailto:{{ $contact->email }}" class="text-[#fe5000] hover:text-orange-600 transition-colors">
                                            {{ $contact->email }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            
                            @if($contact->phone)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Phone Number</p>
                                    <p class="text-sm text-gray-900">
                                        <a href="tel:{{ $contact->phone }}" class="text-[#fe5000] hover:text-orange-600 transition-colors">
                                            {{ $contact->phone }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            @endif
                            
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Received Date</p>
                                    <p class="text-sm text-gray-900">{{ $contact->created_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            @if($contact->replied_at)
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <svg class="h-5 w-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Replied Date</p>
                                    <p class="text-sm text-gray-900">{{ $contact->replied_at->format('M d, Y') }}</p>
                                    @if($contact->repliedBy)
                                        <p class="text-xs text-gray-500">by {{ $contact->repliedBy->name }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-[#fe5000]/10 to-orange-50 border-b border-[#fe5000]/20">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-[#fe5000] rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-[#fe5000]">Quick Actions</h3>
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            @if($contact->status !== 'replied')
                                <form action="{{ route('admin.contacts.mark-replied', $contact) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Mark as Replied
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.contacts.mark-urgent', $contact) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                @if(!$contact->is_urgent)
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        Mark as Urgent
                                    </button>
                                @else
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Remove Urgent
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Message Content & Admin Notes -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Contact Message -->
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-purple-100 border-b border-purple-200">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-purple-900">Contact Message</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h4 class="text-sm font-semibold text-gray-700 mb-2">Subject</h4>
                                <p class="text-gray-900">{{ $contact->subject }}</p>
                            </div>
                            
                            <div class="prose max-w-none">
                                <h4 class="text-lg font-semibold text-gray-900 mb-3">Message Content</h4>
                                <div class="text-gray-700 leading-relaxed whitespace-pre-wrap bg-white p-4 rounded-lg border border-gray-200">{{ $contact->message }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Admin Notes -->
                    @if($contact->admin_notes)
                    <div class="bg-gradient-to-br from-gray-50 to-white shadow-lg rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-green-100 border-b border-green-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-green-900">Admin Notes</h3>
                                </div>
                                <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">Internal Use Only</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="prose max-w-none">
                                <div class="text-gray-700 leading-relaxed whitespace-pre-wrap bg-yellow-50 p-4 rounded-lg border border-yellow-200">{{ $contact->admin_notes }}</div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 