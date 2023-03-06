@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent

    <title>Fretboard Cheatsheet</title>
    <meta property="og:title" content="Fretboard Cheatsheet">
    <meta name="description" content="Demystify the fretboard with the Guitareo Fretboard Cheatsheet"/>
    <meta property="og:description" content="Demystify the fretboard with the Guitareo Fretboard Cheatsheet">
    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/Fretboard+Cheatsheet/share-image.png">
    <meta property="og:url" content="https://www.guitareo.com/fretboard-cheatsheet/">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/song-in-an-hour.css') }}">
    <style>
        .hero-header img {
            width:auto;
            max-width:100%;
        }

        .hero-header h2 {
            max-width:100%;
            text-shadow:none;
        }

        .hero-header .infusion-form button {
            background:#01c9ac;
        }

        .hero-header .infusion-form button:hover {
            background:#02e0bf;
        }


        .hero-header .play-button {
             margin: 176px auto 0;
        }
        @media (min-width: 768px) {
            .hero-header .play-button {
                 margin: 256px auto 0;
            }
        }
        @media (min-width: 1024px) {
            .hero-header .play-button {
                 margin: 288px auto 0;
            }
        }
    </style>
@stop

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop

@section('body')
    <header class="hero-header text-white text-center px-3 py-5 md:py-12 relative" style="background-image:url(https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://guitareo.s3.amazonaws.com/lead-gen/Fretboard+Cheatsheet/header-3.jpg);">
        <div class="container mx-auto relative z-10">
            <img class="h-6 md:h-11 lg:h-12 w-auto mx-auto" src="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://guitareo.s3.amazonaws.com/lead-gen/Fretboard+Cheatsheet/logo.png"><br>
            <i data-open="trailer" class="fas fa-play play-button autoplay-video"></i>
            <h6 class="uppercase font-bebas mt-2.5 mb-5 md:mb-9">SEE WHAT'S INSIDE</h6>
            <h2 class="leading-tight text-shadow-4"><strong>Your All-In-One Guide To<br class="hidden md:inline"> Understand The Fretboard</strong></h2>
            <h6 class="px-4 sm:px-0 mt-1 mb-5 text-guitareo leading-normal max-w-xs md:max-w-full">Download your free PDF and easily navigate the fretboard<br class="hidden sm:inline">
                 to unlock new possibilities in your playing</h6>
            @include("guitareo.lead-gen.partials._sign-up-form-tw", [
                    "formId" => "Guitareo - Engagement - Trigger - Fretboard Cheatsheet - Web Form",
                    "formName" => 'Fretboard Cheatsheet',
                    "buttonText" => "Get It Now",
               ])
        </div>
    </header>

    <div class="reveal trailer text-center" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="inset-0 absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/675629928?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
@stop
