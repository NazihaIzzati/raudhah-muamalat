@extends('layouts.admin')

@section('title', 'Edit Partner - Admin Dashboard')
@section('page-title', 'Edit Partner')

@section('content')
<div class="space-y-6">
    <!-- Main Content -->
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-200">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
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
                            <h3 class="text-xl font-bold text-[#fe5000]">Edit Partner</h3>
                            <p class="text-sm text-[#fe5000] mt-1">Update partner information and settings</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('admin.partners.show', $partner) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Partner
                        </a>
                        <a href="{{ route('admin.partners.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Partner Info Banner -->
            <div class="mx-6 mt-6 bg-gradient-to-r from-[#fe5000]/5 to-orange-50 rounded-xl p-6 flex items-center border border-[#fe5000]/20">
                <div class="flex-shrink-0 mr-6">
                    @if($partner->logo)
                        <div class="h-20 w-20 rounded-xl overflow-hidden bg-gray-100 border-2 border-[#fe5000]/30 shadow-sm">
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="h-full w-full object-cover">
                        </div>
                    @else
                        <div class="h-20 w-20 rounded-xl overflow-hidden bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center border-2 border-[#fe5000]/30 shadow-sm">
                            <svg class="h-10 w-10 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-gray-900">{{ $partner->name }}</h2>
                    <p class="text-sm text-gray-600 flex items-center mt-1">
                        <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Created {{ $partner->created_at->format('M d, Y') }}
                    </p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                            @if($partner->status === 'active') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border border-green-200
                            @else bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 border border-gray-200
                            @endif">
                            <span class="h-2 w-2 rounded-full mr-1
                                @if($partner->status === 'active') bg-green-400
                                @else bg-gray-400
                                @endif"></span>
                            {{ ucfirst($partner->status) }}
                        </span>
                        @if($partner->featured)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border border-yellow-200">
                                <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                Featured Partner
                            </span>
                        @endif
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm bg-gradient-to-r from-[#fe5000]/10 to-orange-100 text-[#fe5000] border border-[#fe5000]/20">
                            Display Order: #{{ $partner->display_order }}
                        </span>
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
                            <p class="text-sm text-[#fe5000]/70">Update the partner's basic details</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Partner Name -->
                        <div class="group sm:col-span-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Partner Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-2m-2 0H7m14 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v12m14 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v12"></path>
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name', $partner->name) }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="Enter partner name..." required>
                            </div>
                        </div>
                        
                        <!-- Website URL -->
                        <div class="group">
                            <label for="url" class="block text-sm font-semibold text-gray-700 mb-2">
                                Website URL <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="relative rounded-xl shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                </div>
                                <input type="url" name="url" id="url" value="{{ old('url', $partner->url) }}" 
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="https://example.com">
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="group">
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Partner Status <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="status" name="status" 
                                    class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-3 px-4 bg-white transition-all duration-200 appearance-none" 
                                    required>
                                    <option value="active" {{ old('status', $partner->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $partner->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
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
                                <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $partner->display_order) }}" min="0"
                                    class="pl-12 pr-4 py-3 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                    placeholder="0">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Lower numbers appear first in the partner list</p>
                        </div>
                        
                        <!-- Featured Partner -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Featured Partner
                            </label>
                            <div class="flex items-center p-3 bg-gray-50 rounded-xl border border-gray-200 hover:border-[#fe5000] transition-colors duration-200">
                                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $partner->featured) ? 'checked' : '' }}
                                    class="h-4 w-4 text-[#fe5000] focus:ring-[#fe5000] border-gray-300 rounded">
                                <label for="featured" class="ml-3 block text-sm text-gray-700">
                                    Mark this partner as featured
                                </label>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Featured partners appear prominently on the website</p>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="group">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Partner Description <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <textarea name="description" id="description" rows="4" 
                                class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400 p-4" 
                                placeholder="Enter a brief description of the partner organization...">{{ old('description', $partner->description) }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Media & Assets Section -->
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
                            <h4 class="text-lg font-semibold text-purple-900">Media & Assets</h4>
                            <p class="text-sm text-purple-700">Update partner logo and visual assets</p>
                        </div>
                    </div>
                    
                    <!-- Current Logo Display -->
                    @if($partner->logo)
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Current Logo
                            </label>
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-200">
                                <div class="flex-shrink-0 mr-4">
                                    <img class="h-16 w-16 rounded-lg object-cover border border-gray-300 shadow-sm" src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ basename($partner->logo) }}</p>
                                    <p class="text-xs text-gray-500">Current partner logo</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Logo Upload -->
                    <div class="group">
                        <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ $partner->logo ? 'Replace Logo' : 'Partner Logo' }} <span class="text-gray-400 text-xs">(Optional)</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-[#fe5000] transition-colors duration-200 bg-gray-50 hover:bg-gray-100">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="logo" class="relative cursor-pointer bg-white rounded-md font-medium text-[#fe5000] hover:text-orange-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[#fe5000] px-2 py-1">
                                        <span>{{ $partner->logo ? 'Upload new logo' : 'Upload a logo' }}</span>
                                        <input id="logo" name="logo" type="file" class="sr-only" accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF, SVG up to 2MB</p>
                                @if($partner->logo)
                                    <p class="text-xs text-gray-600 font-medium">Leave empty to keep current logo</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.partners.show', $partner) }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                    
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Partner
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 