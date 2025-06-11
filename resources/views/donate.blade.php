@extends('layouts.master')

@section('title', 'Donate Now - Jariah Fund')
@section('description', 'Make a secure donation to support meaningful campaigns that create lasting impact in communities across Malaysia. Every donation makes a difference.')

@push('styles')
<style>
/* Donation Page Animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.05);
  }
}

@keyframes heartbeat {
  0%, 100% {
    transform: scale(1);
  }
  25% {
    transform: scale(1.1);
  }
  50% {
    transform: scale(1);
  }
  75% {
    transform: scale(1.05);
  }
}

@keyframes progressFill {
  from {
    width: 0%;
  }
  to {
    width: 73%;
  }
}

@keyframes shimmer {
  0% {
    background-position: -200% 0;
  }
  100% {
    background-position: 200% 0;
  }
}

/* Animation Classes */
.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
}

.animate-slide-in-left {
  animation: slideInLeft 0.8s ease-out forwards;
}

.animate-slide-in-right {
  animation: slideInRight 0.8s ease-out forwards;
}

.animate-pulse-gentle {
  animation: pulse 2s ease-in-out infinite;
}

.animate-heartbeat {
  animation: heartbeat 1.5s ease-in-out infinite;
}

.animate-progress {
  animation: progressFill 2s ease-out forwards;
}

.animate-shimmer {
  background: linear-gradient(90deg, transparent, rgba(254, 81, 0, 0.1), transparent);
  background-size: 200% 100%;
  animation: shimmer 2s infinite;
}

/* Carousel Styles */
.carousel-container {
  position: relative;
  overflow: hidden;
  border-radius: 0.75rem;
}

.carousel-track {
  display: flex;
  transition: transform 0.5s ease-in-out;
  will-change: transform;
}

.carousel-slide {
  min-width: 100%;
  flex-shrink: 0;
  position: relative;
}

.carousel-slide img {
  display: block;
  width: 100%;
  height: 320px;
  object-fit: cover;
  object-position: center;
}

.carousel-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(4px);
  border: none;
  border-radius: 50%;
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 20;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.carousel-nav:hover {
  background: rgba(254, 81, 0, 0.9);
  color: white;
  transform: translateY(-50%) scale(1.1);
  box-shadow: 0 4px 12px rgba(254, 81, 0, 0.3);
}

.carousel-nav:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(254, 81, 0, 0.3);
}

.carousel-nav.prev {
  left: 16px;
}

.carousel-nav.next {
  right: 16px;
}

.carousel-indicators {
  position: absolute;
  bottom: 16px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 8px;
  z-index: 20;
}

.carousel-indicator {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.5);
  cursor: pointer;
  transition: all 0.3s ease;
  border: 2px solid rgba(255, 255, 255, 0.8);
}

.carousel-indicator.active {
  background: rgba(254, 81, 0, 0.9);
  border-color: rgba(254, 81, 0, 0.9);
  transform: scale(1.2);
}

.carousel-indicator:hover {
  background: rgba(254, 81, 0, 0.7);
  border-color: rgba(254, 81, 0, 0.7);
}

/* Fallback for missing images */
.carousel-slide img[src*="campaigns/"]:not([src*="http"]) {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  display: flex;
  align-items: center;
  justify-content: center;
}

.carousel-slide img[src*="campaigns/"]:not([src*="http"])::before {
  content: "📷";
  font-size: 3rem;
  color: white;
}

/* Hover Animations */
.hover-lift {
  transition: all 0.3s ease;
}

.hover-lift:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.hover-scale {
  transition: transform 0.3s ease;
}

.hover-scale:hover {
  transform: scale(1.05);
}

.hover-glow {
  transition: all 0.3s ease;
}

.hover-glow:hover {
  box-shadow: 0 0 20px rgba(254, 81, 0, 0.3);
}

/* Staggered Animation Delays */
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
.delay-600 { animation-delay: 0.6s; }

/* Initial hidden state for animations */
.animate-on-scroll {
  opacity: 0;
  transform: translateY(30px);
}

.animate-on-scroll.animated {
  opacity: 1;
  transform: translateY(0);
  transition: all 0.8s ease-out;
}
</style>
@endpush

@section('content')

        <!-- Hero Section -->
        <section class="py-20 bg-gradient-to-br from-primary-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-6 animate-fade-in-up">
                        <svg class="w-4 h-4 text-primary-600 mr-2 animate-heartbeat" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">Secure Donation</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6 animate-fade-in-up delay-200">
                        Make a Difference
                        <span class="text-primary-500 relative block">
                            Today
                            <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-64 h-3 text-primary-200" viewBox="0 0 100 12" fill="currentColor">
                                <path d="M0 8c30-4 70-4 100 0v4H0z"/>
                            </svg>
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed mb-8 animate-fade-in-up delay-400">
                        Support <strong>verified campaigns</strong> that make a real difference in communities worldwide.
                        Each donation is secured with <span class="text-primary-600 font-medium">complete transparency</span> and
                        <span class="text-primary-600 font-medium">effective impact</span>.
                    </p>
                </div>
            </div>
        </section>

        <!-- Campaign & Donation Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                    <!-- Campaign Information - Left Side -->
                    <div class="order-2 lg:order-1 animate-slide-in-left">
                        <!-- Campaign Image Carousel -->
                        <div class="relative mb-8 hover-lift">
                            <div class="carousel-container rounded-xl overflow-hidden">
                                <div class="carousel-track" id="carouselTrack">
                                    <!-- Slide 1 - Eye Examination -->
                                    <div class="carousel-slide">
                                        <img src="{{ asset('images/campaigns/01.jpg') }}"
                                             onerror="this.src='https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'"
                                             alt="Eye examination for students"
                                             class="w-full h-80 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent flex items-end">
                                            <div class="p-8 text-white w-full">
                                                <div class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                                                    <span class="text-white font-medium text-sm">Featured Campaign</span>
                                                </div>
                                                <h1 class="text-3xl font-bold mb-2">Vision for Education Program</h1>
                                                <p class="text-white/90 text-base">Providing free eye care and glasses for underprivileged students</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Slide 2 - Students with Glasses -->
                                    <div class="carousel-slide">
                                        <img src="{{ asset('images/campaigns/02.jpg') }}"
                                             onerror="this.src='https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'"
                                             alt="Students wearing glasses in classroom"
                                             class="w-full h-80 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent flex items-end">
                                            <div class="p-8 text-white w-full">
                                                <div class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                                                    <span class="text-white font-medium text-sm">Impact Story</span>
                                                </div>
                                                <h1 class="text-3xl font-bold mb-2">Improved Learning Experience</h1>
                                                <p class="text-white/90 text-base">Students can now see clearly and participate fully in their education</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Slide 3 - Eye Care Equipment -->
                                    <div class="carousel-slide">
                                        <img src="{{ asset('images/campaigns/03.jpg') }}"
                                             onerror="this.src='https://images.unsplash.com/photo-1559757148-5c350d0d3c56?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'"
                                             alt="Eye care equipment and examination tools"
                                             class="w-full h-80 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent flex items-end">
                                            <div class="p-8 text-white w-full">
                                                <div class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                                                    <span class="text-white font-medium text-sm">Professional Care</span>
                                                </div>
                                                <h1 class="text-3xl font-bold mb-2">Quality Eye Examinations</h1>
                                                <p class="text-white/90 text-base">Professional equipment ensures accurate diagnosis and treatment</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Slide 4 - Community Impact -->
                                    <div class="carousel-slide">
                                        <img src="{{ asset('images/campaigns/04.jpg') }}"
                                             onerror="this.src='https://images.unsplash.com/photo-1509062522246-3755977927d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'"
                                             alt="Community children and families"
                                             class="w-full h-80 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent flex items-end">
                                            <div class="p-8 text-white w-full">
                                                <div class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                                                    <span class="text-white font-medium text-sm">Community Impact</span>
                                                </div>
                                                <h1 class="text-3xl font-bold mb-2">Supporting B40 Families</h1>
                                                <p class="text-white/90 text-base">Reducing financial burden while improving children's quality of life</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation Buttons -->
                                <button class="carousel-nav prev" onclick="previousSlide()">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </button>
                                <button class="carousel-nav next" onclick="nextSlide()">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>

                                <!-- Indicators -->
                                <div class="carousel-indicators">
                                    <div class="carousel-indicator active" onclick="goToSlide(0)"></div>
                                    <div class="carousel-indicator" onclick="goToSlide(1)"></div>
                                    <div class="carousel-indicator" onclick="goToSlide(2)"></div>
                                    <div class="carousel-indicator" onclick="goToSlide(3)"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Indicator -->
                        <div class="bg-white rounded-xl p-6 mb-8 border border-gray-100 hover-lift animate-on-scroll delay-200">
                            <div class="flex justify-between items-baseline mb-4">
                                <div>
                                    <div class="text-2xl font-bold text-gray-900 animate-pulse-gentle">RM 45,230</div>
                                    <div class="text-sm text-gray-500">raised of RM 62,000 goal</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-semibold text-primary-600 animate-pulse-gentle">73%</div>
                                    <div class="text-sm text-gray-500">funded</div>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                                <div class="bg-primary-500 h-2 rounded-full animate-progress animate-shimmer" style="width: 73%"></div>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    @include('components.uxwing-icon', ['name' => 'people', 'class' => 'w-4 h-4 mr-2'])
                                    <span>234 donors</span>
                                </div>
                                <div class="animate-pulse-gentle">15 days left</div>
                            </div>

                            <!-- Audit Trail Toggle -->
                            <div class="border-t border-gray-100 pt-4">
                                <button onclick="toggleAuditTrail()"
                                        class="flex items-center justify-between w-full text-left text-sm font-medium text-gray-700 hover:text-primary-600 transition-colors"
                                        id="audit-trail-toggle">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        Progress History & Milestones
                                    </span>
                                    <svg class="w-4 h-4 transform transition-transform duration-200" id="audit-trail-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <!-- Audit Trail Content -->
                                <div id="audit-trail-content" class="hidden mt-4 space-y-4">
                                    <!-- Milestones Section -->
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <h4 class="font-medium text-gray-900 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Campaign Milestones
                                        </h4>
                                        <div class="space-y-2">
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="flex items-center text-green-600">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                                    </svg>
                                                    50% Goal Reached
                                                </span>
                                                <span class="text-gray-500">RM 31,000</span>
                                            </div>
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="flex items-center text-green-600">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                                    </svg>
                                                    100 Donors Milestone
                                                </span>
                                                <span class="text-gray-500">RM 18,500</span>
                                            </div>
                                            <div class="flex items-center justify-between text-sm">
                                                <span class="flex items-center text-orange-600">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    75% Goal (Upcoming)
                                                </span>
                                                <span class="text-gray-500">RM 46,500</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Recent Progress Timeline -->
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <h4 class="font-medium text-gray-900 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Recent Progress
                                        </h4>
                                        <div class="space-y-3">
                                            <!-- Progress Entry 1 -->
                                            <div class="flex items-start space-x-3">
                                                <div class="w-2 h-2 bg-primary-500 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-sm font-medium text-gray-900">Major donation received</p>
                                                        <span class="text-xs text-gray-500">2 hours ago</span>
                                                    </div>
                                                    <p class="text-xs text-gray-600">+RM 2,500 • Progress: 69% → 73%</p>
                                                </div>
                                            </div>

                                            <!-- Progress Entry 2 -->
                                            <div class="flex items-start space-x-3">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-sm font-medium text-gray-900">50% milestone achieved</p>
                                                        <span class="text-xs text-gray-500">1 day ago</span>
                                                    </div>
                                                    <p class="text-xs text-gray-600">Reached RM 31,000 • 150 donors contributed</p>
                                                </div>
                                            </div>

                                            <!-- Progress Entry 3 -->
                                            <div class="flex items-start space-x-3">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-sm font-medium text-gray-900">Campaign featured on social media</p>
                                                        <span class="text-xs text-gray-500">3 days ago</span>
                                                    </div>
                                                    <p class="text-xs text-gray-600">Increased visibility • +45 new donors</p>
                                                </div>
                                            </div>

                                            <!-- Progress Entry 4 -->
                                            <div class="flex items-start space-x-3">
                                                <div class="w-2 h-2 bg-purple-500 rounded-full mt-2 flex-shrink-0"></div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between">
                                                        <p class="text-sm font-medium text-gray-900">First 100 donors milestone</p>
                                                        <span class="text-xs text-gray-500">1 week ago</span>
                                                    </div>
                                                    <p class="text-xs text-gray-600">RM 18,500 raised • 30% progress achieved</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Transparency Information -->
                                    <div class="bg-blue-50 rounded-lg p-4">
                                        <h4 class="font-medium text-gray-900 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            Transparency & Verification
                                        </h4>
                                        <div class="text-xs text-gray-600 space-y-1">
                                            <p>• All donations are tracked and verified in real-time</p>
                                            <p>• Progress updates are automatically recorded</p>
                                            <p>• Audit trail maintained for full transparency</p>
                                            <p>• Last verified: <span class="font-medium">Today, 3:45 PM</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Campaign Content -->
                        <div class="bg-white rounded-xl border border-gray-100 p-8 hover-lift animate-on-scroll delay-400">
                            <!-- Organization Info -->
                            <div class="flex items-center mb-8 pb-6 border-b border-gray-100">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center mr-4 bg-primary-50 hover-scale">
                                    <img src="{{ asset('images/charity/prubsn.png') }}"
                                         alt="PruBSN Prihatin"
                                         class="w-8 h-8 object-contain">
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">PruBSN Prihatin</h3>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 mr-3">Verified Corporate Foundation</span>
                                        <div class="flex items-center px-2 py-1 bg-green-50 rounded-full animate-pulse-gentle">
                                            <svg class="w-3 h-3 text-green-600 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                            </svg>
                                            <span class="text-xs font-medium text-green-700">Verified</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Campaign Title -->
                            <h1 class="text-2xl font-bold text-gray-900 mb-6 leading-tight">
                                Vision for Education Program
                            </h1>

                            <!-- Campaign Description -->
                            <div class="space-y-6">
                                <!-- Background Section -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Background</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        The Vision for Education Program is an initiative under PruBSN Prihatin that aims to help school students from asnaf and B40 groups who face vision problems. Beneficiaries will undergo free eye examinations, and if they require glasses or further examination, full assistance will be provided at no cost to them.
                                    </p>
                                </div>

                                <!-- Brief Info Section -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Program Overview</h3>
                                    <div class="space-y-4">
                                        <p class="text-gray-600 leading-relaxed">
                                            This contribution helps reduce inequality in access to eye healthcare. Rural or underprivileged communities are often overlooked in terms of eye care. This program provides them with equal opportunities to receive proper care.
                                        </p>
                                        <p class="text-gray-600 leading-relaxed">
                                            Assistance through this program can improve the overall productivity and quality of life for school students with vision problems. They can also perform daily tasks and classroom learning effectively without disruption due to vision issues.
                                        </p>
                                        <p class="text-gray-600 leading-relaxed">
                                            This program also helps with cost savings for underprivileged families. Eye examinations and glasses often require high costs. With this assistance, it can reduce the financial burden on families and allow them to use money for other needs such as food, education, and family welfare.
                                        </p>
                                    </div>
                                </div>

                                <!-- Key Benefits -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Why Support This Campaign?</h3>
                                    <div class="space-y-3">
                                        <div class="flex items-start space-x-3">
                                            <div class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900 text-sm">Equal Access to Healthcare</h4>
                                                <p class="text-gray-600 text-sm">Reduces inequality in eye healthcare access for rural and underprivileged communities.</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start space-x-3">
                                            <div class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900 text-sm">Improved Learning Outcomes</h4>
                                                <p class="text-gray-600 text-sm">Students can perform better in class without vision-related disruptions.</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start space-x-3">
                                            <div class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <svg class="w-3 h-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900 text-sm">Financial Relief for Families</h4>
                                                <p class="text-gray-600 text-sm">Reduces financial burden on families, allowing resources for other essential needs.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Required Assistance Section -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Required Assistance</h3>
                                    <p class="text-gray-600 leading-relaxed mb-4">
                                        The breakdown of required assistance includes essential items for the Vision for Education Campaign.
                                    </p>

                                    <!-- PDF Download Link -->
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:border-primary-300 transition-colors">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h4 class="font-medium text-gray-900 text-sm">Campaign Requirements Document</h4>
                                                    <p class="text-gray-600 text-xs">Detailed breakdown of assistance needed</p>
                                                </div>
                                            </div>
                                            <a href="https://jariahfund.muamalat.com.my/docs/15/QUO-2025-0001.pdf"
                                               target="_blank"
                                               class="inline-flex items-center px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-lg transition-colors hover:shadow-md">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Download PDF
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Share Section -->
                            <div class="border-t border-gray-100 pt-6 mt-8">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-medium text-gray-900 mb-1">Share this campaign</h4>
                                        <p class="text-sm text-gray-600">Help us reach more people</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button onclick="shareOnFacebook()" class="w-9 h-9 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center transition-colors" title="Share on Facebook">
                                            @include('components.uxwing-icon', ['name' => 'facebook', 'class' => 'w-4 h-4'])
                                        </button>
                                        <button onclick="shareOnTwitter()" class="w-9 h-9 bg-black hover:bg-gray-800 text-white rounded-lg flex items-center justify-center transition-colors" title="Share on X">
                                            @include('components.uxwing-icon', ['name' => 'twitter', 'class' => 'w-4 h-4'])
                                        </button>
                                        <button onclick="shareOnWhatsApp()" class="w-9 h-9 bg-green-500 hover:bg-green-600 text-white rounded-lg flex items-center justify-center transition-colors" title="Share on WhatsApp">
                                            @include('components.uxwing-icon', ['name' => 'whatsapp', 'class' => 'w-4 h-4'])
                                        </button>
                                        <button onclick="copyLink()" class="w-9 h-9 bg-gray-500 hover:bg-gray-600 text-white rounded-lg flex items-center justify-center transition-colors" title="Copy Link">
                                            @include('components.uxwing-icon', ['name' => 'copy-link', 'class' => 'w-4 h-4'])
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donation Form - Right Side -->
                    <div class="order-1 lg:order-2 animate-slide-in-right">
                        <div class="bg-white rounded-xl border border-gray-200 sticky top-6 hover-glow">
                            <!-- Form Header -->
                            <div class="px-8 py-6 border-b border-gray-100">
                                <h2 class="text-xl font-semibold text-gray-900 mb-2 animate-fade-in-up">Make Your Donation</h2>
                                <p class="text-gray-600 animate-fade-in-up delay-100">Every contribution makes a difference</p>
                            </div>

                            <!-- Professional Form -->
                            <div class="px-8 py-8">
                                <form action="#" method="POST" class="space-y-8" onsubmit="return handleDonationSubmit(event)">
                                    @csrf
                                    <input type="hidden" name="campaign_id" value="1">
                                    <input type="hidden" name="donation_type" id="donation-type-input" value="single">

                                    <!-- Donation Type -->
                                    <div>
                                        <label class="block text-base font-medium text-gray-900 mb-4">Donation Type</label>
                                        <div class="grid grid-cols-2 gap-3">
                                            <button type="button" id="single-btn" class="py-3 px-4 border-2 border-primary-500 bg-primary-500 text-white rounded-lg text-sm font-medium transition-colors hover:bg-primary-600 hover:border-primary-600">
                                                One-Time
                                            </button>
                                            <button type="button" id="monthly-btn" class="py-3 px-4 border-2 border-gray-200 bg-white text-gray-700 rounded-lg text-sm font-medium transition-colors hover:border-gray-300 hover:bg-gray-50">
                                                Monthly
                                            </button>
                                        </div>
                                    </div>



                                    <!-- Amount Selection -->
                                    <div class="animate-on-scroll delay-300">
                                        <label class="block text-base font-medium text-gray-900 mb-4">Select Amount (MYR)</label>
                                        <div class="grid grid-cols-2 gap-3">
                                            <label class="cursor-pointer amount-option hover-scale">
                                                <input type="radio" name="amount" value="50" class="sr-only">
                                                <div class="amount-button border-2 border-gray-200 py-4 px-4 rounded-lg text-center transition-all duration-300 hover:border-primary-300 hover:bg-primary-50 hover:shadow-lg">
                                                    <div class="text-lg font-semibold text-gray-900">RM 50</div>
                                                </div>
                                            </label>
                                            <label class="cursor-pointer amount-option hover-scale">
                                                <input type="radio" name="amount" value="150" class="sr-only">
                                                <div class="amount-button border-2 border-gray-200 py-4 px-4 rounded-lg text-center transition-all duration-300 hover:border-primary-300 hover:bg-primary-50 hover:shadow-lg">
                                                    <div class="text-lg font-semibold text-gray-900">RM 150</div>
                                                </div>
                                            </label>
                                            <label class="cursor-pointer amount-option hover-scale">
                                                <input type="radio" name="amount" value="250" class="sr-only" checked>
                                                <div class="amount-button border-2 border-primary-500 bg-primary-500 py-4 px-4 rounded-lg text-center transition-all duration-300 animate-pulse-gentle">
                                                    <div class="text-lg font-semibold text-white">RM 250</div>
                                                </div>
                                            </label>
                                            <label class="cursor-pointer amount-option hover-scale">
                                                <input type="radio" name="amount" value="500" class="sr-only">
                                                <div class="amount-button border-2 border-gray-200 py-4 px-4 rounded-lg text-center transition-all duration-300 hover:border-primary-300 hover:bg-primary-50 hover:shadow-lg">
                                                    <div class="text-lg font-semibold text-gray-900">RM 500</div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Custom Amount -->
                                    <div>
                                        <label class="block text-base font-medium text-gray-900 mb-4">Custom Amount</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <span class="text-sm font-medium text-gray-500">MYR</span>
                                            </div>
                                            <input type="number" name="custom_amount" id="custom-amount" placeholder="Enter amount" min="1" step="1"
                                                   class="w-full pl-16 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        </div>
                                    </div>

                                    <!-- Payment Methods -->
                                    <div>
                                        <label class="block text-base font-medium text-gray-900 mb-4">Payment Method</label>
                                        <div class="space-y-3">
                                            <!-- FPX Option -->
                                            <label class="cursor-pointer payment-option">
                                                <input type="radio" name="payment_method" value="fpx" class="sr-only" checked>
                                                <div class="payment-card flex items-center p-4 border-2 border-primary-500 bg-primary-50 rounded-lg transition-colors">
                                                    <div class="w-10 h-8 bg-blue-600 rounded text-white text-xs flex items-center justify-center font-semibold mr-4">FPX</div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-900">FPX Online Banking</div>
                                                        <div class="text-sm text-gray-600">Direct bank transfer</div>
                                                    </div>
                                                    <div class="w-5 h-5 border-2 border-primary-500 rounded-full flex items-center justify-center">
                                                        <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                                                    </div>
                                                </div>
                                            </label>

                                            <!-- DuitNow QR Option -->
                                            <label class="cursor-pointer payment-option">
                                                <input type="radio" name="payment_method" value="duitnow_qr" class="sr-only">
                                                <div class="payment-card flex items-center p-4 border-2 border-gray-200 rounded-lg transition-colors hover:border-gray-300">
                                                    <div class="w-10 h-8 bg-green-600 rounded text-white text-xs flex items-center justify-center font-semibold mr-4">QR</div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-900">DuitNow QR</div>
                                                        <div class="text-sm text-gray-600">Scan with banking app</div>
                                                    </div>
                                                    <div class="payment-radio w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center">
                                                        <div class="w-2 h-2 bg-primary-500 rounded-full hidden"></div>
                                                    </div>
                                                </div>
                                            </label>

                                            <!-- Credit/Debit Card Option -->
                                            <label class="cursor-pointer payment-option">
                                                <input type="radio" name="payment_method" value="card" class="sr-only">
                                                <div class="payment-card flex items-center p-4 border-2 border-gray-200 rounded-lg transition-colors hover:border-gray-300">
                                                    <div class="flex space-x-1 mr-4">
                                                        <div class="w-6 h-4 bg-blue-700 rounded text-white text-xs flex items-center justify-center font-semibold">V</div>
                                                        <div class="w-6 h-4 bg-red-500 rounded text-white text-xs flex items-center justify-center font-semibold">M</div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-900">Credit/Debit Card</div>
                                                        <div class="text-sm text-gray-600">Visa, Mastercard</div>
                                                    </div>
                                                    <div class="payment-radio w-5 h-5 border-2 border-gray-300 rounded-full flex items-center justify-center">
                                                        <div class="w-2 h-2 bg-primary-500 rounded-full hidden"></div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Donate Button -->
                                    <div class="pt-8 border-t border-gray-100 animate-on-scroll delay-600">
                                        <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white py-4 px-6 rounded-lg text-lg font-semibold transition-all duration-300 hover:shadow-lg hover:scale-105 animate-pulse-gentle">
                                            Donate Now
                                        </button>

                                        <!-- Trust Indicators -->
                                        <div class="mt-6 text-center">
                                            <div class="flex items-center justify-center text-sm text-gray-600 mb-4 animate-fade-in-up delay-700">
                                                @include('components.uxwing-icon', ['name' => 'security', 'class' => 'w-4 h-4 text-green-600 mr-2 animate-pulse-gentle'])
                                                <span>Secure & encrypted payment</span>
                                            </div>
                                            <div class="flex justify-center gap-6 text-xs text-gray-500 animate-fade-in-up delay-800">
                                                <div class="flex items-center hover-scale">
                                                    <span class="mr-1">🔒</span>
                                                    <span>SSL Secured</span>
                                                </div>
                                                <div class="flex items-center hover-scale">
                                                    <span class="mr-1">⚡</span>
                                                    <span>Instant</span>
                                                </div>
                                                <div class="flex items-center hover-scale">
                                                    <span class="mr-1">🏆</span>
                                                    <span>Tax Receipt</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>





@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle buttons functionality
    const singleBtn = document.getElementById('single-btn');
    const monthlyBtn = document.getElementById('monthly-btn');
    const donationTypeInput = document.getElementById('donation-type-input');

    function setActiveButton(activeBtn, inactiveBtn, type) {
        // Reset buttons
        activeBtn.classList.remove('text-gray-700', 'bg-white', 'border-gray-200');
        activeBtn.classList.add('text-white', 'border-primary-500', 'bg-primary-500');

        inactiveBtn.classList.remove('text-white', 'border-primary-500', 'bg-primary-500');
        inactiveBtn.classList.add('text-gray-700', 'bg-white', 'border-gray-200');

        // Update hidden input
        if (donationTypeInput) {
            donationTypeInput.value = type;
        }
    }

    // Button events
    if (singleBtn && monthlyBtn) {
        singleBtn.addEventListener('click', function() {
            setActiveButton(singleBtn, monthlyBtn, 'single');
        });

        monthlyBtn.addEventListener('click', function() {
            setActiveButton(monthlyBtn, singleBtn, 'monthly');
        });
    }

    // Amount selection functionality
    const amountInputs = document.querySelectorAll('input[name="amount"]');
    const customAmountInput = document.getElementById('custom-amount');

    // Handle amount selection
    amountInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Clear custom amount when radio button is selected
            if (customAmountInput) {
                customAmountInput.value = '';
            }

            // Update visual state for all amount buttons
            amountInputs.forEach(otherInput => {
                const button = otherInput.closest('label').querySelector('.amount-button');
                const textElement = button.querySelector('div');
                if (otherInput === this) {
                    // Selected state
                    button.classList.remove('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
                    button.classList.add('border-primary-500', 'bg-primary-500');
                    textElement.classList.remove('text-gray-900');
                    textElement.classList.add('text-white');
                } else {
                    // Unselected state
                    button.classList.remove('border-primary-500', 'bg-primary-500');
                    button.classList.add('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
                    textElement.classList.remove('text-white');
                    textElement.classList.add('text-gray-900');
                }
            });
        });
    });

    // Handle custom amount input
    if (customAmountInput) {
        customAmountInput.addEventListener('input', function() {
            if (this.value) {
                // Clear amount radio selections when custom amount is entered
                amountInputs.forEach(input => {
                    input.checked = false;
                    const button = input.closest('label').querySelector('.amount-button');
                    const textElement = button.querySelector('div');
                    button.classList.remove('border-primary-500', 'bg-primary-500');
                    button.classList.add('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
                    textElement.classList.remove('text-white');
                    textElement.classList.add('text-gray-900');
                });
            }
        });
    }

    // Handle payment method selection
    const paymentInputs = document.querySelectorAll('input[name="payment_method"]');
    paymentInputs.forEach(input => {
        input.addEventListener('change', function() {
            paymentInputs.forEach(otherInput => {
                const card = otherInput.closest('label').querySelector('.payment-card');
                const radio = otherInput.closest('label').querySelector('.payment-radio');
                const radioInner = radio ? radio.querySelector('div') : null;

                if (otherInput === this) {
                    // Selected state
                    card.classList.remove('border-gray-200', 'hover:border-gray-300');
                    card.classList.add('border-primary-500', 'bg-primary-50');
                    if (radio) {
                        radio.classList.remove('border-gray-300');
                        radio.classList.add('border-primary-500');
                        // Show inner dot
                        if (radioInner) {
                            radioInner.classList.remove('hidden');
                            radioInner.classList.add('block');
                        }
                    }
                } else {
                    // Unselected state
                    card.classList.remove('border-primary-500', 'bg-primary-50');
                    card.classList.add('border-gray-200', 'hover:border-gray-300');
                    if (radio) {
                        radio.classList.remove('border-primary-500');
                        radio.classList.add('border-gray-300');
                        // Hide inner dot
                        if (radioInner) {
                            radioInner.classList.remove('block');
                            radioInner.classList.add('hidden');
                        }
                    }
                }
            });
        });
    });

    // Form validation and submission handler
    window.handleDonationSubmit = function(e) {
        e.preventDefault();

        const selectedAmount = document.querySelector('input[name="amount"]:checked');
        const customAmount = customAmountInput ? customAmountInput.value : '';
        const selectedPayment = document.querySelector('input[name="payment_method"]:checked');

        // Validate amount
        if (!selectedAmount && !customAmount) {
            showNotification('Please select or enter a donation amount.', 'error');
            return false;
        }

        if (customAmount && parseFloat(customAmount) < 1) {
            showNotification('Please enter a valid donation amount (minimum RM 1).', 'error');
            return false;
        }

        // Validate payment method
        if (!selectedPayment) {
            showNotification('Please select a payment method.', 'error');
            return false;
        }

        // Get donation details
        const amount = selectedAmount ? selectedAmount.value : customAmount;
        const donationType = donationTypeInput ? donationTypeInput.value : 'single';
        const paymentMethod = selectedPayment.value;

        // Show success message
        showNotification(`Thank you! Your ${donationType} donation of RM ${amount} via ${getPaymentMethodName(paymentMethod)} has been processed successfully.`, 'success');

        // Reset form after successful submission
        setTimeout(() => {
            document.querySelector('form').reset();
            // Reset visual states
            resetFormStates();
        }, 2000);

        return false;
    };

    function getPaymentMethodName(method) {
        switch(method) {
            case 'fpx': return 'FPX Online Banking';
            case 'duitnow_qr': return 'DuitNow QR';
            case 'card': return 'Credit/Debit Card';
            default: return method;
        }
    }

    function resetFormStates() {
        // Reset donation type buttons
        if (singleBtn && monthlyBtn) {
            setActiveButton(singleBtn, monthlyBtn, 'single');
        }

        // Reset amount buttons
        amountInputs.forEach(input => {
            const button = input.closest('label').querySelector('.amount-button');
            const textElement = button.querySelector('div');
            button.classList.remove('border-primary-500', 'bg-primary-500');
            button.classList.add('border-gray-200', 'hover:border-primary-300', 'hover:bg-primary-50');
            textElement.classList.remove('text-white');
            textElement.classList.add('text-gray-900');
        });

        // Reset payment method buttons
        const paymentInputs = document.querySelectorAll('input[name="payment_method"]');
        paymentInputs.forEach(input => {
            const card = input.closest('label').querySelector('.payment-card');
            const radio = input.closest('label').querySelector('.payment-radio');
            const radioInner = radio ? radio.querySelector('div') : null;

            if (input.value === 'fpx') {
                // Set FPX as default
                input.checked = true;
                card.classList.add('border-primary-500', 'bg-primary-50');
                if (radio) {
                    radio.classList.add('border-primary-500');
                    if (radioInner) radioInner.style.display = 'block';
                }
            } else {
                card.classList.remove('border-primary-500', 'bg-primary-50');
                card.classList.add('border-gray-200', 'hover:border-gray-300');
                if (radio) {
                    radio.classList.remove('border-primary-500');
                    radio.classList.add('border-gray-300');
                    if (radioInner) {
                        radioInner.classList.remove('block');
                        radioInner.classList.add('hidden');
                    }
                }
            }
        });
    }

    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.textContent = message;

        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-4 rounded-lg shadow-lg z-50 transition-all duration-300 max-w-md`;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('opacity-0');
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 300);
        }, type === 'success' ? 4000 : 3000);
    }

    // Accessibility improvements
    const amountLabels = document.querySelectorAll('label[class*="cursor-pointer"]');
    amountLabels.forEach(label => {
        label.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                const input = this.querySelector('input');
                if (input) {
                    input.checked = true;
                    input.dispatchEvent(new Event('change'));
                }
            }
        });

        // Make labels focusable
        label.setAttribute('tabindex', '0');
    });

    // Social Media Share Functions
    window.shareOnFacebook = function() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent('Vision for Education Program');
        const shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    };

    window.shareOnTwitter = function() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('Support the Vision for Education Program! Help provide free eye care and glasses for underprivileged students. Every donation improves a child\'s learning experience.');
        const shareUrl = `https://twitter.com/intent/tweet?text=${text}&url=${url}`;
        window.open(shareUrl, '_blank', 'width=600,height=400');
    };

    window.shareOnWhatsApp = function() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('👓 Support the Vision for Education Program!\n\nVision for Education Program\n\nHelp provide free eye examinations and glasses for underprivileged students. Every donation helps improve a child\'s learning experience and quality of life.');
        const shareUrl = `https://wa.me/?text=${text}%20${url}`;
        window.open(shareUrl, '_blank');
    };

    window.shareOnTelegram = function() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('👓 Support the Vision for Education Program!\n\nVision for Education Program');
        const shareUrl = `https://t.me/share/url?url=${url}&text=${text}`;
        window.open(shareUrl, '_blank');
    };

    window.copyLink = function() {
        const url = window.location.href;

        if (navigator.clipboard && window.isSecureContext) {
            // Use modern clipboard API
            navigator.clipboard.writeText(url).then(function() {
                showCopyNotification('Link copied to clipboard!');
            }).catch(function() {
                fallbackCopyTextToClipboard(url);
            });
        } else {
            // Fallback for older browsers
            fallbackCopyTextToClipboard(url);
        }
    };

    function fallbackCopyTextToClipboard(text) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.className = "fixed top-0 left-0 opacity-0 pointer-events-none";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
            showCopyNotification('Link copied to clipboard!');
        } catch (err) {
            showCopyNotification('Failed to copy link');
        }

        document.body.removeChild(textArea);
    }

    function showCopyNotification(message) {
        showNotification(message, 'success');
    }

    // Scroll-triggered animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all elements with animate-on-scroll class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });

    // Enhanced button interactions
    document.querySelectorAll('.amount-option').forEach(option => {
        option.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });

        option.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Donation button pulse effect on hover
    const donateButton = document.querySelector('button[type="submit"]');
    if (donateButton) {
        donateButton.addEventListener('mouseenter', function() {
            this.classList.add('animate-heartbeat');
        });

        donateButton.addEventListener('mouseleave', function() {
            this.classList.remove('animate-heartbeat');
        });
    }

    // Progress bar animation trigger
    const progressBar = document.querySelector('.animate-progress');
    if (progressBar) {
        const progressObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    progressObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        progressObserver.observe(progressBar);
    }

    // Carousel functionality
    let currentSlide = 0;
    const totalSlides = 4;
    const carouselTrack = document.getElementById('carouselTrack');
    const indicators = document.querySelectorAll('.carousel-indicator');
    let autoPlayInterval;

    // Initialize carousel
    function initCarousel() {
        if (!carouselTrack || indicators.length === 0) {
            console.warn('Carousel elements not found');
            return;
        }

        // Start auto-play
        startAutoPlay();

        // Set initial state
        updateCarousel();
    }

    // Auto-play functions
    function startAutoPlay() {
        if (autoPlayInterval) clearInterval(autoPlayInterval);
        autoPlayInterval = setInterval(nextSlide, 5000);
    }

    function stopAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
            autoPlayInterval = null;
        }
    }

    // Pause auto-play on hover
    const carouselContainer = document.querySelector('.carousel-container');
    if (carouselContainer) {
        carouselContainer.addEventListener('mouseenter', stopAutoPlay);
        carouselContainer.addEventListener('mouseleave', startAutoPlay);

        // Also pause on focus for accessibility
        carouselContainer.addEventListener('focusin', stopAutoPlay);
        carouselContainer.addEventListener('focusout', startAutoPlay);
    }

    // Update carousel display
    function updateCarousel() {
        if (!carouselTrack) return;

        try {
            carouselTrack.style.transform = `translateX(-${currentSlide * 100}%)`;

            // Update indicators
            indicators.forEach((indicator, index) => {
                if (index === currentSlide) {
                    indicator.classList.add('active');
                    indicator.setAttribute('aria-current', 'true');
                } else {
                    indicator.classList.remove('active');
                    indicator.removeAttribute('aria-current');
                }
            });
        } catch (error) {
            console.error('Error updating carousel:', error);
        }
    }

    // Navigation functions
    window.nextSlide = function() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    };

    window.previousSlide = function() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel();
    };

    window.goToSlide = function(slideIndex) {
        if (slideIndex >= 0 && slideIndex < totalSlides) {
            currentSlide = slideIndex;
            updateCarousel();
        }
    };

    // Touch/swipe support for mobile
    let startX = 0;
    let endX = 0;
    let isDragging = false;

    if (carouselContainer) {
        // Touch events
        carouselContainer.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            isDragging = true;
            stopAutoPlay();
        }, { passive: true });

        carouselContainer.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
        }, { passive: false });

        carouselContainer.addEventListener('touchend', (e) => {
            if (!isDragging) return;
            endX = e.changedTouches[0].clientX;
            handleSwipe();
            isDragging = false;
            startAutoPlay();
        }, { passive: true });

        // Mouse events for desktop drag
        carouselContainer.addEventListener('mousedown', (e) => {
            startX = e.clientX;
            isDragging = true;
            stopAutoPlay();
            e.preventDefault();
        });

        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
        });

        document.addEventListener('mouseup', (e) => {
            if (!isDragging) return;
            endX = e.clientX;
            handleSwipe();
            isDragging = false;
            startAutoPlay();
        });
    }

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = startX - endX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                previousSlide();
            }
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        // Only handle arrow keys when carousel is in focus or no other element is focused
        const activeElement = document.activeElement;
        const isInputFocused = activeElement && (
            activeElement.tagName === 'INPUT' ||
            activeElement.tagName === 'TEXTAREA' ||
            activeElement.tagName === 'SELECT'
        );

        if (!isInputFocused) {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                previousSlide();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                nextSlide();
            }
        }
    });

    // Initialize carousel when DOM is ready
    initCarousel();

    // Audit Trail functionality
    window.toggleAuditTrail = function() {
        const content = document.getElementById('audit-trail-content');
        const arrow = document.getElementById('audit-trail-arrow');
        const toggle = document.getElementById('audit-trail-toggle');

        if (!content || !arrow) return;

        const isHidden = content.classList.contains('hidden');

        if (isHidden) {
            // Show audit trail
            content.classList.remove('hidden');
            arrow.style.transform = 'rotate(180deg)';
            toggle.classList.add('text-primary-600');

            // Animate content appearance
            content.style.opacity = '0';
            content.style.transform = 'translateY(-10px)';

            requestAnimationFrame(() => {
                content.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                content.style.opacity = '1';
                content.style.transform = 'translateY(0)';
            });
        } else {
            // Hide audit trail
            content.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            content.style.opacity = '0';
            content.style.transform = 'translateY(-10px)';

            setTimeout(() => {
                content.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
                toggle.classList.remove('text-primary-600');
            }, 300);
        }
    };

    // Auto-update progress simulation (for demo purposes)
    function simulateProgressUpdate() {
        const progressBar = document.querySelector('.animate-progress');
        const amountElement = document.querySelector('.text-2xl.font-bold');
        const percentageElement = document.querySelector('.text-lg.font-semibold');

        if (!progressBar || !amountElement || !percentageElement) return;

        // Simulate small progress updates
        setInterval(() => {
            const currentAmount = parseInt(amountElement.textContent.replace(/[^\d]/g, ''));
            const goalAmount = 62000;
            const increment = Math.floor(Math.random() * 100) + 50; // Random increment 50-150

            if (currentAmount < goalAmount) {
                const newAmount = Math.min(currentAmount + increment, goalAmount);
                const newPercentage = Math.round((newAmount / goalAmount) * 100);

                // Update display with animation
                amountElement.style.transition = 'all 0.5s ease';
                amountElement.textContent = `RM ${newAmount.toLocaleString()}`;

                percentageElement.style.transition = 'all 0.5s ease';
                percentageElement.textContent = `${newPercentage}%`;

                progressBar.style.width = `${newPercentage}%`;

                // Add pulse effect
                amountElement.classList.add('animate-pulse-gentle');
                percentageElement.classList.add('animate-pulse-gentle');

                setTimeout(() => {
                    amountElement.classList.remove('animate-pulse-gentle');
                    percentageElement.classList.remove('animate-pulse-gentle');
                }, 1000);
            }
        }, 30000); // Update every 30 seconds
    }

    // Initialize progress simulation (comment out for production)
    // simulateProgressUpdate();

    // Real-time progress tracking (for production use)
    function trackProgressUpdate(amount, donorCount, percentage) {
        const progressBar = document.querySelector('.animate-progress');
        const amountElement = document.querySelector('.text-2xl.font-bold');
        const percentageElement = document.querySelector('.text-lg.font-semibold');
        const donorElement = document.querySelector('span:contains("donors")');

        if (progressBar) progressBar.style.width = `${percentage}%`;
        if (amountElement) amountElement.textContent = `RM ${amount.toLocaleString()}`;
        if (percentageElement) percentageElement.textContent = `${percentage}%`;
        if (donorElement) donorElement.textContent = `${donorCount} donors`;

        // Add audit trail entry
        addAuditTrailEntry({
            type: 'donation',
            message: 'New donation received',
            amount: amount,
            percentage: percentage,
            timestamp: new Date()
        });
    }

    // Add new audit trail entry
    function addAuditTrailEntry(entry) {
        const auditContent = document.getElementById('audit-trail-content');
        const progressSection = auditContent?.querySelector('.space-y-3');

        if (!progressSection) return;

        const entryElement = document.createElement('div');
        entryElement.className = 'flex items-start space-x-3';
        entryElement.innerHTML = `
            <div class="w-2 h-2 bg-primary-500 rounded-full mt-2 flex-shrink-0"></div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">${entry.message}</p>
                    <span class="text-xs text-gray-500">Just now</span>
                </div>
                <p class="text-xs text-gray-600">+RM ${entry.amount?.toLocaleString()} • Progress: ${entry.percentage}%</p>
            </div>
        `;

        // Add to top of list
        progressSection.insertBefore(entryElement, progressSection.firstChild);

        // Keep only last 5 entries
        const entries = progressSection.children;
        if (entries.length > 5) {
            progressSection.removeChild(entries[entries.length - 1]);
        }

        // Animate new entry
        entryElement.style.opacity = '0';
        entryElement.style.transform = 'translateX(-20px)';

        requestAnimationFrame(() => {
            entryElement.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            entryElement.style.opacity = '1';
            entryElement.style.transform = 'translateX(0)';
        });
    }

    // Expose functions for external use
    window.trackProgressUpdate = trackProgressUpdate;
    window.addAuditTrailEntry = addAuditTrailEntry;
});
</script>
@endpush
