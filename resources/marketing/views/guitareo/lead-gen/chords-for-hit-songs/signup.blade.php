@php
    $albums = [
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/perfect-album.jpg',
            'title' => 'Perfect',
            'artist' => 'Ed Sheeran',
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/standbyme-album.jpg',
            'title' => 'Stand by me',
            'artist' => 'Ben E. King',
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/viva-album.jpg',
            'title' => 'Viva La Vida',
            'artist' => 'Coldplay',
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/zombie-album.jpg',
            'title' => 'Zombie',
            'artist' => 'The Cranberries',
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/browneyedgirl-album.jpg',
            'title' => 'Brown Eyed Girl',
            'artist' => 'Van Morrison',
        ],
        [
            'img' => 'https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/sweethomeala-album.jpg',
            'title' => 'Sweet Home Alabama',
            'artist' => 'Lynyrd Skynyrd',
        ],
    ];
@endphp

@extends('lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Guitar Chords for Hit Songs | Guitareo</title>
    <meta property="og:title" content="Guitar Chords for Hit Songs | Guitareo">
    <meta name="description" content=""/>
    <meta property="og:description" content="">

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/fb-share-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/chords-for-hit-songs/">

    @parent

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="preload" href="/assets/marketing/song-in-an-hour.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="/assets/marketing/song-in-an-hour.css"></noscript>
    <style>
        i.fa-check {
            color: #00C9AC;
        }

        header {
            background-image: url('https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/header-bg-m.jpg');
            background-size: 450px;
            background-color: #000C17;
            background-position-x: center;
            background-position-y: 0px;
        }
        
        header img {
            margin-bottom: 500px;
        }

        .footer {
            background-image: url('https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/footer-bg-m.jpg');
            background-color: #000C17;
        }

        @media (min-width:768px){
            header {
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/header-bg.jpg');
                background-size: 1600px;
                background-position-x: center;
                background-position-y: top;
            }

            header img {
                margin-bottom: 32px;
            }

            .footer {
                background-image: url('https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/footer-bg.jpg');
                background-size: 1700px;
                background-position: center;
            }
        }
    </style>
@endsection

@section('body')
    <header class="pt-3 pb-6 md:py-20 bg-no-repeat"> 
        <div class="max-w-md md:max-w-5xl mx-auto md:flex px-4">
            <div class="md:w-1/2 text-center md:text-left">
                <img class="h-24 md:h-40 md:mb-8 md:pl-3 inline-block lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/logo.png" alt="logo">
                <h6 class="font-extrabold text-white mb-6 pl-2 md:pl-3">Sign-up for your free online lessons today!</h6>
                <div class="md:max-w-md lg:max-w-auto lg:w-3/4">
                    @include('lead-gen.partials._sign-up-form-tw', [
                        "formId" => "Guitareo - Engagement - Trigger - Guitar Chords for Hit Songs - Web Form",
                        "formName" => 'Guitar Chords for Hit Songs',
                        "redirectURL" => "/chords-for-hit-songs/thank-you",
                        "buttonText" => "Get Started",
                        'buttonTextColor' => 'black',
                        "stacked" => true,
                        'disclaimerColor' => '#B3B3B9',
                    ])
                </div>
            </div>
        </div>
    </header>

    <section class="py-12 md:py-20" style="background:#FAFAFA;">
        <div class="max-w-md md:max-w-5xl px-4 mx-auto">
            <h4 class="font-extrabold text-center leading-normal mb-2">
                Master four essential guitar chords <br>
                with play-along style lessons.
            </h4>
            <p class="text-center mb-6">Unlock the possibilities of playing thousands of songs.</p>
            <div class="md:flex md:flex-wrap md:items-center mb-10">
                <div class="md:w-1/2 md:pr-10 mb-6 md:mb-0">
                    <img class="lazyload" data-src="https://cdn.musora.com/image/fetch/w_700,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/collage.png" alt="collage image">
                </div>
                <div class="md:w-1/2 rounded-xl border py-6 px-4 md:pl-10" style="border-color:#E0E0E0;">
                    <p class="font-bold md:text-center mb-4">You’ll begin to hear the difference with:</p>
                    <div class="lg:w-3/5 mx-auto">
                        <h6 class="mb-4"><i class="fas fa-check mr-3 text-xl" aria-hidden="true"></i>Smoother chord changes.</h6>
                        <h6 class="mb-4"><i class="fas fa-check mr-3 text-xl" aria-hidden="true"></i>Cleaner sounds on guitar.</h6>
                        <h6><i class="fas fa-check mr-2 text-xl" aria-hidden="true"></i>Enhanced muscle memory.</h6>
                    </div>
                </div>
            </div>
            <picture>
                <source media="(min-width: 768px)" srcset="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/chords.png">
                <img class="w-full lazyload" data-src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/chords-m.png" alt="chords">
            </picture>
        </div>
    </section>

    <div class="relative h-5 sm:h-7 -mb-5 sm:-mb-7" style="background: linear-gradient(to top left, transparent calc(50% - 1px), #FAFAFA, #FAFAFA calc(50% + 1px));"></div>

    <section class="py-12 md:py-20">
        <div class="max-w-md md:max-w-5xl px-4 mx-auto text-center">
            <p class="mb-2">Guided play-along lessons with Ayla Tesler-Mabe.</p>
            <h4 class="font-extrabold leading-normal mb-10">
                With your play-along lessons, you’ll unlock <br>
                how to play thousands of hit songs like:
            </h4>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-14">
                @foreach ($albums as $key => $album)
                    <div @if($key === 0) class="md:mb-6" @endif>
                        <img class="lazyload rounded-md" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/{{ $album['img'] }}" alt="{{ $album['title'] }}">
                        <p>
                            <span class="font-bold">{{ $album['title'] }}</span><br>
                            {{ $album['artist'] }}
                        </p>
                    </div>
                @endforeach
            </div>
            <h5 class="font-extrabold">… and more!</h5>
        </div>
    </section>

    <section class="bg-no-repeat py-12 md:py-20 footer">
        <div class="max-w-md md:max-w-5xl px-4 mx-auto md:flex">
            <div class="md:w-1/2">
                <div class="md:pl-3 text-white text-center md:text-left">
                    <img class="h-32 mb-8 inline-block lazyload" data-src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/logo.png" alt="logo">
                    <p class="font-bold italic mb-2">Start to make your chords sound amazing:</p>
                    <p class="leading-relaxed"><i class="fas fa-check mr-2 text-xl" aria-hidden="true"></i>Guided play-along lessons.</p>
                    <p class="leading-relaxed"><i class="fas fa-check mr-2 text-xl" aria-hidden="true"></i>Free chord chart diagram.</p>
                    <p class="mb-4 leading-relaxed"><i class="fas fa-check mr-2 text-xl" aria-hidden="true"></i>Yours to keep forever.</p>
                </div>
                
                <div class="md:max-w-md lg:max-w-auto lg:w-3/4">
                    @include('lead-gen.partials._sign-up-form-tw', [
                        "formId" => "Guitareo - Engagement - Trigger - Guitar Chords for Hit Songs - Web Form",
                        "formName" => 'Guitar Chords for Hit Songs',
                        "redirectURL" => "/chords-for-hit-songs/thank-you",
                        "buttonText" => "Get Started",
                        'buttonTextColor' => 'black',
                        "stacked" => true,
                        'disclaimerColor' => '#B3B3B9',
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection