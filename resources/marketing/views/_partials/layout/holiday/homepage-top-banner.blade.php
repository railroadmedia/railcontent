<section class="big-promo-banner text-white text-center relative z-10 overflow-hidden px-5 sm:px-3 lg:px-5 sm:px-8 py-6 sm:pb-12 bg-cover bg-top"

    style="background-image:@if(!empty($bg)) {{ $bg }} @else url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/header-bg.webp') @endif ;
">
    <div class="container mx-auto relative z-30 max-w-lg">
        @if($theme === 'drumeo')
            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
                <img class="w-auto h-14 sm:h-16 lg:h-20" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/drumeo-summer-logo-text-only.webp">
            </a>
            <img class="h-80 absolute right-0 top-0 hidden sm:block translate-x-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/drumeo-summer-hand-icon.webp">
        @elseif($theme === 'pianote')
            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
                <img class="w-auto h-14 sm:h-16 lg:h-20" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/summer-sale/pianote-summer-logo-text-only.webp">
            </a>
            <img class="h-80 absolute right-0 top-0 hidden sm:block translate-x-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/summer-sale/pianote-summer-sun-icon.webp">
        @endif
            <h5 class="leading-tight my-4">{!! $text !!}</h5>

            <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs sm:max-w-none mt-4">
                <a class="w-full sm:w-1/2 join smaller outline sm:order-2 border-[#FFD600]" href="@if($theme === 'drumeo') /drumshop @else /shop @endif">SHOP NOW &raquo;</a>

                <div class="w-full sm:w-1/2 sm:pr-2 mt-3 sm:mt-0 relative">
                    <a class="w-full join white smaller anchor-slide" href="#customize-anchor">JOIN {{ strtoupper($theme) }} &raquo;</a>
                </div>
            </div>

        @if(session()->has('error'))
            <h5 class="leading-tight my-2"><strong class="text-musora">{{ session()->get('error') }}</strong></h5>
        @endif
    </div>
{{--    <div class="inset-0 absolute z-0" style="background-size: 400px;background-image: url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif);"></div>--}}
</section>
