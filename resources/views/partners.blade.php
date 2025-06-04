<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Partners - Jariah Fund Raudhah Muamalat</title>

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
    <body class="bg-white text-gray-900 font-sans">
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
                        <a href="{{ url('/partners') }}" class="text-primary-500 font-medium">Partners</a>
                        <a href="{{ url('/campaigns') }}" class="text-gray-700 hover:text-primary-500 transition-colors">Campaigns</a>
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
                        Our Trusted <span class="text-primary-500">Partners</span>
                    </h1>
                    <p class="text-base md:text-lg lg:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                        We work together with trusted and verified organizations to provide assistance to those in need.
                        Each partner is thoroughly vetted to ensure complete transparency and effective impact.
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Partners Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Yayasan Muslimin -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="https://images.unsplash.com/photo-1544027993-37dbfe43562a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                 alt="Yayasan Muslimin"
                                 class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Yayasan Muslimin</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                An Islamic foundation dedicated to revitalizing the spirit of wakaf, sedekah and zakat institutions
                                to enhance socio-economic and educational development of the Muslim community.
                            </p>
                            <a href="https://yayasanmuslimin.org/" target="_blank"
                               class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                                Find Out More
                            </a>
                        </div>
                    </div>

                    <!-- Yayasan Ikhlas -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                 alt="Yayasan Ikhlas"
                                 class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Yayasan Ikhlas</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                A charitable organization dedicated to alleviating the burden faced by orphans, people with disabilities,
                                the poor and those affected by disasters, while providing assistance for learning and research.
                            </p>
                            <a href="http://www.yayasanikhlas.org.my/" target="_blank"
                               class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                                Find Out More
                            </a>
                        </div>
                    </div>

                    <!-- MAB -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                 alt="Malaysian Association for the Blind"
                                 class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Malaysian Association for the Blind (MAB)</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                A leading voluntary organization in Malaysia that cares for people with visual impairments,
                                providing services to help the blind and prevent avoidable blindness tragedies.
                            </p>
                            <a href="https://mab.org.my/maborg/default.html" target="_blank"
                               class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                                Find Out More
                            </a>
                        </div>
                    </div>

                    <!-- NASOM -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                 alt="National Autism Society of Malaysia"
                                 class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">National Autism Society of Malaysia (NASOM)</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                An association formed by parents and professionals dedicated to providing lifelong services
                                to people with autism, supporting families and promoting autism awareness.
                            </p>
                            <a href="http://www.nasom.org.my/" target="_blank"
                               class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                                Find Out More
                            </a>
                        </div>
                    </div>

                    <!-- PruBSN -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                 alt="PruBSN Prihatin"
                                 class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">PruBSN Prihatin</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                A charitable body under Prudential BSN Takaful providing educational opportunities, life skills,
                                health and well-being support, and disaster relief for underprivileged communities.
                            </p>
                            <a href="https://www.prubsn.com.my/ms/caring-for-society/" target="_blank"
                               class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                                Find Out More
                            </a>
                        </div>
                    </div>

                    <!-- Yayasan Angkasa -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                 alt="Yayasan Angkasa"
                                 class="w-full h-48 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Yayasan Angkasa</h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                A foundation established by the Malaysian National Cooperative Movement providing educational financing,
                                motivation courses, and entrepreneurship programs to develop skilled individuals.
                            </p>
                            <a href="https://www.yayasanangkasa.coop/" target="_blank"
                               class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                                Find Out More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="py-20 bg-primary-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    Want to Become Our Partner?
                </h2>
                <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">
                    If your organization is interested in partnering with Jariah Fund to help the community,
                    contact us to learn about the application process to become a verified partner.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/') }}#contact" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Contact Us
                    </a>
                    <a href="{{ url('/about') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-500 transition-colors">
                        About Jariah Fund
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
                            <li><a href="{{ url('/') }}#contact" class="hover:text-primary-500 transition-colors">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">Areas of Support</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Education Campaigns</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Health Campaigns</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Economic Support</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-colors">Emergency Aid</a></li>
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
