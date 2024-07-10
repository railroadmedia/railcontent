<section class="big-promo-banner text-white text-center relative z-10 overflow-hidden px-5 sm:px-3 lg:px-5 sm:px-8 pt-4 pb-8 sm:pb-12 bg-cover bg-top"

    style="background-image:@if(!empty($bg)) {{ $bg }} @else url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/drumeo/promos/summer-sale/header-bg.webp') @endif ;
">
    <div class="container mx-auto relative z-30 @if(!empty($bfVersion)) max-w-3xl @else max-w-2xl @endif">

            <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
                @include($theme.'._partials.holiday-logo', [
                    'styles' => 'h-16 sm:h-24 lg:h-36 mx-auto'
                ])
            </a>
            <h5 class="leading-tight my-4 uppercase">{!! $text !!}</h5>

            <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs sm:max-w-none mt-4">
                <a class="w-full sm:w-1/2 join smaller sm:order-2 bg-[#FFD600] text-black" href="@if($theme === 'drumeo') /drumshop @else /shop @endif">SHOP NOW &raquo;</a>

{{--                <div class="w-full sm:w-1/2 sm:pr-2 mt-3 sm:mt-0 relative">--}}
{{--                    <a class="w-full join white smaller anchor-slide" href="#customize-anchor">JOIN {{ strtoupper($theme) }} &raquo;</a>--}}
{{--                </div>--}}
            </div>

        @if(session()->has('error'))
            <h5 class="leading-tight my-2"><strong class="text-musora">{{ session()->get('error') }}</strong></h5>
        @endif
    </div>
{{--    <div class="inset-0 absolute z-0" style="background-size: 400px;background-image: url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif);"></div>--}}
</section>
