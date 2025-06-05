<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>News & Events - Jariah Fund</title>

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
        @include('components.navigation')

        <!-- Hero Section -->
        <section class="bg-gradient-to-br from-primary-50 to-white py-12 md:py-16 lg:py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 md:mb-6">
                        Latest <span class="text-primary-500">News & Events</span>
                    </h1>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-6 md:mb-8">
                        Stay updated with our latest initiatives, success stories, and upcoming events.
                        Discover how your contributions are making a real difference in communities across Malaysia.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center">
                        <a href="#news" class="bg-primary-500 text-white px-6 py-3 md:px-8 md:py-4 rounded-lg font-semibold hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Browse Updates
                        </a>
                        <a href="#" class="border-2 border-primary-500 text-primary-500 px-6 py-3 md:px-8 md:py-4 rounded-lg font-semibold hover:bg-primary-50 transition-all duration-300 transform hover:scale-105">
                            Subscribe Newsletter
                        </a>
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
                        <img src="https://images.unsplash.com/photo-1593113598332-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
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
                        <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
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
                                <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
                                     alt="Mobile Clinic" class="w-full h-32 object-cover rounded-lg mb-2">
                                <h4 class="font-semibold text-gray-900 text-sm mb-1">Mobile Clinic Success</h4>
                                <p class="text-xs text-gray-600">500 patients treated in rural areas</p>
                            </a>
                            <a href="#" class="block">
                                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
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
                        <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80"
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

        @include('components.footer')
    </body>
</html>
