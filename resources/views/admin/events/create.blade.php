@extends('layouts.admin')

@section('title', 'Create New Event - Admin Dashboard')
@section('page-title', 'Create New Event')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        
        <!-- Header -->
        <div class="border-b border-gray-200 pb-5 mb-6 flex justify-between items-start">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Event Information</h3>
                <p class="mt-1 text-sm text-gray-500">Create a new event with all required details.</p>
            </div>
            <a href="{{ route('admin.events.index') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000]">
                <svg class="-ml-1 mr-1 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to List
            </a>
        </div>
        
        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="rounded-md bg-red-50 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <!-- Basic Information Section -->
            <div class="sm:col-span-6 mb-6">
                <div class="flex items-center bg-gray-50 p-3 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="ml-3 text-md font-medium text-gray-900">Basic Information</h4>
                </div>
            </div>
            
            <!-- Title -->
            <div class="sm:col-span-4 mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1.5">Event Title <span class="text-red-500">*</span></label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="Annual Charity Gala" required>
                </div>
            </div>
            
            <!-- Category -->
            <div class="sm:col-span-2 mb-6">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <select id="category" name="category" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200 appearance-none">
                        <option value="">Select category</option>
                        @foreach($categories as $value => $label)
                            <option value="{{ $value }}" {{ old('category') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <div class="sm:col-span-6 mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1.5">Short Description <span class="text-red-500">*</span></label>
                <div class="mt-1 relative group">
                    <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                    </div>
                    <textarea name="description" id="description" rows="3" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="Brief description of the event..." required>{{ old('description') }}</textarea>
                </div>
            </div>
            
            <!-- Content -->
            <div class="sm:col-span-6 mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1.5">Detailed Content</label>
                <div class="mt-1 relative group">
                    <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <textarea name="content" id="content" rows="6" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="Detailed event information, agenda, speakers, etc...">{{ old('content') }}</textarea>
                </div>
            </div>
            
            <!-- Date & Time Section -->
            <div class="sm:col-span-6 mb-6">
                <div class="flex items-center bg-gray-50 p-3 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 012 0v4h4V3a1 1 0 012 0v4h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h2z"></path>
                        </svg>
                    </div>
                    <h4 class="ml-3 text-md font-medium text-gray-900">Date & Time Information</h4>
                </div>
            </div>
            
            <!-- Start Date -->
            <div class="sm:col-span-3 mb-6">
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1.5">Start Date <span class="text-red-500">*</span></label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 012 0v4h4V3a1 1 0 012 0v4h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h2z"></path>
                        </svg>
                    </div>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        required>
                </div>
            </div>
            
            <!-- End Date -->
            <div class="sm:col-span-3 mb-6">
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1.5">End Date</label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 012 0v4h4V3a1 1 0 012 0v4h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h2z"></path>
                        </svg>
                    </div>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <span class="text-xs text-gray-400 italic">Optional</span>
                    </div>
                </div>
            </div>
            
            <!-- Start Time -->
            <div class="sm:col-span-3 mb-6">
                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1.5">Start Time</label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200">
                </div>
            </div>
            
            <!-- End Time -->
            <div class="sm:col-span-3 mb-6">
                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1.5">End Time</label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200">
                </div>
            </div>
            
            <!-- Location Section -->
            <div class="sm:col-span-6 mb-6">
                <div class="flex items-center bg-gray-50 p-3 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h4 class="ml-3 text-md font-medium text-gray-900">Location Information</h4>
                </div>
            </div>
            
            <!-- Location -->
            <div class="sm:col-span-3 mb-6">
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1.5">Location <span class="text-red-500">*</span></label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="Grand Ballroom, City Hotel" required>
                </div>
            </div>
            
            <!-- Address -->
            <div class="sm:col-span-3 mb-6">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1.5">Full Address</label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="123 Main Street, City, State 12345">
                </div>
            </div>
            
            <!-- Registration Section -->
            <div class="sm:col-span-6 mb-6">
                <div class="flex items-center bg-gray-50 p-3 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h4 class="ml-3 text-md font-medium text-gray-900">Registration Settings</h4>
                </div>
            </div>
            
            <!-- Registration Required -->
            <div class="sm:col-span-2 mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Registration Required</label>
                <div class="mt-1 flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="registration_required" value="1" {{ old('registration_required', '1') == '1' ? 'checked' : '' }} 
                            class="focus:ring-[#fe5000] h-4 w-4 text-[#fe5000] border-gray-300">
                        <span class="ml-2 text-sm text-gray-700">Yes</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="registration_required" value="0" {{ old('registration_required') == '0' ? 'checked' : '' }} 
                            class="focus:ring-[#fe5000] h-4 w-4 text-[#fe5000] border-gray-300">
                        <span class="ml-2 text-sm text-gray-700">No</span>
                    </label>
                </div>
            </div>
            
            <!-- Max Participants -->
            <div class="sm:col-span-2 mb-6">
                <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-1.5">Max Participants</label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <input type="number" name="max_participants" id="max_participants" value="{{ old('max_participants') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="100" min="1">
                </div>
            </div>
            
            <!-- Registration Fee -->
            <div class="sm:col-span-2 mb-6">
                <label for="registration_fee" class="block text-sm font-medium text-gray-700 mb-1.5">Registration Fee</label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" name="registration_fee" id="registration_fee" value="{{ old('registration_fee', '0') }}" 
                        class="pl-8 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="0.00" min="0" step="0.01">
                </div>
            </div>
            
            <!-- Status & Settings Section -->
            <div class="sm:col-span-6 mb-6">
                <div class="flex items-center bg-gray-50 p-3 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h4 class="ml-3 text-md font-medium text-gray-900">Status & Settings</h4>
                </div>
            </div>
            
            <!-- Status -->
            <div class="sm:col-span-2 mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">Status <span class="text-red-500">*</span></label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <select id="status" name="status" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200 appearance-none" 
                        required>
                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Currency -->
            <div class="sm:col-span-2 mb-6">
                <label for="currency" class="block text-sm font-medium text-gray-700 mb-1.5">Currency</label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <select id="currency" name="currency" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200 appearance-none">
                        @foreach($currencies as $value => $label)
                            <option value="{{ $value }}" {{ old('currency', 'USD') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Featured Event -->
            <div class="sm:col-span-2 mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Featured Event</label>
                <div class="mt-1 flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} 
                        class="focus:ring-[#fe5000] h-4 w-4 text-[#fe5000] border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Mark as featured event</span>
                </div>
            </div>
            
            <!-- Featured Image -->
            <div class="sm:col-span-6 mb-6">
                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1.5">Featured Image</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-[#fe5000] transition-colors duration-200 group">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="featured_image" class="relative cursor-pointer bg-white rounded-md font-medium text-[#fe5000] hover:text-[#fe5000]/80 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#fe5000]">
                                <span>Upload a file</span>
                                <input id="featured_image" name="featured_image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="pt-6 border-t border-gray-200">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.events.index') }}" class="bg-white py-2.5 px-5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" class="inline-flex justify-center py-2.5 px-5 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[#fe5000] hover:bg-[#fe5000]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-colors duration-200">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Event
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    const imageInput = document.getElementById('featured_image');
    const imagePreview = document.createElement('div');
    imagePreview.className = 'mt-4 hidden';
    imageInput.closest('.space-y-1').appendChild(imagePreview);
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `
                    <div class="relative inline-block">
                        <img src="${e.target.result}" alt="Preview" class="h-32 w-32 object-cover rounded-lg border-2 border-[#fe5000]/20">
                        <button type="button" onclick="clearImagePreview()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">×</button>
                    </div>
                `;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const description = document.getElementById('description').value.trim();
        const location = document.getElementById('location').value.trim();
        const startDate = document.getElementById('start_date').value;
        
        if (!title || !description || !location || !startDate) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
    });
});

function clearImagePreview() {
    document.getElementById('featured_image').value = '';
    document.querySelector('.mt-4.hidden').classList.add('hidden');
}
</script>
@endsection 