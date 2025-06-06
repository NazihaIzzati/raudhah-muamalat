@extends('layouts.master')

@section('title', 'News & Events - Jariah Fund')
@section('description', 'Stay updated with our latest initiatives, success stories, and upcoming events. Discover how your contributions are making a real difference.')

@section('content')

        <!-- Hero Section -->
        <section class="py-20 bg-gradient-to-br from-primary-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-6">
                        <svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">News & Events</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Stay Connected with
                        <span class="text-primary-500 relative block">
                            Our Mission
                            <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-64 h-3 text-primary-200" viewBox="0 0 100 12" fill="currentColor">
                                <path d="M0 8c30-4 70-4 100 0v4H0z"/>
                            </svg>
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed mb-8">
                        Stay updated with our <strong>latest initiatives, success stories, and upcoming events</strong>.
                        Discover how your contributions are making a <span class="text-primary-600 font-medium">real difference</span> in
                        <span class="text-primary-600 font-medium">communities across Malaysia</span>.
                    </p>
                    <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-600">
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Latest Updates
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Impact Stories
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Community Events
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured News Section -->
        <section id="news" class="py-12 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-8 gap-3">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Featured News</h2>
                    <a href="#" class="text-primary-500 font-medium hover:text-primary-600 text-sm md:text-base">View all</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    <!-- Featured News Card 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <img src="{{ asset('images/campaigns/emergency-food-relief.svg') }}"
                             alt="Emergency Food Relief" class="w-full h-40 md:h-48 object-cover">
                        <div class="p-4 md:p-6">
                            <div class="flex items-center mb-3">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium mr-3">Impact Story</span>
                                <span class="text-xs md:text-sm text-gray-600">Dec 15, 2024</span>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 leading-tight">1,000 Families Receive Emergency Food Aid</h3>
                            <p class="text-sm md:text-base text-gray-600 mb-3 md:mb-4 leading-relaxed line-clamp-3">
                                Thanks to generous donations, we successfully distributed emergency food packages
                                to families affected by recent floods in Kelantan.
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs md:text-sm text-gray-500">1,000 families helped</span>
                                <a href="#" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Featured News Card 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="{{ asset('images/campaigns/education-initiative.svg') }}"
                             alt="Education Initiative" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium mr-3">News</span>
                                <span class="text-sm text-gray-600">Dec 12, 2024</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">New Education Initiative Launched</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                We're excited to announce our new education program providing scholarships
                                and learning resources to underprivileged children in rural areas.
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">500 students</span>
                                <a href="#" class="bg-primary-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-600 transition-colors">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Featured News Card 3 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                             alt="Charity Gala" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium mr-3">Event</span>
                                <span class="text-sm text-gray-600">Dec 20, 2024</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Annual Charity Gala 2024</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                Join us for an evening of inspiration and giving at our annual charity gala.
                                All proceeds support our education and healthcare initiatives.
                            </p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Kuala Lumpur</span>
                                <a href="#" class="bg-primary-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-600 transition-colors">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Updates Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Recent Updates</h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Update Spotlight 1 -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium mr-4">Announcement</span>
                            <span class="text-sm text-gray-600">Dec 8, 2024</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-4">Platform Security Enhancement</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            We've implemented enhanced security measures and added new features to improve your donation experience.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="#" class="block">
                                <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                     alt="Security Update" class="w-full h-32 object-cover rounded-lg mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Enhanced Security Features</h4>
                                <p class="text-xs text-gray-600">Two-factor authentication now available</p>
                            </a>
                            <a href="#" class="block">
                                <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                     alt="New Features" class="w-full h-32 object-cover rounded-lg mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Improved User Interface</h4>
                                <p class="text-xs text-gray-600">Better mobile experience and navigation</p>
                            </a>
                        </div>
                    </div>

                    <!-- Update Spotlight 2 -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center mb-4">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium mr-4">Impact</span>
                            <span class="text-sm text-gray-600">Dec 5, 2024</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-4">Healthcare Milestone Reached</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Our mobile healthcare unit has successfully provided medical services to 500 patients in remote villages.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="#" class="block">
                                <img src="{{ asset('images/campaigns/medical-mission.svg') }}"
                                     alt="Mobile Clinic" class="w-full h-32 object-cover rounded-lg mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Mobile Clinic Success</h4>
                                <p class="text-xs text-gray-600">500 patients treated in rural areas</p>
                            </a>
                            <a href="#" class="block">
                                <img src="{{ asset('images/campaigns/medical-mission.svg') }}"
                                     alt="Medical Equipment" class="w-full h-32 object-cover rounded-lg mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">New Medical Equipment</h4>
                                <p class="text-xs text-gray-600">Advanced diagnostic tools acquired</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- More News Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">More News & Events</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Small News Card 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="{{ asset('images/news/workshop.svg') }}"
                             alt="Workshop" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium mb-2 inline-block">Event</span>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">Financial Literacy Workshop</h4>
                            <p class="text-xs text-gray-600 mb-3">Free workshop for young adults</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">Dec 18, 2024</span>
                                <span class="text-xs text-primary-500 font-medium">Online</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small News Card 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Partnership" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium mb-2 inline-block">News</span>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">New Partnership Announced</h4>
                            <p class="text-xs text-gray-600 mb-3">Expanding our reach with local NGOs</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">Dec 5, 2024</span>
                                <span class="text-xs text-primary-500 font-medium">5 NGOs</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small News Card 3 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1541544181051-e46607bc22a4?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Water Project" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium mb-2 inline-block">Impact</span>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">Clean Water Project Complete</h4>
                            <p class="text-xs text-gray-600 mb-3">500 families now have clean water</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">Dec 1, 2024</span>
                                <span class="text-xs text-primary-500 font-medium">Rural Areas</span>
                            </div>
                        </div>
                    </div>

                    <!-- Small News Card 4 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                             alt="Emergency Relief" class="w-full h-32 object-cover">
                        <div class="p-4">
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium mb-2 inline-block">Urgent</span>
                            <h4 class="font-semibold text-gray-900 text-sm mb-2">Emergency Relief Fund</h4>
                            <p class="text-xs text-gray-600 mb-3">Disaster response activated</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">Nov 28, 2024</span>
                                <span class="text-xs text-primary-500 font-medium">Active</span>
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
                    Stay Connected with Our Mission
                </h2>
                <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">
                    Subscribe to our newsletter to receive the latest updates on our campaigns, success stories,
                    and upcoming events. Be part of our community making a difference.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Subscribe Newsletter
                    </a>
                    <a href="{{ url('/campaigns') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-500 transition-colors">
                        View Campaigns
                    </a>
                </div>
            </div>
        </section>

@endsection
