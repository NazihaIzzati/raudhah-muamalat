<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-primary-500">
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
            <nav class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="@if(request()->is('/')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors">Home</a>
                <a href="{{ url('/about') }}" class="@if(request()->is('about')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors">About</a>
                <a href="{{ url('/partners') }}" class="@if(request()->is('partners')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors">Partners</a>
                <a href="{{ url('/campaigns') }}" class="@if(request()->is('campaigns')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors">Campaigns</a>
                <a href="{{ url('/news') }}" class="@if(request()->is('news')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors">News</a>
                <a href="{{ url('/faq') }}" class="@if(request()->is('faq')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors">FAQ</a>
                <a href="{{ url('/contact') }}" class="@if(request()->is('contact')) text-primary-500 font-medium @else text-gray-700 hover:text-primary-500 @endif transition-colors">Contact</a>
            </nav>
            
            <!-- Auth Links -->
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-500 transition-colors">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="text-gray-700 hover:text-primary-500" id="mobile-menu-button">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
    });
</script>
