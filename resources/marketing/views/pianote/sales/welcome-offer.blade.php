@extends('pianote.sales.subscription', [
    "promoVersion" => true,
])

@section('global-head')
    <title>Learn Piano with Step by Step Online Lessons | Pianote</title>
    <meta property="og:title" content="Pianote - The Better Way To Learn Piano">
    <meta property="og:url" content="https://www.pianote.com/welcome-offer">
    @parent
@endsection

@section('promo-banner')
    <div class="sticky-trigger block"></div>
    <a href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&redirect=/order&locked=true&promo-code=welcome-offer"
        class="promo-banner flex text-white items-center justify-center fixed mt-0 py-1.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide"style="background: linear-gradient(to bottom, #f41a30, #79080b);">
        {{--        <img class="h-8 sm:h-10 mr-4" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-blue-glow.png" alt="30 day drummer logo" />--}}
        <h3 class="inline-block font-bebas text-musora mx-0 pr-3">SAVE 25%</h3>
        <p class="inline-block text-xs mx-0 leading-tight">

        </p>
    </a>
@endsection
@section('final')

    <section class="py-14 sm:py-20 lg:py-24 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background: linear-gradient(to right, #08203a, #0c1524);">
        <div class="container mx-auto max-w-6xl relative z-50">
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-lg">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 45%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class=" front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <picture class="h-full w-full bg-top bg-cover opacity-100" :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}" x-intersect.once="lazyLoad = true">
                                    <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/pianote-annual-2w-card.webp" media="(min-width: 640px)">
                                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/membership/homepage/webp-format/pianote-annual-2w-card.webp" alt="Top Image" class="w-full h-full object-cover transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')">
                                </picture>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h2 class="leading-tight mt-4 sm:mt-5 mb-2"><strong>Online piano lessons for all skill levels.</strong></h2>
                <h3 class="leading-tight mt-4 sm:mt-5 mb-2">
                    <s class="opacity-50">$240</s>
                    <strong>$180</strong> <span class="text-musora">(Save 25%)</span>
                </h3>
                <p class="text-sm mb-4 sm:mb-6">For your first year, then $240/yr.</p>
                <a class="join {{ $theme }} my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&redirect=/order&locked=true&promo-code=welcome-offer">GET STARTED &raquo;</a>
            </div>
            <p class="opacity-70 text-sm mt-2"><em>90-day money-back guarantee. Cancel anytime.</em></p>
        </div>
    </section>
@endsection
