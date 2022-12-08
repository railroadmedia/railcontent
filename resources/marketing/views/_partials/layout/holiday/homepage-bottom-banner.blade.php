<section class="big-promo-banner bg-black text-white text-center relative z-10 overflow-hidden px-5 md:px-3 lg:px-5 md:px-8 py-12 sm:py-24 lg:py-36 bg-cover bg-center">
    <div class="container mx-auto relative z-30 max-w-lg">
        <a href="@if($theme === 'drumeo') /drumshop @else /shop @endif">
            @include($theme.'._partials.holiday-logo',[
                'styles' => 'h-10 md:h-14 lg:h-16 mx-auto'
            ])
        </a>
        <p class="leading-tight my-6 uppercase">
            {!! $text !!}
        </p>
        <div class="rounded-xl px-3 sm:px-6 py-2 inline-flex flex-wrap mx-auto justify-center items-center" style="background-color:#181515;">
            <p class="leading-none m-0"><strong>DEALS END IN:</strong></p>
            <div class="h-12 mx-3 sm:mx-5 bg-promo" style="width:2px;"></div>
            <div class="tzcd-big2">
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
        <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs md:max-w-none mt-6">
            <a class="w-full md:w-1/2 join smaller outline md:order-2" href="@if($theme === 'drumeo') /drumshop @else /shop @endif">SHOP ALL DEALS &raquo;</a>
        </div>
    </div>
    <div class="inset-0 block sm:hidden absolute bg-center bg-cover z-0" style="background-image:url(https://cdn.musora.com/image/fetch/w_750,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/header-banner-bg-m.jpg);"></div>
    <div class="inset-0 block sm:hidden absolute bg-center bg-cover z-0" style="background-image:url(https://cdn.musora.com/image/fetch/w_750,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/header-banner-bg-m2.jpg);"></div>
    <div class="inset-0 hidden sm:block absolute bg-center bg-cover z-0" style="background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/header-banner-bg.jpg);"></div>
</section>
