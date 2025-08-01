@extends('layouts.master')

@section('title', 'News - Raudhah Muamalat')
@section('meta_description', 'Stay updated with the latest news, announcements, and events from Raudhah Muamalat. Read about our community initiatives, Islamic programs, and charitable activities.')

@section('content')
<div class="bg-gradient-to-br from-orange-50 via-white to-orange-50 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-r from-[#fe5000] to-orange-600">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Latest News & Updates
                </h1>
                <p class="text-xl text-orange-100 max-w-3xl mx-auto">
                    Stay informed about our community initiatives, Islamic programs, and charitable activities that make a difference in people's lives.
                </p>
            </div>
        </div>
    </div>

    <!-- News Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($news->count() > 0)
            <!-- Featured News Section -->
            @php
                $featuredNews = $news->where('featured', true);
                $regularNews = $news->where('featured', false);
            @endphp

            @if($featuredNews->count() > 0)
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                        Featured News
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($featuredNews as $newsItem)
                            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                                @if($newsItem->image_path)
                                    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                                        <img src="{{ asset('storage/' . $newsItem->image_path) }}" 
                                             alt="{{ $newsItem->title }}" 
                                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="p-6">
                                    <div class="flex items-center mb-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-[#fe5000] to-orange-600 text-white">
                                            <svg class="-ml-1 mr-1.5 h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            Featured
                                        </span>
                                        <span class="ml-2 text-xs text-gray-500">
                                            {{ $newsItem->published_at ? $newsItem->published_at->format('M d, Y') : $newsItem->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#fe5000] transition-colors duration-200">
                                        {{ $newsItem->title }}
                                    </h3>
                                    
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        {{ $newsItem->excerpt ?: Str::limit(strip_tags($newsItem->content), 150) }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ucfirst($newsItem->category) }}
                                        </span>
                                        
                                        <a href="#" class="text-[#fe5000] hover:text-orange-600 font-semibold text-sm transition-colors duration-200">
                                            Read More →
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- All News Section -->
            @if($regularNews->count() > 0)
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                        Latest News
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($regularNews as $newsItem)
                            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                                @if($newsItem->image_path)
                                    <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                                        <img src="{{ asset('storage/' . $newsItem->image_path) }}" 
                                             alt="{{ $newsItem->title }}" 
                                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="aspect-w-16 aspect-h-9 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="p-6">
                                    <div class="flex items-center mb-3">
                                        <span class="text-xs text-gray-500">
                                            {{ $newsItem->published_at ? $newsItem->published_at->format('M d, Y') : $newsItem->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#fe5000] transition-colors duration-200">
                                        {{ $newsItem->title }}
                                    </h3>
                                    
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        {{ $newsItem->excerpt ?: Str::limit(strip_tags($newsItem->content), 150) }}
                                    </p>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ ucfirst($newsItem->category) }}
                                        </span>
                                        
                                        <a href="#" class="text-[#fe5000] hover:text-orange-600 font-semibold text-sm transition-colors duration-200">
                                            Read More →
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif

        @else
            <!-- No News Available -->
            <div class="text-center py-16">
                <div class="mx-auto h-24 w-24 text-gray-300 mb-6">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="h-24 w-24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">No News Available</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    We're currently working on bringing you the latest news and updates. Please check back soon for updates about our community initiatives and programs.
                </p>
            </div>
        @endif
    </div>
</div>

<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
