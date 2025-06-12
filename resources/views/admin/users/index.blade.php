@extends('layouts.admin')

@section('title', 'Users Management - Admin Dashboard')
@section('page-title', 'Users Management')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards with Enhanced Visual Appeal -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="overflow-hidden rounded-xl border border-[#fe5000]/10 bg-[#fe5000]/10 transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-[#fe5000]">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/30 rounded-lg flex items-center justify-center ring-2 ring-white/50">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000] opacity-90">Total Users</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ $users->total() }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-[#fe5000]/70 bg-white/20 px-2 py-1 rounded-full">All registered users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-green-500 to-green-600 overflow-hidden rounded-xl transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-white">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center ring-2 ring-white/30">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-green-100">Active Users</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ $users->where('status', 'active')->count() }}</p>
                        <div class="flex items-center mt-1">
                            <div class="h-2 w-2 bg-green-300 rounded-full mr-2 animate-pulse"></div>
                            <span class="text-xs text-green-100 bg-white/10 px-2 py-1 rounded-full">Currently active</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-[#fe5000]/10 border border-[#fe5000]/10 overflow-hidden rounded-xl transform hover:scale-105 transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-[#fe5000]/20 rounded-lg flex items-center justify-center ring-2 ring-[#fe5000]/30">
                            <svg class="h-6 w-6 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-[#fe5000]">Administrators</h3>
                        <p class="text-3xl font-bold text-[#fe5000] tracking-tight">{{ $users->where('role', 'admin')->count() }}</p>
                        <div class="flex items-center mt-1">
                            <svg class="h-3 w-3 text-[#fe5000] mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.385 2.667l.615-1.333L10.615 2.667A1.001 1.001 0 0011 3.001h2a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V5.001a2 2 0 012-2h2c.183 0 .366-.05.512-.144.173-.112.288-.272.288-.446 0-.174-.115-.334-.288-.446A.999.999 0 019 2.001H8a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-xs text-[#fe5000] bg-[#fe5000]/10 px-2 py-1 rounded-full">System admins</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-orange-500 to-[#fe5000] overflow-hidden rounded-xl transform hover:scale-105 transition-all duration-300">
            <div class="p-6 text-white">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 bg-white/20 rounded-lg flex items-center justify-center ring-2 ring-white/30">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-sm font-medium text-orange-100">New This Month</h3>
                        <p class="text-3xl font-bold tracking-tight">{{ $users->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-orange-100 bg-white/10 px-2 py-1 rounded-full">{{ now()->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content with Enhanced Design -->
    <div class="bg-white overflow-hidden sm:rounded-2xl border border-gray-200">
        <!-- Enhanced Header Section -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 via-white to-gray-50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-14 w-14 bg-gradient-to-br from-[#fe5000] to-orange-600 rounded-2xl flex items-center justify-center">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5">
                        <h3 class="text-2xl font-bold text-[#fe5000]">User Management</h3>
                        <p class="text-sm text-[#fe5000]/80 mt-1 font-medium">Manage user accounts, roles, and permissions with ease</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <div class="text-sm text-gray-600 bg-gradient-to-r from-gray-100 to-gray-200 px-4 py-2 rounded-xl font-medium">
                        <span class="text-[#fe5000] font-semibold">{{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }}</span> of <span class="text-[#fe5000] font-semibold">{{ $users->total() }}</span> users
                    </div>
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New User
                    </a>
                </div>
            </div>
            
            <!-- Enhanced Search and Filters -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                        <div class="h-8 w-8 bg-[#fe5000]/10 rounded-lg flex items-center justify-center mr-3">
                            <svg class="h-4 w-4 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                        </div>
                        Search & Filter Users
                    </h4>
                    <p class="text-sm text-gray-600 ml-11">Find exactly what you're looking for with our advanced search options</p>
                </div>
                <form action="{{ route('admin.users.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="group">
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-3">🔍 Search Users</label>
                        <div class="relative rounded-xl">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-hover:text-[#fe5000] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                class="pl-12 pr-4 py-4 focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] bg-white transition-all duration-200 placeholder-gray-400" 
                                placeholder="Search by name, email...">
                        </div>
                    </div>
                    
                    <div class="group">
                        <label for="role" class="block text-sm font-semibold text-gray-700 mb-3">👤 Filter by Role</label>
                        <div class="relative">
                            <select id="role" name="role" 
                                class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-4 px-4 bg-white transition-all duration-200 appearance-none">
                                @foreach($roles as $value => $label)
                                    <option value="{{ $value }}" {{ request('role') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="group">
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-3">📊 Filter by Status</label>
                        <div class="relative">
                            <select id="status" name="status" 
                                class="focus:ring-2 focus:ring-[#fe5000] focus:border-transparent block w-full text-sm border border-gray-300 rounded-xl hover:border-[#fe5000] py-4 px-4 bg-white transition-all duration-200 appearance-none">
                                @foreach($statuses as $value => $label)
                                    <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg class="h-5 w-5 group-hover:text-[#fe5000] transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-end space-x-3">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-4 border border-transparent rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Search
                        </button>
                        @if(request()->hasAny(['search', 'role', 'status']))
                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-4 py-4 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105" title="Clear all filters">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Enhanced Users Display -->
        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <span>👤 User Information</span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider hidden md:table-cell">
                                <div class="flex items-center space-x-2">
                                    <span>📞 Contact Details</span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <span>🎯 Role & Status</span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-600 uppercase tracking-wider hidden sm:table-cell">
                                <div class="flex items-center space-x-2">
                                    <span>📅 Member Since</span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-5 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">
                                <div class="flex items-center justify-end space-x-2">
                                    <span>⚡ Actions</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-gradient-to-r hover:from-[#fe5000]/5 hover:to-orange-50 transition-all duration-300 group">
                                <td class="px-6 py-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16">
                                            @if($user->profile_photo)
                                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="h-16 w-16 rounded-2xl object-cover border-2 border-[#fe5000]/20 group-hover:border-[#fe5000]/40 transition-all duration-200">
                                            @else
                                                <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center border-2 border-[#fe5000]/20 group-hover:border-[#fe5000]/40 transition-all duration-200">
                                                    <span class="text-2xl font-bold text-[#fe5000]">{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-5 flex-1">
                                            <div class="text-lg font-bold text-gray-900 group-hover:text-[#fe5000] transition-colors duration-200">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-600 flex items-center mt-2">
                                                <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $user->email }}
                                            </div>
                                            @if($user->last_login_at)
                                                <div class="text-xs text-gray-500 flex items-center mt-2 bg-green-50 px-3 py-1 rounded-full w-fit">
                                                    <div class="h-2 w-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                                    <span class="font-medium">Last seen {{ $user->last_login_at->diffForHumans() }}</span>
                                                </div>
                                            @else
                                                <div class="text-xs text-gray-500 flex items-center mt-2 bg-gray-50 px-3 py-1 rounded-full w-fit">
                                                    <div class="h-2 w-2 bg-gray-400 rounded-full mr-2"></div>
                                                    <span class="font-medium">Never logged in</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-sm text-gray-600 hidden md:table-cell">
                                    @if($user->phone)
                                        <div class="flex items-center bg-gray-50 p-3 rounded-xl">
                                            <svg class="h-5 w-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            <span class="font-medium">{{ $user->phone }}</span>
                                        </div>
                                    @else
                                        <div class="flex items-center bg-red-50 p-3 rounded-xl text-red-600">
                                            <svg class="h-5 w-5 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <span class="font-medium italic">No phone provided</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-6">
                                    <div class="space-y-3">
                                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold border-2 transition-all duration-200 hover:scale-105
                                            @if($user->role === 'admin') bg-gradient-to-r from-red-100 to-red-200 text-red-800 border-red-300
                                            @else bg-gradient-to-r from-green-100 to-green-200 text-green-800 border-green-300
                                            @endif">
                                            @if($user->role === 'admin')
                                                <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9.385 2.667l.615-1.333L10.615 2.667A1.001 1.001 0 0011 3.001h2a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V5.001a2 2 0 012-2h2c.183 0 .366-.05.512-.144.173-.112.288-.272.288-.446 0-.174-.115-.334-.288-.446A.999.999 0 019 2.001H8a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                                                </svg>
                                                Admin
                                            @else
                                                <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                                </svg>
                                                User
                                            @endif
                                        </span>
                                        <br>
                                        <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold border-2 transition-all duration-200 hover:scale-105
                                            @if($user->status === 'active') bg-gradient-to-r from-green-100 to-green-200 text-green-800 border-green-300
                                            @elseif($user->status === 'inactive') bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 border-yellow-300
                                            @else bg-gradient-to-r from-red-100 to-red-200 text-red-800 border-red-300
                                            @endif">
                                            <span class="h-3 w-3 rounded-full mr-2 animate-pulse
                                                @if($user->status === 'active') bg-green-500
                                                @elseif($user->status === 'inactive') bg-yellow-500
                                                @else bg-red-500
                                                @endif"></span>
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-sm text-gray-600 hidden sm:table-cell">
                                    <div class="flex items-center bg-gray-50 p-3 rounded-xl">
                                        <svg class="h-5 w-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 012 0v4h4V3a1 1 0 012 0v4h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h2z"></path>
                                        </svg>
                                        <div>
                                            <div class="font-bold text-gray-900">{{ $user->created_at->format('M d, Y') }}</div>
                                            <div class="text-xs text-gray-500 font-medium">{{ $user->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6 text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.users.show', $user) }}" class="group relative text-gray-600 hover:text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 rounded-xl p-3 transition-all duration-200 transform hover:scale-105" title="View Details">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="group relative text-[#fe5000] hover:text-[#fe5000]/80 bg-white hover:bg-[#fe5000]/5 border border-[#fe5000]/20 rounded-xl p-3 transition-all duration-200 transform hover:scale-105" title="Edit User">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        @if($user->id !== Auth::id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('⚠️ Are you sure you want to delete this user? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="group relative text-red-600 hover:text-red-900 bg-white hover:bg-red-50 border border-red-200 rounded-xl p-3 transition-all duration-200 transform hover:scale-105" title="Delete User">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Enhanced Pagination -->
            <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200 rounded-b-2xl">
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
                    <div class="text-sm text-gray-600 bg-white px-4 py-2 rounded-xl">
                        Showing <span class="font-bold text-[#fe5000]">{{ $users->firstItem() ?? 0 }}</span> to 
                        <span class="font-bold text-[#fe5000]">{{ $users->lastItem() ?? 0 }}</span> of 
                        <span class="font-bold text-[#fe5000]">{{ $users->total() }}</span> results
                    </div>
                    <div class="flex items-center space-x-2">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 bg-gradient-to-br from-gray-50 to-white">
                <div class="mx-auto h-40 w-40 rounded-3xl bg-gradient-to-br from-[#fe5000]/10 to-orange-100 flex items-center justify-center mb-8">
                    <svg class="h-20 w-20 text-[#fe5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">🔍 No users found</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto text-lg leading-relaxed">
                    @if(request()->hasAny(['search', 'role', 'status']))
                        We couldn't find any users matching your search criteria. Try adjusting your filters or search terms to find what you're looking for.
                    @else
                        Ready to get started? Create your first user account to begin building your community and managing your platform effectively.
                    @endif
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @if(request()->hasAny(['search', 'role', 'status']))
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-8 py-4 border border-gray-300 text-sm font-bold rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                            <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Clear All Filters
                        </a>
                    @endif
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-[#fe5000] to-orange-600 hover:from-[#fe5000]/90 hover:to-orange-600/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fe5000] transition-all duration-200 transform hover:scale-105">
                        <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        {{ request()->hasAny(['search', 'role', 'status']) ? 'Create New User' : 'Create Your First User' }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 