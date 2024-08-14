<header class="text-white text-center relative z-10 overflow-hidden px-5 sm:px-6 py-6 sm:py-12 lg:py-16" style="background-color:#141535;">
    <div class="container mx-auto relative z-30 max-w-2xl">
        @if($theme === 'drumeo')
            @if(!empty($logo))
                <img src="{{ $logo }}" alt="Drumeo" class=" @if(!empty($logoStyles)) {{ $logoStyles }} @endif mx-auto">
            @endif
            <h1 class="uppercase leading-none sm:leading-none text-4xl sm:text-6xl mb-1">
                <strong>DRUM SHOP</strong>
            </h1>
        @else
            <h1 class="uppercase leading-none sm:leading-none text-4xl sm:text-7xl mb-2">
                <strong>
                    @if(!empty($logo))
                        <img src="{{ $logo }}" alt="Drumeo" class=" @if(!empty($logoStyles)) {{ $logoStyles }} @endif mx-auto">
                    @else
                        <span class="text-{{ $theme }}">{{ $theme }}</span>
                    @endif
                    SHOP</strong>
            </h1>
        @endif
        <h6 class="leading-tight mb-4">{!! $text !!}</h6>
    </div>
    <div class="inset-0 inline-block sm:hidden absolute bg-center bg-cover z-0" style="background-image:url('https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $bg }}');"></div>
    <div class="inset-0 hidden sm:inline-block absolute bg-center bg-cover z-0" style="background-image:url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/{{ $bg }}');"></div>
</header>
