@extends('layouts.master')

@section('title', 'News & Events - Jariah Fund')
@section('description', 'Stay updated with our latest initiatives, success stories, and upcoming events. Discover how your contributions are making a real difference.')

@section('content')

        @include('components.hero-section', [
            'badge' => [
                'text' => 'News & Events',
                'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>'
            ],
            'title' => 'Stay Connected with',
            'subtitle' => 'Our Mission',
            'description' => 'Stay updated with our <strong>latest initiatives, success stories, and upcoming events</strong>. Discover how your contributions are making a',
            'highlights' => [
                ['text' => 'real difference', 'delay' => '0.6s'],
                ['text' => 'communities across Malaysia', 'delay' => '0.8s']
            ],
            'pills' => [
                ['text' => 'Latest Updates', 'delay' => '0.6s'],
                ['text' => 'Impact Stories', 'delay' => '0.7s'],
                ['text' => 'Community Events', 'delay' => '0.8s']
            ]
        ])

        <!-- Featured News Section with Animations -->
        <section id="news" class="py-12 md:py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 md:mb-8 gap-3 animate-on-scroll" data-animation="fade-in-up">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Featured News</h2>
                    <a href="#" class="text-primary-500 font-medium hover:text-primary-600 text-sm md:text-base hover:scale-105 transition-all duration-300">View all</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 animate-on-scroll" data-animation="stagger-up">
                    <!-- Featured News Card 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <img src="{{ asset('images/news/success.jpg') }}"
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
                        <img src="{{ asset('images/news/success_02.jpg') }}"
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
                        <img src="{{ asset('images/news/success_03.jpg') }}"
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

        <!-- Call to Action Section with Animations -->
        <section class="py-20 bg-primary-500 relative overflow-hidden">
            <!-- Animated Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-10 left-10 w-24 h-24 bg-white/10 rounded-full blur-2xl animate-float"></div>
                <div class="absolute bottom-10 right-10 w-32 h-32 bg-white/5 rounded-full blur-3xl animate-float-delayed"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 animate-on-scroll" data-animation="fade-in-up">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 animate-fade-in-up" style="animation-delay: 0.1s;">
                    Stay Connected with Our Mission
                </h2>
                <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s;">
                    Subscribe to our newsletter to receive the latest updates on our campaigns, success stories,
                    and upcoming events. Be part of our community making a difference.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up" style="animation-delay: 0.3s;">
                    <a href="#" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg animate-pulse-button">
                        Subscribe Newsletter
                    </a>
                    <a href="{{ url('/campaigns') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-500 transition-all duration-300 transform hover:scale-105">
                        View Campaigns
                    </a>
                </div>
            </div>
        </section>

@endsection

@push('styles')
<style>
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

    @keyframes card-hover {
        0% {
            transform: translateY(0) scale(1);
        }
        100% {
            transform: translateY(-10px) scale(1.02);
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

    .animate-on-scroll[data-animation="stagger-up"] .news-card {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }

    .animate-on-scroll[data-animation="stagger-up"].animate-in .news-card {
        opacity: 1;
        transform: translateY(0);
    }

    /* Enhanced card animations */
    .news-card {
        transition: all 0.3s ease;
    }

    .news-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .news-card img {
        transition: transform 0.3s ease;
    }

    .news-card:hover img {
        transform: scale(1.1);
    }

    /* Badge animations */
    .news-badge {
        transition: all 0.3s ease;
    }

    .news-card:hover .news-badge {
        transform: scale(1.1);
    }

    /* Button hover effects */
    .news-button {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .news-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .news-button:hover::before {
        left: 100%;
    }

    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Loading animation for images */
    .news-card img {
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .news-card img.loaded {
        opacity: 1;
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

                    // Staggered animation for news cards
                    if (entry.target.dataset.animation === 'stagger-up') {
                        const cards = entry.target.querySelectorAll('.news-card');
                        cards.forEach((card, index) => {
                            setTimeout(() => {
                                card.style.transitionDelay = `${index * 0.1}s`;
                            }, 100);
                        });
                    }
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Add news-card class to all news cards for animations
        document.querySelectorAll('.bg-white.rounded-lg.overflow-hidden.shadow-lg, .bg-white.rounded-lg.overflow-hidden.shadow-md').forEach(card => {
            card.classList.add('news-card');
        });

        // Add news-badge class to all badges
        document.querySelectorAll('[class*="bg-"][class*="100"][class*="text-"][class*="800"]').forEach(badge => {
            badge.classList.add('news-badge');
        });

        // Add news-button class to all buttons
        document.querySelectorAll('a[class*="bg-primary-500"]').forEach(button => {
            button.classList.add('news-button');
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

        // Image loading animation
        const images = document.querySelectorAll('.news-card img');
        images.forEach(img => {
            if (img.complete) {
                img.classList.add('loaded');
            } else {
                img.addEventListener('load', function() {
                    this.classList.add('loaded');
                });
            }
        });

        // Enhanced hover effects for cards
        document.querySelectorAll('.news-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
                this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
                this.style.boxShadow = '';
            });
        });

        // Smooth scroll for internal links
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
    });
</script>
@endpush
