<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tentang Kami - Jariah Fund Raudhah Muamalat</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Fallback styles */
                body { font-family: 'Instrument Sans', sans-serif; }
            </style>
        @endif
    </head>
    <body class="bg-white text-gray-900 font-sans">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-2xl font-bold text-primary-500">
                            Jariah Fund
                        </a>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="hidden md:flex space-x-8">
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-primary-500 transition-colors">Home</a>
                        <a href="{{ url('/about') }}" class="text-primary-500 font-medium">About</a>
                        <a href="{{ url('/partners') }}" class="text-gray-700 hover:text-primary-500 transition-colors">Partners</a>
                        <a href="{{ url('/campaigns') }}" class="text-gray-700 hover:text-primary-500 transition-colors">Campaigns</a>
                        <a href="{{ url('/') }}#contact" class="text-gray-700 hover:text-primary-500 transition-colors">Contact</a>
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
                        <button type="button" class="text-gray-700 hover:text-primary-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="py-20 bg-gradient-to-br from-primary-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-6">
                        <svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">About Us</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Empowering Communities
                        <span class="text-primary-500 relative block">
                            Through Trusted Giving
                            <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-64 h-3 text-primary-200" viewBox="0 0 100 12" fill="currentColor">
                                <path d="M0 8c30-4 70-4 100 0v4H0z"/>
                            </svg>
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed mb-8">
                        <strong>Jariah Fund</strong> is Malaysia's trusted Islamic crowdfunding platform that makes it easy
                        to support those in need through <span class="text-primary-600 font-medium">education</span>,
                        <span class="text-primary-600 font-medium">healthcare</span>, and
                        <span class="text-primary-600 font-medium">economic assistance</span> programs.
                    </p>
                    <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-600">
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            100% Secure
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Tax Deductible
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Transparent & Trusted
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Grid -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Mission Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start mb-16">
                    <!-- Left Content -->
                    <div class="space-y-8">
                        <!-- Header -->
                        <div>
                            <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-4">
                                <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">About us</span>
                            </div>
                        </div>

                        <!-- Our Objective -->
                        <div class="space-y-6">
                            <h3 class="text-2xl font-bold text-gray-900">Our Objective</h3>
                            <p class="text-gray-600 leading-relaxed">
                                We are committed to helping the less fortunate in our community and
                                contributing to the welfare of Malaysian society through Islamic principles
                                and values-based banking services.
                            </p>
                        </div>

                        <!-- Non-Profit Platform -->
                        <div class="space-y-6">
                            <h3 class="text-2xl font-bold text-gray-900">Non-Profit Platform</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Jariah Fund is a 100% non-profit platform that prioritizes Value Based
                                Intermediaries (VBI) in Islamic banking services, ensuring all donations
                                reach those who need them most.
                            </p>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="flex justify-center lg:justify-end">
                        <div class="rounded-2xl overflow-hidden shadow-xl max-w-md">
                            <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="Community support and charity work"
                                 class="w-full h-96 object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bank Muamalat Section -->
        <section class="py-12 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start lg:items-center">
                    <!-- Left Cards -->
                    <div class="space-y-6 lg:space-y-8">
                        <!-- Better Lives Together Card -->
                        <div class="bg-gradient-to-br from-primary-500 to-primary-600 rounded-2xl lg:rounded-3xl p-6 md:p-8 shadow-xl text-white relative overflow-hidden transform hover:scale-105 transition-transform duration-300">
                            <!-- Islamic Arch Pattern -->
                            <div class="text-center">
                                <div class="flex justify-center mb-4 md:mb-6">
                                    <svg class="w-24 h-16 md:w-32 md:h-20 text-white" viewBox="0 0 200 100" fill="none">
                                        <!-- Multiple Islamic arches -->
                                        <path d="M20 80 Q20 40 40 40 Q60 40 60 80" stroke="currentColor" stroke-width="2.5" fill="none"/>
                                        <path d="M40 80 Q40 40 60 40 Q80 40 80 80" stroke="currentColor" stroke-width="2.5" fill="none"/>
                                        <path d="M60 80 Q60 40 80 40 Q100 40 100 80" stroke="currentColor" stroke-width="2.5" fill="none"/>
                                        <path d="M80 80 Q80 40 100 40 Q120 40 120 80" stroke="currentColor" stroke-width="2.5" fill="none"/>
                                        <path d="M100 80 Q100 40 120 40 Q140 40 140 80" stroke="currentColor" stroke-width="2.5" fill="none"/>
                                        <path d="M120 80 Q120 40 140 40 Q160 40 160 80" stroke="currentColor" stroke-width="2.5" fill="none"/>
                                        <path d="M140 80 Q140 40 160 40 Q180 40 180 80" stroke="currentColor" stroke-width="2.5" fill="none"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl md:text-3xl font-bold mb-3 md:mb-4">Better lives, together</h3>
                                <div class="space-y-1">
                                    <p class="text-base md:text-lg text-white/90 font-medium">#IslamicBankingForAll</p>
                                    <p class="text-base md:text-lg text-white/90 font-medium">#HereToHelp</p>
                                </div>
                            </div>
                        </div>

                        <!-- Bank Muamalat Quote Card -->
                        <div class="bg-gradient-to-br from-gray-800 via-gray-900 to-purple-900 rounded-2xl lg:rounded-3xl p-6 md:p-8 shadow-xl text-white relative overflow-hidden transform hover:scale-105 transition-transform duration-300">
                            <!-- Simplified Background Pattern for Mobile -->
                            <div class="absolute inset-0 opacity-5 md:opacity-10">
                                <div class="absolute top-4 left-4 w-12 h-12 md:w-16 md:h-16 border border-white/20 rounded-lg"></div>
                                <div class="absolute top-6 right-6 w-8 h-8 md:w-12 md:h-12 border border-white/20 rounded-full"></div>
                                <div class="absolute bottom-6 left-6 w-6 h-6 md:w-8 md:h-8 border border-white/20 rounded"></div>
                                <div class="absolute bottom-4 right-4 w-16 h-16 md:w-20 md:h-20 border border-white/20 rounded-xl"></div>
                            </div>

                            <!-- Logo/Icon -->
                            <div class="relative mb-6 md:mb-8">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 md:w-12 md:h-12 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <span class="text-lg md:text-xl font-bold">Bank Muamalat</span>
                                </div>
                            </div>

                            <!-- Quote -->
                            <div class="relative">
                                <blockquote class="text-base md:text-lg leading-relaxed mb-6">
                                    "As a trusted and authoritative Islamic banking institution, Bank Muamalat Malaysia Berhad has realized an extraordinary initiative to support beneficiaries through Jariah Fund."
                                </blockquote>

                                <!-- Attribution -->
                                <div class="flex items-center">
                                    <div class="w-10 h-10 md:w-12 md:h-12 bg-white/20 rounded-full flex items-center justify-center mr-3 md:mr-4 flex-shrink-0">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-sm md:text-base">Bank Muamalat Malaysia</div>
                                        <div class="text-xs md:text-sm text-white/80">Islamic Banking Institution</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content -->
                    <div class="space-y-6 lg:space-y-8">
                        <!-- Header -->
                        <div>
                            <div class="inline-flex items-center px-3 py-2 md:px-4 md:py-2 bg-primary-100 rounded-full mb-3 md:mb-4">
                                <span class="text-primary-600 font-semibold text-xs md:text-sm tracking-wide uppercase">Trusted Banking Partner</span>
                            </div>
                            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                                Backed by Bank Muamalat Malaysia
                            </h2>
                        </div>

                        <!-- Content Paragraphs -->
                        <div class="space-y-4 md:space-y-6 text-gray-600 leading-relaxed">
                            <p class="text-sm md:text-base">
                                Bank Muamalat began operations on <strong>October 1, 1999</strong> as a merger of Islamic banking assets
                                from Bank Bumiputra Malaysia Berhad, Bank of Commerce (M) Berhad and BBMB Kewangan.
                                Our objective is to help the less fortunate in the community and contribute to Malaysian society.
                            </p>

                            <p class="text-sm md:text-base">
                                Bank Muamalat Malaysia Berhad is the <strong>second bank</strong> to offer Islamic banking under the
                                "Islamic Banking Act 1983" in Malaysia, after Bank Islam Malaysia Berhad. We are committed to
                                providing Islamic banking services to all Malaysians regardless of race or religion.
                            </p>

                            <p class="text-sm md:text-base">
                                Jariah Fund is a <strong>100% non-profit platform</strong> that prioritizes Value Based Intermediaries (VBI)
                                in Islamic banking services. <strong>DRB-HICOM</strong> holds 70% shares in Bank Muamalat while
                                <strong>Khazanah Nasional Berhad</strong> holds the remainder - backed by Malaysia's leading corporations.
                            </p>
                        </div>

                        <!-- Key Features -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4 mt-6 md:mt-8">
                            <div class="bg-white rounded-lg p-3 md:p-4 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm md:text-base">Shariah Compliant</h4>
                                        <p class="text-xs md:text-sm text-gray-600">100% Islamic banking</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg p-3 md:p-4 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm md:text-base">Non-Profit</h4>
                                        <p class="text-xs md:text-sm text-gray-600">100% for charity</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Payment Network Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center px-4 py-2 bg-green-50 rounded-full mb-4">
                        <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span class="text-green-600 font-semibold text-sm tracking-wide uppercase">Secure Payments</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        <span class="text-primary-500">Easy & Secure</span> Ways to Donate
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        We support Malaysia's most trusted payment systems to make your donations simple and secure
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-12">
                    <!-- FPX -->
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-all duration-300 group">
                        <div class="text-center">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-105 transition-transform">
                                <span class="text-white font-bold text-2xl">FPX</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">💳 FPX Online Banking</h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Online payment system that connects directly to your bank account.
                                <strong>Safe, fast and easy!</strong>
                            </p>
                            <div class="space-y-2 text-sm text-gray-500">
                                <div class="flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                    </svg>
                                    All major Malaysian banks
                                </div>
                                <div class="flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                    </svg>
                                    No additional charges
                                </div>
                                <div class="flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                    </svg>
                                    Instant processing
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DuitNow -->
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-all duration-300 group">
                        <div class="text-center">
                            <div class="w-24 h-24 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-105 transition-transform">
                                <span class="text-white font-bold text-lg">DuitNow</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">⚡ DuitNow Transfer</h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Bank Negara Malaysia's real-time money transfer system.
                                <strong>Available 24/7, instant transfers!</strong>
                            </p>
                            <div class="space-y-2 text-sm text-gray-500">
                                <div class="flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                    </svg>
                                    Real-time transfers 24/7
                                </div>
                                <div class="flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                    </svg>
                                    Use ID or Phone Number
                                </div>
                                <div class="flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                    </svg>
                                    Backed by Bank Negara
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-8 shadow-lg border border-gray-100 max-w-3xl mx-auto">
                        <div class="flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h4 class="text-xl font-semibold text-gray-900">🔒 Security Guaranteed</h4>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Both payment systems are regulated by <strong>Bank Negara Malaysia</strong>
                            and use the latest encryption technology to protect your personal information.
                            Your donations are processed through secure, bank-grade infrastructure.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-20 bg-gradient-to-br from-primary-500 to-primary-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white">
                    Ready to Make a Difference?
                </h2>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="space-y-4">
                        <div class="text-2xl font-bold text-primary-500">
                            Jariah Fund
                        </div>
                        <p class="text-gray-300 leading-relaxed">
                            A trusted crowdfunding platform to help the underprivileged.
                            Contributing to society with Islamic values.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Quick Links</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="{{ url('/') }}" class="hover:text-primary-500 transition-colors">Home</a></li>
                            <li><a href="{{ url('/about') }}" class="hover:text-primary-500 transition-colors">About Us</a></li>
                            <li><a href="{{ url('/partners') }}" class="hover:text-primary-500 transition-colors">Partners</a></li>
                            <li><a href="{{ url('/campaigns') }}" class="hover:text-primary-500 transition-colors">Campaigns</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
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

        <!-- Smooth Scrolling Script -->
        <script>
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
        </script>
    </body>
</html>
