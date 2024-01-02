<header class="text-white text-center relative z-10 overflow-hidden px-5 sm:px-6 py-6 sm:py-10 lg:py-14" style="background-color:#141535;">
    <div class="container mx-auto relative z-30 max-w-2xl">
{{--            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">--}}
{{--                @include($theme.'._partials.holiday-logo', [--}}
{{--                    'styles' => 'h-10 sm:h-14 mx-auto'--}}
{{--                ])--}}
{{--            </a>--}}
            <h1 class="uppercase leading-none sm:leading-none text-4xl sm:text-6xl my-1.5">
                <strong>{{ $theme }} SHOP</strong>
            </h1>
            <h5 class="leading-tight mb-4"><strong>{!! $text !!}</strong></h5>

    </div>
    <div class="inset-0 inline-block sm:hidden absolute bg-center bg-cover z-0" style="background-image:url('https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $bg }}');"></div>
    <div class="inset-0 hidden sm:inline-block absolute bg-center bg-cover z-0" style="background-image:url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/{{ $bg }}');"></div>
{{--    <div class="inset-0 absolute z-0" style="background-size: 400px;background-image: url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif);"></div>--}}
</header>
