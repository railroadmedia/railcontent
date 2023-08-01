@extends('drumeo._partials.global-layout')

@section('global-head')
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
        .text-coaches { color: #fe9f13; }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <div class="shim w-full block h-11 sm:h-9" style="background-color:#010a2b;"></div>
    <a href="/choose-plan" class="edge-pitch block text-center w-full whitespace-nowrap z-20 py-2 sm:py-1 fixed mx-auto bg-black text-white">
        <div class="container mx-auto">
            <div class="text-center sm:text-left inline-block align-middle hover:opacity-90 transition-opacity duration-300">
                <h3 class="inline-block align-middle mr-2 leading-none font-bebas text-coaches">100 SONGS</h3>
                <p class="inline-block align-middle mx-auto text-xs leading-tight"><strong>EXPANDED EDITION</strong>
                    For a limited time, you can<br>
                    grab the ultimate drummer’s songs pack, FREE.</p>
            </div>
        </div>
    </a>
    <header class="text-white text-center sm:text-left pt-7 md:pt-20 px-6 pb-7 md:pb-0" style="background: #010a2b url(https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/header-background.jpg) center bottom/cover;">
        <div class="container mx-auto max-w-5xl">
            <div class="flex flex-wrap justify-center items-end lg:items-center">
                <div class="w-10/12 sm:w-1/2 {{--lg:w-7/12--}} sm:order-1 text-right sm:pl-4 lg:pl-0">
                    <div class="relative inline-block align-bottom z-10 w-1/3" style="max-width:190px;margin-right: -6%;">
                        <video class="absolute top-0 left-0 right-0 bottom-0 w-full p-1 rounded-2xl overflow-hidden" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/tom-sawyer.mp4" muted autoplay loop playsinline></video>
                        <img src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/phone-background.png" alt="phone-background">
                    </div>
                    <div class="relative inline-block align-bottom z-0 w-2/3" style="max-width:420px">
                        <div class="absolute rounded-xl overflow-hidden bg-white bg-cover bg-center" style="top: 1.5%;left: 1.5%;right: 1.5%;bottom: 7%;background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/tablet-screen2.png);"></div>
                        <img src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/tablet-background.png" alt="tablet-background">
                    </div>
                </div>
                <div class="w-full sm:w-1/2 {{--lg:w-5/12--}} mt-5 sm:mt-0 {{--lg:mt-14--}}">
                    <h1 class="leading-none uppercase font-bebas"><span class="text-coaches">100 Drumming Anthems</span><br> Every. Single. Note.</h1>
                    <h6 class="mt-2 md:mt-4 mb-4 md:mb-7 lg:mb-8 leading-tight">
                        Enter your email to get note-for-note <br>
                        sheet music + handy playback tools for <br>
                        <s class="opacity-50">40</s> <strong class="text-coaches">100</strong> of drumming’s biggest songs FREE.
                    </h6>
                    <div class="mx-auto sm:mx-0 text-center" style="max-width:470px">
                        @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
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

    <section class="text-center relative py-8 md:py-10 lg:py-16 px-4">
        <div class="container max-w-6xl mx-auto">
            <h2 class="mb-4 md:mb-5">
                <strong>All the hits.</strong>
            </h2>
            <h6 class="leading-normal mb-6 md:mb-12 lg:mb-16 sm:px-4">
                Out of {{ Prices::$drumeoSongs }}+ songs inside Drumeo, these are the <s class="opacity-50">40</s> <strong>100</strong> songs drummers love to play the most– and now <br class="hidden lg:inline">
                it’s your turn. Scroll down to find your favorites and enter your email to get ALL the songs totally free.
            </h6>
            <div class="relative">
                @include('drumeo.lead-gen.100-songs._songs',[
                    "signup" => true,
                    "dataOpen" => "signUpModal",
                ])
                <div class="h-96 absolute bottom-0 left-0 right-0" style="background:linear-gradient(to bottom, transparent, #fff 90%);"></div>
            </div>
            <h4 class="leading-tight"><strong><em>…and more! For a limited time,<br class="hidden sm:inline"> you’ll get 100 SONGS total.</em></strong></h4>
        </div>
    </section>
    <div class="relative h-5 sm:h-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #000318 calc(50% + 1px));"></div>
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
                    <img class="lazyload side-pic" data-src="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-1.png" alt="songs-1">
                    <img class="lazyload side-pic mobile-feature" data-src="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-2-alt.png" alt="songs-2">
                    <img class="lazyload side-pic" data-src="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-3.png" alt="songs-3">
                    <img class="lazyload side-pic" data-src="https://www.musora.com/musora-cdn/image/width=650,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-phone-5.png" alt="songs-4">
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
                            <p>Add or remove the metronome to help you count out the beats in a bar. This makes learning songs of all levels easier — even that odd-time Rush song!</p>
                        </div>
                    </div>
                    <div class="text-icon-wrap">
                        <i class="text-songs fal fa-phone-laptop"></i>
                        <div>
                            <h3><strong>Available on all your devices.</strong></h3>
                            <p>Load up DrumeoSONGS on your phone during practice time, your laptop when you’re behind the kit, and your tablet at the gig — wherever the music takes you!</p>
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

    <section class="text-center py-14 md:py-24 lg:py-32 text-white bg-black bg-center bg-cover lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/40-songs/order-background.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <h1 class="leading-none uppercase font-bebas"><span class="text-coaches">100 Drumming Anthems</span><br> Every. Single. Note.</h1>
                <p class="text-coaches my-2 sm:my-3">EXPANDED EDITION</p>
                <h5 class="mb-6 lg:mb-9 leading-normal">
                    <strong>For a LIMITED TIME, you’ll get 100 Drumeo Songs totally FREE.</strong><br>
                    <em>Enter your email to grab note-for-note sheet music & handy play-along tools.</em>
                </h5>
                <div class="mx-auto" style="max-width:700px">
                    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
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
                    100 of drumming’s biggest songs FREE.
                </strong>
            </h4>
            @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
            "formId" => "Drumeo - Engagement - Trigger - 40S - Web Form",
                                "buttonText" => "Get It Now ",
            "formName" => '40 Songs',
            "stacked" => true
            ])
        </div>
    </div>
    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
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
    <script src="{{ asset('/marketing/js/pre-form-submit-facebook-lead.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/infusionsoft-tracking.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
