@extends('layouts.master')

@section('title', __('app.all_campaigns') . ' - Jariah Fund')
@section('description', 'Browse all our campaigns and find meaningful causes to support. Every donation makes a difference through Shariah-compliant giving.')

@section('content')
    <!-- Hero Section -->
    @include('components.hero-section', [
        'badge' => [
            'text' => __('app.all_campaigns'),
            'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'
        ],
        'title' => __('app.make_a_lasting'),
        'subtitle' => __('app.impact_through_giving'),
        'description' => __('app.browse_our_full_range'),
        'highlights' => [
            ['text' => 'complete transparency', 'delay' => '0.6s'],
            ['text' => 'meaningful impact', 'delay' => '0.8s']
        ],
        'pills' => [
            ['text' => '100% Shariah-Compliant', 'delay' => '0.7s'],
            ['text' => 'Fully Verified Causes', 'delay' => '0.8s'],
            ['text' => 'Zero Platform Fees', 'delay' => '0.9s']
        ],
        
    ])

    <!-- Campaigns Grid Section -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filters (optional) -->
            <div class="mb-8 flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900">
                        {{ __('app.supporting_worthy_causes') }}
                    </h2>
                </div>
                <div class="flex items-center space-x-4">
                    <select class="bg-white border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="all">{{ __('app.all_categories') }}</option>
                        <option value="education">{{ __('app.education') }}</option>
                        <option value="healthcare">{{ __('app.healthcare') }}</option>
                        <option value="community">{{ __('app.community') }}</option>
                        <option value="emergency">{{ __('app.emergency_relief') }}</option>
                    </select>
                    <select class="bg-white border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="newest">{{ __('app.newest_first') }}</option>
                        <option value="oldest">{{ __('app.oldest_first') }}</option>
                        <option value="goal">{{ __('app.highest_goal') }}</option>
                        <option value="percent">{{ __('app.highest_percent_complete') }}</option>
                    </select>
                </div>
            </div>

            <!-- Campaigns Grid - 3x3 Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10 lg:gap-12">
                <!-- Campaign 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <img src="{{ asset('assets/images/campaigns/01.jpg') }}" class="w-full h-48 object-cover">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('assets/images/charity/yayasanmuslim.png') }}" alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                            <span class="text-xs md:text-sm text-gray-600">Yayasan Muslimin</span>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Vision for Education Program</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                            The Vision for Education Program aims to help school students from asnaf and B40 groups who face vision problems.
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-3 md:mb-4">
                            <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                <span>RM 45,230 raised</span>
                                <span>73% of RM 62,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[73%]"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-500">234 donors</span>
                            <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                {{ __('app.donate_now') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <img src="{{ asset('assets/images/campaigns/mab_project.jpg') }}" alt="Clean Water Project" class="w-full h-48 object-cover">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('assets/images/charity/yayasanikhlas.png') }}" alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                            <span class="text-xs md:text-sm text-gray-600">Yayasan Ikhlas</span>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Clean Water Wells for Rural Communities</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                            Build sustainable water wells in remote villages to provide clean, safe drinking water for families.
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-3 md:mb-4">
                            <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                <span>RM 28,450 raised</span>
                                <span>57% of RM 50,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[57%]"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-500">156 donors</span>
                            <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                {{ __('app.donate_now') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <img src="{{ asset('assets/images/campaigns/03.jpg') }}" alt="Orphan Education" class="w-full h-48 object-cover">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('assets/images/charity/nasom.png') }}" alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                            <span class="text-xs md:text-sm text-gray-600">NASOM</span>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Education Support for Orphaned Children</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                            Sponsor the education of orphaned children by providing school supplies, uniforms, and tuition fees.
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-3 md:mb-4">
                            <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                <span>RM 18,750 raised</span>
                                <span>62% of RM 30,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[62%]"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-500">89 donors</span>
                            <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                {{ __('app.donate_now') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign 4 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <img src="{{ asset('assets/images/campaigns/04.jpg') }}" alt="Mosque Renovation" class="w-full h-48 object-cover">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('assets/images/charity/yayasanmuslim.png') }}" alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                            <span class="text-xs md:text-sm text-gray-600">Islamic Relief</span>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Rural Mosque Renovation Project</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                            Help renovate an old mosque in a rural community that serves as both a place of worship and community center.
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-3 md:mb-4">
                            <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                <span>RM 82,150 raised</span>
                                <span>54% of RM 150,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[54%]"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-500">312 donors</span>
                            <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                {{ __('app.donate_now') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign 5 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <img src="{{ asset('assets/images/campaigns/mab_01.jpg') }}" alt="Medical Aid" class="w-full h-48 object-cover">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('assets/images/charity/yayasanikhlas.png') }}" alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                            <span class="text-xs md:text-sm text-gray-600">Malaysian Red Crescent</span>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Emergency Medical Aid for Flood Victims</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                            Provide emergency medical support to communities affected by recent flooding in East Coast Malaysia.
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-3 md:mb-4">
                            <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                <span>RM 36,890 raised</span>
                                <span>92% of RM 40,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[92%]"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-500">205 donors</span>
                            <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                {{ __('app.donate_now') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign 6 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <img src="{{ asset('assets/images/campaigns/mab_02.jpg') }}" alt="Food Security" class="w-full h-48 object-cover">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('assets/images/charity/nasom.png') }}" alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                            <span class="text-xs md:text-sm text-gray-600">Food Aid Foundation</span>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Food Security Initiative for Urban Poor</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                            Support food banks and community kitchens providing meals to urban poor families in Kuala Lumpur.
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-3 md:mb-4">
                            <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                <span>RM 12,780 raised</span>
                                <span>25% of RM 50,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[25%]"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-500">97 donors</span>
                            <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                {{ __('app.donate_now') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign 7 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <img src="{{ asset('assets/images/campaigns/mab_03.jpg') }}" alt="Micro Business" class="w-full h-48 object-cover">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('assets/images/charity/yayasanmuslim.png') }}" alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                            <span class="text-xs md:text-sm text-gray-600">Amanah Ikhtiar Malaysia</span>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Micro-Business Grants for Single Mothers</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                            Help single mothers start small businesses with micro-grants, training, and ongoing mentorship.
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-3 md:mb-4">
                            <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                <span>RM 33,450 raised</span>
                                <span>67% of RM 50,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[67%]"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-500">178 donors</span>
                            <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                {{ __('app.donate_now') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign 8 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <img src="{{ asset('assets/images/campaigns/map_01.jpg') }}" alt="School Construction" class="w-full h-48 object-cover">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('assets/images/charity/yayasanikhlas.png') }}" alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                            <span class="text-xs md:text-sm text-gray-600">Yayasan Pendidikan Islam</span>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Rural School Construction Project</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                            Build a new school facility in a remote village to provide education access to underserved children.
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-3 md:mb-4">
                            <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                <span>RM 105,230 raised</span>
                                <span>42% of RM 250,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[42%]"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-500">345 donors</span>
                            <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                {{ __('app.donate_now') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Campaign 9 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <img src="{{ asset('assets/images/campaigns/map_02.jpg') }}" alt="Tech Education" class="w-full h-48 object-cover">
                    <div class="p-4 md:p-6">
                        <div class="flex items-center mb-3">
                            <img src="{{ asset('assets/images/charity/nasom.png') }}" alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                            <span class="text-xs md:text-sm text-gray-600">Digital Future Malaysia</span>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Tech Education for Rural Youth</h3>
                        <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed">
                            Provide computers, internet access, and digital skills training to youth in rural communities.
                        </p>

                        <!-- Progress Bar -->
                        <div class="mb-3 md:mb-4">
                            <div class="flex justify-between text-xs md:text-sm text-gray-600 mb-2">
                                <span>RM 22,340 raised</span>
                                <span>45% of RM 50,000</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[45%]"></div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-500">137 donors</span>
                            <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                {{ __('app.donate_now') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Pagination Section -->
    <section class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-center">
                <div class="flex justify-between space-x-4 sm:hidden">
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 shadow-sm">
                        Previous
                    </a>
                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 shadow-sm">
                        Next
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:justify-center">
                    <div>
                        <span class="relative z-0 inline-flex shadow-md rounded-md mx-auto">
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" aria-current="page" class="z-10 bg-primary-50 border-primary-500 text-primary-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium mx-0.5">
                                1
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium mx-0.5">
                                2
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium mx-0.5">
                                3
                            </a>
                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 mx-0.5">
                                ...
                            </span>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium mx-0.5">
                                8
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium mx-0.5">
                                9
                            </a>
                            <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium mx-0.5">
                                10
                            </a>
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </span>
                    </div>
                </div>
            </nav>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 md:py-16 bg-primary-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                Ready to Make a Difference?
            </h2>
            <p class="text-base md:text-lg text-white opacity-90 max-w-3xl mx-auto mb-8">
                Join thousands of donors who are changing lives through Shariah-compliant giving. 
                100% of your donation goes directly to your chosen cause.
            </p>
            
        </div>
    </section>
@endsection 