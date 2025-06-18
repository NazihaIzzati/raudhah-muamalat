<div class="relative">
    <button id="language-button" type="button" class="inline-flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900 hover:text-primary-500 transition-colors" aria-expanded="false">
        @if(app()->getLocale() == 'en')
            <span class="hidden sm:inline-block">{{ __('app.language') }}</span>
            <span class="flag-icon">🇬🇧</span>
        @else
            <span class="hidden sm:inline-block">{{ __('app.language') }}</span>
            <span class="flag-icon">🇲🇾</span>
        @endif
        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
    </button>

    <div id="language-dropdown" class="hidden absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="language-button" tabindex="-1">
        <div class="py-1" role="none">
            <a href="{{ route('language.switch', 'en') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                <span class="flag-icon mr-2">🇬🇧</span>{{ __('app.english') }}
            </a>
            <a href="{{ route('language.switch', 'ms') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                <span class="flag-icon mr-2">🇲🇾</span>{{ __('app.bahasa_malaysia') }}
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('language-button');
        const dropdown = document.getElementById('language-dropdown');

        if (button && dropdown) {
            button.addEventListener('click', function() {
                dropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        }
    });
</script> 