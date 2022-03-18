@extends('singeo.sales.standard-layout', [
"trialVersion" => true
])

@section('head-includes')
    @parent

    <title>Your start-to-finish guide to confident singing | Singeo.com</title>
    <meta property="og:url" content="https://www.singeo.com/trial"/>
    <meta property="og:title" content="Singeo.com: Your start-to-finish guide to confident singing"/>
@endsection

@section('promo-banner')
    <div id="promo" class="anchor"></div>
    <section class="text-white text-center relative z-10 overflow-hidden px-4 md:px-3 lg:px-5 md:px-8 py-8 md:py-14 bg-cover bg-center" style="background:radial-gradient(#022040, #01050f 80%);">
        <div class="container mx-auto relative z-10 max-w-6xl">
            <h1 class="font-bebas leading-none mb-1 text-5xl md:text-6xl">FIND <span class="text-coaches">(AND LOVE)</span><br class="inline md:hidden"> YOUR TRUE VOICE</h1>
            <p class="leading-normal mb-3 md:mb-5 uppercase"><strong>With International Singing Superstar - Sheléa<br>
                    <span class="text-coaches">GET STARTED WITH A<br class="inline md:hidden"> FREE 7-DAY TRIAL</span></strong></p>
            <p class="leading-relaxed text-light-navy mb-5 max-w-3xl">Sheléa has performed on the world’s biggest stages. From NFL Stadiums to the Grammy Museum, and even the White House. Her voice ….
                <br><br>
                And this month she’ll help you find (and love) your true voice. Join Sheléa exclusively inside the Singeo Members Area and learn the secrets to finding, trusting, protecting, and ultimately LOVING your voice. Get inspired and learn practical tips from a world-class singer.</p>


            <div class="max-w-lg lg:max-w-2xl mx-auto relative">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full" src="https://www.youtube.com/embed/GEZQZ3pxpAE?rel=0&showinfo=0" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
                <img style="transform: translate(-100%, -50%);" class="absolute hidden sm:inline top-1/2 -left-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/march/left_spread.png">
                <img style="transform: translate(100%, -50%);" class="absolute hidden sm:inline top-1/2 -right-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/march/right_spread.png">
            </div>
            <a class="anchor-slide join smaller coaches mt-5" href="#customize-anchor">START YOUR FREE TRIAL</a>
        </div>
    </section>
@endsection

@section('final')
    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include("singeo.sales.partials._final-trial", [ "sevenDay" => true, "url" => "/choose-your-trial/" ])
@endsection