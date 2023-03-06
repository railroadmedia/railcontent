@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    @parent
    <meta name="robots" content="noindex">
    <title>How To Stop Hating Your Voice | Singeo</title>
    <meta property="og:title" content="How To Stop Hating Your Voice">
    <meta name="description" content="Learn to love your voice in 3 easy lessons!"/>
    <meta property="og:description" content="Learn to love your voice in 3 easy lessons!">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,q_60,quality=85/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/fb-share-image.jpg">
    <meta property="og:url" content="https://www.singeo.com/stop-hating-your-voice/">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/lead-gen.css') }}">
@stop

@section('body')
    <header class="header text-center text-white py-10 md:py-18 px-4 bg-center bg-no-repeat relative" style="background-color:#010519; background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/order-bg.jpg);">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <img class="h-16 md:h-24 lg:h-28" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/logo.png">
        </div>
    </header>

    <div class="text-center text-white py-10 md:py-20 px-4" style="background: linear-gradient(to bottom, #00101d 60%, #171427);">
        <div class="container mx-auto">
            <h5 class="leading-normal max-w-xl lg:max-w-2xl">Simply click on the first lesson<br class="inline md:hidden"> below to get started.</h5>
            @php
                $lessons = [
                    [
                        'img' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/thumb-1.png',
                        'title' => 'IT’S NORMAL!',
                        'desc' => 'Everyone hates their voice. But it’s completely normal! In this lesson, you’ll learn the ONE thing you can do that will instantly make you sound better.',
                        'href' => '/stop-hating-your-voice/lessons/1'
                    ],
                    [
                        'img' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/thumb-2.png',
                        'title' => 'GET CONTROL',
                        'desc' => 'Your voice uses muscles. And when you strengthen them, you gain control of how you sound. This lesson will show you how to sing stronger, and sound better.',
                        'href' => '/stop-hating-your-voice/lessons/2'
                    ],
                    [
                        'img' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/thumb-3.png',
                        'title' => 'FIND YOUR NEW VOICE',
                        'desc' => 'Put your exercises to work and sing a real song. Notice how much better and more confident you’ll sound after only a few short lessons!',
                        'href' => '/stop-hating-your-voice/lessons/3'
                    ],
                ];
            @endphp

            <div class="flex flex-wrap justify-center text-left mx-auto max-w-2xl lg:max-w-5xl my-8">
                @foreach ($lessons as $lesson)
                    <a href="{{ $lesson['href'] }}" class="flex lg:flex-auto w-full md:w-1/2 lg:w-1/3 px-2 md:px-3 mb-7 md:mb-10 step">
                        <div class="rounded-xl overflow-hidden" style="background: linear-gradient(to bottom, #153044 56%, #252646); ">
                            <div class="aspect-16:9 w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $lesson['img'] }});">
                                <i class="fas fa-play bg-singeo rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                            </div>
                            <h4 class="px-4 mt-4 mb-2 uppercase font-bebas">{{ $lesson['title'] }}</h4>

                            <p class="px-4 pb-4 opacity-70">{!! $lesson['desc'] !!}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <section class="text-center py-12 md:py-20 text-white bg-center bg-cover lazyload" style="background-color:#030d17;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,q_60,quality=85/https://singeo.s3.amazonaws.com/products/singing-starter-kit/final-bg.jpg">
        <div class="container mx-auto">
            <div class="w-full px-3 md:px-4 text-center">
                <img class="h-16 sm:h-20 lg:h-24 mb-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1300,q_60,quality=85/https://singeo.s3.amazonaws.com/products/singing-starter-kit/logo.png">
                <h3><strong>Put your beautiful new voice to work.</strong></h3>
                <h5 class="mt-3 leading-normal">
                    Build your control, range, and confidence with the Singing Starter Kit.<br class="hidden sm:inline">
                    Click below for your exclusive discount. <br class="hidden sm:inline lg:hidden">
                    Only for How To Stop Hating Your Voice students.</h5>
                <a class="join my-5 md:my-7" href="/singing-starter-kit-shyv-discount">CLAIM MY DISCOUNT &raquo;</a>
            </div>
        </div>
    </section>
@endsection
