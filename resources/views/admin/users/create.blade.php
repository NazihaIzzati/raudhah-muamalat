@extends('layouts.admin')

@section('title', 'Create New User - Admin Dashboard')
@section('page-title', 'Create New User')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        
        <!-- Header -->
        <div class="border-b border-gray-200 pb-5 mb-5 flex justify-between items-start">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">User Information</h3>
                <p class="mt-1 text-sm text-gray-500">Create a new user account with all required details.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
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
            <div class="sm:col-span-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h4 class="ml-2 text-md font-medium text-gray-900">Basic Information</h4>
                </div>
                <div class="mt-2 h-px bg-gray-200"></div>
            </div>
            
            <!-- Name -->
            <div class="sm:col-span-3 mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="John Doe" required>
                </div>
                <p class="mt-1 text-xs text-gray-500 hidden opacity-0 group-hover:opacity-100 group-hover:block transition-opacity duration-200">Enter your full legal name</p>
            </div>
            
            <!-- Email -->
            <div class="sm:col-span-3 mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="user@example.com" required>
                </div>
            </div>
            
            <!-- Phone -->
            <div class="sm:col-span-3 mb-6">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">Phone Number</label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="+1 (555) 123-4567">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <span class="text-xs text-gray-400 italic">Optional</span>
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-500">Enter phone number with country code</p>
            </div>
            
            <!-- Role -->
            <div class="sm:col-span-3 mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                        </svg>
                    </div>
                    <select id="role" name="role" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200 appearance-none" 
                        required>
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select a role</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-500">Admin users have full access to all features</p>
            </div>
            
            <!-- Status -->
            <div class="sm:col-span-3 mb-6">
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
                        <option value="active" {{ old('status') == 'active' || !old('status') ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                        <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-500">Inactive users cannot log in to the system</p>
            </div>
            
            <!-- Password Section -->
            <div class="sm:col-span-6 pt-6">
                <div class="flex items-center bg-gray-50 p-3 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h4 class="ml-3 text-md font-medium text-gray-900">Password Information</h4>
                </div>
                <div class="mt-4 h-px bg-gray-200"></div>
            </div>
            
            <!-- Password -->
            <div class="sm:col-span-3 mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                        </svg>
                    </div>
                    <input type="password" name="password" id="password" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        required>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" id="toggle-password" class="text-gray-400 hover:text-[#fe5000] focus:outline-none transition-colors duration-200">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="mt-2 text-xs text-gray-500">Minimum 8 characters with letters and numbers.</p>
            </div>
            
            <!-- Password Confirmation -->
            <div class="sm:col-span-3 mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Password <span class="text-red-500">*</span></label>
                <div class="mt-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        required>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <button type="button" id="toggle-confirm-password" class="text-gray-400 hover:text-[#fe5000] focus:outline-none transition-colors duration-200">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Additional Information Section -->
            <div class="sm:col-span-6 pt-6">
                <div class="flex items-center bg-gray-50 p-3 rounded-lg border-l-4 border-[#fe5000] shadow-sm">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="ml-3 text-md font-medium text-gray-900">Additional Information</h4>
                </div>
                <div class="mt-4 h-px bg-gray-200"></div>
            </div>
            
            <!-- Address -->
            <div class="sm:col-span-6 mb-6">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1.5">Address</label>
                <div class="mt-1 relative group">
                    <div class="absolute top-0 left-0 pt-3 pl-3 flex items-start pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <textarea id="address" name="address" rows="3" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="Enter full address">{{ old('address') }}</textarea>
                </div>
                <p class="mt-1 text-xs text-gray-500">Include street, city, state/province, and postal code</p>
            </div>
            
            <!-- Bio -->
            <div class="sm:col-span-6 mb-6">
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1.5">Bio</label>
                <div class="mt-1 relative group">
                    <div class="absolute top-0 left-0 pt-3 pl-3 flex items-start pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <textarea id="bio" name="bio" rows="3" 
                        class="pl-10 shadow-sm focus:ring-[#fe5000] focus:border-[#fe5000] block w-full text-base border border-gray-300 rounded-lg hover:border-[#fe5000] py-3 px-4 transition-all duration-200" 
                        placeholder="Brief description about the user">{{ old('bio') }}</textarea>
                </div>
                <p class="mt-1 text-xs text-gray-500">Brief description about the user that will be displayed on their profile</p>
            </div>
            
            <!-- Profile Photo -->
            <div class="sm:col-span-6 mb-6">
                <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-1.5">Profile Photo</label>
                <div class="mt-1 flex items-center space-x-5">
                    <div class="flex-shrink-0">
                        <div class="relative group h-20 w-20 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center border border-gray-200 shadow-sm">
                            <img id="preview-image" class="h-full w-full object-cover hidden">
                            <svg id="default-image" class="h-12 w-12 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="max-w-lg flex justify-center px-6 pt-5 pb-6 border border-gray-300 border-dashed rounded-lg hover:border-[#fe5000] transition-colors duration-200 bg-white">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="profile_photo" class="relative cursor-pointer bg-white rounded-md font-medium text-[#fe5000] hover:text-[#fe5000]/80 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#fe5000]">
                                        <span>Upload a file</span>
                                        <input id="profile_photo" name="profile_photo" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF up to 2MB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Actions -->
        <div class="pt-6 mt-8 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500 italic">
                    <span class="text-red-500">*</span> Required fields
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.users.index') }}" class="bg-white py-2.5 px-5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2.5 px-5 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-[#fe5000] hover:bg-[#fe5000]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-colors duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create User
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Input field effects
        const inputFields = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], input[type="password"], select, textarea');
        
        inputFields.forEach(field => {
            // Add focus effect
            field.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-[#fe5000]/20');
                const icon = this.parentElement.querySelector('svg');
                if (icon) icon.classList.replace('text-gray-400', 'text-[#fe5000]');
            });
            
            // Remove focus effect
            field.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-[#fe5000]/20');
                const icon = this.parentElement.querySelector('svg');
                if (icon && !this.value) icon.classList.replace('text-[#fe5000]', 'text-gray-400');
            });
            
            // Add validation feedback
            field.addEventListener('input', function() {
                if (this.value) {
                    this.classList.add('border-[#fe5000]');
                    const icon = this.parentElement.querySelector('svg');
                    if (icon) icon.classList.replace('text-gray-400', 'text-[#fe5000]');
                } else {
                    this.classList.remove('border-[#fe5000]');
                    const icon = this.parentElement.querySelector('svg');
                    if (icon) icon.classList.replace('text-[#fe5000]', 'text-gray-400');
                }
            });
        });
        
        // Initialize input state for fields with values
        inputFields.forEach(field => {
            if (field.value) {
                field.classList.add('border-[#fe5000]');
                const icon = field.parentElement.querySelector('svg');
                if (icon) icon.classList.replace('text-gray-400', 'text-[#fe5000]');
            }
        });
        
        // Password visibility toggle
        const togglePassword = document.getElementById('toggle-password');
        const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle icon
                const eyeIcon = togglePassword.querySelector('svg');
                if (type === 'text') {
                    eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
                } else {
                    eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
                }
            });
        }
        
        if (toggleConfirmPassword && confirmPasswordInput) {
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                
                // Toggle icon
                const eyeIcon = toggleConfirmPassword.querySelector('svg');
                if (type === 'text') {
                    eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
                } else {
                    eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
                }
            });
        }
        
        // Profile photo preview
        const photoInput = document.getElementById('profile_photo');
        const previewImage = document.getElementById('preview-image');
        const defaultImage = document.getElementById('default-image');
        
        if (photoInput && previewImage && defaultImage) {
            photoInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        defaultImage.classList.add('hidden');
                    }
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    });
</script>
@endpush 