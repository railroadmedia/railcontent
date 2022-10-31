@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>40 Drumming Anthems | Drumeo</title>
    <meta name="description" content="Get expertly transcribed sheet music for 40 of drumming’s biggest songs (FREE).">
    <!-- Social Media -->
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/lead-gen/40-songs/og-image.png" style="display: none;">
    <meta property="og:title" content="40 Drumming Anthems | Drumeo">
    <meta property="og:description" content="Get expertly transcribed sheet music for 40 of drumming’s biggest songs (FREE).">
    <meta property="og:url" content="https://www.drumeo.com/40-songs/">

    @include('drumeo._partials._fonts')

    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"></noscript>
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <header class="text-white text-center sm:text-left pt-7 md:pt-20 px-6 pb-7 md:pb-0" style="background: #010a2b url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/40-songs/header-background.jpg) center bottom/cover;">
        <div class="container mx-auto max-w-5xl">
            <div class="flex flex-wrap justify-center items-end lg:items-center">
                <div class="w-10/12 sm:w-1/2 {{--lg:w-7/12--}} sm:order-1 text-right sm:pl-4 lg:pl-0">
                    <div class="relative inline-block align-bottom z-10 w-1/3" style="max-width:190px;margin-right: -6%;">
                        <video class="absolute top-0 left-0 right-0 bottom-0 w-full p-1 rounded-2xl overflow-hidden" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/40-songs/tom-sawyer.mp4" muted autoplay loop playsinline></video>
                        <img src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/40-songs/phone-background.png" alt="phone-background">
                    </div>
                    <div class="relative inline-block align-bottom z-0 w-2/3" style="max-width:420px">
                        <div class="absolute rounded-xl overflow-hidden bg-white bg-cover bg-center" style="top: 1.5%;left: 1.5%;right: 1.5%;bottom: 7%;background-image:url(https://drumeo-assets.s3.amazonaws.com/lead-gen/40-songs/tablet-screen.png);"></div>
                        <img src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/40-songs/tablet-background.png" alt="tablet-background">
                    </div>
                </div>
                <div class="w-full sm:w-1/2 {{--lg:w-5/12--}} mt-5 sm:mt-0 {{--lg:mt-14--}}">
                    <h2><strong>40 Drumming Anthems<br> Every. Single. Note.</strong></h2>
                    <h6 class="mt-2 md:mt-4 lg:mt-6 mb-4 md:mb-7 lg:mb-8 leading-tight">
                        Enter your email to get note-for-note <br class="inline md:hidden">
                        sheet music + handy playback tools for <br class="inline md:hidden">
                        40 of drumming’s biggest songs FREE.
                    </h6>
                    <div class="mx-auto sm:mx-0 text-center" style="max-width:470px">
                        @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                                "formName" => '40 Songs',
                                "formId" => "Drumeo - Engagement - Trigger - 40S - Web Form",
                                "buttonText" => "Get It Now ",
                                "stacked" => true
                            ])
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="text-center text-white relative py-8 md:py-10 lg:py-16 px-4" style="background-color:#000318;">
        <div class="container mx-auto">
            <h2 class="mb-4 md:mb-5">
                <strong>All the hits.</strong>
            </h2>
            <h6 class="leading-normal text-light-navy mb-6 md:mb-12 lg:mb-16">
                Out of {{ Prices::$songs }}+ songs inside Drumeo (our super-awesome membership<br class="hidden md:inline">
                 site), these are the 40 songs drummers love to play the most. So we thought<br class="hidden md:inline">
                  we’d let you get in on the fun. Scroll down to find your favorites.
            </h6>

            @include('drumeo.lead-gen.40-songs._songs',[
                "dataOpen" => "signUpModal",
            ])
        </div>
    </section>
    <section class="songs-info text-center text-white relative overflow-hidden py-8 md:py-14 lg:py-24" style="background-color:#000318;">
        <div class="container mx-auto">
            <h2 class="mb-4 md:mb-5">
                <strong>
                    Professional charts + handy <br class="inline md:hidden">
                    playback<br class="hidden md:inline"> tools to help  <br class="inline md:hidden">
                    you nail every note.
                </strong>
            </h2>
            <h6 class="leading-normal text-light-navy px-2">
                Slow down the tempo, add/remove metronome, or loop any section you're <br class="hidden sm:inline">
                struggling with. It’s never been easier to learn your favorite songs.
            </h6>
            <div class="flex-container w-full mx-auto md:max-w-6xl md:flex items-center px-5 md:px-8 mb-9 md:mb-10 mt-4 md:mt-16 lg:mt-20">
                <div class="pic-wrap">
                    <img class="lazyload side-pic" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-1.png" alt="songs-1">
                    <img class="lazyload side-pic mobile-feature" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-2-alt.png" alt="songs-2">
                    <img class="lazyload side-pic" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-3.png" alt="songs-3">
                    <img class="lazyload side-pic" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-5.png" alt="songs-4">
                </div>
                <div class="text-left">
                    <div class="text-icon-wrap active">
                        <i class="text-songs fal fa-music"></i>
                        <div>
                            <h3><strong>Find the perfect tempo.</strong></h3>
                            <p>Slow down or speed up any section of a song to hear every note your favorite drummer plays. When you’ve nailed the part, bump the tempo back up and rock out in real time.</p>
                        </div>
                    </div>
                    <div class="text-icon-wrap">
                        <i class="text-songs fal fa-repeat"></i>
                        <div>
                            <h3><strong>Loop the trouble spots.</strong></h3>
                            <p>No more pausing and rewinding when you mess up that fill. Simply grab the section of the song and loop it over, and over, and over until you’ve got it down.</p>
                        </div>
                    </div>
                    <div class="text-icon-wrap">
                        <i class="text-songs icon-metronome"></i>
                        <div>
                            <h3><strong>Counting just got easier.</strong></h3>
                            <p>Add or remove the metronome to help you count out the beats in a bar. This makes learning songs of all levels easier -- even that odd-time Rush song!</p>
                        </div>
                    </div>
                    <div class="text-icon-wrap">
                        <i class="text-songs fal fa-phone-laptop"></i>
                        <div>
                            <h3><strong>Available on all your devices.</strong></h3>
                            <p>Load up DrumeoSONGS on your phone during practice time, your laptop when you’re behind the kit, and your tablet at the gig -- wherever the music takes you!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.quick-questions',[
        "bgColor" => "#030a21",
        "textColor" => "white",
    ])

    <section class="text-center py-14 md:py-24 lg:py-32 text-white bg-black bg-center bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/40-songs/order-background.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <h1><strong>40 Drumming Anthems<br> Every. Single. Note.</strong></h1>
                <h4 class="mt-5 lg:mt-6 mb-6 lg:mb-9 leading-normal">
                    Enter your email to get note-for-note sheet music + handy<br class="hidden md:inline">
                    playback tools for 40 of drumming’s biggest songs FREE.
                </h4>
                <div class="mx-auto" style="max-width:700px">
                    @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                            "formId" => "Drumeo - Engagement - Trigger - 40S - Web Form",
                                "buttonText" => "Get It Now ",
                            "formName" => '40 Songs',
                        ])
                </div>
            </div>
        </div>
    </section>

    <div class="reveal text-center max-w-2xl" id="signUpModal" data-reveal style="background-color: rgb(243, 244, 246);">
        <div class="py-5 px-3 md:px-9 md:py-9">
            <h4 class="leading-normal mb-4">
                <strong>
                    Enter your email to get note-for-note <br class="inline md:hidden">
                    sheet music + handy playback tools for <br class="inline md:hidden">
                    40 of drumming’s biggest songs FREE.
                </strong>
            </h4>
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
            "formId" => "Drumeo - Engagement - Trigger - 40S - Web Form",
                                "buttonText" => "Get It Now ",
            "formName" => '40 Songs',
            "stacked" => true
            ])
        </div>
    </div>

    @include("drumeo.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            // song point cycle
            var $songPoint = $('.songs-info .side-pic'),
                $songPointToggle = $('.songs-info .text-icon-wrap'),
                currentSongPoint = 0,
                updateIndex = function (currentSongPoint) {
                    $songPoint.removeClass('active');
                    $songPointToggle.removeClass('active');

                    $songPoint.eq(currentSongPoint).addClass('active');
                    $songPointToggle.eq(currentSongPoint).addClass('active');
                },
                autoplaySongPoints = setInterval(function () {
                    if(currentSongPoint < 4){
                        currentSongPoint++;
                        updateIndex(currentSongPoint);
                    }
                    else {
                        currentSongPoint = 0;
                        updateIndex(currentSongPoint);
                    }
                }, 10000);

            $songPoint.first().addClass('active');
            $songPointToggle.first().addClass('active');
            $songPointToggle.on('click', function () {
                updateIndex($songPointToggle.index($(this)));
                currentSongPoint = $songPointToggle.index($(this));
                clearInterval(autoplaySongPoints);
            });
        });
    </script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/pre-form-submit-facebook-lead.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/infusionsoft-tracking.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
