<a href="{{ $link }}" class="flex items-center justify-center py-1 sm:pb-0 px-2 sm:px-0 w-full text-white z-[100] fixed anchor-slide"
    style="background: linear-gradient(to bottom, #0b74d8, #024e95);">
    @if(!empty($logo))
    <img
        class="h-10 sm:h-12 mr-4 sm:-mb-2 transition-opacity opacity-0"
        src="https://www.musora.com/musora-cdn/image/width=300,quality=95/{{ $logo }}"
        alt="sticky bar logo"
        loading="lazy"
        onload="this.classList.remove('opacity-0')"
    />
    @endif
    <div class="flex flex-col sm:flex-row items-start sm:items-center sm:py-2">
        <h3 class="font-bebas uppercase mx-0 leading-none sm:mr-3">{!! $text !!}</h3>
        <p class="mx-0 leading-none">Only <s class="opacity-50">500</s> <strong>{!! $stock !!}</strong> left!</p>
    </div>
</a>
