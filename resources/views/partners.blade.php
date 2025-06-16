@extends('layouts.master')

@section('title', 'Partners - Jariah Fund Raudhah Muamalat')
@section('description', 'We work together with trusted and verified organizations to provide assistance to those in need. Each partner is thoroughly vetted to ensure complete transparency.')

@section('content')

        @include('components.hero-section', [
            'badge' => [
                'text' => 'Our Partners',
                'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>'
            ],
            'title' => 'Our Trusted',
            'subtitle' => 'Partners',
            'description' => 'We work together with <strong>trusted and verified organizations</strong> to provide assistance to those in need. Each partner is thoroughly vetted to ensure',
            'highlights' => [
                ['text' => 'complete transparency', 'delay' => '0.6s'],
                ['text' => 'effective impact', 'delay' => '0.8s']
            ],
            'pills' => [
                ['text' => 'Verified Organizations', 'delay' => '0.6s'],
                ['text' => 'Transparent Impact', 'delay' => '0.7s'],
                ['text' => 'Trusted Network', 'delay' => '0.8s']
            ]
        ])

        <!-- Main Content with Animations -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Partners Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-10 animate-on-scroll" data-animation="fade-in-up">
                    <!-- Yayasan Muslimin -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:border-primary-200 transform hover:scale-105">
                        <!-- Logo Section -->
                        <div class="h-56 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <div class="logo-container w-48 h-48 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-full shadow-xl hover:shadow-2xl flex items-center justify-center p-6 transition-all duration-700 hover:scale-110 hover:-translate-y-4 hover:rotate-3 group cursor-pointer animate-float"
                                 tabindex="0"
                                 role="button"
                                 aria-label="Learn more about Yayasan Muslimin">
                                <img src="{{ asset('assets/images/charity/yayasanmuslim.png') }}"
                                     alt="Yayasan Muslimin Logo"
                                     class="w-32 h-32 object-contain filter grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-300"
                                     loading="lazy">
                                <!-- Hover indicator -->
                                <div class="hover-indicator absolute bottom-3 right-3 w-8 h-8 bg-emerald-500 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center shadow-lg">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="mb-3">
                                <h3 class="text-xl font-bold text-gray-900">Yayasan Muslimin</h3>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-4">
                                The aspiration of establishing Yayasan Muslimin is to revitalize the spirit of wakaf, sedekah and zakat institutions
                                as required by Islam to enhance development in the socio-economic and educational fields of the Muslim community.
                                Its existence opens wider opportunities for society to contribute for charitable purposes to the development of Islam.
                            </p>

                            <!-- Action Section -->
                            <div class="flex items-center justify-between">
                                <a href="https://yayasanmuslimin.org/" target="_blank"
                                   class="inline-flex items-center text-primary-500 font-semibold hover:text-primary-600 transition-colors group">
                                    Learn More
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <span class="text-xs text-gray-400">Islamic Foundation</span>
                            </div>
                        </div>
                    </div>

                    <!-- Yayasan Ikhlas -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:border-primary-200 transform hover:scale-105">
                        <!-- Logo Section -->
                        <div class="h-56 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <div class="logo-container w-48 h-48 bg-gradient-to-br from-blue-50 to-blue-100 rounded-full shadow-xl hover:shadow-2xl flex items-center justify-center p-6 transition-all duration-700 hover:scale-110 hover:-translate-y-4 hover:rotate-3 group cursor-pointer animate-float-delay-1"
                                 tabindex="0"
                                 role="button"
                                 aria-label="Learn more about Yayasan Ikhlas">
                                <img src="{{ asset('assets/images/charity/yayasanikhlas.png') }}"
                                     alt="Yayasan Ikhlas Logo"
                                     class="w-32 h-32 object-contain filter grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-300"
                                     loading="lazy">
                                <!-- Hover indicator -->
                                <div class="hover-indicator absolute bottom-3 right-3 w-8 h-8 bg-blue-500 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center shadow-lg">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="mb-3">
                                <h3 class="text-xl font-bold text-gray-900">Yayasan Ikhlas</h3>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-4">
                                Yayasan Ikhlas is an organization established under the Trustees (Incorporation) Act 1952 (Act 258) on 5 March 2009,
                                aimed at alleviating the burden faced by orphans, people with disabilities, the poor and those affected by disasters,
                                while providing assistance or incentives to individuals or groups for learning or research in Malaysia.
                            </p>

                            <!-- Action Section -->
                            <div class="flex items-center justify-between">
                                <a href="http://www.yayasanikhlas.org.my/" target="_blank"
                                   class="inline-flex items-center text-primary-500 font-semibold hover:text-primary-600 transition-colors group">
                                    Learn More
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <span class="text-xs text-gray-400">Charitable Organization</span>
                            </div>
                        </div>
                    </div>

                    <!-- MAB -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:border-primary-200 transform hover:scale-105">
                        <!-- Logo Section -->
                        <div class="h-56 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <div class="logo-container w-48 h-48 bg-gradient-to-br from-purple-50 to-purple-100 rounded-full shadow-xl hover:shadow-2xl flex items-center justify-center p-6 transition-all duration-700 hover:scale-110 hover:-translate-y-4 hover:rotate-3 group cursor-pointer animate-float-delay-2"
                                 tabindex="0"
                                 role="button"
                                 aria-label="Learn more about Malaysian Association for the Blind">
                                <img src="{{ asset('assets/images/charity/mab.png') }}"
                                     alt="Malaysian Association for the Blind Logo"
                                     class="w-32 h-32 object-contain filter grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-300"
                                     loading="lazy">
                                <!-- Hover indicator -->
                                <div class="hover-indicator absolute bottom-3 right-3 w-8 h-8 bg-purple-500 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center shadow-lg">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="mb-3">
                                <h3 class="text-lg font-bold text-gray-900">Malaysian Association for the Blind (MAB)</h3>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                Malaysian Association for the Blind (MAB) is a leading voluntary organization in Malaysia that cares for people
                                with visual impairments. The association provides services to help the blind and prevent avoidable blindness tragedies.
                            </p>

                            <!-- Action Section -->
                            <div class="flex items-center justify-between">
                                <a href="https://mab.org.my/maborg/default.html" target="_blank"
                                   class="inline-flex items-center text-primary-500 font-semibold hover:text-primary-600 transition-colors group">
                                    Learn More
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <span class="text-xs text-gray-400">Disability Support</span>
                            </div>
                        </div>
                    </div>

                    <!-- NASOM -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:border-primary-200 transform hover:scale-105">
                        <!-- Logo Section -->
                        <div class="h-56 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <div class="logo-container w-48 h-48 bg-gradient-to-br from-orange-50 to-orange-100 rounded-full shadow-xl hover:shadow-2xl flex items-center justify-center p-6 transition-all duration-700 hover:scale-110 hover:-translate-y-4 hover:rotate-3 group cursor-pointer animate-float-delay-3"
                                 tabindex="0"
                                 role="button"
                                 aria-label="Learn more about National Autism Society of Malaysia">
                                <img src="{{ asset('assets/images/charity/nasom.png') }}"
                                     alt="National Autism Society of Malaysia Logo"
                                     class="w-32 h-32 object-contain filter grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-300"
                                     loading="lazy">
                                <!-- Hover indicator -->
                                <div class="hover-indicator absolute bottom-3 right-3 w-8 h-8 bg-orange-500 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center shadow-lg">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="mb-3">
                                <h3 class="text-xl font-bold text-gray-900">National Autism Society of Malaysia (NASOM)</h3>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                National Autism Society of Malaysia (NASOM) is an association formed in 1987 by a group of parents and professionals
                                with the purpose of providing lifelong services to people with autism.
                            </p>

                            <!-- Action Section -->
                            <div class="flex items-center justify-between">
                                <a href="http://www.nasom.org.my/" target="_blank"
                                   class="inline-flex items-center text-primary-500 font-semibold hover:text-primary-600 transition-colors group">
                                    Learn More
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <span class="text-xs text-gray-400">Autism Support</span>
                            </div>
                        </div>
                    </div>

                    <!-- PruBSN -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:border-primary-200 transform hover:scale-105">
                        <!-- Logo Section -->
                        <div class="h-56 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <div class="logo-container w-48 h-48 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-full shadow-xl hover:shadow-2xl flex items-center justify-center p-6 transition-all duration-700 hover:scale-110 hover:-translate-y-4 hover:rotate-3 group cursor-pointer animate-float-delay-4"
                                 tabindex="0"
                                 role="button"
                                 aria-label="Learn more about PruBSN Prihatin">
                                <img src="{{ asset('assets/images/charity/prubsn.png') }}"
                                     alt="PruBSN Prihatin Logo"
                                     class="w-32 h-32 object-contain filter grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-300"
                                     loading="lazy">
                                <!-- Hover indicator -->
                                <div class="hover-indicator absolute bottom-3 right-3 w-8 h-8 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center shadow-lg">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="mb-3">
                                <h3 class="text-xl font-bold text-gray-900">PruBSN Prihatin</h3>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                A charitable body under Prudential BSN Takaful providing educational opportunities, life skills,
                                health and well-being support, and disaster relief for underprivileged communities.
                            </p>

                            <!-- Action Section -->
                            <div class="flex items-center justify-between">
                                <a href="https://www.prubsn.com.my/ms/caring-for-society/" target="_blank"
                                   class="inline-flex items-center text-primary-500 font-semibold hover:text-primary-600 transition-colors group">
                                    Learn More
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <span class="text-xs text-gray-400">Corporate Foundation</span>
                            </div>
                        </div>
                    </div>

                    <!-- Yayasan Angkasa -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:border-primary-200 transform hover:scale-105">
                        <!-- Logo Section -->
                        <div class="h-56 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <div class="logo-container w-48 h-48 bg-gradient-to-br from-teal-50 to-teal-100 rounded-full shadow-xl hover:shadow-2xl flex items-center justify-center p-6 transition-all duration-700 hover:scale-110 hover:-translate-y-4 hover:rotate-3 group cursor-pointer animate-float-delay-5"
                                 tabindex="0"
                                 role="button"
                                 aria-label="Learn more about Yayasan Angkasa">
                                <img src="{{ asset('assets/images/charity/yaysanangkasa.png') }}"
                                     alt="Yayasan Angkasa Logo"
                                     class="w-32 h-32 object-contain filter grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-300"
                                     loading="lazy">
                                <!-- Hover indicator -->
                                <div class="hover-indicator absolute bottom-3 right-3 w-8 h-8 bg-teal-500 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center shadow-lg">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="mb-3">
                                <h3 class="text-xl font-bold text-gray-900">Yayasan Angkasa</h3>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                A foundation established by the Malaysian National Cooperative Movement providing educational financing,
                                motivation courses, and entrepreneurship programs to develop skilled individuals.
                            </p>

                            <!-- Action Section -->
                            <div class="flex items-center justify-between">
                                <a href="https://www.yayasanangkasa.coop/" target="_blank"
                                   class="inline-flex items-center text-primary-500 font-semibold hover:text-primary-600 transition-colors group">
                                    Learn More
                                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                                <span class="text-xs text-gray-400">Educational Foundation</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section with Animations -->
        <section class="py-20 bg-primary-500 relative overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-10 left-10 w-24 h-24 bg-white/10 rounded-full blur-2xl animate-float"></div>
                <div class="absolute bottom-10 right-10 w-32 h-32 bg-white/5 rounded-full blur-3xl animate-float-delayed"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 animate-on-scroll" data-animation="fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 animate-fade-in-up" style="animation-delay: 0.1s;">
                    Want to Become Our Partner?
                </h2>
                <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s;">
                    If your organization is interested in partnering with Jariah Fund to help the community,
                    contact us to learn about the application process to become a verified partner.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up" style="animation-delay: 0.3s;">
                    <a href="{{ url('/contact') }}" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg animate-pulse-button">
                        Contact Us
                    </a>
                    <a href="{{ url('/about') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-500 transition-all duration-300 transform hover:scale-105">
                        About Jariah Fund
                    </a>
                </div>
            </div>
        </section>

@endsection

@push('styles')
<style>
    /* Enhanced logo animations */
    .logo-container {
        position: relative;
        overflow: hidden;
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.1),
            0 8px 16px rgba(0, 0, 0, 0.06),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
    }

    /* Background Animation Keyframes */
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-20px) rotate(1deg); }
        66% { transform: translateY(-10px) rotate(-1deg); }
    }

    @keyframes float-delayed {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-15px) rotate(-1deg); }
        66% { transform: translateY(-8px) rotate(1deg); }
    }

    @keyframes float-slow {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-12px) rotate(0.5deg); }
    }

    /* Entrance Animations */
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
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
        }
        50% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }
    }

    /* Logo floating animation */
    @keyframes logo-float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        33% {
            transform: translateY(-8px) rotate(1deg);
        }
        66% {
            transform: translateY(-4px) rotate(-1deg);
        }
    }

    /* Animation Classes */
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-float-delayed {
        animation: float-delayed 8s ease-in-out infinite;
    }

    .animate-float-slow {
        animation: float-slow 10s ease-in-out infinite;
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

    /* Scroll-triggered animations */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.8s ease-out;
    }

    .animate-on-scroll.animate-in {
        opacity: 1;
        transform: translateY(0);
    }

    .animate-on-scroll[data-animation="fade-in-up"] {
        transform: translateY(50px);
    }

    .animate-on-scroll[data-animation="fade-in-up"].animate-in {
        transform: translateY(0);
    }

    .animate-float-delay-1 {
        animation: float 6s ease-in-out infinite;
        animation-delay: -1s;
    }

    .animate-float-delay-2 {
        animation: float 6s ease-in-out infinite;
        animation-delay: -2s;
    }

    .animate-float-delay-3 {
        animation: float 6s ease-in-out infinite;
        animation-delay: -3s;
    }

    .animate-float-delay-4 {
        animation: float 6s ease-in-out infinite;
        animation-delay: -4s;
    }

    .animate-float-delay-5 {
        animation: float 6s ease-in-out infinite;
        animation-delay: -5s;
    }

    /* Shimmer effect on hover */
    .logo-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
        transform: rotate(45deg) translateX(-100%);
        transition: transform 0.8s ease;
        opacity: 0;
    }

    .logo-container:hover::before {
        transform: rotate(45deg) translateX(100%);
        opacity: 1;
    }

    /* Enhanced hover effects */
    .logo-container:hover {
        box-shadow:
            0 30px 60px rgba(0, 0, 0, 0.15),
            0 12px 24px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.9);
        animation-play-state: paused;
    }

    /* Focus states for accessibility */
    .logo-container:focus {
        outline: none;
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.1),
            0 8px 16px rgba(0, 0, 0, 0.06),
            0 0 0 4px rgba(59, 130, 246, 0.3);
    }

    /* Smooth transitions */
    .logo-container img {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Pulse animation for hover indicators */
    @keyframes pulse-gentle {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    .logo-container:hover .hover-indicator {
        animation: pulse-gentle 1.5s infinite;
    }

    /* Gradient animation */
    @keyframes gradient-shift {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    .logo-container {
        background-size: 200% 200%;
        animation: gradient-shift 8s ease infinite;
    }

    /* Staggered entrance animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .logo-container {
        animation: fadeInUp 0.8s ease-out, float 6s ease-in-out infinite 0.8s;
    }

    .animate-float-delay-1 {
        animation: fadeInUp 0.8s ease-out 0.1s both, float 6s ease-in-out infinite 0.9s;
    }

    .animate-float-delay-2 {
        animation: fadeInUp 0.8s ease-out 0.2s both, float 6s ease-in-out infinite 1s;
    }

    .animate-float-delay-3 {
        animation: fadeInUp 0.8s ease-out 0.3s both, float 6s ease-in-out infinite 1.1s;
    }

    .animate-float-delay-4 {
        animation: fadeInUp 0.8s ease-out 0.4s both, float 6s ease-in-out infinite 1.2s;
    }

    .animate-float-delay-5 {
        animation: fadeInUp 0.8s ease-out 0.5s both, float 6s ease-in-out infinite 1.3s;
    }
</style>
@endpush

@push('scripts')
<script>
    // Scroll-triggered animations
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Parallax effect for background elements
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.animate-float, .animate-float-delayed, .animate-float-slow');

            parallaxElements.forEach((element, index) => {
                const speed = 0.5 + (index * 0.1);
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

    // Enhanced partner logo interactions
        const logoContainers = document.querySelectorAll('.logo-container');

        logoContainers.forEach(container => {
            // Add click functionality
            container.addEventListener('click', function() {
                const partnerName = this.getAttribute('aria-label').replace('Learn more about ', '');
                showPartnerInfo(partnerName);
            });

            // Add keyboard support
            container.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });

            // Add hover sound effect (optional)
            container.addEventListener('mouseenter', function() {
                // You can add a subtle sound effect here
                this.style.transform = 'scale(1.05) translateY(-8px)';
            });

            container.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });
    });

    function showPartnerInfo(partnerName) {
        // Create a simple modal or redirect to partner page
        const partnerInfo = {
            'Yayasan Muslimin': {
                description: 'Islamic foundation dedicated to community welfare and religious education.',
                focus: 'Religious Education, Community Welfare',
                established: '1995'
            },
            'Yayasan Ikhlas': {
                description: 'Charitable organization focused on humanitarian aid and disaster relief.',
                focus: 'Humanitarian Aid, Emergency Response',
                established: '2001'
            },
            'Malaysian Association for the Blind': {
                description: 'Leading organization supporting visually impaired individuals in Malaysia.',
                focus: 'Disability Support, Accessibility',
                established: '1951'
            },
            'National Autism Society of Malaysia': {
                description: 'Dedicated to supporting individuals with autism and their families.',
                focus: 'Autism Support, Special Education',
                established: '1987'
            },
            'PruBSN Prihatin': {
                description: 'Corporate foundation focused on education and community development.',
                focus: 'Education, Corporate Social Responsibility',
                established: '2010'
            },
            'Yayasan Angkasa': {
                description: 'Educational foundation promoting learning and development opportunities.',
                focus: 'Education, Youth Development',
                established: '1998'
            }
        };

        const info = partnerInfo[partnerName];
        if (info) {
            alert(`${partnerName}\n\n${info.description}\n\nFocus Areas: ${info.focus}\nEstablished: ${info.established}`);
            // In a real implementation, you'd show a proper modal or navigate to a detailed page
        }
    }
</script>
@endpush
