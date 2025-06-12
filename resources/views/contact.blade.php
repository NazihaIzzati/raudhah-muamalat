@extends('layouts.master')

@section('title', 'Contact Us - Jariah Fund')
@section('description', 'Get in touch with our expert team. We provide professional guidance and assistance to help you make a meaningful impact in your community.')

@push('styles')
<style>
/* Clean Card Styling */
.contact-form-card {
  background: white;
  border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(254, 81, 0, 0.1);
  transition: all 0.3s ease;
}

.contact-form-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
  border-color: rgba(254, 81, 0, 0.2);
}

/* Animation Keyframes */
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

@keyframes float-gentle {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
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

@keyframes slide-in-left {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slide-in-right {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
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

@keyframes pulse-gentle {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.02);
    }
}

@keyframes bounce-gentle {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
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

.animate-float-gentle {
    animation: float-gentle 4s ease-in-out infinite;
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

.animate-pulse-gentle {
    animation: pulse-gentle 3s ease-in-out infinite;
}

.animate-bounce-gentle {
    animation: bounce-gentle 2s ease-in-out infinite;
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

.animate-on-scroll[data-animation="slide-in-left"] {
    transform: translateX(-50px);
}

.animate-on-scroll[data-animation="slide-in-left"].animate-in {
    transform: translateX(0);
}

.animate-on-scroll[data-animation="slide-in-right"] {
    transform: translateX(50px);
}

.animate-on-scroll[data-animation="slide-in-right"].animate-in {
    transform: translateX(0);
}

/* Form input animations */
.form-input-focus {
    transform: scale(1.02);
    box-shadow: 0 0 0 3px rgba(254, 81, 0, 0.1);
}

/* Enhanced hover effects */
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}
</style>
@endpush

@section('content')

        @include('components.hero-section', [
            'badge' => [
                'text' => 'Contact Us',
                'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>'
            ],
            'title' => 'Get in Touch with',
            'subtitle' => 'Our Expert Team',
            'description' => 'We\'re here to support your <strong>Islamic crowdfunding journey</strong>. Our dedicated team provides',
            'highlights' => [
                ['text' => 'professional guidance', 'delay' => '0.6s'],
                ['text' => 'meaningful impact', 'delay' => '0.8s']
            ],
            'pills' => [
                ['text' => '24/7 Support', 'delay' => '0.6s'],
                ['text' => 'Expert Guidance', 'delay' => '0.7s'],
                ['text' => 'Quick Response', 'delay' => '0.8s']
            ]
        ])

        <!-- Contact Information Section with Animations -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Contact Information Section -->
                    <div class="space-y-8 animate-on-scroll" data-animation="slide-in-left">
                        <!-- Contact Information Cards -->
                        <div class="space-y-6">
                            <!-- Office Address -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl hover:scale-105 hover:border-primary-200 border border-gray-100 transition-all duration-300 group cursor-pointer animate-fade-in-up" style="animation-delay: 0.1s;" onclick="openMap()">
                                <div class="p-6">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 animate-pulse-gentle">
                                            <svg class="w-6 h-6 text-primary-500 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors duration-300">Visit Our Office</h3>
                                            <p class="text-gray-600 text-sm leading-relaxed mb-4 group-hover:text-gray-700 transition-colors duration-300">
                                                Menara Muamalat<br>
                                                No. 22, Jalan Melaka<br>
                                                50100 Kuala Lumpur, Malaysia
                                            </p>
                                            <span class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors animate-bounce-gentle">
                                                View on Map
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone Support -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl hover:scale-105 hover:border-primary-200 border border-gray-100 transition-all duration-300 group cursor-pointer" onclick="callPhone()">
                                <div class="p-6">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900 mb-3">Call Us</h3>
                                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                                +60 3-2161 2000<br>
                                                +60 3-2161 2001
                                            </p>
                                            <span class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                                                Call Now
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Email Support -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl hover:scale-105 hover:border-primary-200 border border-gray-100 transition-all duration-300 group cursor-pointer" onclick="sendEmail()">
                                <div class="p-6">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900 mb-3">Email Us</h3>
                                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                                jariahfund@muamalat.com.my<br>
                                                support@jariahfund.com
                                            </p>
                                            <span class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                                                Send Email
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Business Hours -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl hover:scale-105 hover:border-primary-200 border border-gray-100 transition-all duration-300 cursor-pointer">
                                <div class="p-6">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900 mb-3">Business Hours</h3>
                                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                                Monday - Friday: 9:00 AM - 6:00 PM<br>
                                                Saturday: 9:00 AM - 1:00 PM<br>
                                                Sunday: Closed
                                            </p>
                                            <span class="text-gray-500 text-xs">GMT+8 (Malaysia Time)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Media & Additional Contact -->
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl hover:scale-105 hover:border-primary-200 border border-gray-100 transition-all duration-300 cursor-pointer">
                                <div class="p-6">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900 mb-3">Follow Us</h3>
                                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                                Stay connected with us on social media for the latest updates and community stories.
                                            </p>
                                            <div class="flex space-x-3">
                                                <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                                    </svg>
                                                </a>
                                                <a href="#" class="w-8 h-8 bg-blue-800 text-white rounded-full flex items-center justify-center hover:bg-blue-900 transition-colors">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                                    </svg>
                                                </a>
                                                <a href="#" class="w-8 h-8 bg-pink-600 text-white rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                                                    </svg>
                                                </a>
                                                <a href="#" class="w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form Section -->
                    <div class="contact-form-card p-8 animate-on-scroll animate-float-gentle" data-animation="slide-in-right">
                        <div class="text-center mb-8">
                            <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-gentle">
                                <svg class="w-8 h-8 text-primary-500 animate-bounce-gentle" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2 animate-fade-in-up" style="animation-delay: 0.2s;">Send us a Message</h2>
                            <p class="text-gray-600 leading-relaxed animate-fade-in-up" style="animation-delay: 0.3s;">
                                Fill out the form below and we'll get back to you within <span class="font-semibold text-primary-600 animate-highlight">24 hours</span>
                            </p>
                        </div>
                        <form id="contact-form" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first-name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        First Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="first-name" name="first-name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-400 transition-all duration-200"
                                           placeholder="Enter your first name">
                                </div>
                                <div>
                                    <label for="last-name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Last Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="last-name" name="last-name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-400 transition-all duration-200"
                                           placeholder="Enter your last name">
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-400 transition-all duration-200"
                                       placeholder="Enter your email address">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Phone Number <span class="text-gray-400">(Optional)</span>
                                </label>
                                <input type="tel" id="phone" name="phone"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-400 transition-all duration-200"
                                       placeholder="+60 12-345 6789">
                            </div>
                            <div>
                                <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Subject <span class="text-red-500">*</span>
                                </label>
                                <select id="subject" name="subject" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 transition-all duration-200">
                                    <option value="">Select a subject</option>
                                    <option value="campaign">Campaign Support</option>
                                    <option value="donation">Donation Inquiry</option>
                                    <option value="partnership">Partnership Opportunity</option>
                                    <option value="technical">Technical Support</option>
                                    <option value="media">Media & Press</option>
                                    <option value="general">General Inquiry</option>
                                </select>
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Message <span class="text-red-500">*</span>
                                </label>
                                <textarea id="message" name="message" rows="5" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-gray-900 placeholder-gray-400 resize-vertical transition-all duration-200"
                                          placeholder="Please describe your inquiry in detail..."></textarea>
                                <p class="text-xs text-gray-500 mt-1">Minimum 10 characters required</p>
                            </div>
                            <!-- Privacy Notice -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <div class="flex items-start space-x-3">
                                    <svg class="w-5 h-5 text-primary-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-700 font-medium mb-1">Privacy & Security</p>
                                        <p class="text-xs text-gray-600">
                                            Your information is encrypted and secure. We respect your privacy and will only use your details to respond to your inquiry.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="submit-btn" class="w-full bg-primary-500 text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-200 transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                <span id="submit-text" class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Send Message
                                </span>
                                <span id="submit-loading" class="hidden items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Sending...
                                </span>
                            </button>

                            <!-- Success/Error Messages -->
                            <div id="form-message" class="hidden mt-4 p-4 rounded-lg"></div>

                            <!-- Form Footer -->
                            <div class="mt-6 text-center">
                                <p class="text-gray-500 text-sm">
                                    <span class="text-red-500">*</span> Required fields |
                                    Response time: <span class="font-semibold text-primary-600">Within 24 hours</span>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>



@endsection

@push('scripts')
<script>
    // Contact interactions
    function openMap() {
        const address = "Menara Muamalat, No. 22, Jalan Melaka, Kuala Lumpur, Malaysia 50100";
        const encodedAddress = encodeURIComponent(address);
        window.open(`https://www.google.com/maps/search/?api=1&query=${encodedAddress}`, '_blank');
    }

    function callPhone() {
        window.location.href = 'tel:+60321612000';
    }

    function sendEmail() {
        window.location.href = 'mailto:jariahfund@muamalat.com.my?subject=Inquiry from Jariah Fund Website';
    }

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

        // Enhanced form input animations
        const formInputs = document.querySelectorAll('input, select, textarea');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.add('form-input-focus');
            });

            input.addEventListener('blur', function() {
                this.classList.remove('form-input-focus');
            });
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

    // Form validation and submission
        const form = document.getElementById('contact-form');
        const submitBtn = document.getElementById('submit-btn');
        const submitText = document.getElementById('submit-text');
        const submitLoading = document.getElementById('submit-loading');
        const formMessage = document.getElementById('form-message');

        // Form validation
        function validateForm() {
            const firstName = document.getElementById('first-name').value.trim();
            const lastName = document.getElementById('last-name').value.trim();
            const email = document.getElementById('email').value.trim();
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value.trim();

            if (!firstName || !lastName || !email || !subject || !message) {
                showMessage('Please fill in all required fields.', 'error');
                return false;
            }

            if (message.length < 10) {
                showMessage('Message must be at least 10 characters long.', 'error');
                return false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showMessage('Please enter a valid email address.', 'error');
                return false;
            }

            return true;
        }

        // Show message function
        function showMessage(text, type) {
            formMessage.className = `mt-4 p-4 rounded-lg ${type === 'success' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200'}`;
            formMessage.textContent = text;
            formMessage.classList.remove('hidden');

            // Auto hide after 5 seconds
            setTimeout(() => {
                formMessage.classList.add('hidden');
            }, 5000);
        }

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateForm()) {
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            submitLoading.classList.remove('hidden');
            submitLoading.classList.add('flex');

            // Simulate form submission (replace with actual API call)
            setTimeout(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                submitLoading.classList.add('hidden');
                submitLoading.classList.remove('flex');

                // Show success message
                showMessage('Thank you for your message! We\'ll get back to you within 24 hours.', 'success');

                // Reset form
                form.reset();
            }, 2000);
        });

        // Real-time validation feedback
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.classList.add('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
                    this.classList.remove('border-gray-300', 'focus:border-primary-500', 'focus:ring-primary-500');
                } else {
                    this.classList.remove('border-red-300', 'focus:border-red-500', 'focus:ring-red-500');
                    this.classList.add('border-gray-300', 'focus:border-primary-500', 'focus:ring-primary-500');
                }
            });
        });
    });
</script>
@endpush
