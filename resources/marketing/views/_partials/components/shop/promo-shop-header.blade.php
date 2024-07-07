<header class="text-white text-center relative z-10 overflow-hidden px-5 sm:px-6
@if($theme === 'drumeo' || $theme === 'pianote')
    py-6 sm:pb-12
@else
    py-6 sm:py-12 lg:py-16
@endif
" {{--style="background-color:#141535;"--}}>
    <div class="container mx-auto relative z-30 max-w-2xl">
        @if($theme === 'drumeo' || $theme === 'pianote')
            @include($theme.'._partials.holiday-logo', [
                    'styles' => 'h-16 sm:h-24 lg:h-36 mx-auto mb-2'
                ])
{{--            @if(!empty($logo))--}}
{{--                <img src="{{ $logo }}" alt="Drumeo" class=" @if(!empty($logoStyles)) {{ $logoStyles }} @endif mx-auto">--}}
{{--            @endif--}}
{{--            <h1 class="uppercase leading-none sm:leading-none text-4xl sm:text-6xl mb-1">--}}
{{--                <strong>DRUM SHOP</strong>--}}
{{--            </h1>--}}
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
        <h5 class="leading-tight mb-4 uppercase">{!! $text !!}</h5>
    </div>
    <div class="inset-0 inline-block sm:hidden absolute bg-center bg-cover z-0" style="background-image:url('https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $bg }}');"></div>
    <div class="inset-0 hidden sm:inline-block absolute bg-center bg-cover z-0" style="background-image:url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/{{ $bg }}');"></div>
{{--    <div class="inset-0 absolute z-0" style="background-size: 400px;background-image: url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif);"></div>--}}
</header>
