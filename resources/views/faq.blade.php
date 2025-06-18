@extends('layouts.master')

@section('title', __('app.faq_page_title'))
@section('description', __('app.faq_page_description'))

@section('content')

        @include('components.hero-section', [
            'badge' => [
                'text' => __('app.faq'),
                'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            ],
            'title' => __('app.frequently_asked'),
            'subtitle' => __('app.questions'),
            'description' => __('app.faq_hero_description'),
            'highlights' => [
                ['text' => __('app.feel_free_to_contact_us'), 'delay' => '0.6s']
            ],
            'pills' => [
                ['text' => __('app.instant_answers'), 'delay' => '0.6s'],
                ['text' => __('app.comprehensive_guide'), 'delay' => '0.7s'],
                ['text' => __('app.24_7_support'), 'delay' => '0.8s']
            ]
        ])

        <!-- Category Navigation -->
        <section class="py-6 mt-4 mb-4 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap justify-center gap-4">
                    <button onclick="scrollToSection('basics')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('app.basics') }}
                        </span>
                    </button>
                    <button onclick="scrollToSection('donations')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                            {{ __('app.donations') }}
                        </span>
                    </button>
                    <button onclick="scrollToSection('campaigns')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            {{ __('app.campaigns') }}
                        </span>
                    </button>
                    <button onclick="scrollToSection('operations')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ __('app.operations') }}
                        </span>
                    </button>
                    <button onclick="scrollToSection('other')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('app.other') }}
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
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('app.basics') }}</h2>
                        <p class="text-lg text-gray-600">{{ __('app.basics_description') }}</p>
                    </div>
                    <div class="space-y-4">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.what_is_jariah') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.jariah_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.what_is_jariah_fund') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.jariah_fund_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.what_is_crowdfunding') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.crowdfunding_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.what_types_of_campaigns') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.campaign_types_answer') }}</p>
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
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('app.donations') }}</h2>
                        <p class="text-lg text-gray-600">{{ __('app.donations_description') }}</p>
                    </div>
                    <div class="space-y-4">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.how_to_donate') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <div class="text-gray-600 leading-relaxed">
                                    <p class="mb-4"><strong>{{ __('app.payment_via_fpx') }}</strong></p>
                                    <ol class="list-decimal list-inside space-y-1 mb-4">
                                        <li>{{ __('app.login_register') }}</li>
                                        <li>{{ __('app.select_campaign') }}</li>
                                        <li>{{ __('app.click_donate_button') }}</li>
                                        <li>{{ __('app.enter_amount_and_pay') }}</li>
                                        <li>{{ __('app.taken_to_payment_page') }}</li>
                                        <li>{{ __('app.choose_payment_method') }}</li>
                                    </ol>
                                    <p class="mb-4"><strong>{{ __('app.payment_via_qr') }}</strong></p>
                                    <ol class="list-decimal list-inside space-y-1">
                                        <li>{{ __('app.select_campaign') }}</li>
                                        <li>{{ __('app.click_duitnow') }}</li>
                                        <li>{{ __('app.select_banking_app') }}</li>
                                        <li>{{ __('app.scan_qr_code') }}</li>
                                        <li>{{ __('app.enter_donation_amount') }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.need_to_register') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.need_to_register_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.min_max_donation') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.min_max_donation_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.donor_charges') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.donor_charges_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.jariah_fund_fees') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.jariah_fund_fees_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 6 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.tax_deductible') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.tax_deductible_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 7 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.donations_secure') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.donations_secure_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 8 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.apply_tax_receipt') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.apply_tax_receipt_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 9 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.when_receive_receipt') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.when_receive_receipt_answer') }}</p>
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
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('app.campaigns_section_title') }}</h2>
                        <p class="text-lg text-gray-600">{{ __('app.campaigns_section_description') }}</p>
                    </div>
                    <div class="space-y-4">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.campaign_not_reach_target') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <div class="text-gray-600 leading-relaxed">
                                    <p class="mb-2">{{ __('app.campaign_not_reach_target_answer_intro') }}</p>
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>{{ __('app.campaign_extend_period') }}</li>
                                        <li>{{ __('app.campaign_end_incomplete_transfer') }}</li>
                                        <li>{{ __('app.campaign_end_incomplete_add_balance') }}</li>
                                    </ul>
                                    <p class="mt-2 text-sm italic">{{ __('app.campaign_decisions_discretion') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.campaign_updates') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.campaign_updates_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.contact_charity_partners') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.contact_charity_partners_answer') }}</p>
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
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('app.operations_section_title') }}</h2>
                        <p class="text-lg text-gray-600">{{ __('app.operations_section_description') }}</p>
                    </div>
                    <div class="space-y-4">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.operational_costs') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.operational_costs_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.due_diligence_process') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.due_diligence_process_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.management_costs_breakdown') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.management_costs_breakdown_answer') }}</p>
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
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('app.other_section_title') }}</h2>
                        <p class="text-lg text-gray-600">{{ __('app.other_section_description') }}</p>
                    </div>
                    <div class="space-y-4">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.receipt_after_donating') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.receipt_after_donating_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.registration_fee_for_partners') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.registration_fee_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.fee_for_transferring_funds') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.fee_for_transferring_funds_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.organization_interested_in_campaigns') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.organization_interested_in_campaigns_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.when_collect_funds') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.when_collect_funds_answer') }}</p>
                            </div>
                        </div>

                        <!-- FAQ Item 6 -->
                        <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ __('app.how_funds_transferred') }}</h3>
                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                            <div class="faq-answer mt-4 hidden">
                                <p class="text-gray-600 leading-relaxed">{{ __('app.how_funds_transferred_answer') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-20 bg-primary-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">{{ __('app.still_have_questions') }}</h2>
                <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">{{ __('app.contact_support_team') }}</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:jariahfund@muamalat.com.my" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        {{ __('app.email_us') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                        {{ __('app.contact_page') }}
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
        
        // Close all other FAQs
        document.querySelectorAll('.faq-answer').forEach(item => {
            if (item !== answer && item.classList.contains('block')) {
                item.classList.add('hidden');
                item.classList.remove('block');
                item.previousElementSibling.querySelector('.faq-icon').classList.remove('rotate-180');
            }
        });
        
        // Toggle current FAQ
        answer.classList.toggle('hidden');
        answer.classList.toggle('block');
        icon.classList.toggle('rotate-180');
    }
    
    // Scroll to section
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        window.scrollTo({
            top: section.offsetTop - 120,
            behavior: 'smooth'
        });
        
        // Add active state to button
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('bg-primary-500', 'text-white');
            btn.classList.add('bg-white', 'text-gray-700');
        });
        
        const activeBtn = document.querySelector(`[onclick="scrollToSection('${sectionId}')"]`);
        activeBtn.classList.remove('bg-white', 'text-gray-700');
        activeBtn.classList.add('bg-primary-500', 'text-white');
    }
    
    // Check if URL has hash
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash) {
            const sectionId = window.location.hash.substring(1);
            setTimeout(() => {
                scrollToSection(sectionId);
            }, 300);
        }
        
        // Add animation on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, {
            threshold: 0.1
        });
        
        document.querySelectorAll('.faq-item').forEach(item => {
            observer.observe(item);
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Animation for FAQ items */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .fade-in-up {
        animation: fadeInUp 0.5s ease forwards;
    }
    
    .faq-item {
        opacity: 0;
    }
    
    .faq-answer {
        transition: all 0.3s ease;
    }
</style>
@endpush
