{{--
    Master Call-to-Action Section Component
    
    Usage:
    @include('components.cta-section', [
        'type' => 'primary', // 'primary', 'secondary', 'contact', 'partner'
        'title' => __('app.ready_to_make_difference'),
        'subtitle' => null, // Optional subtitle
        'description' => __('app.join_our_community'),
        'buttons' => [
            [
                'text' => __('app.get_started'),
                'url' => '/campaigns',
                'type' => 'primary', // 'primary', 'secondary'
                'icon' => '<svg>...</svg>' // Optional
            ],
            [
                'text' => __('app.learn_more'),
                'url' => '/about',
                'type' => 'secondary'
            ]
        ],
        'background' => 'primary', // 'primary', 'gray', 'white'
        'animated' => true, // Enable animations
        'centered' => true // Center align content
    ])
--}}

@php
    // Set default values
    $type = $type ?? 'primary';
    $background = $background ?? 'primary';
    $animated = $animated ?? true;
    $centered = $centered ?? true;
    $buttons = $buttons ?? [];
    
    // Background classes based on type
    $bgClasses = [
        'primary' => 'bg-primary-500',
        'gray' => 'bg-gray-50',
        'white' => 'bg-white'
    ];
    
    // Text color classes based on background
    $textClasses = [
        'primary' => 'text-white',
        'gray' => 'text-gray-900',
        'white' => 'text-gray-900'
    ];
    
    // Description color classes
    $descClasses = [
        'primary' => 'text-primary-100',
        'gray' => 'text-gray-600',
        'white' => 'text-gray-600'
    ];
    
    $bgClass = $bgClasses[$background];
    $textClass = $textClasses[$background];
    $descClass = $descClasses[$background];
@endphp

<!-- Call to Action Section -->
<section class="py-20 {{ $bgClass }} relative overflow-hidden">
    @if($background === 'primary')
        <!-- Animated Background Elements for Primary -->
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-10 left-10 w-24 h-24 bg-white/10 rounded-full blur-2xl animate-float"></div>
            <div class="absolute bottom-10 right-10 w-32 h-32 bg-white/5 rounded-full blur-3xl animate-float-delayed"></div>
            <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white/5 rounded-full blur-xl animate-float-slow"></div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 {{ $centered ? 'text-center' : '' }} relative z-10 {{ $animated ? 'animate-on-scroll' : '' }}" data-animation="fade-in-up">
        <!-- Title -->
        <h2 class="text-3xl md:text-4xl font-bold {{ $textClass }} mb-6 {{ $animated ? 'animate-fade-in-up' : '' }}" style="{{ $animated ? 'animation-delay: 0.1s;' : '' }}">
            {{ $title }}
            @if(isset($subtitle))
                <span class="block text-2xl md:text-3xl font-medium mt-2 {{ $animated ? 'animate-fade-in-up' : '' }}" style="{{ $animated ? 'animation-delay: 0.2s;' : '' }}">
                    {{ $subtitle }}
                </span>
            @endif
        </h2>

        <!-- Description -->
        <p class="text-xl {{ $descClass }} mb-8 max-w-3xl {{ $centered ? 'mx-auto' : '' }} {{ $animated ? 'animate-fade-in-up' : '' }}" style="{{ $animated ? 'animation-delay: 0.2s;' : '' }}">
            {!! $description !!}
        </p>

        <!-- Buttons -->
        @if(!empty($buttons))
            <div class="flex flex-col sm:flex-row gap-4 {{ $centered ? 'justify-center' : '' }} {{ $animated ? 'animate-fade-in-up' : '' }}" style="{{ $animated ? 'animation-delay: 0.3s;' : '' }}">
                @foreach($buttons as $button)
                    @if($button['type'] === 'primary')
                        @if($background === 'primary')
                            <a href="{{ $button['url'] }}" class="inline-flex items-center bg-white text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg {{ $animated ? 'animate-pulse-button' : '' }}">
                                @if(isset($button['icon']))
                                    {!! $button['icon'] !!}
                                @endif
                                {{ $button['text'] }}
                            </a>
                        @else
                            <a href="{{ $button['url'] }}" class="inline-flex items-center bg-primary-500 text-white px-8 py-4 rounded-lg font-semibold hover:bg-primary-600 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl {{ $animated ? 'animate-pulse-button' : '' }}">
                                @if(isset($button['icon']))
                                    {!! $button['icon'] !!}
                                @endif
                                {{ $button['text'] }}
                            </a>
                        @endif
                    @else
                        @if($background === 'primary')
                            <a href="{{ $button['url'] }}" class="inline-flex items-center border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-primary-500 transition-all duration-300 transform hover:scale-105">
                                @if(isset($button['icon']))
                                    {!! $button['icon'] !!}
                                @endif
                                {{ $button['text'] }}
                            </a>
                        @else
                            <a href="{{ $button['url'] }}" class="inline-flex items-center border-2 border-primary-500 text-primary-500 px-8 py-4 rounded-lg font-semibold hover:bg-primary-50 transition-all duration-300 transform hover:scale-105">
                                @if(isset($button['icon']))
                                    {!! $button['icon'] !!}
                                @endif
                                {{ $button['text'] }}
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</section>

@if($animated)
@push('styles')
<style>
/* CTA Section Animation Keyframes */
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

@keyframes pulse-button {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
    }
    50% {
        box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
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
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll-triggered animations for CTA sections
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

    // Observe CTA sections with animate-on-scroll class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endpush
@endif
