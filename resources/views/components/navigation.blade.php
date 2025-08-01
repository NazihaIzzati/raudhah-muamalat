<!-- Header -->
<header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-sm border-b border-gray-200 transition-all duration-300">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo & Navigation -->
            <div class="flex items-center space-x-8">
                <a href="{{ url('/') }}" class="text-3xl font-bold text-primary-600 whitespace-nowrap transition-transform duration-300 hover:scale-105">
                    Jariah Fund
                </a>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-4 lg:space-x-6">
                    <a href="{{ url('/') }}" class="nav-link @if(request()->is('/')) active @endif">{{ __('app.home') }}</a>

                    <!-- About Dropdown -->
                    <div class="relative" id="about-dropdown-container">
                        <button type="button" class="nav-link flex items-center gap-x-1.5 @if(request()->is('about') || request()->is('partners')) active @endif" id="about-dropdown-button">
                            {{ __('app.about') }}
                            <svg class="h-5 w-5 transition-transform duration-200" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="about-dropdown" class="hidden absolute left-0 z-10 mt-3 w-48 origin-top-right rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transition-all duration-300 opacity-0 transform -translate-y-2">
                            <div class="py-2">
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
            </div>
            
            <!-- Auth Links & Mobile Menu Button -->
            <div class="flex items-center space-x-3">
                <!-- Desktop Auth Links -->
                <div class="hidden md:flex items-center space-x-3">
                    <x-language-switcher />
                    
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary-outline whitespace-nowrap flex items-center gap-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                {{ __('app.dashboard') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-secondary whitespace-nowrap">
                                {{ __('app.login') }}
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary whitespace-nowrap flex items-center gap-x-2">
                                    {{ __('app.register') }}
                                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
                
                <!-- BMMB Logo (moved for better alignment) -->
                <div class="hidden sm:flex items-center pl-3 ml-3 border-l border-gray-300">
                    <img src="{{ asset('assets/images/logos/bmmb.png') }}"
                         alt="Bank Muamalat Malaysia Berhad"
                         class="h-12 w-auto object-contain">
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-primary-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500" id="mobile-menu-button">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-4 space-y-2 sm:px-3 border-t border-gray-200">
            <a href="{{ url('/') }}" class="mobile-nav-link @if(request()->is('/')) active-mobile @endif">{{ __('app.home') }}</a>
            <a href="{{ url('/about') }}" class="mobile-nav-link @if(request()->is('about')) active-mobile @endif">{{ __('app.about_us') }}</a>
            <a href="{{ url('/partners') }}" class="mobile-nav-link @if(request()->is('partners')) active-mobile @endif">{{ __('app.partners') }}</a>
            <a href="{{ url('/campaigns') }}" class="mobile-nav-link @if(request()->is('campaigns')) active-mobile @endif">{{ __('app.campaigns') }}</a>
            <a href="{{ url('/news') }}" class="mobile-nav-link @if(request()->is('news')) active-mobile @endif">{{ __('app.news') }}</a>
            <a href="{{ url('/faq') }}" class="mobile-nav-link @if(request()->is('faq')) active-mobile @endif">{{ __('app.faq') }}</a>
            <a href="{{ url('/contact') }}" class="mobile-nav-link @if(request()->is('contact')) active-mobile @endif">{{ __('app.contact') }}</a>
            
            <!-- Mobile Auth Links & Language Switcher -->
            <div class="pt-4 pb-2 mt-4 border-t border-gray-200">
                <div class="flex items-center justify-between px-2">
                    <div class="flex-shrink-0">
                        <x-language-switcher />
                    </div>
                    <div class="flex items-center space-x-2">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary-outline whitespace-nowrap text-sm">
                                    {{ __('app.dashboard') }}
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-secondary whitespace-nowrap text-sm">
                                    {{ __('app.login') }}
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary whitespace-nowrap text-sm">
                                        {{ __('app.register') }}
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* Navigation Styles */
    .nav-link {
        @apply text-base font-medium text-gray-700 hover:text-primary-600 transition-colors duration-300 relative py-2;
    }
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #00A79D;
        transition: width 0.3s ease-in-out;
    }
    .nav-link:hover::after,
    .nav-link.active::after {
        width: 100%;
    }
    .nav-link.active {
        @apply text-primary-600 font-semibold;
    }
    .dropdown-item {
        @apply block w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200;
    }
    .active-dropdown-item {
        @apply bg-primary-50 text-primary-600 font-semibold;
    }
    .mobile-nav-link {
        @apply block px-4 py-3 text-base font-medium rounded-lg text-gray-800 hover:text-primary-600 hover:bg-primary-50 transition-all duration-300;
    }
    .active-mobile {
        @apply text-primary-600 font-bold bg-primary-100;
    }
    .btn-primary {
        @apply bg-primary-500 text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-primary-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center;
    }
    .btn-primary-outline {
        @apply bg-white border-2 border-primary-500 text-primary-500 px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-primary-500 hover:text-white transition-all duration-300 flex items-center justify-center;
    }
    .btn-secondary {
        @apply bg-transparent text-gray-800 px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-gray-100 transition-all duration-300;
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
                mobileMenu.classList.toggle('active');
            });
        }
        
        // About dropdown toggle
        const aboutButton = document.getElementById('about-dropdown-button');
        const aboutDropdown = document.getElementById('about-dropdown');
        const aboutContainer = document.getElementById('about-dropdown-container');
        const dropdownIcon = aboutButton.querySelector('svg');
        
        if (aboutButton && aboutDropdown && aboutContainer) {
            aboutButton.addEventListener('click', function(event) {
                event.stopPropagation();
                const isHidden = aboutDropdown.classList.contains('hidden');
                if (isHidden) {
                    aboutDropdown.classList.remove('hidden');
                    setTimeout(() => {
                        aboutDropdown.classList.remove('opacity-0', '-translate-y-2');
                        dropdownIcon.style.transform = 'rotate(180deg)';
                    }, 10);
                } else {
                    aboutDropdown.classList.add('opacity-0', '-translate-y-2');
                    dropdownIcon.style.transform = 'rotate(0deg)';
                    setTimeout(() => {
                        aboutDropdown.classList.add('hidden');
                    }, 300);
                }
            });
            
            document.addEventListener('click', function(event) {
                if (!aboutContainer.contains(event.target) && !aboutDropdown.classList.contains('hidden')) {
                    aboutDropdown.classList.add('opacity-0', '-translate-y-2');
                    dropdownIcon.style.transform = 'rotate(0deg)';
                    setTimeout(() => {
                        aboutDropdown.classList.add('hidden');
                    }, 300);
                }
            });
        }

        // Add shadow on scroll
        const header = document.querySelector('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                header.classList.add('shadow-xl');
            } else {
                header.classList.remove('shadow-xl');
            }
        });
    });
</script>
