@extends('layouts.master')

@section('title', 'Dashboard - Jariah Fund')
@section('description', 'Your personal dashboard to manage donations and track your impact.')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Dashboard Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <div>
                        <h1 class="text-lg font-semibold text-gray-900">Dashboard</h1>
                        <p class="text-sm text-gray-500">Here's what's happening with your donations</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="hidden md:flex items-center space-x-2 bg-green-50 px-3 py-1 rounded-full">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-sm font-medium text-green-700">Active</span>
                    </div>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Donations -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Donated</p>
                        <p class="text-2xl font-bold text-gray-900">RM 0.00</p>
                        <p class="text-xs text-gray-500 mt-1">Start your giving journey</p>
                    </div>
                </div>
            </div>

            <!-- Campaigns Supported -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Campaigns Supported</p>
                        <p class="text-2xl font-bold text-gray-900">0</p>
                        <p class="text-xs text-gray-500 mt-1">Ready to make impact</p>
                    </div>
                </div>
            </div>

            <!-- Impact Points -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Impact Points</p>
                        <p class="text-2xl font-bold text-gray-900">0</p>
                        <p class="text-xs text-gray-500 mt-1">Earn by donating</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Quick Actions -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
                        <p class="text-sm text-gray-600 mt-1">Get started with these common tasks</p>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <a href="{{ url('/donate') }}" class="group flex items-center p-4 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition-all">
                                <div class="w-10 h-10 bg-primary-100 group-hover:bg-primary-200 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Make Donation</p>
                                    <p class="text-sm text-gray-600">Support a cause today</p>
                                </div>
                            </a>

                            <a href="{{ url('/campaigns') }}" class="group flex items-center p-4 border border-gray-200 rounded-lg hover:border-green-300 hover:bg-green-50 transition-all">
                                <div class="w-10 h-10 bg-green-100 group-hover:bg-green-200 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Browse Campaigns</p>
                                    <p class="text-sm text-gray-600">Find causes to support</p>
                                </div>
                            </a>

                            <a href="#" class="group flex items-center p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-all">
                                <div class="w-10 h-10 bg-blue-100 group-hover:bg-blue-200 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">View History</p>
                                    <p class="text-sm text-gray-600">Track your donations</p>
                                </div>
                            </a>

                            <a href="#" class="group flex items-center p-4 border border-gray-200 rounded-lg hover:border-purple-300 hover:bg-purple-50 transition-all">
                                <div class="w-10 h-10 bg-purple-100 group-hover:bg-purple-200 rounded-lg flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Profile Settings</p>
                                    <p class="text-sm text-gray-600">Update your info</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
                        <p class="text-sm text-gray-600 mt-1">Your latest donations and activities</p>
                    </div>
                    <div class="p-6">
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No activity yet</h3>
                            <p class="text-gray-600 mb-6">Start making donations to see your activity here</p>
                            <a href="{{ url('/campaigns') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Browse Campaigns
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">
                <!-- Featured Campaign -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Featured Campaign</h2>
                        <p class="text-sm text-gray-600 mt-1">Help make a difference today</p>
                    </div>
                    <div class="p-6">
                        <div class="bg-gradient-to-r from-primary-500 to-primary-600 rounded-lg p-6 text-white mb-4">
                            <h3 class="font-semibold mb-2">Emergency Food Relief</h3>
                            <p class="text-sm text-primary-100 mb-4">Help provide meals for families in need during difficult times.</p>
                            <div class="flex items-center justify-between text-sm">
                                <span>RM 15,000 raised</span>
                                <span>75% complete</span>
                            </div>
                            <div class="w-full bg-primary-400 rounded-full h-2 mt-2">
                                <div class="bg-white h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                        <a href="{{ url('/campaigns') }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            View All Campaigns
                        </a>
                    </div>
                </div>

                <!-- Impact Summary -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Your Impact</h2>
                        <p class="text-sm text-gray-600 mt-1">See how you're making a difference</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900">Meals Provided</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">0</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900">Students Helped</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">0</span>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900">Families Supported</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-900">0</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <p class="text-xs text-gray-500 text-center">Start donating to see your impact grow!</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Tips -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200 p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="ml-3 text-sm font-semibold text-gray-900">Quick Tip</h3>
                    </div>
                    <p class="text-sm text-gray-700 mb-3">Set up recurring donations to maximize your impact and earn more points!</p>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-700">Learn more →</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection