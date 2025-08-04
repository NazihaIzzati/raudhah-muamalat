@extends('layouts.admin')

@section('title', 'Edit User - Admin Dashboard')
@section('page-title', 'Edit User')

@section('content')
<div class="space-y-6">
    <!-- Main Content -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Enhanced Header Section -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                                <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold text-[#fe5000]">Edit User</h3>
                            <p class="text-sm text-[#fe5000] mt-1">Update user information and settings</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Profile
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- User Info Banner -->
            <div class="mx-6 mt-6 bg-gradient-to-r from-[#fe5000]/5 to-orange-50 rounded-xl p-6 flex items-center border border-[#fe5000]/20">
                <div class="flex-shrink-0 mr-6">
                    @if($user->profile_photo)
                        <div class="h-20 w-20 rounded-xl overflow-hidden bg-gray-100 border-2 border-[#fe5000]/30 shadow-sm">
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                        </div>
                    @else
                        <div class="h-20 w-20 rounded-xl overflow-hidden bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center border-2 border-[#fe5000]/30 shadow-sm">
                            <span class="text-2xl font-bold text-[#fe5000]">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-600 flex items-center mt-1">
                        <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        {{ $user->email }}
                    </p>
                    <div class="mt-3 flex flex-wrap gap-2">
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
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                            @if($user->is_active) bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                            @else bg-gradient-to-r from-red-100 to-red-200 text-red-800 border border-red-200
                            @endif">
                            <span class="h-2 w-2 rounded-full mr-1
                                @if($user->is_active) bg-green-400
                                @else bg-red-400
                                @endif"></span>
                            @if($user->is_active)
                                Active
                            @else
                                Inactive
                            @endif
                        </span>
                        @if($user->user_type === 'staff' && $user->staff)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 border border-purple-200">
                                {{ ucfirst($user->staff->role) }}
                            </span>
                        @elseif($user->user_type === 'donor' && $user->donor)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm bg-gradient-to-r from-orange-100 to-orange-200 text-orange-800 border border-orange-200">
                                {{ ucfirst($user->donor->donor_type) }}
                            </span>
                        @endif
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-[#fe5000]">Basic Information</h4>
                            <p class="text-sm text-[#fe5000]/70">Update the user's personal details</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Name -->
                        <div class="group">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter full name..." required>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="group">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="user@example.com" required>
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="group">
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                Phone Number <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="+60 12-345 6789">
                            </div>
                        </div>
                        
                        <!-- User Type -->
                        <div class="group">
                            <label for="user_type" class="block text-sm font-semibold text-gray-700 mb-2">
                                User Type <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="user_type" name="user_type" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    <option value="" disabled {{ old('user_type', $user->user_type) ? '' : 'selected' }}>Select user type</option>
                                    <option value="staff" {{ old('user_type', $user->user_type) == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="donor" {{ old('user_type', $user->user_type) == 'donor' ? 'selected' : '' }}>Donor</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Account Status -->
                        <div class="group">
                            <label for="is_active" class="block text-sm font-semibold text-gray-700 mb-2">
                                Account Status <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="is_active" name="is_active" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    <option value="1" {{ old('is_active', $user->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active', $user->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Staff Profile Section -->
                <div id="staff-section" class="space-y-6" style="display: {{ $user->user_type === 'staff' ? 'block' : 'none' }};">
                    <div class="flex items-center bg-gradient-to-r from-blue-500/10 to-blue-50 p-4 rounded-xl border border-blue-500/20">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-blue-600">Staff Profile</h4>
                            <p class="text-sm text-blue-600/70">Update staff-specific information</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Employee ID -->
                        <div class="group">
                            <label for="employee_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Employee ID <span class="text-gray-400 text-xs">(Auto-generated)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                    </svg>
                                </div>
                                <input type="text" name="employee_id" id="employee_id" value="{{ old('employee_id', $user->staff->employee_id ?? '') }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-blue-500 bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="EMP12345678">
                            </div>
                        </div>
                        
                        <!-- Position -->
                        <div class="group">
                            <label for="position" class="block text-sm font-semibold text-gray-700 mb-2">
                                Position <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                                <input type="text" name="position" id="position" value="{{ old('position', $user->staff->position ?? '') }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-blue-500 bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="e.g., Manager, Staff">
                            </div>
                        </div>
                        
                        <!-- Department -->
                        <div class="group">
                            <label for="department" class="block text-sm font-semibold text-gray-700 mb-2">
                                Department <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <input type="text" name="department" id="department" value="{{ old('department', $user->staff->department ?? '') }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-blue-500 bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="e.g., IT, Marketing">
                            </div>
                        </div>
                        
                        <!-- Staff Role -->
                        <div class="group">
                            <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                Staff Role <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="role" name="role" 
                                    class="focus:ring-2 focus:ring-blue-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-blue-500 py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    <option value="staff" {{ old('role', $user->staff->role ?? 'staff') == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="manager" {{ old('role', $user->staff->role ?? '') == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="admin" {{ old('role', $user->staff->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="hq" {{ old('role', $user->staff->role ?? '') == 'hq' ? 'selected' : '' }}>HQ</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-blue-500 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Staff Status -->
                        <div class="group">
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Staff Status <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="status" name="status" 
                                    class="focus:ring-2 focus:ring-blue-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-blue-500 py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    <option value="active" {{ old('status', $user->staff->status ?? 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $user->staff->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="terminated" {{ old('status', $user->staff->status ?? '') == 'terminated' ? 'selected' : '' }}>Terminated</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-blue-500 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hire Date -->
                        <div class="group">
                            <label for="hire_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Hire Date <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date', $user->staff->hire_date ?? '') }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-blue-500 bg-white transition-all duration-200">
                            </div>
                        </div>
                        
                        <!-- Address -->
                        <div class="group sm:col-span-2">
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                Address <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 pt-3 flex items-start pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <textarea name="address" id="address" rows="3" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-blue-500 bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter full address...">{{ old('address', $user->staff->address ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Donor Profile Section -->
                <div id="donor-section" class="space-y-6" style="display: {{ $user->user_type === 'donor' ? 'block' : 'none' }};">
                    <div class="flex items-center bg-gradient-to-r from-green-500/10 to-green-50 p-4 rounded-xl border border-green-500/20">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-green-500 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-green-600">Donor Profile</h4>
                            <p class="text-sm text-green-600/70">Update donor-specific information</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Donor ID -->
                        <div class="group">
                            <label for="donor_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Donor ID <span class="text-gray-400 text-xs">(Auto-generated)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-green-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                    </svg>
                                </div>
                                <input type="text" name="donor_id" id="donor_id" value="{{ old('donor_id', $user->donor->donor_id ?? '') }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-green-500 bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="DON12345678">
                            </div>
                        </div>
                        
                        <!-- Identification Number -->
                        <div class="group">
                            <label for="identification_number" class="block text-sm font-semibold text-gray-700 mb-2">
                                Identification Number <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-green-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="identification_number" id="identification_number" value="{{ old('identification_number', $user->donor->identification_number ?? '') }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-green-500 bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="e.g., IC Number, Passport">
                            </div>
                        </div>
                        
                        <!-- Donor Type -->
                        <div class="group">
                            <label for="donor_type" class="block text-sm font-semibold text-gray-700 mb-2">
                                Donor Type <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="donor_type" name="donor_type" 
                                    class="focus:ring-2 focus:ring-green-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-green-500 py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    <option value="individual" {{ old('donor_type', $user->donor->donor_type ?? 'individual') == 'individual' ? 'selected' : '' }}>Individual</option>
                                    <option value="corporate" {{ old('donor_type', $user->donor->donor_type ?? '') == 'corporate' ? 'selected' : '' }}>Corporate</option>
                                    <option value="anonymous" {{ old('donor_type', $user->donor->donor_type ?? '') == 'anonymous' ? 'selected' : '' }}>Anonymous</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-green-500 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Donor Status -->
                        <div class="group">
                            <label for="donor_status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Donor Status <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="donor_status" name="donor_status" 
                                    class="focus:ring-2 focus:ring-green-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-green-500 py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    <option value="active" {{ old('donor_status', $user->donor->status ?? 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('donor_status', $user->donor->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="suspended" {{ old('donor_status', $user->donor->status ?? '') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-green-500 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Registration Date -->
                        <div class="group">
                            <label for="registration_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                Registration Date <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-green-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date" name="registration_date" id="registration_date" value="{{ old('registration_date', $user->donor->registration_date ?? '') }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-green-500 bg-white transition-all duration-200">
                            </div>
                        </div>
                        
                        <!-- Newsletter Subscription -->
                        <div class="group">
                            <label class="flex items-center">
                                <input type="checkbox" name="newsletter_subscribed" id="newsletter_subscribed" value="1" 
                                    {{ old('newsletter_subscribed', $user->donor->newsletter_subscribed ?? false) ? 'checked' : '' }}
                                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <span class="ml-2 text-sm font-semibold text-gray-700">Subscribe to Newsletter</span>
                            </label>
                        </div>
                        
                        <!-- Address -->
                        <div class="group sm:col-span-2">
                            <label for="donor_address" class="block text-sm font-semibold text-gray-700 mb-2">
                                Address <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 pt-3 flex items-start pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-green-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <textarea name="address" id="donor_address" rows="3" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-green-500 focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-green-500 bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter full address...">{{ old('address', $user->donor->address ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Password Section -->
                <div class="space-y-6">
                    <div class="flex items-center bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-blue-800">Password Update</h4>
                            <p class="text-sm text-blue-600">Leave blank to keep current password</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- New Password -->
                        <div class="group">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                New Password <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input type="password" name="password" id="password" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter new password...">
                            </div>
                        </div>
                        
                        <!-- Confirm New Password -->
                        <div class="group">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                Confirm New Password <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Confirm new password...">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Image Section -->
                <div class="space-y-6">
                    <div class="flex items-center bg-gradient-to-r from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 bg-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-purple-800">Profile Image</h4>
                            <p class="text-sm text-purple-600">Update the user's profile picture</p>
                        </div>
                    </div>
                    
                    <!-- Current Profile Photo -->
                    @if($user->profile_photo)
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Current Profile Photo</label>
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                                <div class="flex-shrink-0">
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="h-16 w-16 rounded-xl object-cover border border-gray-300">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">Current profile image</p>
                                    <p class="text-xs text-gray-500 mt-1">Upload a new image below to replace this one</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Profile Photo Upload -->
                    <div class="group">
                        <label for="profile_photo" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ $user->profile_photo ? 'New Profile Photo' : 'Profile Photo' }} <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-[#fe5000] transition-colors duration-200">
                            <div class="space-y-2 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="profile_photo" class="relative cursor-pointer bg-white rounded-md font-medium text-[#fe5000] hover:text-[#fe5000]/80 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#fe5000]">
                                        <span>Upload a file</span>
                                        <input id="profile_photo" name="profile_photo" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                        Update User
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// User type change handler
document.getElementById('user_type').addEventListener('change', function() {
    const userType = this.value;
    const staffSection = document.getElementById('staff-section');
    const donorSection = document.getElementById('donor-section');
    
    // Hide both sections initially
    staffSection.style.display = 'none';
    donorSection.style.display = 'none';
    
    // Show appropriate section based on user type
    if (userType === 'staff') {
        staffSection.style.display = 'block';
        // Make staff fields required
        document.getElementById('role').required = true;
        document.getElementById('status').required = true;
        // Make donor fields not required
        document.getElementById('donor_type').required = false;
        document.getElementById('donor_status').required = false;
    } else if (userType === 'donor') {
        donorSection.style.display = 'block';
        // Make donor fields required
        document.getElementById('donor_type').required = true;
        document.getElementById('donor_status').required = true;
        // Make staff fields not required
        document.getElementById('role').required = false;
        document.getElementById('status').required = false;
    }
});

// Initialize form on page load
document.addEventListener('DOMContentLoaded', function() {
    const userType = document.getElementById('user_type').value;
    if (userType) {
        document.getElementById('user_type').dispatchEvent(new Event('change'));
    }
});
</script>

@endsection 