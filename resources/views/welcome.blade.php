<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Raudhah Muamalat - Islamic Financial Solutions</title>

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
                        <div class="text-2xl font-bold text-primary-500">
                            Raudhah Muamalat
                        </div>
                    </div>

                    <!-- Navigation -->
                    <nav class="hidden md:flex space-x-8">
                        <a href="#home" class="text-gray-700 hover:text-primary-500 transition-colors">Home</a>
                        <a href="{{ url('/about') }}" class="text-gray-700 hover:text-primary-500 transition-colors">About</a>
                        <a href="{{ url('/partners') }}" class="text-gray-700 hover:text-primary-500 transition-colors">Partners</a>
                        <a href="{{ url('/campaigns') }}" class="text-gray-700 hover:text-primary-500 transition-colors">Campaigns</a>
                        <a href="#contact" class="text-gray-700 hover:text-primary-500 transition-colors">Contact</a>
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
        <section id="home" class="bg-gradient-to-br from-primary-50 to-white py-12 md:py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <!-- Hero Content -->
                    <div class="space-y-6 md:space-y-8 text-center lg:text-left">
                        <div class="space-y-3 md:space-y-4">
                            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight">
                                Empowering Communities Through
                                <span class="text-primary-500">Islamic Crowdfunding</span>
                            </h1>
                            <p class="text-base md:text-lg lg:text-xl text-gray-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                                Join thousands of donors supporting verified campaigns that make a real difference.
                                Every contribution helps build stronger communities through Shariah-compliant giving.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center lg:justify-start">
                            <a href="#campaigns" class="bg-primary-500 text-white px-6 py-3 md:px-8 md:py-4 rounded-lg font-semibold hover:bg-primary-600 transition-all duration-300 text-center transform hover:scale-105 shadow-lg hover:shadow-xl">
                                Donate Now
                            </a>
                            <a href="#about" class="border-2 border-primary-500 text-primary-500 px-6 py-3 md:px-8 md:py-4 rounded-lg font-semibold hover:bg-primary-50 transition-all duration-300 text-center transform hover:scale-105">
                                Start Campaign
                            </a>
                        </div>

                        <!-- Impact Stats -->
                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-6 lg:space-x-8 pt-4 md:pt-8">
                            <div class="text-center">
                                <div class="text-xl md:text-2xl font-bold text-primary-600">RM 2.5M+</div>
                                <div class="text-xs md:text-sm text-gray-600">Total Raised</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl md:text-2xl font-bold text-primary-600">15K+</div>
                                <div class="text-xs md:text-sm text-gray-600">Lives Impacted</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl md:text-2xl font-bold text-primary-600">500+</div>
                                <div class="text-xs md:text-sm text-gray-600">Active Campaigns</div>
                            </div>
                        </div>

                        <!-- Quranic Verse -->
                        <div class="bg-primary-50 rounded-lg p-4 md:p-6 border-l-4 border-primary-500">
                            <p class="text-sm md:text-base text-gray-700 italic leading-relaxed">
                                "The example of those who spend their wealth in the way of Allah is like a seed of grain that grows seven ears; in each ear there are a hundred grains."
                            </p>
                            <p class="text-xs md:text-sm text-primary-600 font-medium mt-2">— Quran 2:261</p>
                        </div>
                    </div>

                    <!-- Hero Image -->
                    <div class="relative">
                        <div class="bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl p-8 shadow-xl">
                            <div class="bg-white rounded-xl p-6 shadow-lg">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-semibold text-gray-900">Islamic Banking</h3>
                                        <div class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Savings Account</span>
                                            <span class="font-medium">RM 25,000</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Investment</span>
                                            <span class="font-medium text-green-600">+12.5%</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Financing</span>
                                            <span class="font-medium">Available</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Campaigns Section -->
        <section id="campaigns" class="py-12 md:py-16 lg:py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                        Featured <span class="text-primary-500">Campaigns</span>
                    </h2>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto">
                        Support verified campaigns that are making a real difference in communities worldwide. Every donation is tracked and transparent.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    <!-- Campaign 1 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                             alt="Emergency Food Relief" class="w-full h-40 md:h-48 object-cover">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center mb-3">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&q=80"
                                     alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                                <span class="text-xs md:text-sm text-gray-600">Yayasan Muslimin</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Emergency Food Relief for Gaza Families</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                                Provide essential food packages to families facing severe food shortages.
                            </p>

                            <!-- Progress Bar -->
                            <div class="mb-3 md:mb-4">
                                <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                    <span>RM 45,230 raised</span>
                                    <span>73% of RM 62,000</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full transition-all duration-500" style="width: 73%"></div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-xs md:text-sm text-gray-500">234 donors</span>
                                <a href="#" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                    Donate Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign 2 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                             alt="Education Support" class="w-full h-40 md:h-48 object-cover">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center mb-3">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&q=80"
                                     alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                                <span class="text-xs md:text-sm text-gray-600">Education Foundation</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Build Islamic School in Rural Area</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                                Constructing a new Islamic school to provide quality education for rural children.
                            </p>

                            <!-- Progress Bar -->
                            <div class="mb-3 md:mb-4">
                                <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                    <span>RM 180,500 raised</span>
                                    <span>60% of RM 300,000</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full transition-all duration-500" style="width: 60%"></div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-xs md:text-sm text-gray-500">156 donors</span>
                                <a href="#" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                    Donate Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign 3 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                             alt="Healthcare Support" class="w-full h-40 md:h-48 object-cover">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center mb-3">
                                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&q=80"
                                     alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                                <span class="text-xs md:text-sm text-gray-600">Health Care Malaysia</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Mobile Health Clinic for Remote Villages</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                                Bringing essential healthcare services to underserved remote communities.
                            </p>

                            <!-- Progress Bar -->
                            <div class="mb-3 md:mb-4">
                                <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                    <span>RM 85,200 raised</span>
                                    <span>85% of RM 100,000</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full transition-all duration-500" style="width: 85%"></div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-xs md:text-sm text-gray-500">312 donors</span>
                                <a href="#" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                    Donate Now
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- View All Campaigns Button -->
                <div class="text-center mt-8 md:mt-12">
                    <a href="{{ url('/campaigns') }}" class="inline-flex items-center px-6 py-3 md:px-8 md:py-4 bg-white border-2 border-primary-500 text-primary-500 font-semibold rounded-lg hover:bg-primary-500 hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        View All Campaigns
                        <svg class="w-4 h-4 md:w-5 md:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Our Impact Section -->
        <section class="py-12 md:py-16 lg:py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                        Our <span class="text-primary-500">Impact</span>
                    </h2>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto">
                        Together, we're creating meaningful change in communities worldwide through the power of Islamic crowdfunding.
                    </p>
                </div>

                <!-- Impact Stats Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 mb-12 md:mb-16">
                    <div class="text-center">
                        <div class="bg-white rounded-xl p-4 md:p-6 shadow-lg border border-gray-100">
                            <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-primary-600 mb-2">RM 2.5M+</div>
                            <div class="text-sm md:text-base text-gray-600">Total Raised</div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-white rounded-xl p-4 md:p-6 shadow-lg border border-gray-100">
                            <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-primary-600 mb-2">15,000+</div>
                            <div class="text-sm md:text-base text-gray-600">Lives Impacted</div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-white rounded-xl p-4 md:p-6 shadow-lg border border-gray-100">
                            <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-primary-600 mb-2">500+</div>
                            <div class="text-sm md:text-base text-gray-600">Active Campaigns</div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="bg-white rounded-xl p-4 md:p-6 shadow-lg border border-gray-100">
                            <div class="text-2xl md:text-3xl lg:text-4xl font-bold text-primary-600 mb-2">8,500+</div>
                            <div class="text-sm md:text-base text-gray-600">Generous Donors</div>
                        </div>
                    </div>
                </div>

                <!-- Focus Areas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                    <div class="bg-white rounded-xl p-6 md:p-8 shadow-lg border border-gray-100 text-center">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                            <svg class="w-6 h-6 md:w-8 md:h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 md:mb-4">Education</h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                            Supporting quality Islamic education and building schools in underserved communities.
                        </p>
                    </div>

                    <div class="bg-white rounded-xl p-6 md:p-8 shadow-lg border border-gray-100 text-center">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                            <svg class="w-6 h-6 md:w-8 md:h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 md:mb-4">Healthcare</h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                            Providing essential medical care and health services to those who need it most.
                        </p>
                    </div>

                    <div class="bg-white rounded-xl p-6 md:p-8 shadow-lg border border-gray-100 text-center">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6">
                            <svg class="w-6 h-6 md:w-8 md:h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 md:mb-4">Community</h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                            Empowering communities through social programs and sustainable development initiatives.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-12 md:py-16 lg:py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- About Content -->
                    <div class="space-y-6">
                        <div class="space-y-4">
                            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">
                                About <span class="text-primary-500">Jariah Fund</span>
                            </h2>
                            <p class="text-base md:text-lg text-gray-600 leading-relaxed">
                                Jariah Fund is Malaysia's leading Islamic crowdfunding platform, empowering communities
                                through Shariah-compliant giving and transparent charitable initiatives.
                            </p>
                            <p class="text-base md:text-lg text-gray-600 leading-relaxed">
                                Backed by Bank Muamalat Malaysia, we provide a trusted platform where donors can
                                support verified campaigns that create lasting positive impact in education, healthcare,
                                and community development.
                            </p>
                        </div>

                        <!-- Key Features -->
                        <div class="space-y-4">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900">Why Choose Jariah Fund?</h3>
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-primary-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm md:text-base font-medium text-gray-900">100% Transparent & Verified</h4>
                                        <p class="text-xs md:text-sm text-gray-600">All campaigns are thoroughly vetted and progress is tracked in real-time</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-primary-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm md:text-base font-medium text-gray-900">Shariah-Compliant Giving</h4>
                                        <p class="text-xs md:text-sm text-gray-600">All donations follow Islamic principles and guidelines</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-primary-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm md:text-base font-medium text-gray-900">Trusted by Bank Muamalat</h4>
                                        <p class="text-xs md:text-sm text-gray-600">Backed by Malaysia's leading Islamic banking institution</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <div class="pt-4">
                            <a href="{{ url('/about') }}" class="inline-flex items-center px-6 py-3 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-sm md:text-base">
                                Learn More About Us
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Mission Card -->
                    <div class="relative">
                        <div class="bg-primary-500 rounded-2xl p-6 md:p-8 text-white">
                            <div class="space-y-4 md:space-y-6">
                                <h3 class="text-xl md:text-2xl font-bold">Our Mission</h3>
                                <p class="text-primary-100 leading-relaxed text-sm md:text-base">
                                    To create a transparent, trusted platform that connects generous hearts with
                                    meaningful causes, enabling communities to support each other through
                                    Shariah-compliant crowdfunding.
                                </p>
                                <div class="grid grid-cols-2 gap-3 md:gap-4 pt-2 md:pt-4">
                                    <div class="text-center">
                                        <div class="text-2xl md:text-3xl font-bold">RM 2.5M+</div>
                                        <div class="text-primary-200 text-xs md:text-sm">Total Raised</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl md:text-3xl font-bold">15K+</div>
                                        <div class="text-primary-200 text-xs md:text-sm">Lives Impacted</div>
                                    </div>
                                </div>

                                <!-- Islamic Quote -->
                                <div class="bg-primary-600 rounded-lg p-3 md:p-4 border-l-4 border-white">
                                    <p class="text-xs md:text-sm text-primary-100 italic leading-relaxed">
                                        "Whoever relieves a believer's distress of the distressful aspects of this world,
                                        Allah will rescue him from a difficulty of the difficulties of the Hereafter."
                                    </p>
                                    <p class="text-xs text-primary-200 font-medium mt-2">— Prophet Muhammad (PBUH)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Get in Touch
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Ready to start your Islamic financial journey? Contact us today for personalized consultation
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Information -->
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-6">Contact Information</h3>
                            <div class="space-y-6">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Address</h4>
                                        <p class="text-gray-600">123 Islamic Finance Street<br>Kuala Lumpur, Malaysia 50450</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Phone</h4>
                                        <p class="text-gray-600">+60 3-1234 5678<br>+60 3-1234 5679</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Email</h4>
                                        <p class="text-gray-600">info@raudhahmuamalat.com<br>support@raudhahmuamalat.com</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">Business Hours</h4>
                                        <p class="text-gray-600">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 1:00 PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-gray-50 rounded-xl p-8">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Send us a Message</h3>
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first-name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" id="first-name" name="first-name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="last-name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" id="last-name" name="last-name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label for="service" class="block text-sm font-medium text-gray-700 mb-2">Service Interest</label>
                                <select id="service" name="service" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    <option value="">Select a service</option>
                                    <option value="banking">Islamic Banking</option>
                                    <option value="takaful">Takaful Insurance</option>
                                    <option value="investment">Investment Solutions</option>
                                    <option value="financing">Islamic Financing</option>
                                    <option value="wealth">Wealth Management</option>
                                    <option value="business">Business Solutions</option>
                                </select>
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-primary-500 text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="space-y-4">
                        <div class="text-2xl font-bold text-primary-500">
                            Raudhah Muamalat
                        </div>
                        <p class="text-gray-300 leading-relaxed">
                            Your trusted partner for Shariah-compliant financial solutions.
                            Building wealth while maintaining Islamic values.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-8 h-8 bg-primary-500 text-white rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-8 h-8 bg-primary-500 text-white rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-8 h-8 bg-primary-500 text-white rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Services -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Services</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Islamic Banking</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Takaful Insurance</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Investment Solutions</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Islamic Financing</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Wealth Management</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Business Solutions</a></li>
                        </ul>
                    </div>

                    <!-- Quick Links -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Quick Links</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="{{ url('/about') }}" class="hover:text-primary-500 transition-colors">About Us</a></li>
                            <li><a href="{{ url('/partners') }}" class="hover:text-primary-500 transition-colors">Partners</a></li>
                            <li><a href="{{ url('/campaigns') }}" class="hover:text-primary-500 transition-colors">Campaigns</a></li>
                            <li><a href="#contact" class="hover:text-primary-500 transition-colors">Contact</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Terms of Service</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Contact Info</h3>
                        <div class="space-y-3 text-gray-300">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>123 Islamic Finance Street<br>Kuala Lumpur, Malaysia 50450</span>
                            </div>
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
                                <span>info@raudhahmuamalat.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-gray-800 mt-12 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-gray-400 text-sm">
                            © {{ date('Y') }} Raudhah Muamalat. All rights reserved.
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