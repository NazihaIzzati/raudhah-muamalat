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
                            <img src="{{ asset('assets/images/logos/bmmb.png') }}"
                                 alt="Bank Muamalat Malaysia Berhad"
                                 class="h-8 md:h-10 w-auto object-contain">
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="hidden md:flex space-x-6 lg:space-x-8">
                        <a href="{{ url('/') }}" class="@if(request()->is('/')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">{{ __('app.home') }}</a>
                        <a href="{{ url('/about') }}" class="@if(request()->is('about')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">{{ __('app.about') }}</a>
                        <a href="{{ url('/partners') }}" class="@if(request()->is('partners')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">{{ __('app.partners') }}</a>
                        <a href="{{ url('/campaigns') }}" class="@if(request()->is('campaigns')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">{{ __('app.campaigns') }}</a>
                        <a href="{{ url('/news') }}" class="@if(request()->is('news')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">{{ __('app.news') }}</a>
                        <a href="{{ url('/faq') }}" class="@if(request()->is('faq')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">{{ __('app.faq') }}</a>
                        <a href="{{ url('/contact') }}" class="@if(request()->is('contact')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors text-sm lg:text-base">{{ __('app.contact') }}</a>
                    </nav>

                    <!-- Auth Links -->
                    <div class="hidden md:flex items-center space-x-3 lg:space-x-4">
                        <!-- Language Switcher -->
                        @include('components.language-switcher')

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
                                    {{ __('app.logout') }}
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-500 transition-colors text-sm lg:text-base">
                                {{ __('app.login') }}
                            </a>
                            <a href="{{ route('register') }}" class="bg-primary-500 text-white px-3 py-2 lg:px-4 lg:py-2 rounded-lg hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-sm lg:text-base">
                                {{ __('app.register') }}
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
                        <a href="{{ url('/') }}" class="@if(request()->is('/')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">{{ __('app.home') }}</a>
                        <a href="{{ url('/about') }}" class="@if(request()->is('about')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">{{ __('app.about') }}</a>
                        <a href="{{ url('/partners') }}" class="@if(request()->is('partners')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">{{ __('app.partners') }}</a>
                        <a href="{{ url('/campaigns') }}" class="@if(request()->is('campaigns')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">{{ __('app.campaigns') }}</a>
                        <a href="{{ url('/news') }}" class="@if(request()->is('news')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">{{ __('app.news') }}</a>
                        <a href="{{ url('/faq') }}" class="@if(request()->is('faq')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">{{ __('app.faq') }}</a>
                        <a href="{{ url('/contact') }}" class="@if(request()->is('contact')) text-primary-500 font-medium bg-primary-50 @else text-gray-700 hover:text-primary-500 hover:bg-primary-50 @endif block px-3 py-2 transition-all duration-300 rounded-lg text-sm">{{ __('app.contact') }}</a>
                        
                        <!-- Language Switcher Mobile -->
                        <div class="py-2">
                            <div class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ __('app.language') }}
                            </div>
                            <div class="mt-2 px-3 space-y-1">
                                <a href="{{ route('language.switch', 'en') }}" class="block px-3 py-2 text-sm text-gray-700 hover:text-primary-500 hover:bg-primary-50 rounded-lg">{{ __('app.english') }}</a>
                                <a href="{{ route('language.switch', 'ms') }}" class="block px-3 py-2 text-sm text-gray-700 hover:text-primary-500 hover:bg-primary-50 rounded-lg">{{ __('app.bahasa_malaysia') }}</a>
                            </div>
                        </div>
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
                                <img src="{{ asset('assets/images/logos/bmmb.png') }}"
                                     alt="Bank Muamalat Malaysia Berhad"
                                     class="h-6 w-auto object-contain opacity-80">
                            </div>
                        </div>
                        <p class="text-gray-300 leading-relaxed">
                            {{ __('app.footer_platform_description') }}
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
                        <h3 class="text-lg font-semibold">{{ __('app.quick_links') }}</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="{{ url('/') }}" class="hover:text-primary-500 transition-colors">{{ __('app.home') }}</a></li>
                            <li><a href="{{ url('/about') }}" class="hover:text-primary-500 transition-colors">{{ __('app.about_us') }}</a></li>
                            <li><a href="{{ url('/partners') }}" class="hover:text-primary-500 transition-colors">{{ __('app.partners') }}</a></li>
                            <li><a href="{{ url('/campaigns') }}" class="hover:text-primary-500 transition-colors">{{ __('app.campaigns') }}</a></li>
                            <li><a href="{{ url('/news') }}" class="hover:text-primary-500 transition-colors">{{ __('app.news_and_events') }}</a></li>
                            <li><a href="{{ url('/faq') }}" class="hover:text-primary-500 transition-colors">{{ __('app.faq') }}</a></li>
                            <li><a href="{{ url('/contact') }}" class="hover:text-primary-500 transition-colors">{{ __('app.contact') }}</a></li>
                        </ul>
                    </div>

                    <!-- Areas of Support -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">{{ __('app.areas_of_support') }}</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.education_campaigns') }}</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.health_campaigns') }}</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.economic_support') }}</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.emergency_aid') }}</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">{{ __('app.contact_info') }}</h3>
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
                                <span>{{ __('app.kuala_lumpur_malaysia') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-gray-800 mt-12 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-gray-400 text-sm">
                            © {{ date('Y') }} {{ __('app.jariah_fund_by') }}. {{ __('app.all_rights_reserved_year') }}.
                        </div>
                        <div class="flex space-x-6 text-sm text-gray-400">
                            <a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.privacy_policy') }}</a>
                            <a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.terms_of_service') }}</a>
                            <a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.cookie_policy') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Mobile Menu Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const button = document.getElementById('mobile-menu-button');
                const menu = document.getElementById('mobile-menu');

                button.addEventListener('click', function() {
                    menu.classList.toggle('hidden');
                });
            });
        </script>

        @stack('scripts')
    </body>
</html>
