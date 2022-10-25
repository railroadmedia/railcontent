@extends('drumeo._partials.layout-template')

@section('global-head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <title>The Drumeo App</title>
    <meta name="description" content="Drum lessons, play-alongs, and song breakdowns everywhere you go.">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/app/og-image.png" style="display: none;">
    <meta property="og:title" content="The Drumeo App">
    <meta property="og:description" content="Drum lessons, play-alongs, and song breakdowns everywhere you go.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout.favicons.drumeo-favicons')
    @include('drumeo._partials._fonts')

    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"></noscript>
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-app.css') }}" rel="stylesheet">

@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "edgeVersion" => true
    ])
    <section class="trailer-section text-center">
        <div class="container mx-auto clearfix">
            <p><img src="https://dpwjbsxqtam5n.cloudfront.net/app/drumeo-app-icon.svg"> The New Drumeo App</p>
            <h1>Drum Lessons, Songs & Shows...<br>
                <strong>Everywhere you go.</strong></h1>
            <div class="ipad-phone">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/app/app-header-spread.png">
                <img class="preview" src="https://dpwjbsxqtam5n.cloudfront.net/app/preview-the-app.svg">
                <i class="fas fa-play autoplay-video" data-open="trailer"></i>
            </div>
        </div>
    </section>
    <section class="download-pitch text-center">
        <div class="container mx-auto clearfix">
            <p>Drumeo just got better. Take your video lessons, <br class="hidden sm:inline">
                play-alongs, and exclusive shows anywhere you go.</p>
            <a class="download-badge" href="https://itunes.apple.com/us/app/drumeo/id1460388277?ls=1" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png"></a>
            <a class="download-badge" href="https://play.google.com/store/apps/details?id=com.drumeo" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png"></a>
            <p class="small">Not a member? <a href="/">Click here to join Drumeo</a>.</p>
        </div>
    </section>
    <section class="learn-play-watch text-center">
        <div class="container mx-auto clearfix max-w-3xl lg:max-w-5xl">
            <div class="float-left w-full topic-wrap learn">
                <h1>Learn</h1>
                <h2>Improve your drumming with<br>
                    the best teachers in the world.</h2>
                <img class="hidden sm:inline" src="https://dpwjbsxqtam5n.cloudfront.net/app/learn-spread.png">
                <img class="inline sm:hidden" src="https://dpwjbsxqtam5n.cloudfront.net/app/learn-spread-mobile.png">
                <br>
                <div class="float-left w-full px-3 sm:px-2 sm:w-1/3">
                    <p class="mb-7 sm:mb-0"><strong>Learn anything<br class="hidden sm:inline lg:hidden"> on the drums.</strong><br>
                        Get unlimited access to 2000+ hours of video drum lessons covering every topic, for every level, and every style of music. </p>
                </div>
                <div class="float-left w-full px-3 sm:px-2 sm:w-1/3">
                    <p class="mb-7 sm:mb-0"><strong>World-class teaching,<br class="hidden sm:inline lg:hidden"> every time.</strong><br>
                        Study with 100+ world-class drummers including Grammy Award winners, touring clinicians, published authors, and more.</p>
                </div>
                <div class="float-left w-full px-3 sm:px-2 sm:w-1/3">
                    <p style="margin-bottom: 0;"><strong>More efficient<br class="hidden sm:inline lg:hidden"> practice sessions.</strong><br>
                        Gain clarity with organized courses and helpful progress-tracking tools, so you always know where you left off and what to learn next. </p>
                </div>
            </div>
            <div class="float-left w-full topic-wrap play">
                <h1>Play</h1>
                <h2>Learn your favorite songs,<br class="inline sm:hidden">  wherever you are.</h2>
                <img class="hidden sm:inline" src="https://dpwjbsxqtam5n.cloudfront.net/app/play-spread.png">
                <img class="inline sm:hidden" src="https://dpwjbsxqtam5n.cloudfront.net/app/play-spread-mobile.png">
                <p>Nothing is better than playing to real music. So you’ll love our play-alongs for applying your new<br class="hidden sm:inline">
                    skills to music - and detailed song breakdowns for music by popular bands of all eras and styles. </p>
            </div>
            <div class="float-left w-full topic-wrap watch">
                <h1>Watch</h1>
                <h2>Drumming isn’t limited <br class="inline sm:hidden">to the practice room.</h2>
                <img src="https://dpwjbsxqtam5n.cloudfront.net/app/watch-spread.png">
                <p>Enjoy entertaining shows and documentaries from the most talented content creators in the <br class="hidden sm:inline">
                    drum space -- including Carson Gant’s “Exploring Beats”, Aaron Edgar’s “Rhythms From Another <br class="hidden sm:inline">
                    Planet”, and exclusive episodes of Austin Burcham’s “Study The Greats”. </p>
            </div>
        </div>
    </section>
    <section class="final-pitch text-center">
        <div class="container mx-auto clearfix max-w-5xl">
            <h1>The Ultimate Drum <br class="inline sm:hidden"> Lessons Experience<sup>&trade;</sup></h1>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 option-wrap">
                <p>MEMBERS</p>
                <h4>Take your membership everywhere<br> with the Drumeo app.</h4>
                <a class="download-badge" href="https://itunes.apple.com/us/app/drumeo/id1460388277?ls=1" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png"></a>
                <a class="download-badge" href="https://play.google.com/store/apps/details?id=com.drumeo" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png"></a>
            </div>
            <div class="float-left w-full px-3 sm:px-4 sm:w-1/2 option-wrap">
                <p>NOT A MEMBER?</p>
                <h4>We’ll help you learn the drums<br> faster, easier, and better.</h4>
                <a class="join blue" href="/">EXPLORE DRUMEO &raquo;</a>
            </div>
        </div>
    </section>

    <div class="reveal large" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/338735900?autoplay=1" frameborder="0" allowfullscreen allow="autoplay" title="10year-video"></iframe>
        </div>
    </div>

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script src="{{ asset('/marketing/parcel/drumeo/modal-autoplay.js') }}"></script>
@stop
