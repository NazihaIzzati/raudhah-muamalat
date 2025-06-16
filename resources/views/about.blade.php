@extends('layouts.master')

@section('title', 'About Us - Jariah Fund Raudhah Muamalat')
@section('description', 'Learn about Jariah Fund, Malaysia\'s trusted Islamic crowdfunding platform that empowers communities through education, healthcare, and economic assistance programs.')

@section('content')

        @include('components.hero-section', [
            'badge' => [
                'text' => 'About Us',
                'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            ],
            'title' => 'Building A Better World',
            'subtitle' => 'Through Islamic Crowdfunding',
            'description' => '<strong>Jariah Fund</strong> is Malaysia\'s premier Shariah-compliant crowdfunding platform that channels your donations to create lasting impact through',
            'highlights' => [
                ['text' => 'social welfare programs', 'delay' => '0.6s'],
                ['text' => 'educational initiatives', 'delay' => '0.8s'],
                ['text' => 'humanitarian relief', 'delay' => '1.0s']
            ],
            'cta_buttons' => [
                ['text' => 'Support Our Causes', 'url' => url('/campaigns'), 'type' => 'primary'],
                ['text' => 'Learn How It Works', 'url' => url('/how-it-works'), 'type' => 'secondary']
            ],
            'pills' => [
                ['text' => '100% Shariah-Compliant', 'delay' => '0.7s'],
                ['text' => 'No Administrative Fees', 'delay' => '0.8s'],
                ['text' => 'Full Transparency', 'delay' => '0.9s']
            ]
        ])

        <!-- Main Content Grid with Animations -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Mission Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start mb-16">
                    <!-- Left Content -->
                    <div class="space-y-8 animate-on-scroll" data-animation="slide-in-left">
                        <!-- Header -->
                        <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
                            <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-4 hover:bg-primary-200 transition-colors duration-300">
                                <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">Our Mission</span>
                            </div>
                        </div>

                        <!-- Our Vision -->
                        <div class="space-y-6 animate-fade-in-up" style="animation-delay: 0.2s;">
                            <h3 class="text-2xl font-bold text-gray-900 hover:text-primary-600 transition-colors duration-300">Our Vision</h3>
                            <p class="text-gray-600 leading-relaxed transform hover:scale-105 transition-transform duration-300 hover:text-gray-700">
                                To be the leading Islamic crowdfunding platform in Malaysia that bridges compassionate 
                                donors with meaningful causes, creating sustainable positive change through the principles 
                                of Shariah and ethical financial practices.
                            </p>
                        </div>

                        <!-- Our Values -->
                        <div class="space-y-6 animate-fade-in-up" style="animation-delay: 0.3s;">
                            <h3 class="text-2xl font-bold text-gray-900 hover:text-primary-600 transition-colors duration-300">Our Values</h3>
                            <p class="text-gray-600 leading-relaxed transform hover:scale-105 transition-transform duration-300 hover:text-gray-700">
                                Jariah Fund operates on the Islamic principles of <span class="font-semibold">sadaqah</span> (voluntary giving) and 
                                <span class="font-semibold">amanah</span> (trust), ensuring that every ringgit donated is 
                                managed with absolute integrity and directed to those most in need without administrative deductions.
                            </p>
                        </div>
                    </div>

                    <!-- Right Image -->
                    <div class="flex justify-center lg:justify-end animate-on-scroll" data-animation="slide-in-right">
                        <div class="rounded-2xl overflow-hidden shadow-xl max-w-md bg-white p-8 hover:shadow-2xl hover:scale-105 transition-all duration-500 animate-float-gentle">
                            <img src="{{ asset('images/logos/jariahfund_logo.png') }}"
                                 alt="Jariah Fund Logo"
                                 class="w-full h-96 object-contain hover:scale-110 transition-transform duration-500">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bank Muamalat Section with Animations -->
        <section class="py-12 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start lg:items-center">
                    <!-- Left Image -->
                    <div class="flex justify-center lg:justify-start animate-on-scroll" data-animation="slide-in-left">
                        <img src="{{ asset('images/logos/betterlives.png') }}"
                             alt="Better Lives Together"
                             class="max-w-full h-auto object-contain hover:scale-105 transition-transform duration-500 animate-float-gentle">
                    </div>

                    <!-- Right Content -->
                    <div class="space-y-6 lg:space-y-8 animate-on-scroll" data-animation="slide-in-right">
                        <!-- Header -->
                        <div class="animate-fade-in-up" style="animation-delay: 0.1s;">
                            <div class="inline-flex items-center px-3 py-2 md:px-4 md:py-2 bg-primary-100 rounded-full mb-3 md:mb-4 hover:bg-primary-200 transition-colors duration-300 animate-pulse-gentle">
                                <span class="text-primary-600 font-semibold text-xs md:text-sm tracking-wide uppercase">Islamic Banking Partner</span>
                            </div>
                            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4 hover:text-primary-600 transition-colors duration-300">
                                Bank Muamalat Malaysia – Powering Ethical Finance
                            </h2>
                        </div>

                        <!-- Content Paragraphs -->
                        <div class="space-y-4 md:space-y-6 text-gray-600 leading-relaxed">
                            <p class="text-sm md:text-base">
                                Since <strong>October 1, 1999</strong>, Bank Muamalat has been at the forefront of Islamic finance in Malaysia, 
                                upholding the principles of <span class="italic">Shariah</span> while delivering modern financial solutions. As Jariah Fund's banking partner,
                                they ensure every donation is handled with the highest ethical standards.
                            </p>

                            <p class="text-sm md:text-base">
                                As the <strong>second full-fledged Islamic bank</strong> established under the Islamic Banking Act 1983,
                                Bank Muamalat provides the trusted infrastructure that enables Jariah Fund to operate with complete transparency
                                and accountability, ensuring your contributions create maximum impact.
                            </p>

                            <p class="text-sm md:text-base">
                                Our partnership ensures that <strong>100% of every donation</strong> goes directly to the causes you care about.
                                Together, we're pioneering a new approach to charitable giving that combines Islamic values with
                                modern technology to make giving easy, impactful, and rewarding.
                            </p>
                        </div>

                        <!-- Islamic Banking Principles -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4 mt-6 md:mt-8">
                            <div class="bg-white rounded-lg p-3 md:p-4 shadow-md border border-gray-100 hover:shadow-xl hover:scale-105 hover:border-primary-200 transition-all duration-300 cursor-pointer">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm md:text-base">Riba-Free</h4>
                                        <p class="text-xs md:text-sm text-gray-600">Interest-free transactions</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg p-3 md:p-4 shadow-md border border-gray-100 hover:shadow-xl hover:scale-105 hover:border-primary-200 transition-all duration-300 cursor-pointer">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm md:text-base">Amanah</h4>
                                        <p class="text-xs md:text-sm text-gray-600">Trustworthy management</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg p-3 md:p-4 shadow-md border border-gray-100 hover:shadow-xl hover:scale-105 hover:border-primary-200 transition-all duration-300 cursor-pointer">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm md:text-base">Zakat Integration</h4>
                                        <p class="text-xs md:text-sm text-gray-600">Tax-efficient giving</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg p-3 md:p-4 shadow-md border border-gray-100 hover:shadow-xl hover:scale-105 hover:border-primary-200 transition-all duration-300 cursor-pointer">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 md:w-5 md:h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm md:text-base">Shariah Board</h4>
                                        <p class="text-xs md:text-sm text-gray-600">Expert religious oversight</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Payment Network Section with Animations -->
        <section class="py-16 bg-gradient-to-br from-gray-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 animate-on-scroll" data-animation="fade-in-up">
                    <div class="inline-flex items-center px-6 py-3 bg-primary-50 rounded-full mb-6 shadow-sm hover:shadow-md hover:scale-105 transition-all duration-300 animate-bounce-in">
                        <svg class="w-5 h-5 text-primary-600 mr-3 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">Donate with Confidence</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 animate-fade-in-up" style="animation-delay: 0.2s;">
                        <span class="text-primary-500 animate-highlight">Simple & Secure</span> Donation Methods
                    </h2>
                    <p class="text-lg md:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed animate-fade-in-up" style="animation-delay: 0.3s;">
                        Choose from Malaysia's most trusted and convenient payment options.
                        Your generosity is just a few clicks away with bank-grade security.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 max-w-6xl mx-auto mb-16">
                    <!-- FPX -->
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl hover:scale-105 hover:border-primary-200 transition-all duration-300 cursor-pointer animate-on-scroll animate-float-gentle" data-animation="slide-in-left">
                        <!-- Image Section -->
                        <div class="h-48 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center p-8 hover:from-blue-100 hover:to-blue-200 transition-all duration-300">
                            <img src="{{ asset('images/payment/fpxlogo.png') }}"
                                 alt="FPX Online Banking"
                                 class="max-w-full max-h-full object-contain hover:scale-110 transition-transform duration-300">
                        </div>

                        <!-- Content Section -->
                        <div class="p-8">
                            <div class="flex items-center mb-4">
                                <span class="text-2xl mr-2">🏦</span>
                                <h3 class="text-2xl font-bold text-gray-900">FPX Online Banking</h3>
                            </div>

                            <p class="text-gray-600 leading-relaxed mb-6 text-base">
                                Connect directly to your bank account for instant donations.
                                <span class="text-blue-600 font-semibold">Quick, secure, and hassle-free!</span>
                            </p>

                            <!-- Features List -->
                            <div class="space-y-3 mb-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">Works with Your Bank</h4>
                                        <p class="text-xs text-gray-600">All major Malaysian banks supported</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">No Extra Fees</h4>
                                        <p class="text-xs text-gray-600">100% of your donation reaches the cause</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">Instant Confirmation</h4>
                                        <p class="text-xs text-gray-600">Get immediate receipt and confirmation</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Call to Action -->
                            <div class="p-3 bg-blue-50 rounded-lg text-center">
                                <p class="text-sm text-blue-700 font-medium">
                                    🚀 Most popular choice among donors
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- DuitNow -->
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl hover:scale-105 hover:border-primary-200 transition-all duration-300 cursor-pointer animate-on-scroll animate-float-gentle" data-animation="slide-in-right" style="animation-delay: 0.2s;">
                        <!-- Image Section -->
                        <div class="h-48 bg-gradient-to-br from-pink-50 to-pink-100 flex items-center justify-center p-8 hover:from-pink-100 hover:to-pink-200 transition-all duration-300">
                            <img src="{{ asset('images/payment/duitnowlogo.png') }}"
                                 alt="DuitNow Transfer"
                                 class="max-w-full max-h-full object-contain hover:scale-110 transition-transform duration-300">
                        </div>

                        <!-- Content Section -->
                        <div class="p-8">
                            <div class="flex items-center mb-4">
                                <span class="text-2xl mr-2">⚡</span>
                                <h3 class="text-2xl font-bold text-gray-900">DuitNow Transfer</h3>
                            </div>

                            <p class="text-gray-600 leading-relaxed mb-6 text-base">
                                Malaysia's instant transfer system by Bank Negara.
                                <span class="text-pink-600 font-semibold">Available 24/7 for immediate impact!</span>
                            </p>

                            <!-- Features List -->
                            <div class="space-y-3 mb-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">Lightning Fast</h4>
                                        <p class="text-xs text-gray-600">Real-time transfers 24/7, even on weekends</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">Super Convenient</h4>
                                        <p class="text-xs text-gray-600">Use your phone number or IC number</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3 mt-0.5">
                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">Government Backed</h4>
                                        <p class="text-xs text-gray-600">Regulated by Bank Negara Malaysia</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Call to Action -->
                            <div class="p-3 bg-pink-50 rounded-lg text-center">
                                <p class="text-sm text-pink-700 font-medium">
                                    ⚡ Perfect for urgent donations
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Our Charity Partners Section with Animations -->
        <section class="py-16 bg-primary-500 relative overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-10 left-10 w-24 h-24 bg-white/10 rounded-full blur-2xl animate-float"></div>
                <div class="absolute bottom-10 right-10 w-32 h-32 bg-white/5 rounded-full blur-3xl animate-float-delayed"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex items-center justify-between animate-on-scroll" data-animation="fade-in-up">
                    <!-- Left Arrow -->
                    <a href="{{ url('/partners') }}" class="flex-shrink-0 p-2 text-white/60 hover:text-white transition-all duration-300 hover:scale-110 animate-bounce-gentle" title="View All Partners">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>

                    <!-- Title and Partners Container -->
                    <div class="flex-1 flex items-center justify-center space-x-8 md:space-x-12 lg:space-x-16">
                        <!-- Title -->
                        <h2 class="text-lg md:text-xl font-semibold text-white whitespace-nowrap animate-fade-in-up" style="animation-delay: 0.2s;">
                            Our Charity Partners
                        </h2>

                        <!-- Partner Logos -->
                        <div class="flex items-center space-x-6 md:space-x-8 lg:space-x-12">
                            <!-- MAB (Malaysian Association for the Blind) -->
                            <div class="flex-shrink-0 bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer animate-bounce-in" style="animation-delay: 0.3s;">
                                <img src="{{ asset('images/charity/mab.png') }}"
                                     alt="Malaysian Association for the Blind"
                                     class="h-12 w-16 object-contain hover:rotate-3 transition-transform duration-300">
                            </div>

                            <!-- Yayasan Muslim -->
                            <div class="flex-shrink-0 bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer animate-bounce-in" style="animation-delay: 0.4s;">
                                <img src="{{ asset('images/charity/yayasanmuslim.png') }}"
                                     alt="Yayasan Muslim"
                                     class="h-12 w-16 object-contain hover:rotate-3 transition-transform duration-300">
                            </div>

                            <!-- Yayasan Ikhlas -->
                            <div class="flex-shrink-0 bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer animate-bounce-in" style="animation-delay: 0.5s;">
                                <img src="{{ asset('images/charity/yayasanikhlas.png') }}"
                                     alt="Yayasan Ikhlas"
                                     class="h-12 w-20 object-contain hover:rotate-3 transition-transform duration-300">
                            </div>

                            <!-- PruBSN Prihatin -->
                            <div class="flex-shrink-0 bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/prubsn.png') }}"
                                     alt="PruBSN Prihatin"
                                     class="h-12 w-20 object-contain">
                            </div>

                            <!-- Yayasan Angkasa -->
                            <div class="flex-shrink-0 bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/yaysanangkasa.png') }}"
                                     alt="Yayasan Angkasa"
                                     class="h-12 w-24 object-contain">
                            </div>

                            <!-- NASOM -->
                            <div class="flex-shrink-0 bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/nasom.png') }}"
                                     alt="NASOM"
                                     class="h-12 w-16 object-contain">
                            </div>
                        </div>
                    </div>

                    <!-- Right Arrow -->
                    <a href="{{ url('/partners') }}" class="flex-shrink-0 p-2 text-white/60 hover:text-white transition-colors" title="View All Partners">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <!-- Mobile Version - Responsive Stack -->
                <div class="md:hidden mt-8">
                    <h2 class="text-lg font-semibold text-white text-center mb-6">
                        Our Charity Partners
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- MAB Mobile -->
                        <div class="flex justify-center">
                            <div class="bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/mab.png') }}"
                                     alt="Malaysian Association for the Blind"
                                     class="h-8 w-12 object-contain">
                            </div>
                        </div>

                        <!-- Yayasan Muslim Mobile -->
                        <div class="flex justify-center">
                            <div class="bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/yayasanmuslim.png') }}"
                                     alt="Yayasan Muslim"
                                     class="h-8 w-12 object-contain">
                            </div>
                        </div>

                        <!-- Yayasan Ikhlas Mobile -->
                        <div class="flex justify-center">
                            <div class="bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/yayasanikhlas.png') }}"
                                     alt="Yayasan Ikhlas"
                                     class="h-8 w-14 object-contain">
                            </div>
                        </div>

                        <!-- PruBSN Mobile -->
                        <div class="flex justify-center">
                            <div class="bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/prubsn.png') }}"
                                     alt="PruBSN Prihatin"
                                     class="h-8 w-14 object-contain">
                            </div>
                        </div>

                        <!-- Yayasan Angkasa Mobile -->
                        <div class="flex justify-center">
                            <div class="bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/yaysanangkasa.png') }}"
                                     alt="Yayasan Angkasa"
                                     class="h-8 w-16 object-contain">
                            </div>
                        </div>

                        <!-- NASOM Mobile -->
                        <div class="flex justify-center">
                            <div class="bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/nasom.png') }}"
                                     alt="NASOM"
                                     class="h-8 w-12 object-contain">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

@push('styles')
<style>
    /* Floating Background Elements */
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-20px) rotate(1deg); }
        66% { transform: translateY(-10px) rotate(-1deg); }
    }

    @keyframes float-delayed {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-15px) rotate(-1deg); }
        66% { transform: translateY(-8px) rotate(1deg); }
    }

    @keyframes float-slow {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-12px) rotate(0.5deg); }
    }

    @keyframes float-gentle {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-float-delayed {
        animation: float-delayed 8s ease-in-out infinite;
    }

    .animate-float-slow {
        animation: float-slow 10s ease-in-out infinite;
    }

    .animate-float-gentle {
        animation: float-gentle 4s ease-in-out infinite;
    }

    /* Entrance Animations */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slide-in-left {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slide-in-right {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes bounce-in {
        0% {
            opacity: 0;
            transform: scale(0.3) translateY(50px);
        }
        50% {
            opacity: 1;
            transform: scale(1.05) translateY(-10px);
        }
        70% {
            transform: scale(0.95) translateY(0);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes draw-line {
        from {
            opacity: 0;
            transform: scaleX(0);
        }
        to {
            opacity: 1;
            transform: scaleX(1);
        }
    }

    @keyframes highlight {
        0%, 100% {
            background-size: 0% 100%;
        }
        50% {
            background-size: 100% 100%;
        }
    }

    @keyframes pulse-button {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
        }
    }

    @keyframes pulse-gentle {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.02);
        }
    }

    @keyframes bounce-gentle {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-5px);
        }
    }

    /* Animation Classes */
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-bounce-in {
        animation: bounce-in 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-draw-line {
        animation: draw-line 1s ease-out forwards;
        opacity: 0;
        transform-origin: left center;
    }

    .animate-highlight {
        background: linear-gradient(120deg, transparent 0%, transparent 50%, #fef3c7 50%, #fde68a 100%);
        background-size: 0% 100%;
        background-repeat: no-repeat;
        animation: highlight 2s ease-in-out forwards;
        animation-delay: 1s;
    }

    .animate-pulse-button {
        animation: pulse-button 2s infinite;
    }

    .animate-pulse-gentle {
        animation: pulse-gentle 3s ease-in-out infinite;
    }

    .animate-bounce-gentle {
        animation: bounce-gentle 2s ease-in-out infinite;
    }

    /* Scroll-triggered animations */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.8s ease-out;
    }

    .animate-on-scroll.animate-in {
        opacity: 1;
        transform: translateY(0);
    }

    .animate-on-scroll[data-animation="slide-in-left"] {
        transform: translateX(-50px);
    }

    .animate-on-scroll[data-animation="slide-in-left"].animate-in {
        transform: translateX(0);
    }

    .animate-on-scroll[data-animation="slide-in-right"] {
        transform: translateX(50px);
    }

    .animate-on-scroll[data-animation="slide-in-right"].animate-in {
        transform: translateX(0);
    }

    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Enhanced hover effects */
    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
</style>
@endpush

@push('scripts')
<script>
    // Scroll-triggered animations
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Add staggered animation delays for partner logos
        const partnerLogos = document.querySelectorAll('.animate-bounce-in');
        partnerLogos.forEach((logo, index) => {
            logo.style.animationDelay = `${0.3 + (index * 0.1)}s`;
        });

        // Enhanced hover effects for interactive elements
        const interactiveElements = document.querySelectorAll('a, button, .cursor-pointer');
        interactiveElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });

            element.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Parallax effect for background elements
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.animate-float, .animate-float-delayed, .animate-float-slow');

            parallaxElements.forEach((element, index) => {
                const speed = 0.5 + (index * 0.1);
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Add loading animation to images
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '0';
                this.style.transform = 'scale(0.8)';
                this.style.transition = 'all 0.5s ease';

                setTimeout(() => {
                    this.style.opacity = '1';
                    this.style.transform = 'scale(1)';
                }, 100);
            });
        });
    });
</script>
@endpush
