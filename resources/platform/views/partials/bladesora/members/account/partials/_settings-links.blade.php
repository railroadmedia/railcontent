<div class="flex flex-row pv flex-wrap account-links">
    @foreach($sections as $section)
        <div class="account-link flex flex-column xs-6 sm-4 md-3 pa {{ $brand }}">
            <a href="{{ $section['url'] }}"
               class="flex-center tw-border-2 corners-10 heading no-decoration tw-text-[#00101D] dark:tw-text-[#9EC0DC] pv-3 ph-1 tw-transition-all  tw-border-[#00101D] dark:tw-border-[#445F74] dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6]"
               target="{{ $section['download'] ? '_blank' : '_self' }}"
                {{ $section['download'] ? 'download' : '' }}>
                <i class="{{ $section['icon'] }} mb-1"></i>
                <p class="subtitle text-center">{{ $section['title'] }}</p>
            </a>
        </div>
    @endforeach
</div>