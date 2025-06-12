<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Jariah Fund - Islamic Financial Solutions')</title>
        <meta name="description" content="@yield('description', 'A trusted crowdfunding platform helping the underprivileged access education, healthcare, and economic support through Islamic values.')">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- UXWing Icons Reference -->
        <meta name="icon-source" content="https://uxwing.com/" />
        <meta name="icon-license" content="Free for commercial use - No attribution required" />

        <!-- UXWing Icon System Styles -->
        <style>
            /* UXWing Icon System - Professional Icon Styling */
            .uxw-icon {
                display: inline-block;
                width: 1em;
                height: 1em;
                fill: currentColor;
                vertical-align: middle;
                transition: all 0.2s ease;
            }

            .uxw-icon-sm { width: 0.875rem; height: 0.875rem; }
            .uxw-icon-md { width: 1.25rem; height: 1.25rem; }
            .uxw-icon-lg { width: 1.5rem; height: 1.5rem; }
            .uxw-icon-xl { width: 2rem; height: 2rem; }

            .uxw-icon-primary { color: #FE5100; }
            .uxw-icon-secondary { color: #6B7280; }
            .uxw-icon-white { color: #FFFFFF; }

            .uxw-icon-hover:hover {
                transform: scale(1.1);
                opacity: 0.8;
            }

            /* Social Media Icon Specific Styles */
            .uxw-social-icon {
                width: 2.5rem;
                height: 2.5rem;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }

            .uxw-social-icon:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            }

            .uxw-social-facebook { background-color: #1877F2; color: white; }
            .uxw-social-twitter { background-color: #000000; color: white; }
            .uxw-social-whatsapp { background-color: #25D366; color: white; }
            .uxw-social-telegram { background-color: #0088CC; color: white; }
            .uxw-social-copy { background-color: #6B7280; color: white; }
        </style>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Fallback styles */
                body { font-family: 'Instrument Sans', sans-serif; }
            </style>
        @endif

        @stack('styles')
    </head>
    <body class="bg-gray-50 text-gray-900 font-sans">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-14 md:h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ url('/') }}" class="text-xl md:text-2xl font-bold text-primary-500">
                            Jariah Fund
                        </a>
                        <!-- BMMB Logo -->
                        <div class="flex items-center">
                            <div class="w-px h-8 bg-gray-300 mx-3"></div>
                            <img src="{{ asset('images/logos/bmmb.png') }}"
                                 alt="Bank Muamalat Malaysia Berhad"
                                 class="h-8 md:h-10 w-auto object-contain">
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="hidden md:flex space-x-6 lg:space-x-8">
                        <a href="{{ url('/') }}" class="@if(request()->is('/')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">Home</a>
                        <a href="{{ url('/about') }}" class="@if(request()->is('about')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">About</a>
                        <a href="{{ url('/partners') }}" class="@if(request()->is('partners')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">Partners</a>
                        <a href="{{ url('/campaigns') }}" class="@if(request()->is('campaigns')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">Campaigns</a>
                        <a href="{{ url('/news') }}" class="@if(request()->is('news')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">News</a>
                        <a href="{{ url('/faq') }}" class="@if(request()->is('faq')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">FAQ</a>
                        <a href="{{ url('/contact') }}" class="@if(request()->is('contact')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">Contact</a>
                    </nav>

                    <!-- Auth Links -->
                    <div class="hidden md:flex items-center space-x-3 lg:space-x-4">
                        @auth
                            <span class="text-gray-700 text-sm">Welcome, {{ Auth::user()->name }}</span>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-primary-500 transition-colors text-sm lg:text-base">
                                    Admin
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary-500 transition-colors text-sm lg:text-base">
                                    Dashboard
                                </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-primary-500 transition-colors text-sm lg:text-base">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-500 transition-colors text-sm lg:text-base">
                                Log in
                            </a>
                            <a href="{{ route('register') }}" class="bg-primary-500 text-white px-3 py-2 lg:px-4 lg:py-2 rounded-lg hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-sm lg:text-base">
                                Register
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button type="button" class="text-gray-700 hover:text-primary-500 p-2" id="mobile-menu-button">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Navigation -->
                <div class="md:hidden hidden" id="mobile-menu">
                    <div class="px-2 pt-2 pb-3 space-y-1 border-t border-gray-100">
                        <a href="{{ url('/') }}" class="@if(request()->is('/')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">Home</a>
                        <a href="{{ url('/about') }}" class="@if(request()->is('about')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">About</a>
                        <a href="{{ url('/partners') }}" class="@if(request()->is('partners')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">Partners</a>
                        <a href="{{ url('/campaigns') }}" class="@if(request()->is('campaigns')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">Campaigns</a>
                        <a href="{{ url('/news') }}" class="@if(request()->is('news')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">News</a>
                        <a href="{{ url('/faq') }}" class="@if(request()->is('faq')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">FAQ</a>
                        <a href="{{ url('/contact') }}" class="@if(request()->is('contact')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">Contact</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="text-2xl font-bold text-primary-500">
                                Jariah Fund
                            </div>
                            <!-- BMMB Logo in Footer -->
                            <div class="flex items-center">
                                <div class="w-px h-6 bg-gray-600 mx-3"></div>
                                <img src="{{ asset('images/logos/bmmb.png') }}"
                                     alt="Bank Muamalat Malaysia Berhad"
                                     class="h-6 w-auto object-contain opacity-80">
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed">
                            A trusted crowdfunding platform to help the underprivileged.
                            Contributing to society with Islamic values.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-primary-500 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Quick Links</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="{{ url('/') }}" class="hover:text-primary-500 transition-colors">Home</a></li>
                            <li><a href="{{ url('/about') }}" class="hover:text-primary-500 transition-colors">About Us</a></li>
                            <li><a href="{{ url('/partners') }}" class="hover:text-primary-500 transition-colors">Partners</a></li>
                            <li><a href="{{ url('/campaigns') }}" class="hover:text-primary-500 transition-colors">Campaigns</a></li>
                            <li><a href="{{ url('/news') }}" class="hover:text-primary-500 transition-colors">News & Events</a></li>
                            <li><a href="{{ url('/faq') }}" class="hover:text-primary-500 transition-colors">FAQ</a></li>
                            <li><a href="{{ url('/contact') }}" class="hover:text-primary-500 transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Areas of Support -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Areas of Support</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Education Campaigns</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Health Campaigns</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Economic Support</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Emergency Aid</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Contact Info</h3>
                        <div class="space-y-3 text-gray-300">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>+60 3-1234 5678</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>info@jariahfund.com</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>Kuala Lumpur, Malaysia</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-gray-800 mt-12 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-gray-400 text-sm">
                            © {{ date('Y') }} Jariah Fund. All rights reserved.
                        </div>
                        <div class="flex space-x-6 text-sm text-gray-400">
                            <a href="#" class="hover:text-primary-500 transition-colors">Privacy Policy</a>
                            <a href="#" class="hover:text-primary-500 transition-colors">Terms of Service</a>
                            <a href="#" class="hover:text-primary-500 transition-colors">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- UXWing Icon System JavaScript -->
        <script>
            // UXWing Icon Library - Professional Icon Management System
            // Source: https://uxwing.com/ - Free for commercial use, no attribution required

            const UXWingIcons = {
                // Social Media Icons
                facebook: `<svg class="uxw-icon" fill="currentColor" viewBox="0 0 512 512">
                    <path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.9 3.2 56.6 6.3v70.9c-6.2-0.6-17-1-30.2-1c-42.9 0-59.4 16.6-59.4 59.2V256h81.3l-13.9 78.2h-67.4V510.1C433.7 494.8 512 386.9 512 256z"/>
                </svg>`,

                twitter: `<svg class="uxw-icon" fill="currentColor" viewBox="0 0 512 512">
                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                </svg>`,

                whatsapp: `<svg class="uxw-icon" fill="currentColor" viewBox="0 0 512 512">
                    <path d="M260.062 32C138.605 32 40.134 129.701 40.134 250.232c0 41.23 11.532 79.79 31.559 112.687L32 480l121.764-38.682c31.508 17.285 67.745 27.146 106.298 27.146C381.535 468.464 480 370.749 480 250.232C480 129.701 381.535 32 260.062 32zm109.362 301.11c-5.174 12.827-28.574 24.533-38.899 25.072-10.314.547-10.608 7.994-66.84-16.434-56.225-24.434-90.052-83.844-92.719-87.67-2.669-3.812-21.78-31.047-21.78-59.067 0-28.027 13.758-41.756 18.65-47.084 4.897-5.33 10.607-6.630 14.142-6.630 3.536 0 7.071.16 10.141.3 3.249.14 7.607-1.249 11.895 9.061 4.281 10.31 14.691 35.811 15.985 38.501 1.297 2.687 2.166 5.821 0.434 9.634-1.732 3.813-2.594 6.168-5.256 9.547-2.669 3.379-5.606 7.558-8.005 10.134-2.669 2.99-5.453 6.2-2.34 12.143 3.106 5.936 13.793 22.701 29.618 36.781 20.369 18.145 37.549 23.734 42.898 26.428 5.342 2.694 8.447 2.284 11.537-1.388 3.106-3.678 13.284-15.464 16.82-20.824 3.51-5.359 7.045-4.464 11.824-2.688 4.78 1.77 30.409 14.267 35.611 16.87 5.195 2.59 8.688 3.886 9.985 6.046 1.297 2.165 1.297 12.433-3.874 25.502z"/>
                </svg>`,

                telegram: `<svg class="uxw-icon" fill="currentColor" viewBox="0 0 512 512">
                    <path d="M248 8C111.033 8 0 119.033 0 256s111.033 248 248 248 248-111.033 248-248S384.967 8 248 8zm121.344 169.65l-40.253 190.477c-3.036 13.381-10.956 16.69-22.209 10.378l-61.344-45.191-29.61 28.474c-3.28 3.28-6.018 6.018-12.343 6.018l4.411-62.582 114.188-103.204c4.967-4.411-1.081-6.87-7.73-2.458L155.331 298.705l-59.416-18.592c-12.912-4.033-13.148-12.912 2.691-19.07L237.655 184.2c10.7-4.032 20.062 2.458 16.689 19.45z"/>
                </svg>`,

                copyLink: `<svg class="uxw-icon" fill="currentColor" viewBox="0 0 512 512">
                    <path d="M307.2 169.6c-35.3-35.3-92.7-35.3-128 0L89.6 259.2c-35.3 35.3-35.3 92.7 0 128 35.3 35.3 92.7 35.3 128 0l89.6-89.6c35.3-35.3 35.3-92.7 0-128zM179.2 342.4c-17.7 17.7-46.3 17.7-64 0s-17.7-46.3 0-64l89.6-89.6c17.7-17.7 46.3-17.7 64 0s17.7 46.3 0 64l-89.6 89.6z"/>
                    <path d="M332.8 342.4c35.3 35.3 92.7 35.3 128 0l89.6-89.6c35.3-35.3 35.3-92.7 0-128-35.3-35.3-92.7-35.3-128 0l-89.6 89.6c-35.3 35.3-35.3 92.7 0 128zM460.8 169.6c17.7-17.7 17.7-46.3 0-64s-46.3-17.7-64 0l-89.6 89.6c-17.7 17.7-17.7 46.3 0 64s46.3 17.7 64 0l89.6-89.6z"/>
                </svg>`,

                // Interface Icons
                people: `<svg class="uxw-icon" fill="currentColor" viewBox="0 0 512 512">
                    <path d="M256 0c-74.439 0-135 60.561-135 135s60.561 135 135 135 135-60.561 135-135S330.439 0 256 0zM423.966 358.195C387.006 320.667 338.009 296 256 296s-131.006 24.667-167.966 62.195C51.255 395.539 31 444.833 31 512h450c0-67.167-20.255-116.461-57.034-153.805z"/>
                </svg>`,

                security: `<svg class="uxw-icon" fill="currentColor" viewBox="0 0 512 512">
                    <path d="M256 0c-74.439 0-135 60.561-135 135 0 74.439 60.561 135 135 135s135-60.561 135-135C391 60.561 330.439 0 256 0zM256 240c-57.897 0-105-47.103-105-105S198.103 30 256 30s105 47.103 105 105S313.897 240 256 240zM256 90c-24.813 0-45 20.187-45 45s20.187 45 45 45 45-20.187 45-45S280.813 90 256 90zM256 150c-8.271 0-15-6.729-15-15s6.729-15 15-15 15 6.729 15 15S264.271 150 256 150zM423.966 358.195C387.006 320.667 338.009 296 256 296s-131.006 24.667-167.966 62.195C51.255 395.539 31 444.833 31 512h450C481 444.833 460.745 395.539 423.966 358.195z"/>
                </svg>`,

                // Utility function to get icon
                get: function(iconName, className = '') {
                    if (this[iconName]) {
                        return this[iconName].replace('class="uxw-icon"', `class="uxw-icon ${className}"`);
                    }
                    return '';
                },

                // Render icon in element
                render: function(elementId, iconName, className = '') {
                    const element = document.getElementById(elementId);
                    if (element && this[iconName]) {
                        element.innerHTML = this.get(iconName, className);
                    }
                }
            };

            // Global helper functions for UXWing icons
            window.UXWingIcons = UXWingIcons;

            // Helper function to create social share buttons
            function createSocialShareButton(platform, url, text = '') {
                const shareUrls = {
                    facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`,
                    twitter: `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`,
                    whatsapp: `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`,
                    telegram: `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`
                };

                if (shareUrls[platform]) {
                    window.open(shareUrls[platform], '_blank', 'width=600,height=400');
                }
            }

            // Copy to clipboard function
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(function() {
                    // Show success message
                    const toast = document.createElement('div');
                    toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
                    toast.textContent = 'Link copied to clipboard!';
                    document.body.appendChild(toast);

                    setTimeout(() => {
                        document.body.removeChild(toast);
                    }, 3000);
                }).catch(function(err) {
                    console.error('Could not copy text: ', err);
                });
            }
        </script>

        <!-- Mobile Menu Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const mobileMenuButton = document.getElementById('mobile-menu-button');
                const mobileMenu = document.getElementById('mobile-menu');

                if (mobileMenuButton && mobileMenu) {
                    mobileMenuButton.addEventListener('click', function() {
                        mobileMenu.classList.toggle('hidden');
                    });
                }

                // Smooth scrolling for navigation links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            });
        </script>

        @stack('scripts')
    </body>
</html>
