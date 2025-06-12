@extends('layouts.master')

@section('title', 'JariahFund - Islamic Crowdfunding Platform')
@section('description', 'Malaysia\'s leading Islamic crowdfunding platform. Empowering communities through Shariah-compliant giving and transparent charitable initiatives.')

@section('content')

        <!-- Hero Section -->
        <section id="home" class="bg-gradient-to-br from-primary-50 to-white py-12 md:py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <!-- Hero Content -->
                    <div class="space-y-6 md:space-y-8 text-center lg:text-left">
                        <div class="space-y-3 md:space-y-4">
                            <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-gray-900 leading-tight animate-fade-in-up" style="animation-delay: 0.1s;">
                                Empowering Communities Through
                                <span class="text-primary-500 relative animate-fade-in-up" style="animation-delay: 0.2s;">
                                    Islamic Crowdfunding
                                    <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-64 h-3 text-primary-200 animate-draw-line" viewBox="0 0 100 12" fill="currentColor" style="animation-delay: 0.6s;">
                                        <path d="M0 8c30-4 70-4 100 0v4H0z"/>
                                    </svg>
                                </span>
                            </h1>
                            <p class="text-base md:text-lg lg:text-xl text-gray-600 leading-relaxed max-w-2xl mx-auto lg:mx-0 animate-fade-in-up" style="animation-delay: 0.3s;">
                                To date, Jariah Fund has completed <strong>20 public funding campaigns</strong> with a total of <strong>RM167,330.10</strong> that has benefited <strong>2,564 beneficiaries</strong>. Join us in building stronger communities through <span class="text-primary-600 font-medium animate-highlight">Shariah-compliant giving</span>.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center lg:justify-start animate-fade-in-up" style="animation-delay: 0.4s;">
                            <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-6 py-3 md:px-8 md:py-4 rounded-lg font-semibold hover:bg-primary-600 transition-all duration-300 text-center transform hover:scale-105 shadow-lg hover:shadow-xl animate-pulse-button">
                                Donate Now
                            </a>
                            <a href="{{ url('/campaigns') }}" class="border-2 border-primary-500 text-primary-500 px-6 py-3 md:px-8 md:py-4 rounded-lg font-semibold hover:bg-primary-50 transition-all duration-300 text-center transform hover:scale-105 hover:rotate-1">
                                View Campaigns
                            </a>
                        </div>

                        <!-- Impact Stats -->
                        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-6 lg:space-x-8 pt-4 md:pt-8 animate-fade-in-up" style="animation-delay: 0.5s;">
                            <div class="text-center animate-bounce-in" style="animation-delay: 0.6s;">
                                <div class="text-xl md:text-2xl font-bold text-primary-600">RM 167K+</div>
                                <div class="text-xs md:text-sm text-gray-600">Total Raised</div>
                            </div>
                            <div class="text-center animate-bounce-in" style="animation-delay: 0.7s;">
                                <div class="text-xl md:text-2xl font-bold text-primary-600">2,564</div>
                                <div class="text-xs md:text-sm text-gray-600">Beneficiaries</div>
                            </div>
                            <div class="text-center animate-bounce-in" style="animation-delay: 0.8s;">
                                <div class="text-xl md:text-2xl font-bold text-primary-600">20</div>
                                <div class="text-xs md:text-sm text-gray-600">Completed Campaigns</div>
                            </div>
                        </div>

                        <!-- Quranic Verse -->
                        <div class="bg-primary-50 rounded-lg p-4 md:p-6 border-l-4 border-primary-500 animate-fade-in-up" style="animation-delay: 0.6s;">
                            <p class="text-sm md:text-base text-gray-700 italic leading-relaxed">
                                "The example of those who spend their wealth in the way of Allah is like a seed of grain that grows seven ears; in each ear there are a hundred grains."
                            </p>
                            <p class="text-xs md:text-sm text-primary-600 font-medium mt-2">— Quran 2:261</p>
                        </div>
                    </div>

                    <!-- Hero Image -->
                    <div class="relative animate-fade-in-up" style="animation-delay: 0.4s;">
                        <div class="bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl p-8 shadow-xl animate-float">
                            <div class="bg-white rounded-xl p-6 shadow-lg">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-semibold text-gray-900">Islamic Banking</h3>
                                        <div class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center animate-pulse-gentle">
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
                        <img src="{{ asset('images/campaigns/emergency-food-relief.svg') }}"
                             alt="Emergency Food Relief" class="w-full h-40 md:h-48 object-cover">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center mb-3">
                                <img src="{{ asset('images/logos/organization-avatar.svg') }}"
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
                                    <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[60%]"></div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-xs md:text-sm text-gray-500">156 donors</span>
                                <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
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
                                    <div class="bg-primary-500 h-2 rounded-full transition-all duration-500 w-[85%]"></div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-xs md:text-sm text-gray-500">312 donors</span>
                                <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
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

        <!-- News and Events Section -->
        <section class="py-12 md:py-16 lg:py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 md:mb-16">
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 md:mb-4">
                        News & <span class="text-primary-500">Events</span>
                    </h2>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto">
                        Stay updated with the latest news, events, and success stories from our Islamic crowdfunding community.
                    </p>
                </div>

                <!-- Featured News -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 mb-12 md:mb-16">
                    <!-- Main News Article -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                        <img src="{{ asset('images/news/community-event.svg') }}"
                             alt="Community Event" class="w-full h-48 md:h-64 object-cover">
                        <div class="p-6 md:p-8">
                            <div class="flex items-center mb-3">
                                <span class="bg-primary-100 text-primary-600 px-3 py-1 rounded-full text-xs md:text-sm font-medium">Latest News</span>
                                <span class="text-gray-500 text-xs md:text-sm ml-3">December 15, 2024</span>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 md:mb-4">Jariah Fund Reaches RM 3 Million Milestone</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-4 md:mb-6 leading-relaxed">
                                We're proud to announce that our platform has successfully raised over RM 3 million for various charitable causes,
                                impacting thousands of lives across Malaysia and beyond.
                            </p>
                            <a href="{{ url('/news') }}" class="inline-flex items-center text-primary-500 font-medium hover:text-primary-600 transition-colors text-sm md:text-base">
                                Read More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Event Highlights -->
                    <div class="space-y-6">
                        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                            <div class="flex items-start space-x-4">
                                <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                     alt="Workshop" class="w-16 h-16 md:w-20 md:h-20 rounded-lg object-cover flex-shrink-0">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-medium">Upcoming Event</span>
                                    </div>
                                    <h4 class="text-base md:text-lg font-semibold text-gray-900 mb-2">Islamic Finance Workshop</h4>
                                    <p class="text-xs md:text-sm text-gray-600 mb-2">Learn about Shariah-compliant investment and crowdfunding principles.</p>
                                    <p class="text-xs text-gray-500">January 20, 2025 • Kuala Lumpur</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                            <div class="flex items-start space-x-4">
                                <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                     alt="Medical Mission" class="w-16 h-16 md:w-20 md:h-20 rounded-lg object-cover flex-shrink-0">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs font-medium">Success Story</span>
                                    </div>
                                    <h4 class="text-base md:text-lg font-semibold text-gray-900 mb-2">Medical Mission Completed</h4>
                                    <p class="text-xs md:text-sm text-gray-600 mb-2">Mobile clinic successfully served 500+ patients in rural areas.</p>
                                    <p class="text-xs text-gray-500">December 10, 2024 • Pahang</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                            <div class="flex items-start space-x-4">
                                <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                     alt="School Opening" class="w-16 h-16 md:w-20 md:h-20 rounded-lg object-cover flex-shrink-0">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded-full text-xs font-medium">Achievement</span>
                                    </div>
                                    <h4 class="text-base md:text-lg font-semibold text-gray-900 mb-2">New School Opens</h4>
                                    <p class="text-xs md:text-sm text-gray-600 mb-2">Islamic school in rural Kelantan welcomes first 200 students.</p>
                                    <p class="text-xs text-gray-500">November 25, 2024 • Kelantan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Photo Gallery Slider -->
                <div class="mb-8 md:mb-12">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-6 md:mb-8 text-center">Photo Gallery</h3>

                    <!-- Gallery Slider Container -->
                    <div class="relative">
                        <!-- Slider Wrapper -->
                        <div class="overflow-hidden rounded-xl">
                            <div id="gallery-slider" class="flex transition-transform duration-500 ease-in-out">
                                <!-- Slide 1 -->
                                <div class="w-full flex-shrink-0">
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                                        <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Community Gathering" data-description="Local community members coming together for a charity event">
                                            <img src="{{ asset('../images/campaigns/map_01.jpg') }}"
                                                 alt="Community gathering" class="w-full h-32 md:h-40 object-cover">
                                        </div>
                                        <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="{{ asset('images/gallery/food-distribution.svg') }}" data-title="Food Distribution" data-description="Volunteers distributing food packages to families in need">
                                            <img src="{{ asset('../images/campaigns/map_02.jpg') }}"
                                                 alt="Food distribution" class="w-full h-32 md:h-40 object-cover">
                                        </div>
                                        <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="{{ asset('images/campaigns/education-initiative.svg') }}" data-title="Education Program" data-description="Children attending classes in our newly built school">
                                            <img src="{{ asset('../images/campaigns/mab_01.jpg') }}"
                                                 alt="Education program" class="w-full h-32 md:h-40 object-cover">
                                        </div>
                                        <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Healthcare Service" data-description="Mobile clinic providing medical care to remote communities">
                                            <img src="{{ asset('../images/campaigns/mab_02.jpg') }}"
                                                 alt="Healthcare service" class="w-full h-32 md:h-40 object-cover">
                                        </div>
                                    </div>
                                </div>

                                <!-- Slide 2 -->
                                <div class="w-full flex-shrink-0">
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                                        <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Water Well Project" data-description="New water well providing clean water to rural village">
                                            <img src="{{ asset('../images/campaigns/mab_03.jpg') }}"
                                                 alt="Water well project" class="w-full h-32 md:h-40 object-cover">
                                        </div>
                                        <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Skills Training" data-description="Vocational training program for young adults">
                                            <img src="{{ asset('../images/campaigns/02.jpg') }}"
                                                 alt="Skills training" class="w-full h-32 md:h-40 object-cover">
                                        </div>
                                        <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Orphan Support" data-description="Supporting orphaned children with education and care">
                                            <img src="{{ asset('../images/campaigns/03.jpg') }}"
                                                 alt="Orphan support" class="w-full h-32 md:h-40 object-cover">
                                        </div>
                                        <div class="gallery-item rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105" data-image="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" data-title="Mosque Construction" data-description="Building new mosque for the local community">
                                            <img src="{{ asset('../images/campaigns/04.jpg') }}"
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

                <!-- View More Button -->
                <div class="text-center">
                    <a href="{{ url('/news') }}" class="inline-flex items-center px-6 py-3 md:px-8 md:py-4 bg-white border-2 border-primary-500 text-primary-500 font-semibold rounded-lg hover:bg-primary-500 hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        View All News & Events
                        <svg class="w-4 h-4 md:w-5 md:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
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
                        <div class="rounded-2xl p-6 md:p-8 text-white bg-primary-500">
                            <div class="space-y-4 md:space-y-6">
                                <h3 class="text-xl md:text-2xl font-bold">Our Mission</h3>
                                <p class="text-primary-100 leading-relaxed text-sm md:text-base">
                                    To create a transparent, trusted platform that connects generous hearts with
                                    meaningful causes, enabling communities to support each other through
                                    Shariah-compliant crowdfunding.
                                </p>
                                <div class="grid grid-cols-2 gap-3 md:gap-4 pt-2 md:pt-4">
                                    <div class="text-center">
                                        <div class="text-2xl md:text-3xl font-bold">RM 167K+</div>
                                        <div class="text-primary-200 text-xs md:text-sm">Total Raised</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl md:text-3xl font-bold">2,564</div>
                                        <div class="text-primary-200 text-xs md:text-sm">Beneficiaries</div>
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