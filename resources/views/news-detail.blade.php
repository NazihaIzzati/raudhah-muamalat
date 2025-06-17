@extends('layouts.master')

@section('title', 'News Article - Jariah Fund')
@section('description', 'Read the latest news and updates about our initiatives, success stories, and community impact.')

@section('content')
    <!-- News Article Header -->
    <section class="py-8 md:py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Article Breadcrumbs -->
            <div class="mb-6 md:mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm text-gray-500">
                        <li>
                            <a href="{{ url('/') }}" class="hover:text-primary-600 transition-colors">Home</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </li>
                        <li>
                            <a href="{{ url('/news') }}" class="hover:text-primary-600 transition-colors">News & Events</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </li>
                        <li class="text-gray-700 font-medium truncate">
                            {{ $article->title ?? '1,000 Families Receive Emergency Food Aid' }}
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Article Category Badge & Date -->
            <div class="flex items-center mb-4">
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium mr-4">
                    {{ $article->category ?? 'Impact Story' }}
                </span>
                <span class="text-sm text-gray-600">
                    {{ $article->date ?? 'December 15, 2024' }}
                </span>
            </div>

            <!-- Article Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $article->title ?? '1,000 Families Receive Emergency Food Aid' }}
            </h1>

            <!-- Article Meta Info -->
            <div class="flex items-center mb-8 text-sm text-gray-500">
                <div class="flex items-center mr-6">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>5 min read</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>1,000 families helped</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Full Width Featured Image -->
    <section class="w-full relative">
        <div class="w-full h-[10vh] md:h-[15vh] overflow-hidden bg-gray-100 relative max-w-2xl mx-auto">
            <!-- Loading skeleton -->
            <div class="absolute inset-0 bg-gray-200 animate-pulse image-skeleton"></div>
            
            <!-- Main image with lazy loading and fade-in effect -->
            <img 
                src="{{ $article->image ?? asset('assets/images/news/success.jpg') }}" 
                alt="{{ $article->title ?? 'Emergency Food Relief' }}" 
                class="w-full h-full object-cover transition-opacity duration-500 opacity-0 image-main"
                loading="lazy"
                onclick="openImageViewer(this.src)"
            >
            
            <!-- Image caption -->
            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white p-3 md:p-4 text-sm transform translate-y-full transition-transform duration-300 caption-container">
                <p class="text-center">
                    Emergency food aid distribution in Kelantan, December 2024. 
                    <span class="text-xs text-gray-300">Photo: Jariah Fund Relief Team</span>
                </p>
            </div>
            
            <!-- Zoom/expand indicator -->
            <div class="absolute top-4 right-4 bg-black bg-opacity-50 text-white p-2 rounded-full cursor-pointer hover:bg-opacity-70 transition-all" onclick="openImageViewer('{{ $article->image ?? asset('assets/images/news/success.jpg') }}')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                </svg>
            </div>
        </div>
    </section>

    <!-- Image Viewer Modal (hidden by default) -->
    <div id="imageViewerModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300">
        <button class="absolute top-4 right-4 text-white p-2 hover:text-gray-300 focus:outline-none" onclick="closeImageViewer()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        
        <img id="modalImage" src="" alt="Enlarged view" class="max-w-full max-h-[90vh] object-contain">
        
        <div class="absolute bottom-4 left-4 right-4 text-white text-center">
            <p class="text-sm md:text-base">
                Emergency food aid distribution in Kelantan, December 2024.
                <span class="block text-xs md:text-sm text-gray-300 mt-1">Photo: Jariah Fund Relief Team • Click anywhere to close</span>
            </p>
        </div>
    </div>

    <!-- Article Content -->
    <section class="py-12 md:py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Article Date and Description -->
            <div class="prose prose-lg max-w-none mb-12">
                <div class="mb-6 text-gray-600 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#FE5000]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ $article->date ?? 'December 15, 2024' }}</span>
                </div>
                
                <p class="text-xl leading-relaxed mb-6">
                    Thanks to generous donations, we successfully distributed emergency food packages to families affected by recent floods in Kelantan. The distribution effort reached 1,000 families across 12 villages, providing essential nutrition during this critical time. Our team worked tirelessly to coordinate the distribution of food packages, ensuring that affected families received the support they needed during this challenging time.
                </p>

                <div class="bg-gray-50 p-6 rounded-lg my-8">
                    <h3 class="text-xl font-semibold mb-3">Relief Effort by the Numbers</h3>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>1,000 families received emergency food aid</li>
                        <li>12 villages across Kelantan were reached</li>
                        <li>Each package contained supplies for 7 days</li>
                        <li>50+ volunteers participated in the distribution</li>
                        <li>4 local partner organizations contributed resources</li>
                    </ul>
                </div>
            </div>

            <!-- Share Article -->
            <div class="border-t border-gray-200 pt-6 mb-12">
                <h3 class="font-medium text-gray-900 mb-4">Share this article</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-blue-500 transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-green-500 transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.813 2.406C9.59 2.216 10.036 2.2 12 2.2c1.964 0 2.41.017 4.188.206 1.777.192 2.991.444 4.053.948 1.097.512 2.028 1.196 2.95 2.117.92.923 1.605 1.853 2.117 2.95.504 1.063.756 2.276.947 4.054.19 1.777.206 2.223.206 4.187 0 1.964-.016 2.41-.206 4.188-.191 1.778-.443 2.99-.947 4.053-.512 1.097-1.197 2.027-2.117 2.95-.922.92-1.853 1.605-2.95 2.117-1.062.504-2.276.756-4.053.947-1.778.19-2.224.206-4.188.206-1.964 0-2.41-.016-4.187-.206-1.778-.191-2.991-.443-4.054-.947-1.097-.512-2.027-1.197-2.95-2.117-.92-.923-1.605-1.853-2.117-2.95-.504-1.063-.756-2.275-.948-4.053-.189-1.778-.206-2.224-.206-4.188 0-1.964.017-2.41.206-4.187.192-1.778.444-2.991.948-4.054.512-1.097 1.196-2.027 2.117-2.95.923-.92 1.853-1.605 2.95-2.117 1.063-.504 2.276-.756 4.054-.948zM12 4.2c-1.931 0-2.348.016-4.107.202-1.62.176-2.497.401-3.082.687-.774.3-1.324.659-1.904 1.239-.58.58-.938 1.13-1.238 1.904-.286.585-.512 1.462-.687 3.082-.186 1.759-.202 2.176-.202 4.107 0 1.932.016 2.349.202 4.107.175 1.62.401 2.497.687 3.082.3.774.659 1.324 1.238 1.904.58.58 1.13.938 1.904 1.238.585.286 1.462.512 3.082.687 1.759.186 2.176.202 4.107.202 1.932 0 2.348-.016 4.107-.202 1.62-.175 2.497-.401 3.082-.687.774-.3 1.324-.659 1.904-1.238.58-.58.938-1.13 1.238-1.904.286-.585.512-1.462.687-3.082.186-1.758.202-2.175.202-4.107 0-1.93-.016-2.348-.202-4.107-.175-1.62-.401-2.497-.687-3.082-.3-.774-.659-1.324-1.238-1.904-.58-.58-1.13-.938-1.904-1.238-.585-.286-1.462-.512-3.082-.687-1.759-.186-2.175-.202-4.107-.202zM12 7.025a4.974 4.974 0 110 9.949 4.974 4.974 0 010-9.949zM12 15a3 3 0 100-6 3 3 0 000 6zm5.5-10.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-blue-700 transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 3a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14m-.5 15.5v-5.3a3.26 3.26 0 00-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 011.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 001.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 00-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Related Articles -->
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Related Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Related Article 1 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300">
                        <img src="{{ asset('assets/images/news/success_02.jpg') }}"
                             alt="Education Initiative" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium mb-2 inline-block">News</span>
                            <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">New Education Initiative Launched</h4>
                            <p class="text-xs text-gray-600 mb-3 line-clamp-2">We're excited to announce our new education program providing scholarships and learning resources to underprivileged children.</p>
                            <a href="#" class="text-primary-500 text-sm font-medium hover:text-primary-600 transition-colors">Read More →</a>
                        </div>
                    </div>

                    <!-- Related Article 2 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300">
                        <img src="{{ asset('assets/images/news/success_03.jpg') }}"
                             alt="Charity Gala" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium mb-2 inline-block">Event</span>
                            <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">Annual Charity Gala 2024</h4>
                            <p class="text-xs text-gray-600 mb-3 line-clamp-2">Join us for an evening of inspiration and giving at our annual charity gala. All proceeds support our initiatives.</p>
                            <a href="#" class="text-primary-500 text-sm font-medium hover:text-primary-600 transition-colors">Read More →</a>
                        </div>
                    </div>

                    <!-- Related Article 3 -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300">
                        <img src="{{ asset('assets/images/campaigns/medical-mission.svg') }}"
                             alt="Healthcare Initiative" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium mb-2 inline-block">Impact</span>
                            <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2">Healthcare Milestone Reached</h4>
                            <p class="text-xs text-gray-600 mb-3 line-clamp-2">Our mobile healthcare unit has successfully provided medical services to 500 patients in remote villages.</p>
                            <a href="#" class="text-primary-500 text-sm font-medium hover:text-primary-600 transition-colors">Read More →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Animation for page load */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Image hover effect */
    .image-main {
        transform: scale(1);
        transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .image-main.loaded {
        opacity: 1;
    }

    .image-skeleton {
        opacity: 1;
        transition: opacity 0.5s ease;
    }

    .image-skeleton.hidden {
        opacity: 0;
    }

    /* Image container hover effects */
    .caption-container {
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }

    .w-full.relative:hover .caption-container {
        transform: translateY(0);
    }

    /* Modal styles */
    #imageViewerModal.active {
        opacity: 1;
        pointer-events: auto;
    }

    .prose img {
        border-radius: 0.5rem;
    }

    .prose h2 {
        color: #374151;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .prose p {
        color: #4B5563;
        line-height: 1.75;
    }

    .prose blockquote {
        border-left: 4px solid #10B981;
        padding-left: 1rem;
        font-style: italic;
        color: #4B5563;
    }
</style>
@endpush

@push('scripts')
<script>
    // Image loading and modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.querySelector('.image-main');
        const skeleton = document.querySelector('.image-skeleton');
        const modal = document.getElementById('imageViewerModal');
        const modalImage = document.getElementById('modalImage');

        // Handle image loading
        if (mainImage.complete) {
            imageLoaded();
        } else {
            mainImage.addEventListener('load', imageLoaded);
        }

        // Image load handler
        function imageLoaded() {
            setTimeout(() => {
                mainImage.classList.add('loaded');
                skeleton.classList.add('hidden');
            }, 300); // Small delay for smoother transition
        }

        // Close modal when clicking anywhere on it
        modal.addEventListener('click', function(e) {
            if (e.target === modal || e.target.closest('button')) {
                closeImageViewer();
            }
        });

        // Prevent propagation from the image to allow pinch zoom later
        modalImage.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Add keyboard support
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeImageViewer();
            }
        });
    });

    // Open image viewer
    function openImageViewer(imgSrc) {
        const modal = document.getElementById('imageViewerModal');
        const modalImage = document.getElementById('modalImage');
        
        modalImage.src = imgSrc;
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    // Close image viewer
    function closeImageViewer() {
        const modal = document.getElementById('imageViewerModal');
        modal.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    }
</script>
@endpush 