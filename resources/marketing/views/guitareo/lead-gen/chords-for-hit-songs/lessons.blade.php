@php
    $lessons = [
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/lesson1-thumb.jpg',
            'title' => 'Meet your instructor Ayla',
            'link' => '/chords-for-hit-songs/lessons/1'
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/lesson2-thumb.jpg',
            'title' => 'Master G and Em guitar chords',
            'link' => '/chords-for-hit-songs/lessons/2'
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/lesson3-thumb.jpg',
            'title' => 'Link Em and C chords together',
            'link' => '/chords-for-hit-songs/lessons/3'
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/lesson4-thumb.jpg',
            'title' => 'Switch between C and D chords',
            'link' => '/chords-for-hit-songs/lessons/4'
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/lesson5-thumb.jpg',
            'title' => 'Nail down the D and G chord transition',
            'link' => '/chords-for-hit-songs/lessons/5'
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/lesson6-thumb.jpg',
            'title' => 'Play these four chords all together',
            'link' => '/chords-for-hit-songs/lessons/6'
        ],
    ];
@endphp

@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Guitar Chords for Hit Songs</title>
    <meta property="og:title" content="Guitar Chords for Hit Songs">

    <meta name="description" content="Gain the skills to play guitar chords used in thousands of hit songs with Ayla Tesler-Mabe."/>
    <meta property="og:description" content="Gain the skills to play guitar chords used in thousands of hit songs with Ayla Tesler-Mabe.">

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/fb-share-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/chords-for-hit-songs/lessons">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/song-in-an-hour.css') }}">
    @parent
@stop

@section('body')
    <header class="lazyload bg-cover bg-center py-10 text-center" data-bg="https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/lesson-header.jpg">
        <img class="lazyload inline-block h-36" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/logo.png" alt="logo">
    </header>

    <section class="py-12 md:py-20" style="background:#010D18;">
        <div class="max-w-4xl mx-auto text-white px-4 lg:px-0">
            <h3 class="font-extrabold leading-normal text-center mb-2">
                Gain the skills to play guitar chords used in <br class="hidden md:inline">thousands of hit songs with Ayla Tesler-Mabe.
            </h3>
            <p class="text-center mb-6">
                Learning chords will help you improve your guitar skills without knowing music theory. <br class="hidden md:inline">You’ll learn how to play popular chords so you can unlock thousands of songs on the guitar!
            </p>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                @foreach ($lessons as $lesson)
                    <a href="{{$lesson['link']}}">
                        <div class="relative">
                            <div class="absolute inset-0 flex justify-center items-center md:opacity-0 hover:opacity-100 transition-opacity duration-300">
                                <i class="fas fa-play-circle text-3xl md:text-5xl opacity-70" aria-hidden="true"></i>
                            </div>
                            <img class="lazyload border-4 border-white rounded-xl mb-1" data-src="{{ $lesson['img'] }}" alt="{{ $lesson['title'] }} thumb">
                        </div>
                        <p class="font-bold text-white leading-tight">{{ $lesson['title'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lazyload bg-center bg-cover py-12 md:py-20 text-center" data-bg="https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/lesson-footer.jpg">
        <img class="lazyload mb-2 h-14 lg:h-20" data-src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png" alt="guitareo logo">
        <h3 class="mb-4 leading-snug">
            <strong class="text-white">Start your free 7-day trial.</strong><br>
            <i style="color:#B3B3B9;">Cancel anytime. 90-Day Money-Back Guarantee</i>
        </h3>
        <a href="" class="join" style="color:black;">Get Started»</a>
    </section>
@stop
