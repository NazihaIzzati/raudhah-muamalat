<!-- Footer -->
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @include('partials.footer.company-info')
            @include('partials.footer.quick-links')
            @include('partials.footer.support-areas')
            
            <!-- Share With Us -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Share With Us</h3>
                @include('partials.footer.social-share')
            </div>
        </div>

        @include('partials.footer.copyright')
    </div>
</footer> 