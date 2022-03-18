@extends('guitareo.sales.standard-layout', [
    "openVersion" => true
])

@section('head-includes')
    @parent

    <title>Online guitar lessons that care about you. | Guitareo.com</title>
    <meta property="og:url" content="https://www.guitareo.com"/>
    <meta property="og:title" content="Guitareo.com: Online guitar lessons that care about you."/>
@endsection

@section('promo-banner')
    <section class="text-white text-center relative z-10 overflow-hidden px-4 md:px-3 lg:px-5 md:px-8 py-8 md:py-14 bg-cover bg-center" style="background:radial-gradient(#022040, #01050f 80%);">
        <div class="container mx-auto relative z-10 max-w-6xl">
            <img class="h-16 sm:h-28 lg:h-36 mb-3 md:mb-5" src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/march/play-better-solos-green.png">
            {{--<h1 class="font-bebas leading-none mb-1 text-5xl md:text-6xl --}}{{--mb-3 md:mb-5--}}{{--">PLAY  <span class="text-coaches">BETTER SOLOS</span></h1>--}}
            <p class="leading-tight mb-3 md:mb-5 uppercase"><strong>SAVE 21% ON GUITAREO &<br class="inline sm:hidden"> GET $253 IN FREE BONUSES
                    {{--<br><span class="text-coaches">ONLY <span class="tzcd-full hidden sm:inline">A LIMITED TIME</span> <span class="tzcd-small inline sm:hidden">A LIMITED TIME</span> LEFT!</span>--}}
                </strong></p>
            <p class="leading-relaxed text-light-navy mb-8 max-w-3xl">Stop noodling around with the same old tired licks. Break out of your pentatonic box and learn how to play solos that actually sound good.
                <br><br>
                This month you’ll find Your New Sounds For Soloing with a BRAND NEW course launching inside Guitareo. And to celebrate, you’ll save 21% on your membership + get lifetime access to Guitar Technique Made Easy and The Guitar System for FREE.</p>
            <div class="max-w-lg lg:max-w-2xl mx-auto relative">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/688169456" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
                <img style="transform: translate(100%, -50%);" class="absolute hidden sm:inline top-1/2 -right-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/left-spread-guitareo.png">
                <img style="transform: translate(-100%, -50%);" class="absolute hidden sm:inline top-1/2 -left-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://guitareo.s3.amazonaws.com/sales/2022/right-spread-guitareo.png">
            </div>
        </div>
    </section>
@endsection

@section('sticky-bar')

    <div class="h-10 relative w-full block" style="background:linear-gradient(to bottom, #97fabf, #9ddcf7);"></div>
    <a href="#customize-anchor" style="background:linear-gradient(to bottom, #97fabf, #9ddcf7);"
            class="promo-banner anchor-slide block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap bg-cover bg-center shadow-md py-1 z-0 mx-auto -mt-10 text-xs">
        <div class="container mx-auto relative">
            <div class="inline-block align-middle text-left">
                <img class="inline-block align-middle mr-2 h-8" src="https://cdn.musora.com/image/fetch/w_220,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/march/play-better-solos-black.png">
                {{--<h5 class="leading-none font-bebas inline-block align-middle mx-auto text-2xl mr-2 h-8 py-1.5 px-2 bg-black rounded-md text-white">PLAY BETTER SOLOS</h5>--}}
                <p class="inline-block align-middle mx-auto font-bebas  leading-none sm:text-lg sm:leading-none h-8 text-black">Save 21% on Guitareo &<br> Get $254 In FREE BONUSES</p>
            </div>
        </div>
    </a>
@endsection

@section('final')
    @include("guitareo.sales.partials._subscribe-bonus-tiles")
@endsection