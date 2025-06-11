@extends('layouts.master')

@section('title', 'Frequently Asked Questions - Jariah Fund')
@section('description', 'Find answers to common questions about Jariah Fund, donations, campaigns, and our services. Get instant answers to your questions.')

@section('content')

        <!-- Hero Section -->
        <section class="py-20 bg-gradient-to-br from-primary-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-6">
                        <svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">FAQ</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Frequently Asked
                        <span class="text-primary-500 relative block">
                            Questions
                            <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-64 h-3 text-primary-200" viewBox="0 0 100 12" fill="currentColor">
                                <path d="M0 8c30-4 70-4 100 0v4H0z"/>
                            </svg>
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed mb-8">
                        Find answers to <strong>common questions</strong> about Jariah Fund, donations, campaigns, and our services.
                        If you can't find what you're looking for, <span class="text-primary-600 font-medium">feel free to contact us</span>.
                    </p>
                    <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-600">
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Instant Answers
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Comprehensive Guide
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            24/7 Support
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Category Navigation -->
        <section class="py-6 mt-4 mb-4 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap justify-center gap-4">
                    <button onclick="scrollToSection('basics')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Basics
                        </span>
                    </button>
                    <button onclick="scrollToSection('donations')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            Donations
                        </span>
                    </button>
                    <button onclick="scrollToSection('campaigns')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Campaigns
                        </span>
                    </button>
                    <button onclick="scrollToSection('operations')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Operations
                        </span>
                    </button>
                    <button onclick="scrollToSection('other')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Other
                        </span>
                    </button>
                </div>
            </div>
        </section>

        <!-- FAQ Content Section -->
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Basics Section -->
                <div id="basics" class="mb-16">
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Basics</h2>
                        <p class="text-lg text-gray-600">Learn about Jariah Fund and crowdfunding fundamentals</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">What is Jariah?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">Jariah linguistically means continuous or flowing. In the context of giving donations, Jariah shows an appreciation that has a continuous effect on the giver and helps the recipient over a long period of time.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">What is Jariah Fund?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">Jariah Fund is a public funding platform based on Islamic values that aims to facilitate donors to contribute to aid recipients/beneficiaries.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">What is Crowdfunding?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">Crowdfunding is an online platform to support those who need help. Everyone can contribute a small or large amount to the targeted amount.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">What types of Jariah Fund campaigns are conducted?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">Jariah Fund focuses on social campaigns covering the Education, Health and Economic Empowerment sectors.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donations Section -->
                <div id="donations" class="mb-16">
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Donations</h2>
                        <p class="text-lg text-gray-600">Everything you need to know about making donations</p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer lg:col-span-2" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">How do I donate to a campaign?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <div class="text-gray-600 leading-relaxed">
                                    <p class="mb-4"><strong>Payment via FPX:</strong></p>
                                    <ol class="list-decimal list-inside space-y-1 mb-4">
                                        <li>Log In / Register</li>
                                        <li>Select campaign</li>
                                        <li>Click 'Donate' button</li>
                                        <li>Enter amount and make payment</li>
                                        <li>You will be taken to the payment page</li>
                                        <li>Choose your preferred payment method and complete your donation</li>
                                    </ol>
                                    <p class="mb-4"><strong>Payment via QR Code:</strong></p>
                                    <ol class="list-decimal list-inside space-y-1">
                                        <li>Select campaign</li>
                                        <li>Click 'DuitNow'</li>
                                        <li>Select banking app</li>
                                        <li>Scan QR code</li>
                                        <li>Enter donation amount and make payment</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">Do I need to register to donate?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">Registration and login only apply to donations via FPX. For donations via QR Code, donors do not need to register and log in.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">What are the minimum and maximum amounts for donations?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">The minimum amount for a single transaction is RM10 and the maximum is RM1,000. However, donations via QR code can be made starting from RM0.01.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">Are there any charges for donors?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">Subject to fee exemptions by the main sponsor (if any), normal FPX service fees will be charged accordingly.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">Does Jariah Fund charge any fees for crowdfunding donations?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">No. We offer crowdfunding donation services with the aim of fulfilling Value Based Intermediation values in the banking industry.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 6 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">Are my donations tax deductible?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">All donations are tax exempt. Our charity partners are registered under the Inland Revenue Board (LHDN) and are eligible for tax exemption through receipts issued by them.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 7 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">Are my donations secure?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">Yes. We use FPX and DuitNow QR payment networks, a secure online payment solution that allows real-time debiting of customers' internet banking accounts from various banks.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 8 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer lg:col-span-2" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">How do I apply for a tax exemption receipt?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">For donations via FPX, receipts will be sent to your address as soon as the charity partner receives the list of completed transactions. For donations via DuitNow QR code, you can email us at jariahfund@muamalat.com.my with your transaction details and proof.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 9 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">When will I receive the tax exemption receipt after donating?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">Tax exemption receipts will be sent by our charity partners within 30 days after the campaign ends.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Campaigns Section -->
                <div id="campaigns" class="mb-16">
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Campaigns</h2>
                        <p class="text-lg text-gray-600">Learn about campaign management and updates</p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer lg:col-span-2" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">What happens if a campaign doesn't reach its target amount on time?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <div class="text-gray-600 leading-relaxed">
                                    <p class="mb-2">We will:</p>
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>Extend the campaign period; or</li>
                                        <li>End the campaign as an incomplete campaign and transfer the donated amount to the beneficiary; or</li>
                                        <li>End the campaign as an incomplete campaign and the remaining balance will be added by us</li>
                                    </ul>
                                    <p class="mt-2 text-sm italic">*Any decisions made are subject to our discretion.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer lg:col-span-2" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">How do I get updates from campaigns I've donated to?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">We will inform all registered donors about the latest developments regarding campaigns through updates on the campaign page or registered email. Donors will be notified after the campaign has been fully funded, the campaign period has ended, and the recipients/beneficiaries have received the donations.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer lg:col-span-2" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">How do I contact charity partners?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">You can always visit the charity partner's website as listed on the Partners page and contact them. You can also email us at <a href="mailto:jariahfund@muamalat.com.my" class="text-primary-500 hover:underline">jariahfund@muamalat.com.my</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Operations Section -->
                <div id="operations" class="mb-16">
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Operations</h2>
                        <p class="text-lg text-gray-600">How Jariah Fund operates and manages partnerships</p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">How does Jariah Fund cover its operational costs?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">We are fully sponsored by Bank Muamalat Malaysia Berhad. All operational costs are currently supported by our main sponsor. We do not charge any fees to donors.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">What is the due diligence process in selecting charity partners?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">We only select trusted and verified charity partners and campaigns. Charity partners running campaigns are thoroughly vetted by a trusted panel to provide full transparency. After charity partners are appointed, we will verify all their modus operandi before, during and after to ensure all aid donations are received by aid recipients. This includes all monitoring, reporting and auditing processes.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">What is the breakdown of management costs taken by charity partners?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">Management costs taken (if any) are to cover monitoring costs, administrative costs, transportation costs, operational costs and all other types of costs related to charity partner management.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other Matters Section -->
                <div id="other" class="mb-16">
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Other Matters</h2>
                        <p class="text-lg text-gray-600">Privacy, partnerships, and additional information</p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer lg:col-span-2" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">Does Jariah Fund share my personal information?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <div class="text-gray-600 leading-relaxed">
                                    <p class="mb-2">We may use your information obtained as stated in the Terms & Conditions for the purpose of:</p>
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>Updating the latest campaign developments</li>
                                        <li>Notifying you of new campaigns that may interest you</li>
                                        <li>Delivering our products and services to you</li>
                                        <li>Improving our products and services to you</li>
                                        <li>Marketing and advertising our products and services and also from other platforms in the network to you</li>
                                        <li>To notify you about changes to our services</li>
                                        <li>To give you information about fees and charges</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">Is there a registration fee for charity partners to launch campaigns on the platform?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">There is no registration fee for charity partners to register on the platform.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">Will we receive a receipt after donating?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">Yes, an electronic receipt (E-Receipt) will be emailed to the registered email address. However, if you use Yahoo and Hotmail email, please print your E-Receipt after donating as there are technical issues for those email users.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">Is there a fee for transferring funds from Jariah Fund to charity partners?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">We do not charge any fees for fund transfers to charity partners in Malaysia. Instead, we bear all transfer fees if any.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer lg:col-span-2" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">If we are an Organization/Foundation/NGO/NPO and interested in uploading campaigns on the Jariah Fund portal, what are the steps?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">You need to go through our selection process to ensure all criteria are met. After you are accepted, we will review and determine which campaigns are suitable to be featured on our platform.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 6 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">When can charity partners collect funds for their campaigns?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">The funds will be transferred to the recipient/beneficiary within 30 days from the day the campaign is fully funded. Depending on the charity partner's request, funds can be released earlier subject to our committee's approval.</p>
                            </div>
                        </div>

                        <!-- FAQ Item 7 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">How are funds transferred to charity partners?</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">After the campaign is funded or fully completed, funds will be transferred to the registered account number provided by the charity partner.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-20 bg-primary-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Still Have Questions?</h2>
                <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">Can't find the answer you're looking for? Please contact our support team.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:jariahfund@muamalat.com.my" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Email Us
                    </a>
                    <a href="{{ url('/contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                        Contact Page
                    </a>
                </div>
            </div>
        </section>

@endsection

@push('scripts')
<script>
    // Toggle FAQ items
    function toggleFaq(element) {
        const answer = element.querySelector('.faq-answer');
        const icon = element.querySelector('.faq-icon');

        if (answer.classList.contains('hidden')) {
            answer.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
            element.classList.add('bg-primary-50', 'border-primary-200');
        } else {
            answer.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
            element.classList.remove('bg-primary-50', 'border-primary-200');
        }
    }

    // Smooth scroll to sections
    function scrollToSection(sectionId) {
        const element = document.getElementById(sectionId);
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

            // Update active category button
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('bg-primary-500', 'text-white');
                btn.classList.add('bg-white', 'text-gray-700');
            });

            event.target.closest('.category-btn').classList.remove('bg-white', 'text-gray-700');
            event.target.closest('.category-btn').classList.add('bg-primary-500', 'text-white');
        }
    }

    // Search functionality
    document.getElementById('faq-search').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('h3').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();

            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.classList.remove('hidden');
                item.classList.add('block');

                // Highlight search terms
                if (searchTerm.length > 2) {
                    highlightSearchTerm(item, searchTerm);
                }
            } else {
                item.classList.remove('block');
                item.classList.add('hidden');
            }
        });

        // Show/hide section headers based on visible items
        const sections = ['basics', 'donations', 'campaigns', 'operations', 'other'];
        sections.forEach(sectionId => {
            const section = document.getElementById(sectionId);
            const visibleItems = section.querySelectorAll('.faq-item.block, .faq-item:not(.hidden)');

            if (searchTerm === '' || visibleItems.length > 0) {
                section.classList.remove('hidden');
                section.classList.add('block');
            } else {
                section.classList.remove('block');
                section.classList.add('hidden');
            }
        });
    });

    // Highlight search terms
    function highlightSearchTerm(item, term) {
        const question = item.querySelector('h3');
        const answer = item.querySelector('.faq-answer p');

        [question, answer].forEach(element => {
            const text = element.textContent;
            const regex = new RegExp(`(${term})`, 'gi');
            const highlightedText = text.replace(regex, '<mark class="bg-yellow-200 px-1 rounded">$1</mark>');
            element.innerHTML = highlightedText;
        });
    }

    // Clear highlights when search is cleared
    document.getElementById('faq-search').addEventListener('input', function(e) {
        if (e.target.value === '') {
            document.querySelectorAll('mark').forEach(mark => {
                mark.outerHTML = mark.innerHTML;
            });
        }
    });

    // Initialize all FAQ items as collapsed
    document.addEventListener('DOMContentLoaded', function() {
        const allItems = document.querySelectorAll('.faq-item');
        allItems.forEach(item => {
            const answer = item.querySelector('.faq-answer');
            const icon = item.querySelector('.faq-icon');

            // Ensure all items start collapsed
            answer.classList.add('hidden');
            icon.classList.remove('rotate-45');
            item.classList.remove('bg-primary-50', 'border-primary-200');
        });
    });
</script>
@endpush
