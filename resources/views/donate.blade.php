@extends('layouts.master')

@section('title', __('app.donate_now') . ' - Jariah Fund')
@section('description', __('app.make_a_secure_donation'))

@section('content')
    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-br from-primary-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-6 animate-fade-in">
                    <svg class="w-4 h-4 text-primary-600 mr-2 animate-heartbeat" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">{{ __('app.secure_donation') }}</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6 animate-fade-in">
                    {{ __('app.make_a_difference') }}
                    <span class="text-primary-500 relative block">
                        {{ __('app.today') }}
                        <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-64 h-3 text-primary-200" viewBox="0 0 100 12" fill="currentColor">
                            <path d="M0 8c30-4 70-4 100 0v4H0z"/>
                        </svg>
                    </span>
                </h1>
                <p class="text-xl text-gray-600 leading-relaxed mb-8 animate-fade-in">
                    {{ __('app.support_verified_campaigns') }} <span class="text-primary-600 font-medium">{{ __('app.complete_transparency') }}</span> and
                    <span class="text-primary-600 font-medium">{{ __('app.effective_impact') }}</span>.
                </p>
            </div>
        </div>
    </section>

    <!-- Image Slider Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative hover-lift">
                <div class="carousel-container rounded-xl overflow-hidden">
                    <div class="carousel-track" id="carouselTrack">
                        <!-- Slide 1 - Eye Examination -->
                        <div class="carousel-slide">
                            <img src="{{ asset('assets/images/campaigns/01.jpg') }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'"
                                 alt="Eye examination for students"
                                 class="w-full h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent flex items-end">
                                <div class="p-8 text-white w-full">
                                    <div class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                                        <span class="text-white font-medium text-sm">{{ __('app.featured_campaign') }}</span>
                                    </div>
                                    <h1 class="text-3xl font-bold mb-2">{{ __('app.vision_for_education') }}</h1>
                                    <p class="text-white/90 text-base">{{ __('app.providing_eye_care') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 - Students with Glasses -->
                        <div class="carousel-slide">
                            <img src="{{ asset('assets/images/campaigns/02.jpg') }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'"
                                 alt="Students wearing glasses in classroom"
                                 class="w-full h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent flex items-end">
                                <div class="p-8 text-white w-full">
                                    <div class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                                        <span class="text-white font-medium text-sm">{{ __('app.impact_story') }}</span>
                                    </div>
                                    <h1 class="text-3xl font-bold mb-2">{{ __('app.improved_learning_experience') }}</h1>
                                    <p class="text-white/90 text-base">{{ __('app.students_can_see_clearly') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 - Eye Care Equipment -->
                        <div class="carousel-slide">
                            <img src="{{ asset('assets/images/campaigns/03.jpg') }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'"
                                 alt="Eye care equipment and examination tools"
                                 class="w-full h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent flex items-end">
                                <div class="p-8 text-white w-full">
                                    <div class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                                        <span class="text-white font-medium text-sm">{{ __('app.professional_care') }}</span>
                                    </div>
                                    <h1 class="text-3xl font-bold mb-2">{{ __('app.quality_eye_examinations') }}</h1>
                                    <p class="text-white/90 text-base">{{ __('app.professional_equipment') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 4 - Community Impact -->
                        <div class="carousel-slide">
                            <img src="{{ asset('assets/images/campaigns/04.jpg') }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'"
                                 alt="Community children and families"
                                 class="w-full h-96 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent flex items-end">
                                <div class="p-8 text-white w-full">
                                    <div class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                                        <span class="text-white font-medium text-sm">{{ __('app.community_impact') }}</span>
                                    </div>
                                    <h1 class="text-3xl font-bold mb-2">{{ __('app.supporting_b40_families') }}</h1>
                                    <p class="text-white/90 text-base">{{ __('app.reducing_financial_burden_quality') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <button class="carousel-nav prev" onclick="previousSlide()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="carousel-nav next" onclick="nextSlide()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <div class="carousel-indicator active" onclick="goToSlide(0)"></div>
                        <div class="carousel-indicator" onclick="goToSlide(1)"></div>
                        <div class="carousel-indicator" onclick="goToSlide(2)"></div>
                        <div class="carousel-indicator" onclick="goToSlide(3)"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Campaign & Donation Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Campaign Information - Left Side -->
                <div class="animate-slide-in-left">
                    <!-- Progress Indicator -->
                    <div class="bg-white rounded-xl p-6 mb-8 border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex justify-between items-baseline mb-4">
                            <div>
                                <div class="text-2xl font-bold text-gray-900 animate-pulse">RM 45,230</div>
                                <div class="text-sm text-gray-500">{{ __('app.raised_of_goal', ['62,000']) }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-semibold text-primary-600 animate-pulse">73%</div>
                                <div class="text-sm text-gray-500">{{ __('app.funded') }}</div>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                            <div class="bg-primary-500 h-2 rounded-full animate-progress animate-shimmer" style="width: 73%"></div>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                            <div class="flex items-center">
                                @include('components.uxwing-icon', ['name' => 'people', 'class' => 'w-4 h-4 mr-2'])
                                <span>234 {{ __('app.donors') }}</span>
                            </div>
                            <div class="animate-pulse">15 {{ __('app.days_left') }}</div>
                        </div>

                        <!-- Audit Trail Toggle -->
                        <div class="border-t border-gray-100 pt-4">
                            <button onclick="toggleAuditTrail()"
                                    class="flex items-center justify-between w-full text-left text-sm font-medium text-gray-700 hover:text-primary-600 transition-colors"
                                    id="audit-trail-toggle">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                    {{ __('app.progress_history') }}
                                </span>
                                <svg class="w-4 h-4 transform transition-transform duration-200" id="audit-trail-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Audit Trail Content -->
                            <div id="audit-trail-content" class="hidden mt-4 space-y-4">
                                <!-- Milestones Section -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Campaign Milestones
                                    </h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="flex items-center text-green-600">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                                </svg>
                                                50% Goal Reached
                                            </span>
                                            <span class="text-gray-500">RM 31,000</span>
                                        </div>
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="flex items-center text-green-600">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                                </svg>
                                                100 Donors Milestone
                                            </span>
                                            <span class="text-gray-500">RM 25,000</span>
                                        </div>
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="flex items-center text-blue-600">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                                                </svg>
                                                Next: 75% Goal
                                            </span>
                                            <span class="text-gray-500">RM 46,500</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Recent Activity Section -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Recent Activity
                                    </h4>
                                    <div class="space-y-3" id="progress-section">
                                        <div class="flex items-start space-x-3">
                                            <div class="w-2 h-2 bg-primary-500 rounded-full mt-2 flex-shrink-0"></div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium text-gray-900">Anonymous donation received</p>
                                                    <span class="text-xs text-gray-500">2 min ago</span>
                                                </div>
                                                <p class="text-xs text-gray-600">+RM 100 • Progress: 73%</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start space-x-3">
                                            <div class="w-2 h-2 bg-primary-500 rounded-full mt-2 flex-shrink-0"></div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium text-gray-900">New donor joined the campaign</p>
                                                    <span class="text-xs text-gray-500">5 min ago</span>
                                                </div>
                                                <p class="text-xs text-gray-600">+RM 250 • Progress: 72%</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start space-x-3">
                                            <div class="w-2 h-2 bg-primary-500 rounded-full mt-2 flex-shrink-0"></div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-sm font-medium text-gray-900">Campaign milestone reached</p>
                                                    <span class="text-xs text-gray-500">1 hour ago</span>
                                                </div>
                                                <p class="text-xs text-gray-600">50% goal achieved • RM 31,000</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Details -->
                    <div class="bg-white rounded-xl p-6 mb-8 border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('app.campaign_details') }}</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ __('app.campaign_impact') }}</h4>
                                    <p class="text-sm text-gray-600">{{ __('app.providing_eye_care_services') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ __('app.verified_campaign') }}</h4>
                                    <p class="text-sm text-gray-600">{{ __('app.fully_verified_and_transparent') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ __('app.tax_deductible') }}</h4>
                                    <p class="text-sm text-gray-600">{{ __('app.receipt_provided_for_tax') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PDF Download Link -->
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-primary-300 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900 text-sm">{{ __('app.campaign_requirements') }}</h4>
                                    <p class="text-gray-600 text-xs">{{ __('app.detailed_breakdown') }}</p>
                                </div>
                            </div>
                            <a href="https://jariahfund.muamalat.com.my/docs/15/QUO-2025-0001.pdf"
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-lg transition-colors hover:shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ __('app.download_pdf') }}
                            </a>
                        </div>
                    </div>

                    <!-- Share Section -->
                    <div class="border-t border-gray-100 pt-6 mt-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium text-gray-900 mb-1">{{ __('app.share_campaign') }}</h4>
                                <p class="text-sm text-gray-600">{{ __('app.help_reach_more') }}</p>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="shareOnFacebook()" class="w-9 h-9 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center transition-colors" title="Share on Facebook">
                                    @include('components.uxwing-icon', ['name' => 'facebook', 'class' => 'w-4 h-4'])
                                </button>
                                <button onclick="shareOnTwitter()" class="w-9 h-9 bg-black hover:bg-gray-800 text-white rounded-lg flex items-center justify-center transition-colors" title="Share on X">
                                    @include('components.uxwing-icon', ['name' => 'twitter', 'class' => 'w-4 h-4'])
                                </button>
                                <button onclick="shareOnWhatsApp()" class="w-9 h-9 bg-green-500 hover:bg-green-600 text-white rounded-lg flex items-center justify-center transition-colors" title="Share on WhatsApp">
                                    @include('components.uxwing-icon', ['name' => 'whatsapp', 'class' => 'w-4 h-4'])
                                </button>
                                <button onclick="copyLink()" class="w-9 h-9 bg-gray-500 hover:bg-gray-600 text-white rounded-lg flex items-center justify-center transition-colors" title="Copy Link">
                                    @include('components.uxwing-icon', ['name' => 'copy-link', 'class' => 'w-4 h-4'])
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donation Form - Right Side -->
                <div class="animate-slide-in-right">
                    <div class="bg-white rounded-xl border border-gray-200 sticky top-6 hover-glow">
                        <!-- Form Header -->
                        <div class="px-8 py-6 border-b border-gray-100">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2 animate-fade-in">{{ __('app.make_your_donation') }}</h2>
                            <p class="text-gray-600 animate-fade-in">{{ __('app.every_contribution') }}</p>
                        </div>

                        <!-- Professional Form -->
                        <div class="px-8 py-8">
                            <form action="{{ route('donate.confirm') }}" method="POST" class="space-y-8">
                                @csrf
                                <input type="hidden" name="campaign_id" value="1">

                                <!-- Amount Selection -->
                                <div>
                                    <label class="block text-base font-medium text-gray-900 mb-4">{{ __('app.select_amount') }}</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <label class="cursor-pointer amount-option hover:scale-105 transition-transform duration-300">
                                            <input type="radio" name="amount" value="50" class="sr-only">
                                            <div class="amount-button border-2 border-gray-200 py-4 px-4 rounded-lg text-center transition-all duration-300 hover:border-primary-300 hover:bg-primary-50 hover:shadow-lg">
                                                <div class="text-lg font-semibold text-gray-900">RM 50</div>
                                            </div>
                                        </label>
                                        <label class="cursor-pointer amount-option hover:scale-105 transition-transform duration-300">
                                            <input type="radio" name="amount" value="150" class="sr-only">
                                            <div class="amount-button border-2 border-gray-200 py-4 px-4 rounded-lg text-center transition-all duration-300 hover:border-primary-300 hover:bg-primary-50 hover:shadow-lg">
                                                <div class="text-lg font-semibold text-gray-900">RM 150</div>
                                            </div>
                                        </label>
                                        <label class="cursor-pointer amount-option hover:scale-105 transition-transform duration-300">
                                            <input type="radio" name="amount" value="250" class="sr-only" checked>
                                            <div class="amount-button border-2 border-primary-500 bg-primary-500 py-4 px-4 rounded-lg text-center transition-all duration-300 animate-pulse">
                                                <div class="text-lg font-semibold text-white">RM 250</div>
                                            </div>
                                        </label>
                                        <label class="cursor-pointer amount-option hover:scale-105 transition-transform duration-300">
                                            <input type="radio" name="amount" value="500" class="sr-only">
                                            <div class="amount-button border-2 border-gray-200 py-4 px-4 rounded-lg text-center transition-all duration-300 hover:border-primary-300 hover:bg-primary-50 hover:shadow-lg">
                                                <div class="text-lg font-semibold text-gray-900">RM 500</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Custom Amount -->
                                <div>
                                    <label class="block text-base font-medium text-gray-900 mb-4">{{ __('app.custom_amount') }}</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <span class="text-sm font-medium text-gray-500">MYR</span>
                                        </div>
                                        <input type="number" name="custom_amount" id="custom-amount" placeholder="{{ __('app.enter_amount') }}" min="1" step="1"
                                               class="w-full pl-16 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                </div>

                                <!-- Donor Information -->
                                <div>
                                    <label class="block text-base font-medium text-gray-900 mb-4">{{ __('app.donor_information') }}</label>
                                    <div class="space-y-4">
                                        <!-- Donor Name -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('app.donor_name') }} *</label>
                                            <input type="text" name="donor_name" required
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                   placeholder="{{ __('app.enter_your_full_name') }}">
                                        </div>

                                        <!-- Donor Email -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('app.donor_email') }} *</label>
                                            <input type="email" name="donor_email" required
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                   placeholder="{{ __('app.enter_your_email') }}">
                                        </div>

                                        <!-- Donor Phone -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('app.donor_phone') }}</label>
                                            <input type="tel" name="donor_phone"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                   placeholder="{{ __('app.enter_your_phone') }}">
                                        </div>

                                        <!-- Donation Message -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('app.donation_message') }}</label>
                                            <textarea name="message" rows="3"
                                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                      placeholder="{{ __('app.optional_message') }}"></textarea>
                                        </div>

                                        <!-- Anonymous Donation -->
                                        <div class="flex items-center">
                                            <input type="checkbox" name="is_anonymous" id="is_anonymous" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                                            <label for="is_anonymous" class="ml-2 block text-sm text-gray-700">
                                                {{ __('app.anonymous_donation') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Continue Button -->
                                <div class="pt-8 border-t border-gray-100">
                                    <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white py-4 px-6 rounded-lg text-lg font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 animate-pulse">
                                        {{ __('app.continue_to_review') }}
                                    </button>

                                    <!-- Trust Indicators -->
                                    <div class="mt-6 text-center">
                                        <div class="flex items-center justify-center text-sm text-gray-600 mb-4">
                                            @include('components.uxwing-icon', ['name' => 'security', 'class' => 'w-4 h-4 text-green-600 mr-2 animate-pulse'])
                                            <span>{{ __('app.secure_encrypted_payment') }}</span>
                                        </div>
                                        <div class="flex justify-center gap-6 text-xs text-gray-500">
                                            <div class="flex items-center hover:scale-105 transition-transform duration-300">
                                                <span class="mr-1">🔒</span>
                                                <span>{{ __('app.ssl_secured') }}</span>
                                            </div>
                                            <div class="flex items-center hover:scale-105 transition-transform duration-300">
                                                <span class="mr-1">⚡</span>
                                                <span>{{ __('app.instant') }}</span>
                                            </div>
                                            <div class="flex items-center hover:scale-105 transition-transform duration-300">
                                                <span class="mr-1">🏆</span>
                                                <span>{{ __('app.tax_receipt') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Amount selection functionality
    const amountInputs = document.querySelectorAll('input[name="amount"]');
    const customAmountInput = document.getElementById('custom-amount');

    // Handle amount selection
    amountInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Clear custom amount when radio button is selected
            if (customAmountInput) {
                customAmountInput.value = '';
            }

            // Update visual state for all amount buttons
            amountInputs.forEach(otherInput => {
                const button = otherInput.closest('label').querySelector('.amount-button');
                const textElement = button.querySelector('div');
                if (otherInput === this) {
                    // Selected state
                    button.classList.remove('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
                    button.classList.add('border-primary-500', 'bg-primary-500');
                    textElement.classList.remove('text-gray-900');
                    textElement.classList.add('text-white');
                } else {
                    // Unselected state
                    button.classList.remove('border-primary-500', 'bg-primary-500');
                    button.classList.add('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
                    textElement.classList.remove('text-white');
                    textElement.classList.add('text-gray-900');
                }
            });
        });
    });

    // Handle custom amount input
    if (customAmountInput) {
        customAmountInput.addEventListener('input', function() {
            if (this.value) {
                // Clear amount radio selections when custom amount is entered
                amountInputs.forEach(input => {
                    input.checked = false;
                    const button = input.closest('label').querySelector('.amount-button');
                    const textElement = button.querySelector('div');
                    button.classList.remove('border-primary-500', 'bg-primary-500');
                    button.classList.add('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
                    textElement.classList.remove('text-white');
                    textElement.classList.add('text-gray-900');
                });
            }
        });
    }





    // Accessibility improvements
    const amountLabels = document.querySelectorAll('label[class*="cursor-pointer"]');
    amountLabels.forEach(label => {
        label.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const input = this.querySelector('input');
                if (input) {
                    input.checked = true;
                    input.dispatchEvent(new Event('change'));
                }
            }
        });

        // Make labels focusable
        label.setAttribute('tabindex', '0');
    });

    // Social Media Share Functions
    window.shareOnFacebook = function() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent('Vision for Education Program');
        const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    };

    window.shareOnTwitter = function() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('Support the Vision for Education Program! Help provide free eye care and glasses for underprivileged students. Every donation improves a child\'s learning experience.');
        const shareUrl = `https://twitter.com/intent/tweet?text=${text}&url=${url}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    };

    window.shareOnWhatsApp = function() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('👓 Support the Vision for Education Program!\n\nVision for Education Program\n\nHelp provide free eye examinations and glasses for underprivileged students. Every donation helps improve a child\'s learning experience and quality of life.');
        const shareUrl = `https://wa.me/?text=${text}%20${url}`;
        window.open(shareUrl, '_blank');
    };

    window.shareOnTelegram = function() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('👓 Support the Vision for Education Program!\n\nVision for Education Program');
        const shareUrl = `https://t.me/share/url?url=${url}&text=${text}`;
        window.open(shareUrl, '_blank');
    };

    window.copyLink = function() {
        const url = window.location.href;

        if (navigator.clipboard && window.isSecureContext) {
            // Use modern clipboard API
            navigator.clipboard.writeText(url).then(function() {
                showCopyNotification('Link copied to clipboard!');
            }).catch(function() {
                fallbackCopyTextToClipboard(url);
            });
        } else {
            // Fallback for older browsers
            fallbackCopyTextToClipboard(url);
        }
    };

    function fallbackCopyTextToClipboard(text) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.className = "fixed top-0 left-0 opacity-0 pointer-events-none";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
            showCopyNotification('Link copied to clipboard!');
        } catch (err) {
            showCopyNotification('Failed to copy link');
        }

        document.body.removeChild(textArea);
    }

    function showCopyNotification(message) {
        showNotification(message, 'success');
    }

    // Scroll-triggered animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);



    // Carousel functionality
    let currentSlide = 0;
    const totalSlides = 4;
    const carouselTrack = document.getElementById('carouselTrack');
    const indicators = document.querySelectorAll('.carousel-indicator');
    let autoPlayInterval;

    // Initialize carousel
    function initCarousel() {
        if (!carouselTrack || indicators.length === 0) {
            console.warn('Carousel elements not found');
            return;
        }

        // Start auto-play
        startAutoPlay();

        // Set initial state
        updateCarousel();
    }

    // Auto-play functions
    function startAutoPlay() {
        if (autoPlayInterval) clearInterval(autoPlayInterval);
        autoPlayInterval = setInterval(nextSlide, 5000);
    }

    function stopAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
            autoPlayInterval = null;
        }
    }

    // Pause auto-play on hover
    const carouselContainer = document.querySelector('.carousel-container');
    if (carouselContainer) {
        carouselContainer.addEventListener('mouseenter', stopAutoPlay);
        carouselContainer.addEventListener('mouseleave', startAutoPlay);

        // Also pause on focus for accessibility
        carouselContainer.addEventListener('focusin', stopAutoPlay);
        carouselContainer.addEventListener('focusout', startAutoPlay);
    }

    // Update carousel display
    function updateCarousel() {
        if (!carouselTrack) return;

        try {
            carouselTrack.style.transform = `translateX(-${currentSlide * 100}%)`;

            // Update indicators
            indicators.forEach((indicator, index) => {
                if (index === currentSlide) {
                    indicator.classList.add('active');
                    indicator.setAttribute('aria-current', 'true');
                } else {
                    indicator.classList.remove('active');
                    indicator.removeAttribute('aria-current');
                }
            });
        } catch (error) {
            console.error('Error updating carousel:', error);
        }
    }

    // Navigation functions
    window.nextSlide = function() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    };

    window.previousSlide = function() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel();
    };

    window.goToSlide = function(slideIndex) {
        if (slideIndex >= 0 && slideIndex < totalSlides) {
            currentSlide = slideIndex;
            updateCarousel();
        }
    };

    // Touch/swipe support for mobile
    let startX = 0;
    let endX = 0;
    let isDragging = false;

    if (carouselContainer) {
        // Touch events
        carouselContainer.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            isDragging = true;
            stopAutoPlay();
        }, { passive: true });

        carouselContainer.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
        }, { passive: false });

        carouselContainer.addEventListener('touchend', (e) => {
            if (!isDragging) return;
            endX = e.changedTouches[0].clientX;
            handleSwipe();
            isDragging = false;
            startAutoPlay();
        }, { passive: true });

        // Mouse events for desktop drag
        carouselContainer.addEventListener('mousedown', (e) => {
            startX = e.clientX;
            isDragging = true;
            stopAutoPlay();
            e.preventDefault();
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
        });

        document.addEventListener('mouseup', (e) => {
            if (!isDragging) return;
            endX = e.clientX;
            handleSwipe();
            isDragging = false;
            startAutoPlay();
        });
    }

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = startX - endX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                previousSlide();
            }
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        // Only handle arrow keys when carousel is in focus or no other element is focused
        const activeElement = document.activeElement;
        const isInputFocused = activeElement && (
            activeElement.tagName === 'INPUT' ||
            activeElement.tagName === 'TEXTAREA' ||
            activeElement.tagName === 'SELECT'
        );

        if (!isInputFocused) {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                previousSlide();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                nextSlide();
            }
        }
    });

    // Initialize carousel when DOM is ready
    initCarousel();

    // Audit Trail functionality
    window.toggleAuditTrail = function() {
        const content = document.getElementById('audit-trail-content');
        const arrow = document.getElementById('audit-trail-arrow');
        const toggle = document.getElementById('audit-trail-toggle');

        if (!content || !arrow) return;

        const isHidden = content.classList.contains('hidden');

        if (isHidden) {
            // Show audit trail
            content.classList.remove('hidden');
            arrow.style.transform = 'rotate(180deg)';
            toggle.classList.add('text-primary-600');

            // Animate content appearance
            content.style.opacity = '0';
            content.style.transform = 'translateY(-10px)';

            requestAnimationFrame(() => {
                content.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                content.style.opacity = '1';
                content.style.transform = 'translateY(0)';
            });
        } else {
            // Hide audit trail
            content.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            content.style.opacity = '0';
            content.style.transform = 'translateY(-10px)';

            setTimeout(() => {
                content.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
                toggle.classList.remove('text-primary-600');
            }, 300);
        }
    };

    // Auto-update progress simulation (for demo purposes)
    function simulateProgressUpdate() {
        const progressBar = document.querySelector('.animate-progress');
        const amountElement = document.querySelector('.text-2xl.font-bold');
        const percentageElement = document.querySelector('.text-lg.font-semibold');

        if (!progressBar || !amountElement || !percentageElement) return;

        // Simulate small progress updates
        setInterval(() => {
            const currentAmount = parseInt(amountElement.textContent.replace(/[^\d]/g, ''));
            const goalAmount = 62000;
            const increment = Math.floor(Math.random() * 100) + 50; // Random increment 50-150

            if (currentAmount < goalAmount) {
                const newAmount = Math.min(currentAmount + increment, goalAmount);
                const newPercentage = Math.round((newAmount / goalAmount) * 100);

                // Update display with animation
                amountElement.style.transition = 'all 0.5s ease';
                amountElement.textContent = `RM ${newAmount.toLocaleString()}`;

                percentageElement.style.transition = 'all 0.5s ease';
                percentageElement.textContent = `${newPercentage}%`;

                progressBar.style.width = `${newPercentage}%`;

                // Add pulse effect
                amountElement.classList.add('animate-pulse');
                percentageElement.classList.add('animate-pulse');

                setTimeout(() => {
                    amountElement.classList.remove('animate-pulse');
                    percentageElement.classList.remove('animate-pulse');
                }, 1000);
            }
        }, 30000); // Update every 30 seconds
    }

    // Initialize progress simulation (comment out for production)
    // simulateProgressUpdate();

    // Real-time progress tracking (for production use)
    function trackProgressUpdate(amount, donorCount, percentage) {
        const progressBar = document.querySelector('.animate-progress');
        const amountElement = document.querySelector('.text-2xl.font-bold');
        const percentageElement = document.querySelector('.text-lg.font-semibold');
        const donorElement = document.querySelector('span:contains("donors")');

        if (progressBar) progressBar.style.width = `${percentage}%`;
        if (amountElement) amountElement.textContent = `RM ${amount.toLocaleString()}`;
        if (percentageElement) percentageElement.textContent = `${percentage}%`;
        if (donorElement) donorElement.textContent = `${donorCount} donors`;

        // Add audit trail entry
        addAuditTrailEntry({
            type: 'donation',
            message: 'New donation received',
            amount: amount,
            percentage: percentage,
            timestamp: new Date()
        });
    }

    // Add new audit trail entry
    function addAuditTrailEntry(entry) {
        const auditContent = document.getElementById('audit-trail-content');
        const progressSection = auditContent?.querySelector('.space-y-3');

        if (!progressSection) return;

        const entryElement = document.createElement('div');
        entryElement.className = 'flex items-start space-x-3';
        entryElement.innerHTML = `
            <div class="w-2 h-2 bg-primary-500 rounded-full mt-2 flex-shrink-0"></div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">${entry.message}</p>
                    <span class="text-xs text-gray-500">Just now</span>
                </div>
                <p class="text-xs text-gray-600">+RM ${entry.amount?.toLocaleString()} • Progress: ${entry.percentage}%</p>
            </div>
        `;

        // Add to top of list
        progressSection.insertBefore(entryElement, progressSection.firstChild);

        // Keep only last 5 entries
        const entries = progressSection.children;
        if (entries.length > 5) {
            progressSection.removeChild(entries[entries.length - 1]);
        }

        // Animate new entry
        entryElement.style.opacity = '0';
        entryElement.style.transform = 'translateX(-20px)';

        requestAnimationFrame(() => {
            entryElement.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            entryElement.style.opacity = '1';
            entryElement.style.transform = 'translateX(0)';
        });
    }

    // Expose functions for external use
    window.trackProgressUpdate = trackProgressUpdate;
    window.addAuditTrailEntry = addAuditTrailEntry;
});
</script>
@endpush
