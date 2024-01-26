<div class="flex items-start relative @if(empty($videoModal['last-child'])) border-b pb-7 sm:pb-10 mb-7 sm:mb-10 @endif"
    style="border-color:#404040">
    <picture class="hidden sm:inline-block w-auto flex-shrink-0 h-48 lg:h-72 rounded-xl overflow-hidden">
        <source media="(min-width: 1024px)" srcset="https://www.musora.com/musora-cdn/image/width=580,quality=95/{{ $videoModal['image'] }}">
        <img class="w-full h-full relative opacity-0 transition-opacity"
            loading="lazy" onload="this.classList.remove('opacity-0')" alt="{{ $videoModal['winner'] }}"
            src="https://www.musora.com/musora-cdn/image/width=390,quality=95/{{ $videoModal['image'] }}">
    </picture>
    <div class="sm:pl-6 flex-grow-1">
        <h3 class="text-left uppercase font-bebas chrome">{{ $videoModal['award'] }}</h3>
        <img class="block sm:hidden h-52 rounded-xl overflow-hidden mx-0 my-3 opacity-0 transition-opacity"
            loading="lazy" onload="this.classList.remove('opacity-0')"
            src="https://www.musora.com/musora-cdn/image/width=410,quality=95/{{ $videoModal['image'] }}">
        <div>
            <h5 class="text-left my-2"><strong>{{ $videoModal['winner'] }}</strong></h5>
            <p class="leading-tight text-light-navy">{!! $videoModal['description'] !!}</p>
        </div>
    </div>
</div>
