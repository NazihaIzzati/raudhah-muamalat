@extends('layouts.master')

@section('title', __('app.faq_page_title'))
@section('description', __('app.faq_page_description'))

@section('content')

        @include('components.hero-section', [
            'badge' => [
                'text' => __('app.faq'),
                'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
            ],
            'title' => __('app.frequently_asked'),
            'subtitle' => __('app.questions'),
            'description' => __('app.faq_hero_description'),
            'highlights' => [
                ['text' => __('app.feel_free_to_contact_us'), 'delay' => '0.6s']
            ],
            'pills' => [
                ['text' => __('app.instant_answers'), 'delay' => '0.6s'],
                ['text' => __('app.comprehensive_guide'), 'delay' => '0.7s'],
                ['text' => __('app.24_7_support'), 'delay' => '0.8s']
            ]
        ])

        <!-- Category Navigation -->
        <section class="py-6 mt-4 mb-4 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap justify-center gap-4">
                    @foreach($categories as $categoryKey => $categoryName)
                        <button onclick="scrollToSection('{{ $categoryKey }}')" class="category-btn bg-white text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-all duration-300 shadow-sm border border-gray-200">
                            <span class="flex items-center">
                                @if($categoryKey === 'general')
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @elseif($categoryKey === 'donations')
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                @elseif($categoryKey === 'campaigns')
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                @elseif($categoryKey === 'operations')
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                @elseif($categoryKey === 'partnerships')
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @endif
                                {{ $categoryName }}
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- FAQ Content Section -->
        <section class="py-12 md:py-16 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                @foreach($categories as $categoryKey => $categoryName)
                    @if(isset($faqsByCategory[$categoryKey]) && $faqsByCategory[$categoryKey]->count() > 0)
                        <div id="{{ $categoryKey }}" class="mb-16">
                            <div class="text-center mb-12">
                                <div class="inline-flex items-center justify-center w-16 h-16 
                                    @if($categoryKey === 'general') bg-primary-100
                                    @elseif($categoryKey === 'donations') bg-green-100
                                    @elseif($categoryKey === 'campaigns') bg-blue-100
                                    @elseif($categoryKey === 'operations') bg-purple-100
                                    @elseif($categoryKey === 'partnerships') bg-orange-100
                                    @else bg-gray-100
                                    @endif rounded-full mb-4">
                                    <svg class="w-8 h-8 
                                        @if($categoryKey === 'general') text-primary-600
                                        @elseif($categoryKey === 'donations') text-green-600
                                        @elseif($categoryKey === 'campaigns') text-blue-600
                                        @elseif($categoryKey === 'operations') text-purple-600
                                        @elseif($categoryKey === 'partnerships') text-orange-600
                                        @else text-gray-600
                                        @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($categoryKey === 'general')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @elseif($categoryKey === 'donations')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        @elseif($categoryKey === 'campaigns')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        @elseif($categoryKey === 'operations')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        @elseif($categoryKey === 'partnerships')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @endif
                                    </svg>
                                </div>
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $categoryName }}</h2>
                                <p class="text-lg text-gray-600">
                                    @if($categoryKey === 'general')
                                        {{ __('app.basics_description') }}
                                    @elseif($categoryKey === 'donations')
                                        {{ __('app.donations_description') }}
                                    @elseif($categoryKey === 'campaigns')
                                        {{ __('app.campaigns_section_description') }}
                                    @elseif($categoryKey === 'operations')
                                        {{ __('app.operations_section_description') }}
                                    @elseif($categoryKey === 'partnerships')
                                        {{ __('app.other_section_description') }}
                                    @else
                                        {{ __('app.faq_category_description') }}
                                    @endif
                                </p>
                            </div>
                            <div class="space-y-4">
                                @foreach($faqsByCategory[$categoryKey] as $faq)
                                    <div class="faq-item bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 cursor-pointer" onclick="toggleFaq(this)">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ $faq->question }}</h3>
                                            <div class="flex items-center space-x-2">
                                                @if($faq->featured)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                        </svg>
                                                        Featured
                                                    </span>
                                                @endif
                                                <svg class="faq-icon w-5 h-5 text-primary-500 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="faq-answer mt-4 hidden">
                                            <div class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $faq->answer }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-20 bg-primary-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">{{ __('app.still_have_questions') }}</h2>
                <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">{{ __('app.contact_support_team') }}</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:jariahfund@muamalat.com.my" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        {{ __('app.email_us') }}
                    </a>
                    <a href="{{ url('/contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-600 transition-colors">
                        {{ __('app.contact_page') }}
                    </a>
                </div>
            </div>
        </section>

@endsection

@push('scripts')
<script>
    // Toggle FAQ items
    function toggleFaq(element) {
        const answer = element.querySelector('.faq-answer');
        const icon = element.querySelector('.faq-icon');
        
        // Close all other FAQs
        document.querySelectorAll('.faq-answer').forEach(item => {
            if (item !== answer && item.classList.contains('block')) {
                item.classList.add('hidden');
                item.classList.remove('block');
                item.previousElementSibling.querySelector('.faq-icon').classList.remove('rotate-180');
            }
        });
        
        // Toggle current FAQ
        answer.classList.toggle('hidden');
        answer.classList.toggle('block');
        icon.classList.toggle('rotate-180');
    }
    
    // Scroll to section
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        window.scrollTo({
            top: section.offsetTop - 120,
            behavior: 'smooth'
        });
        
        // Add active state to button
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('bg-primary-500', 'text-white');
            btn.classList.add('bg-white', 'text-gray-700');
        });
        
        const activeBtn = document.querySelector(`[onclick="scrollToSection('${sectionId}')"]`);
        activeBtn.classList.remove('bg-white', 'text-gray-700');
        activeBtn.classList.add('bg-primary-500', 'text-white');
    }
    
    // Check if URL has hash
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash) {
            const sectionId = window.location.hash.substring(1);
            setTimeout(() => {
                scrollToSection(sectionId);
            }, 300);
        }
        
        // Add animation on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, {
            threshold: 0.1
        });
        
        document.querySelectorAll('.faq-item').forEach(item => {
            observer.observe(item);
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Animation for FAQ items */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .fade-in-up {
        animation: fadeInUp 0.5s ease forwards;
    }
    
    .faq-item {
        opacity: 0;
    }
    
    .faq-answer {
        transition: all 0.3s ease;
    }
</style>
@endpush
