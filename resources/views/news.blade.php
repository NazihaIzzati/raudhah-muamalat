@extends('layouts.master')

@section('title', __('app.news_page_title'))
@section('description', __('app.news_page_description'))

@section('content')

        @include('components.hero-section', [
            'badge' => [
                'text' => __('app.latest_news'),
                'icon' => '<svg class="w-4 h-4 text-primary-600 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>'
            ],
            'title' => __('app.stay_updated'),
            'subtitle' => __('app.news'),
            'description' => __('app.news_hero_description'),
            'highlights' => [
                ['text' => __('app.community_initiatives'), 'delay' => '0.6s'],
                ['text' => __('app.islamic_programs'), 'delay' => '0.8s']
            ],
            'pills' => [
                ['text' => __('app.latest_updates'), 'delay' => '0.6s'],
                ['text' => __('app.charitable_activities'), 'delay' => '0.7s'],
                ['text' => __('app.community_news'), 'delay' => '0.8s']
            ]
        ])

        <!-- Main Content with Animations -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($news->count() > 0)
                    <!-- News Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 animate-on-scroll" data-animation="fade-in-up">
                        @foreach($news as $index => $newsItem)
                            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:border-primary-200 transform hover:scale-105 {{ $newsItem->featured ? 'border-2 border-primary-200 hover:border-primary-300 hover:shadow-xl' : '' }} relative">
                                @if($newsItem->featured)
                                    <div class="absolute top-4 right-4 bg-primary-500 text-white px-3 py-1 rounded-full text-xs font-semibold z-10">
                                        {{ __('app.featured') }}
                                    </div>
                                @endif
                                
                                <!-- Image Section -->
                                <div class="h-56 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center overflow-hidden">
                                    @if($newsItem->image_path)
                                        <img src="{{ asset('storage/' . $newsItem->image_path) }}"
                                             alt="{{ $newsItem->title }}"
                                             class="w-full h-full object-cover hover:scale-110 transition-transform duration-300"
                                             loading="lazy">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br {{ $newsItem->featured ? 'from-primary-50 to-primary-100' : 'from-gray-50 to-gray-100' }} flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content Section -->
                                <div class="p-6">
                                    <div class="mb-3">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ ucfirst($newsItem->category) }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ $newsItem->published_at ? $newsItem->published_at->format('M d, Y') : $newsItem->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900">{{ $newsItem->title }}</h3>
                                    </div>
                                    <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-4">
                                        {{ $newsItem->excerpt ?: Str::limit(strip_tags($newsItem->content), 150) }}
                                    </p>

                                    <!-- Action Section -->
                                    <div class="flex items-center justify-between">
                                        <a href="#" class="inline-flex items-center text-primary-500 font-semibold hover:text-primary-600 transition-colors group">
                                            {{ __('app.read_more') }}
                                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                            </svg>
                                        </a>
                                        <span class="text-xs text-gray-400">{{ __('app.news') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- No News Available -->
                    <div class="text-center py-16">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('app.no_news_available') }}</h3>
                            <p class="text-gray-600">
                                {{ __('app.no_news_description') }}
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </section>

<style>
.line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-on-scroll {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease-out;
}

.animate-on-scroll.animate {
    opacity: 1;
    transform: translateY(0);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection
