@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    @parent

    <meta name="robots" content="noindex">
    <title>4 Exercises Guaranteed To Improve ANY Voice!</title>
    <meta property="og:title" content="4 Exercises Guaranteed To Improve ANY Voice!">
    <meta name="description" content="Anyone can sing! Singeo is here to show you how in this free mini lesson series."/>
    <meta property="og:description" content="Anyone can sing! Singeo is here to show you how in this free mini lesson series.">

    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/og-image.jpg">
    <meta property="og:url" content="https://www.singeo.com/stop-hating-your-voice/">
    <link rel="stylesheet" href="{{ asset('/assets/marketing/lead-gen.css') }}">
@stop

@section('body')
    <header class="header text-center text-white py-12 md:py-18 lg:py-20 px-4 bg-center bg-no-repeat relative" style="background-color:#010519; background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/order-bg.jpg);">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <img class="h-10 md:h-20 lg:h-24" src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/logo.png">
        </div>
    </header>

    <div class="text-center text-white py-10 md:py-20 px-4" style="background: linear-gradient(to bottom, #00101d 60%, #171427);">
        <div class="container mx-auto">
            <h5 class="leading-normal max-w-xl lg:max-w-2xl">Simply click on the first lesson<br class="inline md:hidden"> below to get started.</h5>

            <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs md:max-w-2xl lg:max-w-4xl px-0 md:px-2 my-8">
                <a href="/stop-hating-your-voice/lessons/1" class="px-1 md:px-4 w-full sm:w-1/3 mb-7">
                    <div class="aspect-16:9 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/its-normal-thumb.jpg);">
                        <i class="fas fa-play bg-singeo rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><strong>It's Normal!</strong></h6>
                </a>
                <a href="/stop-hating-your-voice/lessons/2" class="px-1 md:px-4 w-full sm:w-1/3 mb-7">
                    <div class="aspect-16:9 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/get-control-thumb.jpg);">
                        <i class="fas fa-play bg-singeo rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><strong>Get Control</strong></h6>
                </a>
                <a href="/stop-hating-your-voice/lessons/3" class="px-1 md:px-4 w-full sm:w-1/3 mb-7">
                    <div class="aspect-16:9 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/find-your-new-voice-thumb.jpg);">
                        <i class="fas fa-play bg-singeo rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><strong>Find Your New Voice</strong></h6>
                </a>
            </div>
        </div>
    </div>
    
    <section class="text-center py-12 md:py-20 lg:py-24 text-white bg-center bg-cover lazyload" style="background-color:#030d17;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_60,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/final-bg.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="h-10 sm:h-20 lg:h-24 mb-5 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1300,q_60,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/logo.png">
                <h3><strong>Put your beautiful new voice to work.</strong></h3>
                <h5 class="mt-3 leading-normal">Build your control, range, and confidence with the Singing Starter Kit.<br>
                    Click below for your exclusive discount. Only for How To Stop Hating Your Voice students.</h5>
                <a class="join my-5 md:my-7" href="/singing-starter-kit-discount">CLAIM MY DISCOUNT &raquo;</a>
            </div>
        </div>
    </section>
@endsection