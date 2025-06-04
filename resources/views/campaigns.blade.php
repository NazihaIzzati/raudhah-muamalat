<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Campaigns - Jariah Fund</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Fallback styles */
                body { font-family: 'Instrument Sans', sans-serif; }
            </style>
        @endif
    </head>
    <body class="bg-gray-50 text-gray-900 font-sans">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-2xl font-bold text-primary-500">
                            Jariah Fund
                        </a>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="hidden md:flex space-x-8">
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-primary-500 transition-colors">Home</a>
                        <a href="{{ url('/about') }}" class="text-gray-700 hover:text-primary-500 transition-colors">About</a>
                        <a href="{{ url('/partners') }}" class="text-gray-700 hover:text-primary-500 transition-colors">Partners</a>
                        <a href="{{ url('/campaigns') }}" class="text-primary-500 font-medium">Campaigns</a>
                        <a href="{{ url('/') }}#contact" class="text-gray-700 hover:text-primary-500 transition-colors">Contact</a>
                    </nav>
                    
                    <!-- Auth Links -->
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-500 transition-colors">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition-colors">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                    
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button type="button" class="text-gray-700 hover:text-primary-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-primary-50 to-white py-12 md:py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 md:mb-6">
                        Support Meaningful <span class="text-primary-500">Campaigns</span>
                    </h1>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-6 md:mb-8">
                        Join thousands of donors supporting verified campaigns that make a real difference in communities worldwide.
                        Each campaign is thoroughly vetted to ensure complete transparency and effective impact.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                        <a href="#campaigns" class="bg-primary-500 text-white px-6 py-3 md:px-8 md:py-4 rounded-lg font-semibold hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Browse Campaigns
                        </a>
                        <a href="#" class="border-2 border-primary-500 text-primary-500 px-6 py-3 md:px-8 md:py-4 rounded-lg font-semibold hover:bg-primary-50 transition-all duration-300 transform hover:scale-105">
                            Start a Campaign
                        </a>
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
                                <a href="#" class="bg-primary-500 text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 text-xs md:text-sm">
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
                                <a href="#" class="bg-primary-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-600 transition-colors">
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
                                <a href="#" class="bg-primary-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-600 transition-colors">
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

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="space-y-4">
                        <div class="text-2xl font-bold text-primary-500">
                            Jariah Fund
                        </div>
                        <p class="text-gray-300 leading-relaxed">
                            A trusted crowdfunding platform to help the underprivileged.
                            Contributing to society with Islamic values.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Quick Links</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="{{ url('/') }}" class="hover:text-primary-500 transition-colors">Home</a></li>
                            <li><a href="{{ url('/about') }}" class="hover:text-primary-500 transition-colors">About Us</a></li>
                            <li><a href="{{ url('/partners') }}" class="hover:text-primary-500 transition-colors">Partners</a></li>
                            <li><a href="{{ url('/campaigns') }}" class="hover:text-primary-500 transition-colors">Campaigns</a></li>
                        </ul>
                    </div>

                    <!-- Campaign Categories -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Campaign Categories</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Emergency Relief</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Education</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Healthcare</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Clean Water</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Contact Info</h3>
                        <div class="space-y-3 text-gray-300">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>+60 3-1234 5678</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-primary-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>info@jariahfund.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-gray-800 mt-12 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-gray-400 text-sm">
                            © {{ date('Y') }} Jariah Fund. All rights reserved.
                        </div>
                        <div class="flex space-x-6 text-sm text-gray-400">
                            <a href="#" class="hover:text-primary-500 transition-colors">Privacy Policy</a>
                            <a href="#" class="hover:text-primary-500 transition-colors">Terms of Service</a>
                            <a href="#" class="hover:text-primary-500 transition-colors">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Smooth Scrolling Script -->
        <script>
            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        </script>
    </body>
</html>
