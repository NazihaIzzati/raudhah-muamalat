@extends('layouts.master')

@section('title', 'Campaigns - Jariah Fund')
@section('description', 'Support meaningful campaigns that make a real difference in communities worldwide. Every donation is tracked and transparent.')

@section('content')

        @include('components.hero-section', [
            'badge' => [
                'text' => 'Our Campaigns',
                'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>'
            ],
            'title' => 'Empowering Communities',
            'subtitle' => 'Through Trusted Giving',
            'description' => 'Join thousands of donors supporting <strong>verified campaigns</strong> that make a real difference in communities worldwide. Each campaign is thoroughly vetted to ensure',
            'highlights' => [
                ['text' => 'complete transparency', 'delay' => '0.6s'],
                ['text' => 'effective impact', 'delay' => '0.8s']
            ],
            'pills' => [
                ['text' => '100% Secure', 'delay' => '0.7s'],
                ['text' => 'Tax Deductible', 'delay' => '0.8s'],
                ['text' => 'Transparent & Trusted', 'delay' => '0.9s']
            ]
        ])



        <!-- Featured Campaigns Section -->
        <section id="campaigns" class="py-12 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-8 gap-3">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Featured Campaigns</h2>
                    <a href="#" class="text-primary-500 font-medium hover:text-primary-600 text-sm md:text-base">View all</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    <!-- Campaign Card 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <img src="../images/campaigns/01.jpg" class="w-full h-40 md:h-48 object-cover">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center mb-3">
                                <img src="../images/charity/yayasanmuslim.png"
                                     alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                                <span class="text-xs md:text-sm text-gray-600">Yayasan Muslimin</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Vision for Education Program</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed line-clamp-3">
                                The Vision for Education Program is an initiative under PruBSN Prihatin that aims to help school students from asnaf and B40 groups who face vision problems. Beneficiaries will undergo free eye examinations, and if they require glasses or further examination, full assistance will be provided at no cost to them.
                            </p>
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
                                    Donate Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="../images/campaigns/mab_project.jpg" 
                             alt="Clean Water Project" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <img src="../images/charity/yayasanikhlas.png" 
                                     alt="Organization" class="w-8 h-8 rounded-full mr-3">
                                <span class="text-sm text-gray-600">Yayasan Ikhlas</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Clean Water Wells for Rural Communities</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                Build sustainable water wells in remote villages to provide clean, safe drinking water 
                                for families who currently walk hours to access water.
                            </p>
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>RM 28,450 raised</span>
                                    <span>57% of RM 50,000</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full w-[57%]"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">156 donors</span>
                                <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-600 transition-colors">
                                    Donate Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 3 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             alt="Orphan Education" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <img src="../images/charity/nasom.png" 
                                     alt="Organization" class="w-8 h-8 rounded-full mr-3">
                                <span class="text-sm text-gray-600">NASOM</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Education Support for Orphaned Children</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                Sponsor the education of orphaned children by providing school supplies, uniforms, 
                                and tuition fees to ensure they have access to quality education.
                            </p>
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-2">
                                    <span>RM 18,750 raised</span>
                                    <span>62% of RM 30,000</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full w-[62%]"></div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">89 donors</span>
                                <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-600 transition-colors">
                                    Donate Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Successful Campaigns Section -->
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-8 gap-3">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Successful Campaigns</h2>
                    <a href="#" class="text-primary-500 font-medium hover:text-primary-600 text-sm md:text-base">View all</a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Successful Campaign 1 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:scale-[1.02] animate-fade-in-up">
                        <!-- Campaign Status Badge -->
                        <div class="relative">
                            <!-- Pills Buttons -->
                            <div class="absolute top-4 left-4 right-4 z-10 flex justify-start items-start">
                                <div class="flex flex-wrap gap-2">
                                    <div class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                        VERIFIED
                                    </div>
                                    <div class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-medium">
                                        106% FUNDED
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Campaign Image -->
                        <div class="relative">
                            <img src="../images/campaigns/ppe.png"
                                 alt="Ramadan Food Distribution" class="w-full h-56 object-cover">
                        </div>

                        <div class="p-8">
                            <!-- Campaign Overview -->
                            <div class="mb-8">
                                <h4 class="text-3xl font-bold text-gray-900 mb-4 animate-slide-in-left">COVID-19 PPE Emergency Support</h4>
                                <p class="text-gray-600 leading-relaxed text-lg animate-slide-in-left delay-100">
                                    Yayasan Ikhlas received notification that the use of PPE during the third phase of the Covid pandemic situation is approximately 4,000 sets of PPE per day in Selangor. The situation in Selangor became more serious when many detected cases through testing could not be linked to any cluster. This reflects that many infected individuals are in the midst of the community and are difficult to detect. A target of 10,000 sets will be prepared within 10 days and will be handed over to the Selangor State Health Department for distribution to each hospital that carries out COVID-19 treatment or screening.
                                </p>

                                <!-- Campaign Details -->
                                <div class="mt-6 flex items-center space-x-6 text-sm text-gray-500 animate-slide-in-left delay-200">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 0v9m-4-9h8m-4 0V7"/>
                                        </svg>
                                        Campaign ended: March 15, 2024
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        10 days duration
                                    </div>
                                </div>
                            </div>

                            <!-- Impact Statistics -->
                            <div class="flex justify-between items-center mb-6 bg-gray-50 rounded-lg p-4">
                                <div class="text-center group animate-scale-in delay-300">
                                    <div class="text-2xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300 animate-count-up">10,000</div>
                                    <div class="text-xs text-gray-600">PPE Sets</div>
                                </div>
                                <div class="text-center group animate-scale-in delay-400">
                                    <div class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 animate-count-up">450</div>
                                    <div class="text-xs text-gray-600">Donors</div>
                                </div>
                                <div class="text-center group animate-scale-in delay-500">
                                    <div class="text-2xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300 animate-count-up">10</div>
                                    <div class="text-xs text-gray-600">Days</div>
                                </div>
                            </div>

                            <!-- Audit Trail Toggle -->
                            <div class="border-t border-gray-100 pt-6 mb-4">
                                <button onclick="toggleCampaignAudit('campaign1')"
                                        class="flex items-center justify-between w-full text-left font-medium text-gray-700 hover:text-gray-900 transition-colors"
                                        id="campaign1-audit-toggle">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        View Campaign Timeline & Audit Trail
                                    </span>
                                    <svg class="w-5 h-5 transform transition-transform duration-200 text-gray-400" id="campaign1-audit-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <!-- Audit Trail Content -->
                                <div id="campaign1-audit-content" class="hidden mt-6 space-y-6">
                                    <!-- Campaign Timeline -->
                                    <div class="bg-gray-50 rounded-xl p-6">
                                        <h5 class="font-semibold text-gray-900 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Campaign Timeline
                                        </h5>
                                        <div class="space-y-4">
                                            <div class="flex items-start space-x-4">
                                                <div class="w-3 h-3 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <p class="font-medium text-gray-900">PPE Distribution Completed</p>
                                                        <span class="text-sm text-gray-500">March 15, 2024</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600">10,000 PPE sets delivered to Selangor Health Department</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start space-x-4">
                                                <div class="w-3 h-3 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <p class="font-medium text-gray-900">Goal Achieved (106%)</p>
                                                        <span class="text-sm text-gray-500">March 10, 2024</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600">Exceeded RM 80,000 target, reached RM 85,000</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start space-x-4">
                                                <div class="w-3 h-3 bg-purple-500 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <p class="font-medium text-gray-900">PPE Production Started</p>
                                                        <span class="text-sm text-gray-500">March 8, 2024</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600">Manufacturing began after reaching 75% funding</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start space-x-4">
                                                <div class="w-3 h-3 bg-gray-400 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <p class="font-medium text-gray-900">Emergency Campaign Launched</p>
                                                        <span class="text-sm text-gray-500">March 5, 2024</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600">Urgent PPE shortage identified in Selangor hospitals</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <!-- Organization and Actions -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                                <div>
                                    <div class="font-semibold text-gray-900">Yayasan Ikhlas</div>
                                    <div class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                        </svg>
                                        Verified Organization
                                    </div>
                                    <div class="text-sm font-bold text-gray-900 mt-1">
                                        RM 85,000 <span class="text-xs text-gray-600 font-normal">of RM 80,000</span>
                                    </div>
                                </div>
                                <div class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                    </svg>
                                    Campaign Completed
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Successful Campaign 2 -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:scale-[1.02] animate-fade-in-up delay-200">
                        <!-- Campaign Status Badge -->
                        <div class="relative">
                            <!-- Pills Buttons -->
                            <div class="absolute top-4 left-4 right-4 z-10 flex justify-start items-start">
                                <div class="flex flex-wrap gap-2">
                                    <div class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                        VERIFIED
                                    </div>
                                    <div class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-medium">
                                        104% FUNDED
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Campaign Image -->
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 alt="School Construction" class="w-full h-56 object-cover">
                        </div>

                        <div class="p-8">
                            <!-- Campaign Overview -->
                            <div class="mb-8">
                                <h4 class="text-3xl font-bold text-gray-900 mb-4 animate-slide-in-left">Rural Islamic School Construction</h4>
                                <p class="text-gray-600 leading-relaxed text-lg animate-slide-in-left delay-100">
                                    Built a complete Islamic school facility in rural Kelantan, providing quality education to 300 children who previously had no access to proper schooling. The facility includes 8 classrooms, library, computer lab, and prayer hall.
                                </p>

                                <!-- Campaign Details -->
                                <div class="mt-6 flex items-center space-x-6 text-sm text-gray-500 animate-slide-in-left delay-200">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 0v9m-4-9h8m-4 0V7"/>
                                        </svg>
                                        Campaign ended: September 30, 2023
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        90 days duration
                                    </div>
                                </div>
                            </div>

                            <!-- Impact Statistics -->
                            <div class="flex justify-between items-center mb-6 bg-gray-50 rounded-lg p-4">
                                <div class="text-center group animate-scale-in delay-300">
                                    <div class="text-2xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-300 animate-count-up">300</div>
                                    <div class="text-xs text-gray-600">Students</div>
                                </div>
                                <div class="text-center group animate-scale-in delay-400">
                                    <div class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 animate-count-up">285</div>
                                    <div class="text-xs text-gray-600">Donors</div>
                                </div>
                                <div class="text-center group animate-scale-in delay-500">
                                    <div class="text-2xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300 animate-count-up">90</div>
                                    <div class="text-xs text-gray-600">Days</div>
                                </div>
                            </div>

                            <!-- Audit Trail Toggle -->
                            <div class="border-t border-gray-100 pt-6 mb-4">
                                <button onclick="toggleCampaignAudit('campaign2')"
                                        class="flex items-center justify-between w-full text-left font-medium text-gray-700 hover:text-gray-900 transition-colors"
                                        id="campaign2-audit-toggle">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        View Campaign Timeline & Audit Trail
                                    </span>
                                    <svg class="w-5 h-5 transform transition-transform duration-200 text-gray-400" id="campaign2-audit-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <!-- Audit Trail Content -->
                                <div id="campaign2-audit-content" class="hidden mt-6 space-y-6">
                                    <!-- Campaign Timeline -->
                                    <div class="bg-gray-50 rounded-xl p-6">
                                        <h5 class="font-semibold text-gray-900 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Campaign Timeline
                                        </h5>
                                        <div class="space-y-4">
                                            <div class="flex items-start space-x-4">
                                                <div class="w-3 h-3 bg-emerald-500 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <p class="font-medium text-gray-900">School Construction Completed</p>
                                                        <span class="text-sm text-gray-500">September 30, 2023</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600">Final amount: RM 125,000 (104% of goal)</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start space-x-4">
                                                <div class="w-3 h-3 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <p class="font-medium text-gray-900">Construction Phase Completed</p>
                                                        <span class="text-sm text-gray-500">September 15, 2023</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600">All building work finished, ready for opening</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start space-x-4">
                                                <div class="w-3 h-3 bg-purple-500 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <p class="font-medium text-gray-900">Goal Achieved (100%)</p>
                                                        <span class="text-sm text-gray-500">August 20, 2023</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600">Reached RM 120,000 target, construction began</p>
                                                </div>
                                            </div>
                                            <div class="flex items-start space-x-4">
                                                <div class="w-3 h-3 bg-gray-400 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <p class="font-medium text-gray-900">Campaign Launched</p>
                                                        <span class="text-sm text-gray-500">July 1, 2023</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600">Initial goal set at RM 120,000 for 90 days</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Construction Progress -->
                                    <div class="bg-indigo-50 rounded-xl p-6">
                                        <h5 class="font-semibold text-gray-900 mb-3 flex items-center">
                                            <svg class="w-5 h-5 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            Construction Milestones
                                        </h5>
                                        <div class="text-sm text-gray-700 space-y-2">
                                            <p class="flex items-center"><span class="text-emerald-500 mr-2">✓</span> Foundation completed (August 25, 2023)</p>
                                            <p class="flex items-center"><span class="text-emerald-500 mr-2">✓</span> Building structure completed (September 5, 2023)</p>
                                            <p class="flex items-center"><span class="text-emerald-500 mr-2">✓</span> Interior work and facilities installed (September 20, 2023)</p>
                                            <p class="flex items-center"><span class="text-emerald-500 mr-2">✓</span> Final inspection and approval (September 28, 2023)</p>
                                            <p class="flex items-center"><span class="text-emerald-500 mr-2">✓</span> School officially opened (October 1, 2023)</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <!-- Organization and Actions -->
                            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                                <div>
                                    <div class="font-semibold text-gray-900">Yayasan Pendidikan</div>
                                    <div class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 text-emerald-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                        </svg>
                                        Verified Organization
                                    </div>
                                    <div class="text-sm font-bold text-gray-900 mt-1">
                                        RM 125,000 <span class="text-xs text-gray-600 font-normal">of RM 120,000</span>
                                    </div>
                                </div>
                                <div class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                    </svg>
                                    Campaign Completed
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>

        <!-- More Campaigns Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">More Campaigns</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Small Campaign Card 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Healthcare" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">Mobile Health Clinic</h4>
                            <p class="text-xs text-gray-600 mb-3">Bringing healthcare to remote villages</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">RM 15,000</span>
                                <span class="text-xs text-primary-500 font-medium">67%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small Campaign Card 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Education" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">Scholarship Program</h4>
                            <p class="text-xs text-gray-600 mb-3">Supporting underprivileged students</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">RM 22,000</span>
                                <span class="text-xs text-primary-500 font-medium">84%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small Campaign Card 3 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1541544181051-e46607bc22a4?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Water" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">Water Purification System</h4>
                            <p class="text-xs text-gray-600 mb-3">Clean water for 500 families</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">RM 35,000</span>
                                <span class="text-xs text-primary-500 font-medium">45%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small Campaign Card 4 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Emergency" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">Disaster Relief Fund</h4>
                            <p class="text-xs text-gray-600 mb-3">Emergency aid for natural disasters</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">RM 50,000</span>
                                <span class="text-xs text-primary-500 font-medium">92%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-20 bg-primary-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    Start Your Own Campaign
                </h2>
                <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">
                    Join our community of changemakers. Create a campaign and make a difference in the lives of those who need it most.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Start a Campaign
                    </a>
                    <a href="#" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-500 transition-colors">
                        Learn More
                    </a>
                </div>
            </div>
        </section>

@endsection

@push('styles')
<style>
    /* Animation Keyframes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes countUp {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes pulseGentle {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.8;
        }
    }

    @keyframes pulse-button {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.4);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(249, 115, 22, 0);
        }
    }

    @keyframes ping {
        75%, 100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    /* Animation Classes */
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.6s ease-out forwards;
    }

    .animate-scale-in {
        animation: scaleIn 0.5s ease-out forwards;
    }

    .animate-count-up {
        animation: countUp 0.8s ease-out forwards;
    }

    .animate-pulse-gentle {
        animation: pulseGentle 2s ease-in-out infinite;
    }

    .animate-ping {
        animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    .animate-pulse-button {
        animation: pulse-button 2s infinite;
    }

    /* Delay Classes */
    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }

    .delay-400 {
        animation-delay: 0.4s;
    }

    .delay-500 {
        animation-delay: 0.5s;
    }

    /* Enhanced Hover Effects */
    .group:hover .animate-count-up {
        animation: countUp 0.3s ease-out forwards;
    }

    /* Card Hover Enhancements */
    .bg-white:hover {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    }

    /* Backdrop Blur Enhancement */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }

    /* Hover lift effect */
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Campaign Audit Trail functionality
    window.toggleCampaignAudit = function(campaignId) {
        const content = document.getElementById(campaignId + '-audit-content');
        const arrow = document.getElementById(campaignId + '-audit-arrow');
        const toggle = document.getElementById(campaignId + '-audit-toggle');

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

    // Add hover effects to campaign cards
    const campaignCards = document.querySelectorAll('.bg-gradient-to-br');
    campaignCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Animate statistics on scroll
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const stats = entry.target.querySelectorAll('.text-2xl, .text-3xl');
                stats.forEach((stat, index) => {
                    setTimeout(() => {
                        stat.style.transform = 'scale(1.1)';
                        stat.style.transition = 'transform 0.3s ease';

                        setTimeout(() => {
                            stat.style.transform = 'scale(1)';
                        }, 300);
                    }, index * 100);
                });
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe campaign cards for animation
    document.querySelectorAll('.bg-gradient-to-br').forEach(card => {
        observer.observe(card);
    });

    // Add subtle pulse animation to "COMPLETED" badges
    const completedBadges = document.querySelectorAll('.bg-emerald-100');
    completedBadges.forEach(badge => {
        setInterval(() => {
            const dot = badge.querySelector('.bg-emerald-500');
            if (dot) {
                dot.style.transform = 'scale(1.2)';
                dot.style.transition = 'transform 0.3s ease';
                setTimeout(() => {
                    dot.style.transform = 'scale(1)';
                }, 300);
            }
        }, 4000);
    });
});
</script>
@endpush
