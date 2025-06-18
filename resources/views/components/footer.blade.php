<!-- Footer -->
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="space-y-4">
                <div class="text-2xl font-bold text-primary-500">
                    Jariah Fund
                </div>
                <p class="text-gray-300 leading-relaxed">
                    {{ __('app.footer_description') }}
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-8 h-8 bg-primary-500 text-white rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors" title="{{ __('app.follow_us_on_twitter') }}">
                        @include('components.uxwing-icon', ['name' => 'twitter', 'class' => 'w-4 h-4'])
                    </a>
                    <a href="#" class="w-8 h-8 bg-primary-500 text-white rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors" title="{{ __('app.follow_us_on_facebook') }}">
                        @include('components.uxwing-icon', ['name' => 'facebook', 'class' => 'w-4 h-4'])
                    </a>
                    <a href="#" class="w-8 h-8 bg-primary-500 text-white rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors" title="{{ __('app.contact_us_on_whatsapp') }}">
                        @include('components.uxwing-icon', ['name' => 'whatsapp', 'class' => 'w-4 h-4'])
                    </a>
                    <a href="#" class="w-8 h-8 bg-primary-500 text-white rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors" title="{{ __('app.join_our_telegram') }}">
                        @include('components.uxwing-icon', ['name' => 'telegram', 'class' => 'w-4 h-4'])
                    </a>
                </div>
            </div>

            <!-- Campaign Categories -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">{{ __('app.campaign_categories') }}</h3>
                <ul class="space-y-2 text-gray-300">
                    <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.education') }}</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.healthcare') }}</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.emergency_relief') }}</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.community_development') }}</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.orphan_support') }}</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.mosque_masjid') }}</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">{{ __('app.quick_links') }}</h3>
                <ul class="space-y-2 text-gray-300">
                    <li><a href="{{ url('/about') }}" class="hover:text-primary-500 transition-colors">{{ __('app.about_us') }}</a></li>
                    <li><a href="{{ url('/partners') }}" class="hover:text-primary-500 transition-colors">{{ __('app.partners') }}</a></li>
                    <li><a href="{{ url('/campaigns') }}" class="hover:text-primary-500 transition-colors">{{ __('app.campaigns') }}</a></li>
                    <li><a href="{{ url('/news') }}" class="hover:text-primary-500 transition-colors">{{ __('app.news_and_events') }}</a></li>
                    <li><a href="#contact" class="hover:text-primary-500 transition-colors">{{ __('app.contact') }}</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.privacy_policy') }}</a></li>
                    <li><a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.terms_of_service') }}</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">{{ __('app.contact_info') }}</h3>
                <div class="space-y-3 text-gray-300">
                    <div class="flex items-start space-x-3">
                        @include('components.uxwing-icon', ['name' => 'location', 'class' => 'w-5 h-5 text-primary-500 mt-0.5 flex-shrink-0'])
                        <span>Menara Muamalat, No. 22, Jalan Melaka<br>Kuala Lumpur, Malaysia 50100</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'phone', 'class' => 'w-5 h-5 text-primary-500 flex-shrink-0'])
                        <span>+60 3-2161 2000</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        @include('components.uxwing-icon', ['name' => 'email', 'class' => 'w-5 h-5 text-primary-500 flex-shrink-0'])
                        <span>info@jariahfund.com</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-800 mt-12 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="text-gray-400 text-sm">
                    © {{ date('Y') }} Jariah Fund by Bank Muamalat Malaysia. {{ __('app.all_rights_reserved') }}
                </div>
                <div class="flex space-x-6 text-sm text-gray-400">
                    <a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.privacy_policy') }}</a>
                    <a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.terms_of_service') }}</a>
                    <a href="#" class="hover:text-primary-500 transition-colors">{{ __('app.cookie_policy') }}</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Smooth Scrolling Script -->
<script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
