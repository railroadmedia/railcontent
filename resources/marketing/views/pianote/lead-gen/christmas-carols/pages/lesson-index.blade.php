@php
  require_once(resource_path('marketing/views/pianote/lead-gen/christmas-carols/lessons.php'))
@endphp

@extends('pianote.lead-gen.christmas-carols.christmas-carols-layout')

@section('meta')
    <meta name="robots" content="noindex">
    @parent
@endsection

@section('page-body')
    <header class="header text-center text-white py-6 md:py-12 lg:py-16 px-4 bg-top bg-no-repeat relative" style="background-color:#010519; background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/email-bg.jpg);">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <img class="h-10 md:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/logo.png">
        </div>
    </header>

    <div class="text-center text-white py-10 px-4" style="background: linear-gradient(to bottom, #00101d 60%, #171427);">
        <div class="container mx-auto">
            <h5 class="leading-normal max-w-xl lg:max-w-2xl">You can play songs on the piano. This video series will prove it. Simply click any of the songs below to get started.</h5>

            <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs md:max-w-xl lg:max-w-4xl px-0 md:px-2 my-8">
                @foreach ($lessons as $lesson)
                    <a href="{{ $lesson['watchLink'] }}" class="px-2 lg:px-4 w-1/2 md:w-1/3 mb-7">
                        <div class="aspect-1:1 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://www.musora.com/musora-cdn/image/width=500,quality=85/{{ $lesson['boxImage'] }});">
                            <i class="fas fa-play bg-pianote rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                        </div>
                        <h6 class="leading-normal"><strong>{{ $lesson['title'] }}</strong></h6>
                    </a>
                @endforeach
            </div>
            <h5 class="leading-normal max-w-xl lg:max-w-2xl">And don’t forget to download your FREE resources, including lead sheets for each song and a handy Chord Reference Guide.</h5>
            <a class="join smaller mt-6" href="https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/sheet-music/christmas-carols.zip">Download All PDFs</a>
        </div>
    </div>
    <section class="text-center py-14 md:py-24 lg:py-28 text-white bg-center bg-cover lazyload" style="background-color:#000417;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,q_60,quality=85/https://pianote.s3.amazonaws.com/shop/header-background.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="w-full max-w-xs md:max-w-md lg:max-w-lg mb-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1300,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg">
                <h4 class="leading-normal"><em><strong>Like these songs? Learn 495 more <br class="inline sm:hidden">
                            with 500 Songs in 5 Days.</strong><br>
                        <span class="opacity-70">Get your exclusive discount here:</span></em></h4>
                <a class="join my-5 md:my-7" href="/500-songs-carols-discount">500 SONGS IN 5 DAYS &raquo;</a>
                <h4>Just <s class="opacity-70">${{ floatval($productPrices['500-songs-in-5-days']->price) }}</s> <strong>$39</strong></h4>
            </div>
        </div>
    </section>
@endsection
