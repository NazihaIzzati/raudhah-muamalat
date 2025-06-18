<div class="relative">
    <!-- Language Button -->
    <button id="language-button" type="button" class="inline-flex items-center gap-x-1.5 px-3 py-2 text-sm font-medium leading-6 text-gray-700 hover:text-primary-600 transition-all duration-300 rounded-lg hover:bg-primary-50 border-0" aria-expanded="false">
        @if(app()->getLocale() == 'en')
            <span class="hidden sm:inline-block">{{ __('app.language') }}</span>
            <span class="flag-icon text-lg">🇬🇧</span>
        @else
            <span class="hidden sm:inline-block">{{ __('app.language') }}</span>
            <span class="flag-icon text-lg">🇲🇾</span>
        @endif
        <svg class="h-4 w-4 transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
    </button>

    <!-- Language Dropdown -->
    <div id="language-dropdown" class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-xl bg-white border-0 overflow-hidden" style="box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(59, 130, 246, 0.1);" role="menu" aria-orientation="vertical" aria-labelledby="language-button" tabindex="-1">
        <div class="py-2" role="none">
            <!-- English Option -->
            <a href="{{ route('language.switch', 'en') }}" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 @if(app()->getLocale() == 'en') bg-blue-50 text-blue-600 @endif" role="menuitem" tabindex="-1">
                <span class="flag-icon mr-3 text-lg group-hover:scale-110 transition-transform duration-200">🇬🇧</span>
                <div class="flex flex-col">
                    <span class="font-medium">{{ __('app.english') }}</span>
                    <span class="text-xs text-gray-500 group-hover:text-blue-500">English</span>
                </div>
                @if(app()->getLocale() == 'en')
                    <svg class="ml-auto w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                @endif
            </a>
            
            <!-- Bahasa Malaysia Option -->
            <a href="{{ route('language.switch', 'ms') }}" class="group flex items-center px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 @if(app()->getLocale() == 'ms') bg-blue-50 text-blue-600 @endif" role="menuitem" tabindex="-1">
                <span class="flag-icon mr-3 text-lg group-hover:scale-110 transition-transform duration-200">🇲🇾</span>
                <div class="flex flex-col">
                    <span class="font-medium">{{ __('app.bahasa_malaysia') }}</span>
                    <span class="text-xs text-gray-500 group-hover:text-blue-500">Bahasa Malaysia</span>
                </div>
                @if(app()->getLocale() == 'ms')
                    <svg class="ml-auto w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                @endif
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('language-button');
        const dropdown = document.getElementById('language-dropdown');
        const arrow = button?.querySelector('svg');

        if (button && dropdown) {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
                
                // Rotate arrow icon
                if (arrow) {
                    if (dropdown.classList.contains('hidden')) {
                        arrow.style.transform = 'rotate(0deg)';
                    } else {
                        arrow.style.transform = 'rotate(180deg)';
                    }
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                    if (arrow) {
                        arrow.style.transform = 'rotate(0deg)';
                    }
                }
            });

            // Close dropdown when pressing Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    dropdown.classList.add('hidden');
                    if (arrow) {
                        arrow.style.transform = 'rotate(0deg)';
                    }
                }
            });
        }
    });
</script> 