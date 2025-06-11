@extends('layouts.master')

@section('title', 'Partners - Jariah Fund Raudhah Muamalat')
@section('description', 'We work together with trusted and verified organizations to provide assistance to those in need. Each partner is thoroughly vetted to ensure complete transparency.')

@section('content')

        <!-- Hero Section -->
        <section class="py-20 bg-gradient-to-br from-primary-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-6">
                        <svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">Our Partners</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Our Trusted
                        <span class="text-primary-500 relative block">
                            Partners
                            <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-64 h-3 text-primary-200" viewBox="0 0 100 12" fill="currentColor">
                                <path d="M0 8c30-4 70-4 100 0v4H0z"/>
                            </svg>
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed mb-8">
                        We work together with <strong>trusted and verified organizations</strong> to provide assistance to those in need.
                        Each partner is thoroughly vetted to ensure <span class="text-primary-600 font-medium">complete transparency</span> and
                        <span class="text-primary-600 font-medium">effective impact</span>.
                    </p>
                    <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-600">
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Verified Organizations
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Transparent Impact
                        </div>
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            Trusted Network
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Partners Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-10">
                    <!-- Yayasan Muslimin -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:border-primary-200 transform hover:scale-105">
                        <!-- Logo Section -->
                        <div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <img src="{{ asset('images/charity/yayasanmuslim.png') }}"
                                 alt="Yayasan Muslimin"
                                 class="w-32 h-24 object-contain">
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900">Yayasan Muslimin</h3>
                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                    ✓ Verified
                                </span>
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
                        <div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <img src="{{ asset('images/charity/yayasanikhlas.png') }}"
                                 alt="Yayasan Ikhlas"
                                 class="w-32 h-24 object-contain">
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900">Yayasan Ikhlas</h3>
                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                    ✓ Verified
                                </span>
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
                        <div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <img src="{{ asset('images/charity/mab.png') }}"
                                 alt="Malaysian Association for the Blind"
                                 class="w-32 h-24 object-contain">
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900">Malaysian Association for the Blind (MAB)</h3>
                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                    ✓ Verified
                                </span>
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
                        <div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <img src="{{ asset('images/charity/nasom.png') }}"
                                 alt="National Autism Society of Malaysia"
                                 class="w-32 h-24 object-contain">
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900">National Autism Society of Malaysia (NASOM)</h3>
                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                    ✓ Verified
                                </span>
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
                        <div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <img src="{{ asset('images/charity/prubsn.png') }}"
                                 alt="PruBSN Prihatin"
                                 class="w-32 h-24 object-contain">
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900">PruBSN Prihatin</h3>
                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                    ✓ Verified
                                </span>
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
                        <div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-8">
                            <img src="{{ asset('images/charity/yaysanangkasa.png') }}"
                                 alt="Yayasan Angkasa"
                                 class="w-32 h-24 object-contain">
                        </div>

                        <!-- Content Section -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900">Yayasan Angkasa</h3>
                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
                                    ✓ Verified
                                </span>
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
                    <a href="{{ url('/contact') }}" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Contact Us
                    </a>
                    <a href="{{ url('/about') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-500 transition-colors">
                        About Jariah Fund
                    </a>
                </div>
            </div>
        </section>

@endsection
