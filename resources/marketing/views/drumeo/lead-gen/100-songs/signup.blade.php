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

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
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

@section('body-data')
    x-data ='{
    soundslice : false,
    }'
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <div class="shim w-full block h-11 sm:h-9" style="background-color:#010a2b;"></div>
    <a href="#final" class="edge-pitch block text-center w-full whitespace-nowrap z-20 py-2 sm:py-1 fixed mx-auto bg-black text-white anchor-slide">
        <div class="container mx-auto">
            <div class="text-center sm:text-left inline-block align-middle hover:opacity-90 transition-opacity duration-300">
                <h3 class="inline-block align-middle mr-2 leading-none font-bebas text-coaches">100 SONGS</h3>
                <p class="inline-block align-middle mx-auto text-xs leading-tight">
                    Enter your email to get 100 <br>
                    FREE note-for-note sheet music</p>
                <div class="join blue smaller ml-1" style="padding: 6px 13px;font-size: 15px;">Get IT NOW</div>
            </div>
        </div>
    </a>
    <header class="text-white text-center sm:text-left pt-7 md:pt-16 px-6 pb-7 md:pb-10" style="background: linear-gradient(45deg, #02163D, #00BEF3);">
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
                ])
                <div class="h-96 absolute bottom-0 left-0 right-0" style="background:linear-gradient(to bottom, transparent, #fff 90%);"></div>
            </div>
            <h4 class="leading-tight"><strong><em>…and more! For a limited time,<br class="hidden sm:inline"> you’ll get 100 SONGS total.</em></strong></h4>
        </div>
    </section>

    <div class="relative h-5 sm:h-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #000318 calc(50% + 1px));"></div>
    <section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
        <div class="container max-w-4xl mx-auto">
            <h2><strong>Professional charts + handy <br class="inline md:hidden">
                    playback<br class="hidden md:inline"> tools to help  <br class="inline md:hidden">
                    you nail every note.</strong></h2>
            <p class="leading-tight mt-2 sm:mt-3">You’ll have <strong>all the tools you need</strong> to make sure you never miss a beat. <strong class="cursor-pointer" x-on:click="soundslice = true;"><u>Try the demo »</u></strong></p>

            <div class="max-w-xs sm:max-w-xl lg:max-w-4xl xl:max-w-full mx-auto">
                <div style="padding-bottom: 62.4%; background-image: url(&quot;https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/device.png&quot;);" class="mt-4 sm:mt-6 lg:mt-8 lg:mb-6 bg-cover bg-center lazyloaded" x-on:click="soundslice = true;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/device.png"></div>
            </div>
            <div class="text-center w-full sm:w-auto mt-6 lg:mt-0 mx-auto mb-5">
                <div class="flex flex-wrap">
                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                        <div class="flex sm:inline-block">
                            <div class="w-14 sm:w-full flex-shrink-0">
                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/5000-songs-icon.svg" class="h-6 sm:h-10">
                            </div>
                            <div class="text-left sm:text-center">
                                <p class="mb-1 sm:my-2"><strong>5000+ popular songs.</strong></p>
                                <p class="text-sm">Get note-for-note song breakdowns for every style, era, and skill level.</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                        <div class="flex sm:inline-block">
                            <div class="w-14 sm:w-full flex-shrink-0">
                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/tempo-icon.svg" class="h-6 sm:h-10">
                            </div>
                            <div class="text-left sm:text-center">
                                <p class="mb-1 sm:my-2"><strong>Find the perfect tempo.</strong></p>
                                <p class="text-sm">Slow down or speed up any section of a song to hear every note.</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                        <div class="flex sm:inline-block">
                            <div class="w-14 sm:w-full flex-shrink-0">
                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/loop-icon.svg" class="h-6 sm:h-10">
                            </div>
                            <div class="text-left sm:text-center">
                                <p class="mb-1 sm:my-2"><strong>Loop the trouble spots.</strong></p>
                                <p class="text-sm">No more pausing and rewinding that tricky fill. Loop it over and over again!</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                        <div class="flex sm:inline-block">
                            <div class="w-14 sm:w-full flex-shrink-0">
                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/no-drums-icon.svg" class="h-6 sm:h-10">
                            </div>
                            <div class="text-left sm:text-center">
                                <p class="mb-1 sm:my-2"><strong>Remove the drums.</strong></p>
                                <p class="text-sm">Magically remove the original drums to make each song uniquely yours.</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                        <div class="flex sm:inline-block">
                            <div class="w-14 sm:w-full flex-shrink-0">
                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/play-it-right-icon.svg" class="h-6 sm:h-10">
                            </div>
                            <div class="text-left sm:text-center">
                                <p class="mb-1 sm:my-2"><strong>Play it right the first time.</strong></p>
                                <p class="text-sm">Get perfect notation and learn to play accurately from the get-go.</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-1/3 sm:px-2 lg:px-6 mb-6 lg:my-6">
                        <div class="flex sm:inline-block">
                            <div class="w-14 sm:w-full flex-shrink-0">
                                <img alt="point icon" src="https://www.musora.com/musora-cdn/image/https://dpwjbsxqtam5n.cloudfront.net/sales/2023/devices-icon.svg" class="h-6 sm:h-10">
                            </div>
                            <div class="text-left sm:text-center">
                                <p class="mb-1 sm:my-2"><strong>Take your songs anywhere.</strong></p>
                                <p class="text-sm">Accessible on any device, or printable,so you can play any song, any time.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.quick-questions',[
        "bgColor" => "white",
        "textColor" => "black",
    ])

    <div id="final" class="anchor"></div>
    <section class="text-center py-14 md:py-24 lg:py-32 text-white" style="background: linear-gradient(45deg, #02163D, #00BEF3);">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <h1 class="leading-none uppercase font-bebas"><span class="text-coaches">100 Drumming Anthems</span><br> Every. Single. Note.</h1>
                <p class="text-coaches my-2 sm:my-3 font-black">EXPANDED EDITION</p>
                <h5 class="mb-6 lg:mb-9 leading-normal">
                    <strong>For a LIMITED TIME, you’ll get 100 Drumeo Songs totally FREE.</strong><br>
                    <em>Enter your email to grab note-for-note sheet music & handy play-along tools.</em>
                </h5>
                <div class="mx-auto" style="max-width:700px">
                    @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                            "formId" => "Drumeo - Engagement - Trigger - 40S - Web Form2",
                                "buttonText" => "Get It Now ",
                            "formName" => '40 Songs',
                        ])
                </div>
            </div>
        </div>
    </section>

    @include('_partials.components.video-modal',[
        'name' => 'soundslice',
        'video' => '1D6Vc',
        'soundslice' => true,
    ])
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
