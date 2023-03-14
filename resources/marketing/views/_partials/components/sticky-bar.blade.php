<a href="{{ $link }}" class="flex items-center justify-center py-2 px-2 sm:px-0 w-full z-[100] fixed" style="background: linear-gradient(180deg, #EBF0FF 0%, #DEE6FF 100%);">
    @if(!empty($logo))
    <img
        class="h-8 sm:h-10 mr-4 transition-opacity opacity-0"
        src="https://www.musora.com/musora-cdn/image/width=300,quality=85/{{ $logo }}"
        alt="sticky bar logo"
        loading="lazy"
        onload="this.classList.remove('opacity-0')"
    />
    @endif
    <p class="text-sm sm:text-lg font-bebas uppercase mx-0 leading-none sm:leading-none">
        {!! $text !!}
    </p>
</a>
