@extends('singeo.sales.standard-layout', [
"openVersion" => true
])

@section('global-head')
    <title>Your complete guide to confident singing. | Singeo.com</title>
    <meta property="og:url" content="https://www.singeo.com"/>
    <meta property="og:title" content="Singeo.com: Your complete guide to confident singing."/>
    @parent
@endsection

@section('head-optimize')
    @include('partials.google-optimize')
@stop

@section('promo-banner')
    <div id="promo" class="anchor"></div>
    <section class="text-white text-center relative z-10 overflow-hidden px-4 md:px-3 lg:px-5 md:px-8 py-8 md:py-14 bg-cover bg-center" style="background:radial-gradient(#022040, #01050f 80%);">
        <div class="container mx-auto relative z-10 max-w-6xl">
            <h1 class="font-bebas leading-none mb-1 text-5xl md:text-6xl">FIND <span class="text-coaches">(AND LOVE)</span><br class="inline md:hidden"> YOUR TRUE VOICE</h1>
            <p class="leading-normal mb-3 md:mb-5 uppercase"><strong>With International Singing<br class="inline sm:hidden"> Superstar - Sheléa<br>
                    <span class="text-coaches">SAVE {{ round(100 - (100 * (\App\Prices::$singeoMembershipAnnual / \App\Prices::$singeoMembershipAnnualFull))) }}% ON AN ANNUAL MEMBERSHIP<br class="inline md:hidden"> + GET A FREE VOWEL POSTER</span></strong></p>
            <p class="leading-relaxed text-light-navy mb-5 max-w-2xl">Sheléa has performed on the world’s biggest stages. From NFL Stadiums to the Grammy Museum, and even the White House. Her voice has been compared to Whitney Houston, and it’s guaranteed to move you.
                <br><br>
                And this month she’ll help you find (and love) your true voice. Join Sheléa exclusively inside the Singeo Members Area and learn the secrets to finding, trusting, protecting, and ultimately LOVING your voice.
                <br><br>
                Get inspired and learn practical tips from a world-class singer.</p>


            <div class="max-w-lg lg:max-w-2xl mx-auto relative">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full" src="https://www.youtube.com/embed/GEZQZ3pxpAE?rel=0&showinfo=0" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
                <img style="transform: translate(-100%, -50%);" class="absolute hidden sm:inline top-1/2 -left-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/march/left_spread.png">
                <img style="transform: translate(100%, -50%);" class="absolute hidden sm:inline top-1/2 -right-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://singeo.s3.amazonaws.com/sales/promos/march/right_spread.png">
            </div>
            <a class="anchor-slide join smaller coaches mt-5" href="#customize-anchor">SEE THE DEAL</a>
        </div>
    </section>
@endsection

@section('sticky-bar')

    <div class="h-10 relative w-full block" style="background:linear-gradient(to bottom, #7fddf7, #afade2);"></div>
    <a href="#customize-anchor" style="background:linear-gradient(to bottom, #7fddf7, #afade2);"
            class="promo-banner anchor-slide block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap text-white bg-cover bg-center shadow-md py-1 hover:text-gray-100 z-0 mx-auto -mt-10 text-xs">
        <div class="container mx-auto relative">
            <div class="inline-block align-middle text-center">
                {{--<img class="inline-block align-middle mr-2 h-8" src="https://drumeo-assets.s3.amazonaws.com/promos/september/logo.svg">--}}
                <h5 class="font-bebas inline-block align-middle mx-auto text-2xl leading-none mr-1.5 h-8 py-1.5 px-2 bg-black rounded-md">FIND YOUR TRUE VOICE WITH SHELÉA</h5>
                <p class="inline-block align-middle mx-auto font-bebas text-sm leading-none sm:text-lg sm:leading-none text-black text-left">
                    <span class="uppercase">SAVE {{ round(100 - (100 * (\App\Prices::$singeoMembershipAnnual / \App\Prices::$singeoMembershipAnnualFull))) }}% ON YOUR<br> MEMBERSHIP</span></p>
            </div>
        </div>
    </a>
@endsection

@section('final')
    @include("singeo.sales.partials._subscribe-options")
@endsection