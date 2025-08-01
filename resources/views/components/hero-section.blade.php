{{--
    Master Hero Section Component
    
    Usage:
    @include('components.hero-section', [
        'badge' => [
            'text' => 'About Us',
            'icon' => '<svg>...</svg>'
        ],
        'title' => 'Empowering Communities Through Trusted Giving',
        'subtitle' => null, // Optional subtitle for title
        'description' => 'Platform introduction with highlights...',
        'highlights' => [
            ['text' => 'complete transparency', 'delay' => '0.6s'],
            ['text' => 'effective impact', 'delay' => '0.8s']
        ],
        'pills' => [
            ['text' => '100% Secure', 'delay' => '0.7s'],
            ['text' => 'Tax Deductible', 'delay' => '0.8s'],
            ['text' => 'Transparent & Trusted', 'delay' => '0.9s']
        ],
        'cta_buttons' => [ // Optional - only for action-oriented pages
            [
                'text' => 'View Our Campaigns',
                'url' => '/campaigns',
                'type' => 'primary'
            ],
            [
                'text' => 'Start Donating', 
                'url' => '/donate',
                'type' => 'secondary'
            ]
        ]
    ])
--}}

<!-- Hero Section with Animations -->
<section class="py-20 bg-gradient-to-br from-primary-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-4xl mx-auto">
            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-2 bg-primary-100 rounded-full mb-6 animate-fade-in-up" style="animation-delay: 0.1s;">
                {!! $badge['icon'] !!}
                <span class="text-primary-600 font-semibold text-sm tracking-wide uppercase">{{ $badge['text'] }}</span>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6 animate-fade-in-up" style="animation-delay: 0.2s;">
                {{ $title }}
                @if(isset($subtitle))
                    <span class="text-primary-500 relative block animate-fade-in-up" style="animation-delay: 0.3s;">
                        {{ $subtitle }}
                        <svg class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-64 h-3 text-primary-200 animate-draw-line" viewBox="0 0 100 12" fill="currentColor" style="animation-delay: 0.8s;">
                            <path d="M0 8c30-4 70-4 100 0v4H0z"/>
                        </svg>
                    </span>
                @endif
            </h1>

            <!-- Description -->
            <p class="text-xl text-gray-600 leading-relaxed mb-8 animate-fade-in-up" style="animation-delay: 0.4s;">
                {!! $description !!}
                @if(isset($highlights))
                    @foreach($highlights as $highlight)
                        <span class="text-primary-600 font-medium animate-highlight" style="animation-delay: {{ $highlight['delay'] }};">{{ $highlight['text'] }}</span>
                        @if(!$loop->last) {{ __('app.and') }} @endif
                    @endforeach
                @endif
            </p>

            <!-- CTA Buttons (Optional) -->
            @if(isset($cta_buttons) && !empty($cta_buttons))
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8 animate-fade-in-up" style="animation-delay: 0.5s;">
                    @foreach($cta_buttons as $button)
                        @if($button['type'] === 'primary')
                            <a href="{{ $button['url'] }}" class="bg-primary-500 text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-600 transition-all duration-300 text-center transform hover:scale-105 shadow-lg hover:shadow-xl animate-pulse-button">
                                {{ $button['text'] }}
                            </a>
                        @else
                            <a href="{{ $button['url'] }}" class="border-2 border-primary-500 text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-primary-50 transition-all duration-300 text-center transform hover:scale-105 hover:rotate-1">
                                {{ $button['text'] }}
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif

            <!-- Feature Pills -->
            @if(isset($pills) && !empty($pills))
                <div class="flex flex-wrap justify-center gap-6 text-sm text-gray-600 animate-fade-in-up" style="animation-delay: {{ isset($cta_buttons) ? '0.6s' : '0.5s' }};">
                    @foreach($pills as $index => $pill)
                        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow-sm hover:shadow-md hover:scale-105 transition-all duration-300 cursor-pointer animate-bounce-in" style="animation-delay: {{ $pill['delay'] }};">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                            </svg>
                            {{ $pill['text'] }}
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

@push('styles')
<style>
/* Hero Animation Keyframes */
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
        box-shadow: 0 0 0 0 rgba(254, 81, 0, 0.4);
    }
    50% {
        box-shadow: 0 0 0 10px rgba(254, 81, 0, 0);
    }
}

/* Animation Classes */
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
</style>
@endpush
