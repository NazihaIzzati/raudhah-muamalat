<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="h-full bg-gray-100">
    <div class="h-full flex flex-col">
        <!-- Top Header -->
        <header class="bg-white w-full border-b border-gray-200 sticky top-0 z-30 flex-shrink-0">
            <div class="w-full px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <!-- Mobile menu button -->
                        <button type="button" id="mobile-menu-button" class="md:hidden p-2 mr-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        
                        <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-orange-500">
                            Admin Dashboard
                        </a>
                    </div>

                    <!-- Notifications and Profile Section -->
                    <div class="flex items-center space-x-4">
                        <!-- Language Switcher -->
                        @include('components.language-switcher')
                        
                        <!-- Notifications Dropdown -->
                        <div x-data="{ 
                            open: false, 
                            notifications: [],
                            unreadCount: 0,
                            async fetchNotifications() {
                                try {
                                    const response = await fetch('/admin/notifications');
                                    const data = await response.json();
                                    this.notifications = data.notifications || [];
                                    this.unreadCount = data.unread_count || 0;
                                } catch (error) {
                                    console.error('Failed to fetch notifications:', error);
                                    // Fallback to empty state on error
                                    this.notifications = [];
                                    this.unreadCount = 0;
                                }
                            },
                            async markAsRead(notificationId) {
                                try {
                                    await fetch(`/admin/notifications/${notificationId}/read`, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                            'Content-Type': 'application/json'
                                        }
                                    });
                                    // Refresh notifications after marking as read
                                    this.fetchNotifications();
                                } catch (error) {
                                    console.error('Failed to mark notification as read:', error);
                                }
                            }
                        }" 
                        x-init="fetchNotifications(); setInterval(() => fetchNotifications(), 30000)" 
                        class="relative">
                            <button @click="open = !open" class="relative p-2 text-gray-500 hover:text-[#fe5000] hover:bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#fe5000] transition-all duration-200">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6.5A2.5 2.5 0 014 16.5v-9A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v3.5M16 1v6M8 1v6M4 9h16"></path>
                                </svg>
                                <!-- Notification Badge -->
                                <span x-show="unreadCount > 0" 
                                      x-text="unreadCount"
                                      class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full min-w-[20px] h-5 animate-pulse">
                                </span>
                            </button>

                            <!-- Notifications Dropdown -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-80 origin-top-right rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 max-h-96 overflow-hidden">
                                
                                <!-- Header -->
                                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50 rounded-t-xl">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
                                        <span x-text="unreadCount > 0 ? unreadCount + ' new' : 'All caught up!'" 
                                              class="text-xs text-[#fe5000] font-medium"></span>
                                    </div>
                                </div>

                                <!-- Notifications List -->
                                <div class="max-h-64 overflow-y-auto">
                                    <template x-if="notifications.length === 0">
                                        <div class="px-4 py-8 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6.5A2.5 2.5 0 014 16.5v-9A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v3.5"></path>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">No notifications yet</p>
                                        </div>
                                    </template>

                                    <template x-for="notification in notifications" :key="notification.id">
                                        <div @click="markAsRead(notification.id)" 
                                             class="px-4 py-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-b-0 transition-colors duration-200"
                                             :class="{ 'bg-blue-50': !notification.read_at }">
                                            <div class="flex items-start space-x-3">
                                                <!-- Icon based on notification type -->
                                                <div class="flex-shrink-0 mt-1">
                                                    <template x-if="notification.type === 'donation'">
                                                        <div class="h-8 w-8 bg-green-100 rounded-full flex items-center justify-center">
                                                            <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                            </svg>
                                                        </div>
                                                    </template>
                                                    <template x-if="notification.type === 'user_registration'">
                                                        <div class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                            <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                                            </svg>
                                                        </div>
                                                    </template>
                                                </div>
                                                
                                                <!-- Notification Content -->
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900" x-text="notification.title"></p>
                                                    <p class="text-sm text-gray-500 mt-1" x-text="notification.message"></p>
                                                    <p class="text-xs text-gray-400 mt-1" x-text="notification.time_ago"></p>
                                                </div>
                                                
                                                <!-- Unread indicator -->
                                                <template x-if="!notification.read_at">
                                                    <div class="flex-shrink-0">
                                                        <div class="h-2 w-2 bg-[#fe5000] rounded-full"></div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <!-- Footer -->
                                <div class="px-4 py-3 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                                    <a href="{{ route('admin.notifications.show') }}" class="text-sm text-[#fe5000] hover:text-[#fe5000]/80 font-medium">View all notifications</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Profile Section - Desktop (hidden on mobile) -->
                        <div x-data="{ open: false }" class="relative hidden md:block">
                            <button @click="open = !open" class="flex items-center space-x-3 text-left focus:outline-none hover:bg-gray-50 rounded-lg p-2 transition-colors duration-200">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-orange-50 flex items-center justify-center">
                                        <span class="text-sm font-medium text-orange-600">
                                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-700 truncate">
                                        {{ auth()->user()->name ?? 'Admin User' }}
                                    </p>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ auth()->user()->email ?? 'admin@example.com' }}
                                    </p>
                                </div>
                                <svg class="h-5 w-5 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute top-full mt-2 right-0 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50 w-56">
                                <div class="py-1">
                                    <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            My Profile
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition-colors duration-200">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Account Settings
                                        </div>
                                    </a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                </svg>
                                                Sign out
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Mobile Profile Menu (hidden on desktop) -->
                        <div class="md:hidden">
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="flex items-center p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <div class="h-8 w-8 rounded-full bg-orange-50 flex items-center justify-center">
                                        <span class="text-sm font-medium text-orange-600">
                                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                                        </span>
                                    </div>
                                </button>
                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                    <div class="py-1">
                                        <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                My Profile
                                            </div>
                                        </a>
                                        <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                </svg>
                                                Account Settings
                                            </div>
                                        </a>
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                                    </svg>
                                                    Sign out
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content with Sidebar -->
        <div class="flex-1 flex flex-row w-full min-h-0">
            <!-- Mobile Sidebar Overlay -->
            <div id="sidebar-overlay" class="fixed inset-0 bg-gray-600 bg-opacity-75 z-20 hidden md:hidden"></div>
            
            <!-- Sidebar -->
            <div id="sidebar" class="hidden md:block w-64 md:static fixed inset-y-0 left-0 z-30 md:z-auto transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex-shrink-0 bg-white border-r border-gray-200">
                <div class="flex flex-col h-full">
                    <!-- Mobile Close Button -->
                    <div class="md:hidden flex items-center justify-between p-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Menu</h2>
                        <button id="close-sidebar-button" class="p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Navigation Menu -->
                    <div class="flex-1 overflow-y-auto p-4">
                        <nav class="space-y-2">
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Dashboard
                            </a>
                            
                            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.users.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                Users
                            </a>
                            
                            <a href="{{ route('admin.events.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.events.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 012 0v4h4V3a1 1 0 012 0v4h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2h2zM6 11v8h12v-8H6z"></path>
                                </svg>
                                Events
                            </a>
                            
                            <a href="{{ route('admin.campaigns.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.campaigns.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                </svg>
                                Campaigns
                            </a>
                            
                            <a href="{{ route('admin.donations.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.donations.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Donations
                            </a>
                            
                            <!-- Notifications Section -->
                            <div x-data="{ 
                                unreadCount: 0,
                                async fetchUnreadCount() {
                                    try {
                                        const response = await fetch('/admin/notifications');
                                        const data = await response.json();
                                        this.unreadCount = data.unread_count || 0;
                                    } catch (error) {
                                        console.error('Failed to fetch notification count:', error);
                                        this.unreadCount = 0;
                                    }
                                }
                            }" 
                            x-init="fetchUnreadCount(); setInterval(() => fetchUnreadCount(), 60000)">
                                <a href="{{ route('admin.notifications.show') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.notifications.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }} relative">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 19H6.5A2.5 2.5 0 014 16.5v-9A2.5 2.5 0 016.5 5h11A2.5 2.5 0 0120 7.5v3.5M16 1v6M8 1v6M4 9h16"></path>
                                    </svg>
                                    <span class="flex-1">Notifications</span>
                                    <!-- Notification Badge -->
                                    <span x-show="unreadCount > 0" 
                                          x-text="unreadCount"
                                          class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full min-w-[20px] h-5 ml-2 animate-pulse">
                                    </span>
                                </a>
                            </div>
                            
                            <a href="{{ route('admin.posters.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.posters.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Posters
                            </a>
                            
                            <a href="{{ route('admin.partners.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.partners.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Partners
                            </a>
                            
                            <a href="{{ route('admin.faqs.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.faqs.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                FAQs
                            </a>
                            
                            <a href="{{ route('admin.contacts.index') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.contacts.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Contacts
                            </a>
                            
                            <!-- Cardzone Debug Section -->
                            <div class="pt-4 pb-2">
                                <h3 class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Development
                                </h3>
                            </div>
                            
                            <a href="{{ route('admin.cardzone.logs') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.cardzone.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Cardzone Logs
                            </a>
                            
                            <a href="{{ route('admin.paynet.logs') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.paynet.*') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Paynet Logs
                            </a>
                            
                            <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.settings') ? 'bg-orange-50 text-orange-600' : 'text-gray-600 hover:bg-gray-50 hover:text-orange-600' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Settings
                            </a>
                        </nav>
                    </div>


                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const closeSidebarButton = document.getElementById('close-sidebar-button');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            function openSidebar() {
                sidebar.classList.remove('hidden');
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                setTimeout(() => {
                    sidebar.classList.add('hidden');
                }, 300);
            }

            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', openSidebar);
            }

            if (closeSidebarButton) {
                closeSidebarButton.addEventListener('click', closeSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeSidebar);
            }
        });
    </script>

    @stack('scripts')
</body>
</html>