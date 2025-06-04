@extends('layouts.master')

@section('title', 'Example Page - Jariah Fund')
@section('description', 'This is an example page demonstrating the master template usage with consistent header and footer design.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Example Page
                </h1>
                <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    This page demonstrates how to use the master template with consistent header and footer design 
                    that matches the homepage layout and branding.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Content Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Feature 1" 
                             class="w-full h-48 object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Consistent Design</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            The master template ensures all pages maintain the same header and footer design, 
                            providing a cohesive user experience across the entire platform.
                        </p>
                        <a href="#" 
                           class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                            Learn More
                        </a>
                    </div>
                </div>

                <!-- Feature Card 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Feature 2" 
                             class="w-full h-48 object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Easy Maintenance</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            Update the header and footer in one place and see changes reflected across all pages 
                            that extend the master template.
                        </p>
                        <a href="#" 
                           class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                            Learn More
                        </a>
                    </div>
                </div>

                <!-- Feature Card 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Feature 3" 
                             class="w-full h-48 object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Mobile Responsive</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            Built with responsive design principles, the template works perfectly on all devices 
                            with mobile-friendly navigation and touch-optimized interactions.
                        </p>
                        <a href="#" 
                           class="inline-block text-primary-500 font-medium hover:text-primary-600 transition-colors">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Template Features</h2>
                <p class="text-xl text-gray-600">Everything you need for consistent page layouts</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Active Navigation</h3>
                    <p class="text-gray-600 text-sm">Automatic highlighting of current page in navigation menu</p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Mobile Menu</h3>
                    <p class="text-gray-600 text-sm">Collapsible mobile navigation with smooth animations</p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">SEO Ready</h3>
                    <p class="text-gray-600 text-sm">Built-in meta tags and structured data for better SEO</p>
                </div>

                <!-- Feature 4 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Fast Loading</h3>
                    <p class="text-gray-600 text-sm">Optimized assets and efficient code structure</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-20 bg-primary-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Ready to Use the Master Template?
            </h2>
            <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">
                Start building consistent, professional pages with our master template. 
                Follow the documentation to get started quickly.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    View Documentation
                </a>
                <a href="#" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-500 transition-colors">
                    See Examples
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Custom styles for this example page */
    .aspect-w-16 {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 aspect ratio */
    }
    
    .aspect-w-16 img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endpush
