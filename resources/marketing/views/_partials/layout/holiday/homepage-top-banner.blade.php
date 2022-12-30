<section class="big-promo-banner bg-black text-white text-center relative z-10 overflow-hidden px-5 md:px-3 lg:px-5 md:px-8 py-8 md:py-14 bg-cover bg-center">
    <div class="container mx-auto relative z-30 max-w-lg">
        <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
            @include($theme.'._partials.holiday-logo', [
                'styles' => 'h-14 sm:h-16 lg:h-20 mx-auto'
            ])
        </a>
        <p class="leading-tight mt-3 uppercase mb-4 text-white"><strong>{!! $text !!}</strong></p>
         <div class="mt-6 mb-7 rounded-xl px-3 sm:px-6 py-1 inline-flex flex-wrap mx-auto justify-center items-center" style="background-color:#181515;">
            <p class="leading-none m-0"><strong>DEALS END IN:</strong></p>
            <div class="h-12 mx-3 sm:mx-5 bg-promo" style="width:2px;"></div>
            <div class="tzcd-big">
                <div class="inline-block">
                    <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                    <p class="leading-none uppercase font-extrabold text-xs text-promo">days</p>
                </div>
                <div class="inline-block mx-2">
                    <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                    <p class="leading-none uppercase font-extrabold text-xs text-promo">hrs</p>
                </div>
                <div class="inline-block mr-2">
                    <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                    <p class="leading-none uppercase font-extrabold text-xs text-promo">mins</p>
                </div>
                <div class="inline-block">
                    <h2 class="font-extrabold leading-none text-2xl md:text-3xl lg:text-4xl">00</h2>
                    <p class="leading-none uppercase font-extrabold text-xs text-promo">secs</p>
                </div>
            </div>
        </div>

        {{-- This is for when a student is on the order form with an offer in their cart they are not eligible for.
             We redirect them back here and show them this error message. --}}
        @if(session()->has('error'))
            <p class="leading-tight mt-1 mb-5 uppercase text-xl"><strong class="text-promo">{{ session()->get('error') }}</strong></p>
        @endif

        <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs md:max-w-none">
            <a class="w-full md:w-1/2 join smaller outline md:order-2" href="@if($theme === 'drumeo') /drumshop @else /shop @endif">SHOP ALL DEALS &raquo;</a>

            <div class="w-full md:w-1/2 md:pr-2 mt-3 md:mt-0 relative">
                <a class="w-full join white smaller anchor-slide" href="#customize-anchor">JOIN {{ strtoupper($theme) }} &raquo;</a>
            </div>
        </div>
    </div>
    <div class="inset-0 block sm:hidden absolute bg-center bg-cover z-0" style="background: #000 url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif) center center/250px;box-shadow: 0 0 100px inset #000;"></div>
    <div class="inset-0 hidden sm:block absolute bg-center bg-cover z-0" style="background: #000 url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif) center center/250px;box-shadow: 0 0 100px inset #000;"></div>
</section>
