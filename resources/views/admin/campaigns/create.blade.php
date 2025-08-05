@extends('layouts.admin')

@section('title', 'Create Campaign - Admin Dashboard')
@section('page-title', 'Create Campaign')

@section('content')
<div class="space-y-6">
    <!-- Main Content -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Enhanced Header Section -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-[#fe5000]">Create New Campaign</h3>
                            <p class="text-sm text-[#fe5000] mt-1">Add a new fundraising campaign with all required details</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('admin.campaigns.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mx-6 mt-6 rounded-xl bg-red-50 p-6 border border-red-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-lg bg-red-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-semibold text-red-800">Please fix the following errors:</h3>
                            <div class="mt-3 text-sm text-red-700">
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
            
            <div class="p-6 space-y-8">
                <!-- Basic Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center bg-gradient-to-r from-[#fe5000]/10 to-orange-50 p-4 rounded-xl border border-[#fe5000]/20">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-[#fe5000] rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-[#fe5000]">Basic Information</h4>
                            <p class="text-sm text-[#fe5000]/70">Enter the campaign's basic details</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Title -->
                        <div class="group">
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                Campaign Title <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter campaign title..." required>
                            </div>
                        </div>
                        
                        <!-- Organization Name -->
                        <div class="group">
                            <label for="organization_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Organization Name <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <input type="text" name="organization_name" id="organization_name" value="{{ old('organization_name') }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter organization name...">
                            </div>
                        </div>
                        
                        <!-- Goal Amount -->
                        <div class="group">
                            <label for="goal_amount" class="block text-sm font-semibold text-gray-700 mb-2">
                                Goal Amount <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <input type="number" name="goal_amount" id="goal_amount" value="{{ old('goal_amount') }}" min="1" step="0.01" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="0.00" required>
                            </div>
                        </div>
                        
                        <!-- Currency -->
                        <div class="group">
                            <label for="currency" class="block text-sm font-semibold text-gray-700 mb-2">
                                Currency <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="currency" name="currency" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    @foreach($currencies as $code => $name)
                                        <option value="{{ $code }}" {{ old('currency') == $code ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="group">
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Campaign Status <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="status" name="status" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select status</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Category -->
                        <div class="group">
                            <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                                Campaign Category <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative">
                                <select id="category" name="category" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none">
                                    <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>General</option>
                                    <option value="emergency" {{ old('category') == 'emergency' ? 'selected' : '' }}>Emergency Relief</option>
                                    <option value="education" {{ old('category') == 'education' ? 'selected' : '' }}>Education</option>
                                    <option value="healthcare" {{ old('category') == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                                    <option value="infrastructure" {{ old('category') == 'infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                                    <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Food & Nutrition</option>
                                    <option value="orphan" {{ old('category') == 'orphan' ? 'selected' : '' }}>Orphan Support</option>
                                    <option value="mosque" {{ old('category') == 'mosque' ? 'selected' : '' }}>Mosque Building</option>
                                    <option value="water" {{ old('category') == 'water' ? 'selected' : '' }}>Water & Sanitation</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Featured -->
                        <div class="group">
                            <label for="featured" class="flex items-center">
                                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }} 
                                    class="h-4 w-4 text-[#fe5000] focus:ring-[#fe5000] border-gray-300 rounded">
                                <span class="ml-2 text-sm font-semibold text-gray-700">Featured Campaign</span>
                                <span class="text-gray-400 text-xs ml-1">(Optional)</span>
                            </label>
                            <p class="mt-1 text-xs text-gray-500">Featured campaigns appear prominently on the homepage</p>
                        </div>
                        
                        <!-- Display Order -->
                        <div class="group">
                            <label for="display_order" class="block text-sm font-semibold text-gray-700 mb-2">
                                Display Order <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                    </svg>
                                </div>
                                <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}" min="0" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="0">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Lower numbers appear first (0 = default order)</p>
                        </div>
                        
                        <!-- Start Date -->
                        <div class="group">
                            <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Start Date <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date" name="start_date" id="start_date" value="{{ old('start_date', date('Y-m-d')) }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200" required>
                            </div>
                        </div>
                        
                        <!-- End Date -->
                        <div class="group">
                            <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                End Date <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="group">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Short Description <span class="text-red-500">*</span>
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <textarea name="description" id="description" rows="4" 
                                class="px-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                placeholder="Brief description of the campaign..." required>{{ old('description') }}</textarea>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Brief description of the campaign (max 500 characters)</p>
                    </div>
                    
                    <!-- Detailed Description -->
                    <div class="group">
                        <label for="short_description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Detailed Description <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <textarea name="short_description" id="short_description" rows="3" 
                                class="px-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                placeholder="More detailed description for campaign display...">{{ old('short_description') }}</textarea>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Detailed description for campaign cards and listings</p>
                    </div>
                    
                    <!-- Content -->
                    <div class="group">
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                            Detailed Content <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <textarea name="content" id="content" rows="6" 
                                class="px-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                placeholder="Detailed campaign information...">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Media Section -->
                <div class="space-y-6">
                    <div class="flex items-center bg-gradient-to-r from-[#fe5000]/10 to-orange-50 p-4 rounded-xl border border-[#fe5000]/20">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-[#fe5000] rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-[#fe5000]">Media & Images</h4>
                            <p class="text-sm text-[#fe5000]/70">Upload campaign images and media</p>
                        </div>
                    </div>
                    
                    <!-- Featured Image -->
                    <div>
                        <label for="featured_image" class="block text-sm font-semibold text-gray-700 mb-2">
                            Featured Image <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-[#fe5000] transition-colors duration-200" id="featured_image_upload_area">
                            <div class="space-y-1 text-center" id="featured_image_upload_content">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="featured_image" class="relative cursor-pointer bg-white rounded-md font-medium text-[#fe5000] hover:text-orange-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#fe5000]">
                                        <span>Upload a file</span>
                                        <input id="featured_image" name="featured_image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                        <!-- Image Preview Area -->
                        <div id="featured_image_preview" class="mt-4 hidden">
                            <div class="relative inline-block">
                                <img id="featured_image_preview_img" src="" alt="Featured Image Preview" class="max-w-full h-auto max-h-64 rounded-xl border-2 border-gray-200">
                                <button type="button" id="featured_image_remove" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Click the X button to remove this image</p>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Recommended size: 1200x630px (16:9 ratio)</p>
                    </div>
                    
                    <!-- Partner Selection -->
                    <div>
                        <label for="partner_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Organization Partner <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <div class="relative">
                            <select id="partner_id" name="partner_id" 
                                class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none">
                                <option value="">Select a partner organization ({{ $partners->count() }} available)</option>
                                @foreach($partners as $partner)
                                    <option value="{{ $partner->id }}" {{ old('partner_id') == $partner->id ? 'selected' : '' }}>
                                        {{ $partner->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Select a partner organization to use their logo and information</p>
                    </div>
                    
                    <!-- QR Code Image -->
                    <div>
                        <label for="qr_code_image" class="block text-sm font-semibold text-gray-700 mb-2">
                            QR Code Image <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-[#fe5000] transition-colors duration-200" id="qr_code_image_upload_area">
                            <div class="space-y-1 text-center" id="qr_code_image_upload_content">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="qr_code_image" class="relative cursor-pointer bg-white rounded-md font-medium text-[#fe5000] hover:text-orange-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#fe5000]">
                                        <span>Upload QR code</span>
                                        <input id="qr_code_image" name="qr_code_image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                        <!-- QR Code Preview Area -->
                        <div id="qr_code_image_preview" class="mt-4 hidden">
                            <div class="relative inline-block">
                                <img id="qr_code_image_preview_img" src="" alt="QR Code Preview" class="max-w-full h-auto max-h-48 rounded-xl border-2 border-gray-200">
                                <button type="button" id="qr_code_image_remove" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Click the X button to remove this QR code</p>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">QR code for payment/donation links</p>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200 rounded-b-xl">
                <div class="flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                    <a href="{{ route('admin.campaigns.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                    <button type="button" onclick="testSweetAlert()" class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Test SweetAlert
                    </button>
                    <button type="button" onclick="debugElements()" class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Debug Elements
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Campaign
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert2 for notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="{{ asset('css/sweetalert2-custom.css') }}">

<script>
// SweetAlert2 Configuration
const SwalConfig = {
    confirmButtonColor: '#fe5000',
    cancelButtonColor: '#6b7280',
    reverseButtons: true,
    focusCancel: true
};

// Global variables to store image previews
let featuredImagePreview = null;
let qrCodeImagePreview = null;

// Initialize image preview functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing image preview functionality...');
    
    // Featured image upload preview with SweetAlert
    const featuredImageInput = document.getElementById('featured_image');
    if (featuredImageInput) {
        console.log('Featured image input found');
        featuredImageInput.addEventListener('change', function(e) {
            console.log('Featured image selected:', e.target.files[0]);
            const file = e.target.files[0];
            if (file) {
                // Validate file size (2MB limit)
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Too Large!',
                        text: 'Featured image must be less than 2MB.',
                        confirmButtonText: 'OK',
                        ...SwalConfig
                    });
                    this.value = '';
                    return;
                }

                // Validate file type
                if (!file.type.match('image.*')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type!',
                        text: 'Please select an image file (PNG, JPG, GIF).',
                        confirmButtonText: 'OK',
                        ...SwalConfig
                    });
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log('Featured image loaded for preview');
                    featuredImagePreview = e.target.result;
                    
                    // Show inline preview
                    const previewArea = document.getElementById('featured_image_preview');
                    const previewImg = document.getElementById('featured_image_preview_img');
                    const uploadArea = document.getElementById('featured_image_upload_area');
                    
                    previewImg.src = featuredImagePreview;
                    previewArea.classList.remove('hidden');
                    uploadArea.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        console.log('Featured image input not found');
    }

    // QR code image upload preview with SweetAlert
    const qrCodeImageInput = document.getElementById('qr_code_image');
    if (qrCodeImageInput) {
        console.log('QR code image input found');
        qrCodeImageInput.addEventListener('change', function(e) {
            console.log('QR code image selected:', e.target.files[0]);
            const file = e.target.files[0];
            if (file) {
                // Validate file size (2MB limit)
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Too Large!',
                        text: 'QR code image must be less than 2MB.',
                        confirmButtonText: 'OK',
                        ...SwalConfig
                    });
                    this.value = '';
                    return;
                }

                // Validate file type
                if (!file.type.match('image.*')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type!',
                        text: 'Please select an image file (PNG, JPG, GIF).',
                        confirmButtonText: 'OK',
                        ...SwalConfig
                    });
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log('QR code image loaded for preview');
                    qrCodeImagePreview = e.target.result;
                    
                    // Show inline preview
                    const previewArea = document.getElementById('qr_code_image_preview');
                    const previewImg = document.getElementById('qr_code_image_preview_img');
                    const uploadArea = document.getElementById('qr_code_image_upload_area');
                    
                    previewImg.src = qrCodeImagePreview;
                    previewArea.classList.remove('hidden');
                    uploadArea.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        console.log('QR code image input not found');
    }

    // Add remove button functionality
    const featuredImageRemove = document.getElementById('featured_image_remove');
    if (featuredImageRemove) {
        featuredImageRemove.addEventListener('click', function() {
            // Reset featured image
            document.getElementById('featured_image').value = '';
            featuredImagePreview = null;
            
            // Hide preview and show upload area
            document.getElementById('featured_image_preview').classList.add('hidden');
            document.getElementById('featured_image_upload_area').classList.remove('hidden');
        });
    }

    const qrCodeImageRemove = document.getElementById('qr_code_image_remove');
    if (qrCodeImageRemove) {
        qrCodeImageRemove.addEventListener('click', function() {
            // Reset QR code image
            document.getElementById('qr_code_image').value = '';
            qrCodeImagePreview = null;
            
            // Hide preview and show upload area
            document.getElementById('qr_code_image_preview').classList.add('hidden');
            document.getElementById('qr_code_image_upload_area').classList.remove('hidden');
        });
    }

});

// Form submission with SweetAlert confirmation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = new FormData(form);
        const title = formData.get('title');
        const description = formData.get('description');
        const goalAmount = formData.get('goal_amount');
        
        // Basic validation
        if (!title || !description || !goalAmount) {
            Swal.fire({
                icon: 'error',
                title: 'Missing Required Fields!',
                text: 'Please fill in all required fields (Title, Description, Goal Amount).',
                confirmButtonText: 'OK',
                ...SwalConfig
            });
            return;
        }
        
        // Prepare preview content
        let previewContent = `
            <div class="text-left">
                <p><strong>Campaign Title:</strong> ${title}</p>
                <p><strong>Description:</strong> ${description.substring(0, 100)}${description.length > 100 ? '...' : ''}</p>
                <p><strong>Goal Amount:</strong> ${formData.get('currency')} ${parseFloat(goalAmount).toLocaleString()}</p>
                <p><strong>Organization:</strong> ${formData.get('organization_name') || 'Not specified'}</p>
                <p><strong>Category:</strong> ${formData.get('category') || 'General'}</p>
                <p><strong>Status:</strong> ${formData.get('status')}</p>
                <p><strong>Featured:</strong> ${formData.get('featured') ? 'Yes' : 'No'}</p>
        `;
        
        // Add image previews if available
        if (featuredImagePreview) {
            previewContent += `<p><strong>Featured Image:</strong> ✓ Selected</p>`;
        }
        if (qrCodeImagePreview) {
            previewContent += `<p><strong>QR Code:</strong> ✓ Selected</p>`;
        }
        
        // Add partner selection if available
        const partnerId = formData.get('partner_id');
        if (partnerId) {
            const partnerSelect = document.getElementById('partner_id');
            const selectedOption = partnerSelect.options[partnerSelect.selectedIndex];
            previewContent += `<p><strong>Partner Organization:</strong> ${selectedOption.text}</p>`;
        }
        
        previewContent += '</div>';
        
        // Show confirmation dialog with preview
        Swal.fire({
            title: 'Create Campaign?',
            html: previewContent,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Create Campaign!',
            cancelButtonText: 'Review & Edit',
            confirmButtonColor: '#fe5000',
            cancelButtonColor: '#6b7280',
            reverseButtons: true,
            focusCancel: true,
            width: '600px'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading state
                Swal.fire({
                    title: 'Creating Campaign...',
                    text: 'Please wait while we save your campaign.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit the form
                form.submit();
            }
        });
    });
});

// Display session messages
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#fe5000'
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#fe5000'
    });
@endif

@if(session('warning'))
    Swal.fire({
        icon: 'warning',
        title: 'Warning!',
        text: '{{ session('warning') }}',
        confirmButtonColor: '#fe5000'
    });
@endif

@if(session('info'))
    Swal.fire({
        icon: 'info',
        title: 'Info!',
        text: '{{ session('info') }}',
        confirmButtonColor: '#fe5000'
    });
@endif

// Test SweetAlert function
function testSweetAlert() {
    console.log('Testing SweetAlert...');
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'SweetAlert Test!',
            text: 'SweetAlert2 is working correctly!',
            icon: 'success',
            confirmButtonColor: '#fe5000'
        });
    } else {
        alert('SweetAlert2 is not loaded!');
    }
}

// Debug elements function
function debugElements() {
    console.log('=== DEBUGGING ELEMENTS ===');
    
    const elements = [
        'featured_image',
        'qr_code_image', 
        'partner_id'
    ];
    
    elements.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            console.log(`✓ ${id} found:`, element);
        } else {
            console.log(`✗ ${id} NOT found`);
        }
    });
    
    // Check SweetAlert
    if (typeof Swal !== 'undefined') {
        console.log('✓ SweetAlert2 is loaded');
    } else {
        console.log('✗ SweetAlert2 is NOT loaded');
    }
    
    // Show debug info in alert
    const foundElements = elements.filter(id => document.getElementById(id)).length;
    alert(`Debug Results:\n- Elements found: ${foundElements}/${elements.length}\n- SweetAlert2: ${typeof Swal !== 'undefined' ? 'Loaded' : 'Not Loaded'}`);
}

// Display validation errors
@if($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Validation Error!',
        html: `
            <ul class="text-left">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        `,
        confirmButtonColor: '#fe5000'
    });
@endif
</script>
@endsection