<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-primary-500 whitespace-nowrap">
                    Jariah Fund
                </a>
                <!-- BMMB Logo -->
                <div class="hidden sm:flex items-center">
                    <div class="w-px h-8 bg-gray-300 mx-3"></div>
                    <img src="{{ asset('assets/images/logos/bmmb.png') }}"
                         alt="Bank Muamalat Malaysia Berhad"
                         class="h-8 md:h-10 w-auto object-contain">
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="hidden md:flex space-x-3 lg:space-x-6">
                <a href="{{ url('/') }}" class="nav-link @if(request()->is('/')) active @endif">{{ __('app.home') }}</a>
                
                <!-- About Dropdown -->
                <div class="relative" id="about-dropdown-container">
                    <button type="button" class="nav-link flex items-center gap-x-1 @if(request()->is('about') || request()->is('partners')) active @endif" id="about-dropdown-button">
                        {{ __('app.about') }}
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="about-dropdown" class="hidden absolute left-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="py-1">
                            <a href="{{ url('/about') }}" class="dropdown-item @if(request()->is('about')) active-dropdown-item @endif">{{ __('app.about_us') }}</a>
                            <a href="{{ url('/partners') }}" class="dropdown-item @if(request()->is('partners')) active-dropdown-item @endif">{{ __('app.partners') }}</a>
                        </div>
                    </div>
                </div>
                
                <a href="{{ url('/campaigns') }}" class="nav-link @if(request()->is('campaigns')) active @endif">{{ __('app.campaigns') }}</a>
                <a href="{{ url('/news') }}" class="nav-link @if(request()->is('news')) active @endif">{{ __('app.news') }}</a>
                <a href="{{ url('/faq') }}" class="nav-link @if(request()->is('faq')) active @endif">{{ __('app.faq') }}</a>
                <a href="{{ url('/contact') }}" class="nav-link @if(request()->is('contact')) active @endif">{{ __('app.contact') }}</a>
            </nav>
            
            <!-- Auth Links -->
            <div class="flex items-center space-x-3 sm:space-x-4">
                <!-- Language Switcher -->
                <x-language-switcher />
                
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary whitespace-nowrap">
                            {{ __('app.dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-500 transition-colors text-sm whitespace-nowrap">
                            {{ __('app.login') }}
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary whitespace-nowrap">
                                {{ __('app.register') }}
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
                <a href="{{ url('/') }}" class="mobile-nav-link @if(request()->is('/')) active-mobile @endif">{{ __('app.home') }}</a>
                <a href="{{ url('/about') }}" class="mobile-nav-link @if(request()->is('about')) active-mobile @endif">{{ __('app.about_us') }}</a>
                <a href="{{ url('/partners') }}" class="mobile-nav-link @if(request()->is('partners')) active-mobile @endif">{{ __('app.partners') }}</a>
                <a href="{{ url('/campaigns') }}" class="mobile-nav-link @if(request()->is('campaigns')) active-mobile @endif">{{ __('app.campaigns') }}</a>
                <a href="{{ url('/news') }}" class="mobile-nav-link @if(request()->is('news')) active-mobile @endif">{{ __('app.news') }}</a>
                <a href="{{ url('/faq') }}" class="mobile-nav-link @if(request()->is('faq')) active-mobile @endif">{{ __('app.faq') }}</a>
                <a href="{{ url('/contact') }}" class="mobile-nav-link @if(request()->is('contact')) active-mobile @endif">{{ __('app.contact') }}</a>
                
                <!-- Mobile language switcher -->
                <div class="px-3 py-2">
                    <x-language-switcher />
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* Navigation Styles */
    .nav-link {
        @apply text-sm font-medium text-gray-700 hover:text-primary-500 transition-colors whitespace-nowrap px-2 py-1;
    }
    .nav-link.active {
        @apply text-primary-500;
    }
    .dropdown-item {
        @apply block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100;
    }
    .active-dropdown-item {
        @apply bg-primary-50 text-primary-500 font-medium;
    }
    .mobile-nav-link {
        @apply block px-3 py-2 text-sm transition-all duration-300 rounded-lg text-gray-700 hover:text-primary-500 hover:bg-primary-50;
    }
    .active-mobile {
        @apply text-primary-500 font-medium bg-primary-50;
    }
    .btn-primary {
        @apply bg-primary-500 text-white px-3 py-2 rounded-lg text-sm hover:bg-primary-600 transition-colors;
    }
</style>

<!-- Navigation Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
        
        // About dropdown toggle
        const aboutButton = document.getElementById('about-dropdown-button');
        const aboutDropdown = document.getElementById('about-dropdown');
        const aboutContainer = document.getElementById('about-dropdown-container');
        
        if (aboutButton && aboutDropdown && aboutContainer) {
            aboutButton.addEventListener('click', function() {
                aboutDropdown.classList.toggle('hidden');
            });
            
            document.addEventListener('click', function(event) {
                if (!aboutContainer.contains(event.target)) {
                    aboutDropdown.classList.add('hidden');
                }
            });
        }
    });
</script>
