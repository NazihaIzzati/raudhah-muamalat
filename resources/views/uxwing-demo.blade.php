@extends('layouts.master')

@section('title', 'UXWing Icon System Demo - Jariah Fund')
@section('description', 'Demonstration of the UXWing icon system implementation across all pages')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">UXWing Icon System Demo</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Professional icon system powered by <a href="https://uxwing.com/" target="_blank" class="text-primary-500 hover:text-primary-600 font-semibold">UXWing</a> - 
                Free for commercial use, no attribution required
            </p>
        </div>

        <!-- Icon Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            
            <!-- Social Media Icons -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Social Media Icons</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'facebook', 'class' => 'w-6 h-6 text-blue-600'])
                        <span class="text-gray-700">Facebook</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'twitter', 'class' => 'w-6 h-6 text-black'])
                        <span class="text-gray-700">Twitter/X</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'whatsapp', 'class' => 'w-6 h-6 text-green-500'])
                        <span class="text-gray-700">WhatsApp</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'telegram', 'class' => 'w-6 h-6 text-blue-500'])
                        <span class="text-gray-700">Telegram</span>
                    </div>
                </div>
            </div>

            <!-- Interface Icons -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Interface Icons</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'people', 'class' => 'w-6 h-6 text-primary-500'])
                        <span class="text-gray-700">People/Users</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'security', 'class' => 'w-6 h-6 text-green-600'])
                        <span class="text-gray-700">Security</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'heart', 'class' => 'w-6 h-6 text-red-500'])
                        <span class="text-gray-700">Heart/Favorite</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'star', 'class' => 'w-6 h-6 text-yellow-500'])
                        <span class="text-gray-700">Star/Rating</span>
                    </div>
                </div>
            </div>

            <!-- Contact Icons -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Icons</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'location', 'class' => 'w-6 h-6 text-red-500'])
                        <span class="text-gray-700">Location</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'phone', 'class' => 'w-6 h-6 text-green-600'])
                        <span class="text-gray-700">Phone</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'email', 'class' => 'w-6 h-6 text-blue-600'])
                        <span class="text-gray-700">Email</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'copy-link', 'class' => 'w-6 h-6 text-gray-600'])
                        <span class="text-gray-700">Copy Link</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Share Buttons Demo -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-12">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Social Share Buttons</h3>
            <div class="flex flex-wrap gap-4">
                <button onclick="createSocialShareButton('facebook', '{{ url()->current() }}', 'Check out this UXWing demo!')" 
                        class="uxw-social-icon uxw-social-facebook" title="Share on Facebook">
                    @include('components.uxwing-icon', ['name' => 'facebook', 'class' => 'w-5 h-5'])
                </button>
                
                <button onclick="createSocialShareButton('twitter', '{{ url()->current() }}', 'Check out this UXWing demo!')" 
                        class="uxw-social-icon uxw-social-twitter" title="Share on Twitter">
                    @include('components.uxwing-icon', ['name' => 'twitter', 'class' => 'w-5 h-5'])
                </button>
                
                <button onclick="createSocialShareButton('whatsapp', '{{ url()->current() }}', 'Check out this UXWing demo!')" 
                        class="uxw-social-icon uxw-social-whatsapp" title="Share on WhatsApp">
                    @include('components.uxwing-icon', ['name' => 'whatsapp', 'class' => 'w-5 h-5'])
                </button>
                
                <button onclick="createSocialShareButton('telegram', '{{ url()->current() }}', 'Check out this UXWing demo!')" 
                        class="uxw-social-icon uxw-social-telegram" title="Share on Telegram">
                    @include('components.uxwing-icon', ['name' => 'telegram', 'class' => 'w-5 h-5'])
                </button>
                
                <button onclick="copyToClipboard('{{ url()->current() }}')" 
                        class="uxw-social-icon uxw-social-copy" title="Copy Link">
                    @include('components.uxwing-icon', ['name' => 'copy-link', 'class' => 'w-5 h-5'])
                </button>
            </div>
        </div>

        <!-- Usage Examples -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-12">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Usage Examples</h3>
            
            <div class="space-y-6">
                <!-- Blade Component Usage -->
                <div>
                    <h4 class="font-medium text-gray-900 mb-2">Blade Component Usage</h4>
                    <div class="bg-gray-100 rounded-lg p-4 font-mono text-sm">
                        <code>@include('components.uxwing-icon', ['name' => 'heart', 'class' => 'w-5 h-5 text-red-500'])</code>
                    </div>
                </div>

                <!-- JavaScript Usage -->
                <div>
                    <h4 class="font-medium text-gray-900 mb-2">JavaScript Usage</h4>
                    <div class="bg-gray-100 rounded-lg p-4 font-mono text-sm space-y-2">
                        <div><code>UXWingIcons.get('facebook', 'w-5 h-5 text-blue-600')</code></div>
                        <div><code>UXWingIcons.render('my-container', 'heart', 'w-6 h-6 text-red-500')</code></div>
                    </div>
                </div>

                <!-- Social Share Functions -->
                <div>
                    <h4 class="font-medium text-gray-900 mb-2">Social Share Functions</h4>
                    <div class="bg-gray-100 rounded-lg p-4 font-mono text-sm space-y-2">
                        <div><code>createSocialShareButton('facebook', url, 'Share text')</code></div>
                        <div><code>copyToClipboard('https://example.com')</code></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documentation Link -->
        <div class="text-center">
            <div class="inline-flex items-center space-x-2 bg-primary-50 text-primary-700 px-6 py-3 rounded-lg">
                @include('components.uxwing-icon', ['name' => 'star', 'class' => 'w-5 h-5'])
                <span class="font-medium">Complete documentation available in <code>docs/uxwing-icon-system.md</code></span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Demo-specific JavaScript
    console.log('UXWing Icon System Demo loaded');
    console.log('Available icons:', Object.keys(UXWingIcons).filter(key => typeof UXWingIcons[key] === 'string'));
</script>
@endpush
