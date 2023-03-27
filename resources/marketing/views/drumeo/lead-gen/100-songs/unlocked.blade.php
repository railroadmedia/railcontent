@extends('drumeo._partials.global-layout')

@section('global-head')
    <meta name="robots" content="noindex">
    <title>100 Drumming Anthems | Drumeo</title>
    <meta name="description" content="Get expertly transcribed sheet music for 100 of drumming’s biggest songs (FREE).">
    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/og-image.png" style="display: none;">
    <meta property="og:title" content="100 Drumming Anthems | Drumeo">
    <meta property="og:description" content="Get expertly transcribed sheet music for 100 of drumming’s biggest songs (FREE).">
    <meta property="og:url" content="https://www.drumeo.com/100-songs/">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
        .edge-pitch {top:40px;}
        @media (min-width: 768px) {  .edge-pitch {top:56px;}  }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <div class="shim w-full block h-11 sm:h-9" style="background-color:#010a2b;"></div>
    <a href="/choose-plan" class="edge-pitch block text-center w-full whitespace-nowrap z-10 py-2 sm:py-1 fixed mx-auto bg-black text-white">
        <div class="container mx-auto">
            <div class="text-center sm:text-left inline-block align-middle hover:opacity-90 transition-opacity duration-300">
                <img class="align-middle w-auto mr-2 h-6 hidden sm:inline-block" src="https://www.musora.com/musora-cdn/image/width=1500,q_60,quality=85/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
                <p class="inline-block align-middle mx-auto text-xs leading-tight">Get {{ Prices::$drumeoSongs }}+ more songs + world-class drum lessons <br>
                    inside Drumeo. Click for a FREE trial.</p>
            </div>
        </div>
    </a>

    <section class="text-center relative text-white py-8 md:py-10 lg:py-16 px-4" style="background-color:#010a2b;">
        <div class="container mx-auto">
            <h3 class="mb-4 md:mb-5">
                <strong>100 Drumming Anthems<br> Every. Single. Note.</strong>
            </h3>
            <p class="leading-normal mb-6 md:mb-12 lg:mb-16 max-w-2xl">
                Say hello to your free charts! Click below to get started playing your favorite songs. You’ll notice a handy player that scrolls along with the music in real time and lets you loop, add/remove metronome, and slow down any part you want.
                <br><br>
                Choose a song below:
            </p>

            @include('drumeo.lead-gen.100-songs._songs')

        </div>
    </section>
    <section class="text-center py-14 md:py-24 lg:py-32 text-white bg-black bg-center bg-cover lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,q_60,quality=85/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/order-background.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <h1><strong>Keep the party going.</strong></h1>
                <h4 class="mt-5 lg:mt-6 mb-6 lg:mb-9 leading-normal px-3">
                    Get {{ Prices::$drumeoSongs }}+ songs & world-class drum lessons inside <br class="hidden md:inline">
                    Drumeo. Click below to try a free trial.</h4>
                <a class="join" href="/choose-plan">Free Trial &raquo;</a>
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
