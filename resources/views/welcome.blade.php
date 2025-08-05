@extends('layouts.master')

@section('title', __('app.site_name') . ' - ' . __('app.islamic_crowdfunding_platform'))
@section('description', __('app.site_description'))

@section('content')

        @include('components.hero-section', [
            'badge' => [
                'text' => __('app.welcome_to_jariah_fund'),
                'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            ],
            'title' => __('app.making_a_difference'),
            'subtitle' => __('app.in_every_donation'),
            'description' => __('app.making_a_difference_description'),
            'highlights' => [
                ['text' => __('app.every_donation_counts'), 'delay' => '0.6s'],
                ['text' => __('app.changing_lives_together'), 'delay' => '0.8s'],
                ['text' => __('app.helping_communities_thrive'), 'delay' => '1.0s']
            ],
            'pills' => [
                ['text' => __('app.shariah_compliant'), 'delay' => '0.7s'],
                ['text' => __('app.no_admin_fees'), 'delay' => '0.8s'],
                ['text' => __('app.full_transparency'), 'delay' => '0.9s']
            ],
            'cta_buttons' => [
                ['text' => __('app.support_a_cause'), 'url' => url('/donate'), 'type' => 'primary'],
                ['text' => __('app.learn_more'), 'url' => url('/about'), 'type' => 'secondary']
            ]
        ])

        <!-- Featured Campaigns Section -->
        <section id="campaigns" class="py-12 md:py-16 lg:py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                        {{ __('app.featured') }} <span class="text-primary-500">{{ __('app.campaigns') }}</span>
                    </h2>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ __('app.support_verified_campaigns') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    <!-- Campaign 1 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <img src="{{ asset('assets/images/campaigns/01.jpg') }}" class="w-full h-48 object-cover">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center mb-3">
                                <img src="{{ asset('assets/images/charity/yayasanmuslim.png') }}"
                                     alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                                <span class="text-xs md:text-sm text-gray-600">{{ __('app.yayasan_muslimin') }}</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">{{ __('app.vision_for_education_program') }}</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                                {{ __('app.vision_program_short_description') }}
                            </p>

                            <!-- Progress Bar -->
                            <div class="mb-3 md:mb-4">
                                <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                    <span>{{ __('app.amount_raised', ['amount' => 'RM 45,230']) }}</span>
                                    <span>{{ __('app.percent_of_goal', ['percent' => '73', 'goal' => 'RM 62,000']) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[73%]"></div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-xs md:text-sm text-gray-500">{{ __('app.donor_count', ['count' => '234']) }}</span>
                                <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                    {{ __('app.donate_now') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign 2 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <img src="{{ asset('assets/images/campaigns/mab_project.jpg') }}"
                             alt="Clean Water Project" class="w-full h-48 object-cover">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center mb-3">
                                <img src="{{ asset('assets/images/charity/yayasanikhlas.png') }}"
                                     alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                                <span class="text-xs md:text-sm text-gray-600">{{ __('app.yayasan_ikhlas') }}</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">{{ __('app.clean_water_wells') }}</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                                {{ __('app.clean_water_short_description') }}
                            </p>

                            <!-- Progress Bar -->
                            <div class="mb-3 md:mb-4">
                                <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                    <span>{{ __('app.amount_raised', ['amount' => 'RM 28,450']) }}</span>
                                    <span>{{ __('app.percent_of_goal', ['percent' => '57', 'goal' => 'RM 50,000']) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[57%]"></div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-xs md:text-sm text-gray-500">{{ __('app.donor_count', ['count' => '156']) }}</span>
                                <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                    {{ __('app.donate_now') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign 3 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                             alt="Orphan Education" class="w-full h-48 object-cover">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center mb-3">
                                <img src="{{ asset('assets/images/charity/nasom.png') }}"
                                     alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                                <span class="text-xs md:text-sm text-gray-600">{{ __('app.nasom') }}</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">{{ __('app.education_for_orphans') }}</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                                {{ __('app.education_orphans_short_description') }}
                            </p>

                            <!-- Progress Bar -->
                            <div class="mb-3 md:mb-4">
                                <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                    <span>{{ __('app.amount_raised', ['amount' => 'RM 18,750']) }}</span>
                                    <span>{{ __('app.percent_of_goal', ['percent' => '62', 'goal' => 'RM 30,000']) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[62%]"></div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-xs md:text-sm text-gray-500">{{ __('app.donor_count', ['count' => '89']) }}</span>
                                <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                    {{ __('app.donate_now') }}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- View All Campaigns Button -->
                <div class="text-center mt-8 md:mt-12">
                    <a href="{{ url('/all-campaigns') }}" class="inline-flex items-center px-6 py-3 md:px-8 md:py-4 bg-white border-2 border-primary-500 text-primary-500 font-semibold rounded-lg hover:bg-primary-500 hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        {{ __('app.view_all') }} {{ __('app.campaigns') }}
                        <svg class="w-4 h-4 md:w-5 md:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- News and Events Section -->
        <section class="py-12 md:py-16 lg:py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                        {{ __('app.news') }} & <span class="text-primary-500">{{ __('app.events') }}</span>
                    </h2>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto">
                        {{ __('app.stay_updated_with_latest') }}
                    </p>
                </div>

                <!-- Featured News -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 mb-12 md:mb-16">
                    <!-- Main News Article -->
                    @if(isset($featuredNews) && $featuredNews)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                        @if($featuredNews->image_path)
                            <img src="{{ asset('storage/' . $featuredNews->image_path) }}"
                                 alt="{{ $featuredNews->title }}" class="w-full h-48 md:h-64 object-cover">
                        @else
                            <img src="{{ asset('assets/images/news/success.jpg') }}"
                                 alt="{{ $featuredNews->title }}" class="w-full h-48 md:h-64 object-cover">
                        @endif
                        <div class="p-6 md:p-8">
                            <div class="flex items-center mb-3">
                                <span class="bg-primary-100 text-primary-600 px-3 py-1 rounded-full text-xs md:text-sm font-medium">
                                    {{ ucfirst($featuredNews->category) }}
                                </span>
                                <span class="text-gray-500 text-xs md:text-sm ml-3">
                                    {{ $featuredNews->published_at ? $featuredNews->published_at->format('F j, Y') : $featuredNews->created_at->format('F j, Y') }}
                                </span>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4">{{ $featuredNews->title }}</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6 leading-relaxed">
                                {{ $featuredNews->excerpt ?: Str::limit(strip_tags($featuredNews->content), 150) }}
                            </p>
                            <a href="{{ url('/news') }}" class="inline-flex items-center text-primary-500 font-medium hover:text-primary-600 transition-colors text-sm md:text-base">
                                {{ __('app.read_more') }}
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @else
                    <!-- Fallback static content if no news -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                        <img src="{{ asset('assets/images/news/success.jpg') }}"
                             alt="Community Event" class="w-full h-48 md:h-64 object-cover">
                        <div class="p-6 md:p-8">
                            <div class="flex items-center mb-3">
                                <span class="bg-primary-100 text-primary-600 px-3 py-1 rounded-full text-xs md:text-sm font-medium">{{ __('app.latest_news') }}</span>
                                <span class="text-gray-500 text-xs md:text-sm ml-3">{{ __('app.december_15_2024') }}</span>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4">{{ __('app.jariah_fund_milestone') }}</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6 leading-relaxed">
                                {{ __('app.milestone_description') }}
                            </p>
                            <a href="{{ url('/news') }}" class="inline-flex items-center text-primary-500 font-medium hover:text-primary-600 transition-colors text-sm md:text-base">
                                {{ __('app.read_more') }}
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Recent News Highlights -->
                    <div class="space-y-6">
                        @if(isset($recentNews) && $recentNews->count() > 0)
                            @foreach($recentNews as $news)
                            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                                <div class="flex items-start space-x-4">
                                    @if($news->image_path)
                                        <img src="{{ asset('storage/' . $news->image_path) }}"
                                             alt="{{ $news->title }}" class="w-20 h-20 rounded-lg object-cover flex-shrink-0">
                                    @else
                                        <img src="{{ asset('assets/images/news/success.jpg') }}"
                                             alt="{{ $news->title }}" class="w-20 h-20 rounded-lg object-cover flex-shrink-0">
                                    @endif
                                    <div>
                                        <div class="flex items-center mb-2">
                                            @if($news->category === 'event')
                                                <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded-full text-xs font-medium">{{ __('app.event') }}</span>
                                            @elseif($news->category === 'announcement')
                                                <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs font-medium">{{ __('app.announcement') }}</span>
                                            @else
                                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-medium">{{ __('app.news') }}</span>
                                            @endif
                                            <span class="text-gray-500 text-xs ml-2">
                                                {{ $news->published_at ? $news->published_at->format('M j, Y') : $news->created_at->format('M j, Y') }}
                                            </span>
                                        </div>
                                        <h4 class="font-semibold text-gray-900 text-base mb-1">{{ $news->title }}</h4>
                                        <p class="text-xs text-gray-600 mb-2">{{ $news->excerpt ?: Str::limit(strip_tags($news->content), 80) }}</p>
                                        <a href="{{ url('/news') }}" class="inline-flex items-center text-primary-500 hover:text-primary-600 text-xs font-medium">
                                            {{ __('app.learn_more') }}
                                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <!-- Fallback static content if no recent news -->
                            <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                                <div class="flex items-start space-x-4">
                                    <img src="{{ asset('assets/images/news/success.jpg') }}"
                                         alt="Workshop" class="w-20 h-20 rounded-lg object-cover flex-shrink-0">
                                    <div>
                                        <div class="flex items-center mb-2">
                                            <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded-full text-xs font-medium">{{ __('app.event') }}</span>
                                            <span class="text-gray-500 text-xs ml-2">{{ __('app.january_10_2025') }}</span>
                                        </div>
                                        <h4 class="font-semibold text-gray-900 text-base mb-1">{{ __('app.financial_literacy_workshop') }}</h4>
                                        <p class="text-xs text-gray-600 mb-2">{{ __('app.workshop_description') }}</p>
                                        <a href="{{ url('/news') }}" class="inline-flex items-center text-primary-500 hover:text-primary-600 text-xs font-medium">
                                            {{ __('app.learn_more') }}
                                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- View All News Button -->
                <div class="text-center">
                    <a href="{{ url('/news') }}" class="inline-flex items-center px-6 py-3 md:px-8 md:py-4 bg-white border-2 border-primary-500 text-primary-500 font-semibold rounded-lg hover:bg-primary-500 hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        {{ __('app.view_all') }} {{ __('app.news') }}
                        <svg class="w-4 h-4 md:w-5 md:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Photo Gallery Slider -->
        <div class="mb-8 md:mb-12">
            <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 md:mb-8 text-center">Photo Gallery</h3>

            <!-- Gallery Slider Container -->
            <div class="relative max-w-4xl mx-auto">
                <!-- Slider Wrapper -->
                <div class="overflow-hidden rounded-xl">
                    <div id="gallery-slider" class="flex transition-transform duration-500 ease-in-out">
                        <!-- Slide 1 -->
                        <div class="w-full flex-shrink-0">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                                <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Community Gathering" data-description="Local community members coming together for a charity event">
                                    <img src="{{ asset('assets/images/campaigns/map_01.jpg') }}"
                                         alt="Community gathering" class="w-full h-32 md:h-40 object-cover">
                                </div>
                                <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="{{ asset('assets/images/gallery/food-distribution.svg') }}" data-title="Food Distribution" data-description="Volunteers distributing food packages to families in need">
                                    <img src="{{ asset('assets/images/campaigns/map_02.jpg') }}"
                                         alt="Food distribution" class="w-full h-32 md:h-40 object-cover">
                                </div>
                                <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="{{ asset('assets/images/campaigns/education-initiative.svg') }}" data-title="Education Program" data-description="Children attending classes in our newly built school">
                                    <img src="{{ asset('assets/images/campaigns/mab_01.jpg') }}"
                                         alt="Education program" class="w-full h-32 md:h-40 object-cover">
                                </div>
                                <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Healthcare Service" data-description="Mobile clinic providing medical care to remote communities">
                                    <img src="{{ asset('assets/images/campaigns/mab_02.jpg') }}"
                                         alt="Healthcare service" class="w-full h-32 md:h-40 object-cover">
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="w-full flex-shrink-0">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                                <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Water Well Project" data-description="New water well providing clean water to rural village">
                                    <img src="{{ asset('assets/images/campaigns/mab_03.jpg') }}"
                                         alt="Water well project" class="w-full h-32 md:h-40 object-cover">
                                </div>
                                <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Skills Training" data-description="Vocational training program for young adults">
                                    <img src="{{ asset('assets/images/campaigns/02.jpg') }}"
                                         alt="Skills training" class="w-full h-32 md:h-40 object-cover">
                                </div>
                                <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Orphan Support" data-description="Supporting orphaned children with education and care">
                                    <img src="{{ asset('assets/images/campaigns/03.jpg') }}"
                                         alt="Orphan support" class="w-full h-32 md:h-40 object-cover">
                                </div>
                                <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Mosque Construction" data-description="Building new mosque for the local community">
                                    <img src="{{ asset('assets/images/campaigns/04.jpg') }}"
                                    <img src="{{ asset('assets/images/campaigns/04.jpg') }}') }}"
                                         alt="Mosque construction" class="w-full h-32 md:h-40 object-cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button id="gallery-prev" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button id="gallery-next" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 p-3 rounded-full shadow-lg transition-all duration-300 hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Slide Indicators -->
                <div class="flex justify-center mt-6 space-x-2">
                    <button class="gallery-indicator w-3 h-3 rounded-full bg-primary-500 transition-all duration-300" data-slide="0"></button>
                    <button class="gallery-indicator w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400 transition-all duration-300" data-slide="1"></button>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <section id="about" class="py-12 md:py-16 lg:py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- About Content -->
                    <div class="space-y-6">
                        <div class="space-y-4">
                            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">
                                {{ __('app.about_jariah_fund') }}
                            </h2>
                            <p class="text-base md:text-lg text-gray-600 leading-relaxed">
                                {{ __('app.about_jariah_fund_description') }}
                            </p>
                            <p class="text-base md:text-lg text-gray-600 leading-relaxed">
                                {{ __('app.about_jariah_fund_description_2') }}
                            </p>
                        </div>

                        <!-- Key Features -->
                        <div class="space-y-4">
                            <h3 class="text-lg md:text-xl font-semibold text-gray-900">{{ __('app.why_choose_jariah_fund') }}</h3>
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-primary-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm md:text-base font-medium text-gray-900">{{ __('app.100_transparent_verified') }}</h4>
                                        <p class="text-xs md:text-sm text-gray-600">{{ __('app.all_campaigns_vetted') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-primary-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm md:text-base font-medium text-gray-900">{{ __('app.shariah_compliant_giving') }}</h4>
                                        <p class="text-xs md:text-sm text-gray-600">{{ __('app.all_donations_follow_islamic') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div class="w-6 h-6 bg-primary-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm md:text-base font-medium text-gray-900">{{ __('app.trusted_by_bank_muamalat') }}</h4>
                                        <p class="text-xs md:text-sm text-gray-600">{{ __('app.backed_by_malaysias_leading') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <div class="pt-4">
                            <a href="{{ url('/about') }}" class="inline-flex items-center px-6 py-3 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-sm md:text-base">
                                {{ __('app.learn_more_about_us') }}
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Mission Card -->
                    <div class="relative">
                        <div class="rounded-2xl p-6 md:p-8 text-white bg-primary-500">
                            <div class="space-y-4 md:space-y-6">
                                <h3 class="text-xl md:text-2xl font-bold">{{ __('app.our_mission_heading') }}</h3>
                                <p class="text-primary-100 leading-relaxed text-sm md:text-base">
                                    {{ __('app.our_mission_description') }}
                                </p>
                                <div class="grid grid-cols-2 gap-3 md:gap-4 pt-2 md:pt-4">
                                    <div class="text-center">
                                        <div class="text-2xl md:text-3xl font-bold">RM 167K+</div>
                                        <div class="text-primary-200 text-xs md:text-sm">{{ __('app.total_raised_label') }}</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl md:text-3xl font-bold">2,564</div>
                                        <div class="text-primary-200 text-xs md:text-sm">{{ __('app.beneficiaries_label') }}</div>
                                    </div>
                                </div>

                                <!-- Islamic Quote -->
                                <div class="bg-primary-600 rounded-lg p-3 md:p-4 border-l-4 border-white">
                                    <p class="text-xs md:text-sm text-primary-100 italic leading-relaxed">
                                        "{{ __('app.islamic_quote') }}"
                                    </p>
                                    <p class="text-xs text-primary-200 font-medium mt-2">{{ __('app.prophet_muhammad') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

@push('styles')
<style>
/* Hero Animation Keyframes */
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-20px) rotate(1deg); }
    66% { transform: translateY(-10px) rotate(-1deg); }
}

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
        box-shadow: 0 0 0 0 rgba(254, 81, 0, 0.4);
    }
    50% {
        box-shadow: 0 0 0 10px rgba(254, 81, 0, 0);
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

/* Animation Classes */
.animate-float {
    animation: float 6s ease-in-out infinite;
}

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
</style>
@endpush

@push('scripts')
<!-- Photo Gallery Modal -->
<div id="gallery-modal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 items-center justify-center p-4">
    <div class="relative max-w-4xl w-full">
        <button id="close-gallery-modal" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="modal-image" src="" alt="" class="w-full h-auto rounded-lg">
        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 rounded-b-lg">
            <h3 id="modal-title" class="text-white text-xl font-bold mb-2"></h3>
            <p id="modal-description" class="text-gray-200"></p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gallery Slider Functionality
    const gallerySlider = document.getElementById('gallery-slider');
    const galleryPrev = document.getElementById('gallery-prev');
    const galleryNext = document.getElementById('gallery-next');
    const galleryIndicators = document.querySelectorAll('.gallery-indicator');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const galleryModal = document.getElementById('gallery-modal');
    const modalImage = document.getElementById('modal-image');
    const modalTitle = document.getElementById('modal-title');
    const modalDescription = document.getElementById('modal-description');
    const closeGalleryModal = document.getElementById('close-gallery-modal');

    let currentSlide = 0;
    const totalSlides = 2;

    // Update slider position
    function updateSlider() {
        gallerySlider.style.transform = `translateX(-${currentSlide * 100}%)`;

        // Update indicators
        galleryIndicators.forEach((indicator, index) => {
            if (index === currentSlide) {
                indicator.classList.remove('bg-gray-300');
                indicator.classList.add('bg-primary-500');
            } else {
                indicator.classList.remove('bg-primary-500');
                indicator.classList.add('bg-gray-300');
            }
        });
    }

    // Previous slide
    galleryPrev.addEventListener('click', function() {
        currentSlide = currentSlide > 0 ? currentSlide - 1 : totalSlides - 1;
        updateSlider();
    });

    // Next slide
    galleryNext.addEventListener('click', function() {
        currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0;
        updateSlider();
    });

    // Indicator clicks
    galleryIndicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            currentSlide = index;
            updateSlider();
        });
    });

    // Auto-slide every 5 seconds
    setInterval(function() {
        currentSlide = currentSlide < totalSlides - 1 ? currentSlide + 1 : 0;
        updateSlider();
    }, 5000);

    // Gallery item clicks (open modal)
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const imageSrc = this.dataset.image;
            const title = this.dataset.title;
            const description = this.dataset.description;

            modalImage.src = imageSrc;
            modalTitle.textContent = title;
            modalDescription.textContent = description;
            galleryModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close modal
    closeGalleryModal.addEventListener('click', function() {
        galleryModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });

    // Close modal when clicking outside
    galleryModal.addEventListener('click', function(e) {
        if (e.target === galleryModal) {
            galleryModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });

    // Contact interactions
    window.openMap = function() {
        const address = "Menara Muamalat, No. 22, Jalan Melaka, Kuala Lumpur, Malaysia 50100";
        const encodedAddress = encodeURIComponent(address);
        window.open(`https://www.google.com/maps/search/?api=1&query=${encodedAddress}`, '_blank');
    };

    window.callPhone = function() {
        window.location.href = 'tel:+60321612000';
    };

    window.sendEmail = function() {
        window.location.href = 'mailto:info@jariahfund.com?subject=Inquiry from Jariah Fund Website';
    };
});
</script>
@endpush