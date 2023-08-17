@php
    $albums = [
        [
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/perfect-album.jpg',
            'title' => 'Perfect',
            'artist' => 'Ed Sheeran',
        ],
        [
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/standbyme-album.jpg',
            'title' => 'Stand by me',
            'artist' => 'Ben E. King',
        ],
        [
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/viva-album.jpg',
            'title' => 'Viva La Vida',
            'artist' => 'Coldplay',
        ],
        [
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/zombie-album.jpg',
            'title' => 'Zombie',
            'artist' => 'The Cranberries',
        ],
        [
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/browneyedgirl-album.jpg',
            'title' => 'Brown Eyed Girl',
            'artist' => 'Van Morrison',
        ],
        [
            'img' => 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/sweethomeala-album.jpg',
            'title' => 'Sweet Home Alabama',
            'artist' => 'Lynyrd Skynyrd',
        ],
    ];
@endphp

@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Guitar Chords for Hit Songs | Guitareo</title>
    <meta property="og:title" content="Guitar Chords for Hit Songs | Guitareo">
    <meta name="description" content="Gain the skills to play guitar chords used in thousands of hit songs with Ayla Tesler-Mabe."/>
    <meta property="og:description" content="Gain the skills to play guitar chords used in thousands of hit songs with Ayla Tesler-Mabe.">

    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/fb-share-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/chords-for-hit-songs/">

    @parent

    <link rel="preload" href="{{ asset('/marketing/parcel/drumeo/song-in-an-hour.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/song-in-an-hour.css') }}"></noscript>
    <style>
        i.fa-check {
            color: #00C9AC;
        }

        header {
            background-image: url('https://www.musora.com/musora-cdn/image/width=650,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/header-bg-m.jpg');
            background-size: 450px;
            background-position-x: center;
            background-position-y: 0px;
        }

        header img {
            margin-bottom: 500px;
        }

        .footer {
            background-image: url('https://www.musora.com/musora-cdn/image/width=650,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/footer-bg-m.jpg');
        }

        @media (min-width:768px){
            header {
                background-image: url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/header-bg.jpg');
                background-size: 1600px;
                background-position-x: center;
                background-position-y: top;
            }

            header img {
                margin-bottom: 32px;
            }

            .footer {
                background-image: url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/footer-bg.jpg');
                background-size: 1700px;
                background-position: center;
            }
        }
    </style>
@endsection

@section('body')
    <header class="pt-3 pb-6 md:py-20 bg-no-repeat bg-musora-black">
        <div class="max-w-md md:max-w-5xl mx-auto md:flex px-4">
            <div class="md:w-1/2 text-center md:text-left">
                <img class="h-24 md:h-40 md:mb-8 md:pl-3 inline-block lazyload" data-src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/logo.png" alt="logo">
                <h6 class="font-extrabold text-white mb-6 pl-2 md:pl-3">Sign-up for your free online lessons today!</h6>
                <div class="md:max-w-md lg:max-w-auto lg:w-3/4">
                    @include("guitareo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
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
                Master four chords on the guitar <br>
                with play-along style lessons.
            </h4>
            <p class="text-center mb-6">Unlock your potential to play thousands of popular songs.</p>
            <div class="md:flex md:flex-wrap md:items-center mb-10">
                <div class="md:w-1/2 md:pr-10 mb-6 md:mb-0">
                    <img class="lazyload" data-src="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/collage.png" alt="collage image">
                </div>
                <div class="md:w-1/2 rounded-xl border py-6 px-4 md:pl-10" style="border-color:#E0E0E0;">
                    <p class="font-bold md:text-center mb-4">Gain 3 essential guitar skills to play songs:</p>
                    <div class="lg:w-3/4 mx-auto">
                        <h6 class="mb-4"><i class="fas fa-check mr-3 text-xl" aria-hidden="true"></i>Smoother chord changes</h6>
                        <h6 class="mb-4"><i class="fas fa-check mr-3 text-xl" aria-hidden="true"></i>Cleaner sounding notes</h6>
                        <h6><i class="fas fa-check mr-2 text-xl" aria-hidden="true"></i>Better finger muscle memory.</h6>
                    </div>
                </div>
            </div>
            <picture>
                <source media="(min-width: 768px)" srcset="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/chords.png">
                <img class="w-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/chords-m.png" alt="chords">
            </picture>
        </div>
    </section>

    <div class="relative h-5 sm:h-7 -mb-5 sm:-mb-7" style="background: linear-gradient(to top left, transparent calc(50% - 1px), #FAFAFA, #FAFAFA calc(50% + 1px));"></div>

    <section class="py-12 md:py-20">
        <div class="max-w-md md:max-w-5xl px-4 mx-auto text-center">
            <p class="mb-2">Gain 5 FREE guided lessons with Ayla Tesler-Mabe | Play along on your guitar anywhere, anytime</p>
            <h4 class="font-extrabold leading-normal mb-10">
                With your play-along lessons, you’ll unlock <br>
                how to play thousands of hit songs like:
            </h4>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-14">
                @foreach ($albums as $key => $album)
                    <div @if($key === 0) class="md:mb-6" @endif>
                        <img class="lazyload rounded-md" data-src="https://www.musora.com/musora-cdn/image/width=500,quality=95/{{ $album['img'] }}" alt="{{ $album['title'] }}">
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

    <section class="bg-no-repeat py-12 md:py-20 footer bg-musora-black">
        <div class="max-w-md md:max-w-5xl px-4 mx-auto md:flex">
            <div class="md:w-1/2">
                <div class="md:pl-3 text-white text-center md:text-left">
                    <img class="h-32 mb-8 inline-block lazyload" data-src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/chords-for-hit-songs/logo.png" alt="logo">
                    <p class="font-bold italic mb-2">Start to sound amazing with 4 guitar chords and <br class="hidden lg:inline">3 essential skills to play hit songs</p>
                    <p class="leading-relaxed"><i class="fas fa-check mr-2 text-xl" aria-hidden="true"></i>Guided play-along lessons.</p>
                    <p class="leading-relaxed"><i class="fas fa-check mr-2 text-xl" aria-hidden="true"></i>Free chord chart diagram.</p>
                    <p class="mb-4 leading-relaxed"><i class="fas fa-check mr-2 text-xl" aria-hidden="true"></i>Yours to keep forever.</p>
                </div>

                <div class="md:max-w-md lg:max-w-auto lg:w-3/4">
                    @include("guitareo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                        "formId" => "Guitareo - Engagement - Trigger - Guitar Chords for Hit Songs - Web Form2",
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
