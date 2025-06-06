@extends('layouts.master')

@section('title', 'Campaigns - Jariah Fund')
@section('description', 'Support meaningful campaigns that make a real difference in communities worldwide. Every donation is tracked and transparent.')

@section('content')

        <!-- Hero Section -->
        <section class="py-20 bg-gradient-to-br from-primary-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-6">
                        <svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">Active Campaigns</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Make a Difference
                        <span class="text-primary-500 relative block">
                            Today
                            <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-64 h-3 text-primary-200" viewBox="0 0 100 12" fill="currentColor">
                                <path d="M0 8c30-4 70-4 100 0v4H0z"/>
                            </svg>
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed mb-8">
                        Join thousands of donors supporting <strong>verified campaigns</strong> that make a real difference in communities worldwide.
                        Each campaign is thoroughly vetted to ensure <span class="text-primary-600 font-medium">complete transparency</span> and
                        <span class="text-primary-600 font-medium">effective impact</span>.
                    </p>
                    <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-600">
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Verified Campaigns
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Real Impact
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            100% Transparent
                        </div>
                    </div>
                </div>
            </div>
        </section>



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
                        <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                             alt="Emergency Food Relief" class="w-full h-40 md:h-48 object-cover">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center mb-3">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&q=80"
                                     alt="Organization" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 md:mr-3">
                                <span class="text-xs md:text-sm text-gray-600">Yayasan Muslimin</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">Emergency Food Relief for Gaza Families</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed line-clamp-3">
                                Provide essential food packages to families in Gaza who are facing severe food shortages.
                                Each package feeds a family of 6 for one month.
                            </p>
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
                                <a href="{{ url('/donate') }}" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                    Donate Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Campaign Card 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1541544181051-e46607bc22a4?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             alt="Clean Water Project" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&q=80" 
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
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 57%"></div>
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
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=40&q=80" 
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
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 62%"></div>
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

        <!-- Spotlight Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Spotlight</h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Organization Spotlight 1 -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80"
                                 alt="Yayasan Muslimin" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h3 class="font-bold text-gray-900">Yayasan Muslimin</h3>
                                <p class="text-sm text-gray-600">Islamic Foundation</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="#" class="block">
                                <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                     alt="Campaign" class="w-full h-32 object-cover rounded-lg mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Feed 1,000 Families This Ramadan</h4>
                                <p class="text-xs text-gray-600">RM 25,000 raised</p>
                            </a>
                            <a href="#" class="block">
                                <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                     alt="Campaign" class="w-full h-32 object-cover rounded-lg mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Build Islamic School in Rural Area</h4>
                                <p class="text-xs text-gray-600">RM 45,000 raised</p>
                            </a>
                        </div>
                    </div>

                    <!-- Organization Spotlight 2 -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=60&q=80"
                                 alt="Yayasan Ikhlas" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h3 class="font-bold text-gray-900">Yayasan Ikhlas</h3>
                                <p class="text-sm text-gray-600">Charity Foundation</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="#" class="block">
                                <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                     alt="Campaign" class="w-full h-32 object-cover rounded-lg mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Emergency Relief for Flood Victims</h4>
                                <p class="text-xs text-gray-600">RM 18,500 raised</p>
                            </a>
                            <a href="#" class="block">
                                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                     alt="Campaign" class="w-full h-32 object-cover rounded-lg mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Medical Aid for Disabled Children</h4>
                                <p class="text-xs text-gray-600">RM 32,000 raised</p>
                            </a>
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
