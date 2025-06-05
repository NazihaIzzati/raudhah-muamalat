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
    <body class="bg-gray-50 text-gray-900 font-sans">
        @include('components.navigation')

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

        @include('components.footer')
    </body>
</html>
