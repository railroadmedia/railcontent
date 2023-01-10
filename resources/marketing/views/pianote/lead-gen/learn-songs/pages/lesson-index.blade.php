@extends('pianote.lead-gen.learn-songs.learn-songs-layout')

@section('meta')
    <meta name="robots" content="noindex">
    @parent
@endsection

@section('page-body')
    <header class="header text-center text-white py-6 lg:py-16 px-4 bg-top bg-no-repeat relative" style="background-color:#010519; background-image:url(https://cdn.musora.com/image/fetch/w_2500,q_60,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/header.jpg);">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <div class="flex flex-wrap items-center justify-end">
                <div class="w-full md:w-1/2">
                    <img class="w-2/3 lg:w-10/12" src="https://cdn.musora.com/image/fetch/w_900,q_60,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/logo-vertical.png">
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-4/5 md:h-1/2 z-0" style="background:linear-gradient(to bottom, transparent, #010519);"></div>
    </header>

    <div class="text-center text-white py-10 px-4" style="background: linear-gradient(to bottom, #000417, #000e2f);">
        <div class="container mx-auto">
            <h5 class="leading-normal max-w-xl lg:max-w-2xl">You can play songs on the piano. This video series will prove it. Simply click any of the lessons below to get started. (Although we do suggest you watch them in order.)</h5>
            <div class="flex flex-wrap items-start mx-auto max-w-xs md:max-w-xl lg:max-w-6xl px-6 md:px-2 my-12">
                <a href="/learn-songs/lessons/intro" class="px-2 md:px-4 w-full md:w-1/2 lg:w-1/4 mb-7 lg:mb-0">
                    <div class="aspect-1:1 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://cdn.musora.com/image/fetch/w_350,q_60,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/thumb-intro.jpg);">
                        <i class="fas fa-play bg-pianote rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><span class="text-pianote uppercase">Start Here!</span><br>
                        <strong>Introduction</strong><br>
                    with Lisa Witt</h6>
                </a>
                <a href="/learn-songs/lessons/someone-you-loved" class="px-2 md:px-4 w-full md:w-1/2 lg:w-1/4 mb-7 lg:mb-0">
                    <div class="aspect-1:1 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://cdn.musora.com/image/fetch/w_350,q_60,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/album-lewis.webp);">
                        <i class="fas fa-play bg-pianote rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><span class="text-pianote uppercase">Song #1</span><br>
                        <strong>Someone You Loved</strong><br>
                    Lewis Capaldi</h6>
                </a>
                <a href="/learn-songs/lessons/hallelujah" class="px-2 md:px-4 w-full md:w-1/2 lg:w-1/4 mb-7 lg:mb-0">
                    <div class="aspect-1:1 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://cdn.musora.com/image/fetch/w_350,q_60,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/album-leonard.webp);">
                        <i class="fas fa-play bg-pianote rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><span class="text-pianote uppercase">Song #2</span><br>
                        <strong>Hallelujah</strong><br>
                    Leonard Cohen</h6>
                </a>
                <a href="/learn-songs/lessons/love-story" class="px-2 md:px-4 w-full md:w-1/2 lg:w-1/4 mb-7 lg:mb-0">
                    <div class="aspect-1:1 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://cdn.musora.com/image/fetch/w_350,q_60,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/album-taylor.webp);">
                        <i class="fas fa-play bg-pianote rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><span class="text-pianote uppercase">Song #3</span><br>
                        <strong>Love Story</strong><br>
                    Taylor Swift</h6>
                </a>
            </div>
            <h5 class="leading-normal max-w-xl lg:max-w-2xl">And don’t forget to download your FREE resources, including chord charts for each song and a handy Chord Reference Guide.</h5>
            <a class="join smaller mt-6" href="https://pianote.s3.amazonaws.com/lead-gen/learn-3-songs/lessons/learn-3-songs.zip">Download All PDFs</a>
        </div>
    </div>
    <section class="text-center py-14 md:py-24 lg:py-28 text-white bg-center bg-cover lazyload" style="background-color:#000417;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_60,q_auto:best/https://pianote.s3.amazonaws.com/shop/header-background.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="w-full max-w-xs md:max-w-md lg:max-w-lg mb-5 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1300,q_60,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg">
                <h4 class="leading-normal"><em><strong>Like these songs? Learn 497 more <br class="inline sm:hidden">
                            with 500 Songs in 5 Days.</strong><br>
                        <span class="opacity-70">Get your exclusive discount here:</span></em></h4>
                <a class="join my-5 md:my-7" href="/500-songs-discount">500 SONGS IN 5 DAYS &raquo;</a>
                <h4>Just <s class="opacity-70">${{ floatval($productPrices['500-songs-in-5-days']->price) }}</s> <strong>$39</strong></h4>
            </div>
        </div>
    </section>
@endsection
