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