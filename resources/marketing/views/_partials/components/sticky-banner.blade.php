<a href="{{ $link }}" class="flex items-center justify-center px-2 sm:px-0 w-full z-[60] sticky top-[40px] md:top-[56px]" style="{{$style}}">
    @if(!empty($logo))
    <img
        class="h-8 sm:h-10 mr-4 transition-opacity opacity-0"
        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/230x0/filters:quality(95)/{{ $logo }}"
        alt="sticky bar logo"
        loading="lazy"
        onload="this.classList.remove('opacity-0')"
    />
    @endif
    <p class="inline-block text-xs mx-0 leading-tight">
        {!! $text !!}
    </p>
</a>