@extends('layouts.master')

@section('title', 'About Us - Jariah Fund Raudhah Muamalat')
@section('description', 'Learn about Jariah Fund, Malaysia\'s trusted Islamic crowdfunding platform that empowers communities through education, healthcare, and economic assistance programs.')

@section('content')

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

                    <!-- Call to Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                        <a href="{{ url('/campaigns') }}" class="bg-primary-500 text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-600 transition-all duration-300 text-center transform hover:scale-105 shadow-lg hover:shadow-xl">
                            View Our Campaigns
                        </a>
                        <a href="{{ url('/donate') }}" class="border-2 border-primary-500 text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-primary-50 transition-all duration-300 text-center transform hover:scale-105">
                            Start Donating
                        </a>
                    </div>

                    <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-600">
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm hover:shadow-md hover:scale-105 transition-all duration-300 cursor-pointer">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            100% Secure
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm hover:shadow-md hover:scale-105 transition-all duration-300 cursor-pointer">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Tax Deductible
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm hover:shadow-md hover:scale-105 transition-all duration-300 cursor-pointer">
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
                        <div class="rounded-2xl overflow-hidden shadow-xl max-w-md bg-white p-8">
                            <img src="{{ asset('images/logos/jariahfund_logo.png') }}"
                                 alt="Jariah Fund Logo"
                                 class="w-full h-96 object-contain">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bank Muamalat Section -->
        <section class="py-12 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start lg:items-center">
                    <!-- Left Image -->
                    <div class="flex justify-center lg:justify-start">
                        <img src="{{ asset('images/logos/betterlives.png') }}"
                             alt="Better Lives Together"
                             class="max-w-full h-auto object-contain">
                    </div>

                    <!-- Right Content -->
                    <div class="space-y-6 lg:space-y-8">
                        <!-- Header -->
                        <div>
                            <div class="inline-flex items-center px-3 py-2 md:px-4 md:py-2 bg-primary-100 rounded-full mb-3 md:mb-4">
                                <span class="text-primary-600 font-semibold text-xs md:text-sm tracking-wide uppercase">Trusted Banking Partner</span>
                            </div>
                            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                                Bank Muamalat Malaysia – Our Trusted Financial Partner
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
                            <div class="bg-white rounded-lg p-3 md:p-4 shadow-md border border-gray-100 hover:shadow-xl hover:scale-105 hover:border-primary-200 transition-all duration-300 cursor-pointer">
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

                            <div class="bg-white rounded-lg p-3 md:p-4 shadow-md border border-gray-100 hover:shadow-xl hover:scale-105 hover:border-primary-200 transition-all duration-300 cursor-pointer">
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
        <section class="py-16 bg-gradient-to-br from-gray-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center px-6 py-3 bg-primary-50 rounded-full mb-6 shadow-sm">
                        <svg class="w-5 h-5 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">Donate with Confidence</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                        <span class="text-primary-500">Simple & Secure</span> Donation Methods
                    </h2>
                    <p class="text-lg md:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                        Choose from Malaysia's most trusted and convenient payment options.
                        Your generosity is just a few clicks away with bank-grade security.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 max-w-6xl mx-auto mb-16">
                    <!-- FPX -->
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl hover:scale-105 hover:border-primary-200 transition-all duration-300 cursor-pointer">
                        <!-- Image Section -->
                        <div class="h-48 bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center p-8">
                            <img src="{{ asset('images/payment/fpxlogo.png') }}"
                                 alt="FPX Online Banking"
                                 class="max-w-full max-h-full object-contain">
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
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl hover:scale-105 hover:border-primary-200 transition-all duration-300 cursor-pointer">
                        <!-- Image Section -->
                        <div class="h-48 bg-gradient-to-br from-pink-50 to-pink-100 flex items-center justify-center p-8">
                            <img src="{{ asset('images/payment/duitnowlogo.png') }}"
                                 alt="DuitNow Transfer"
                                 class="max-w-full max-h-full object-contain">
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

        <!-- Our Charity Partners Section -->
        <section class="py-16 bg-primary-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between">
                    <!-- Left Arrow -->
                    <a href="{{ url('/partners') }}" class="flex-shrink-0 p-2 text-white/60 hover:text-white transition-colors" title="View All Partners">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>

                    <!-- Title and Partners Container -->
                    <div class="flex-1 flex items-center justify-center space-x-8 md:space-x-12 lg:space-x-16">
                        <!-- Title -->
                        <h2 class="text-lg md:text-xl font-semibold text-white whitespace-nowrap">
                            Our Charity Partners
                        </h2>

                        <!-- Partner Logos -->
                        <div class="flex items-center space-x-6 md:space-x-8 lg:space-x-12">
                            <!-- MAB (Malaysian Association for the Blind) -->
                            <div class="flex-shrink-0 bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/mab.png') }}"
                                     alt="Malaysian Association for the Blind"
                                     class="h-12 w-16 object-contain">
                            </div>

                            <!-- Yayasan Muslim -->
                            <div class="flex-shrink-0 bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/yayasanmuslim.png') }}"
                                     alt="Yayasan Muslim"
                                     class="h-12 w-16 object-contain">
                            </div>

                            <!-- Yayasan Ikhlas -->
                            <div class="flex-shrink-0 bg-white rounded-lg p-2 hover:shadow-md hover:scale-110 transition-all duration-300 cursor-pointer">
                                <img src="{{ asset('images/charity/yayasanikhlas.png') }}"
                                     alt="Yayasan Ikhlas"
                                     class="h-12 w-20 object-contain">
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
