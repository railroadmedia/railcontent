@extends('drumeo._partials.global-layout')

@section('global-head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <title>The Drumeo Kids App</title>
    <meta name="description" content="Introduce your kids to drumming through entertaining shows.">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/og-image.png" style="display: none;">
    <meta property="og:title" content="The Drumeo Kids App">
    <meta property="og:description" content="Introduce your kids to drumming through entertaining shows.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout.favicons.drumeo-favicons')
    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-app.css') }}" rel="stylesheet">

@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "subscriptionVersion" => true
    ])
    <section class="trailer-section text-center kids-app">
        <div class="container mx-auto clearfix relative z-10">
            <p><img src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/logo.png" alt="drumeo kids logo"></p>
            <h1>Introduce your kids to<br class="inline sm:hidden"> drumming<br class="hidden sm:inline"> through<br class="inline sm:hidden"> entertaining shows.</h1>
            <div class="ipad-phone">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/tablet-phone.png" alt="tablet img">
                <img class="preview" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/preview.png" alt="preview text">
                <i class="fas fa-play autoplay-video" data-open="trailer"></i>
            </div>
        </div>
        <img class="anchored-image left-image hidden sm:inline" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/rock-spaceship.png" alt="spaceship img">
        <img class="anchored-image right-image" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/rocks.png" alt="rock">
    </section>
    <section class="download-pitch text-center kids-app">
        <div class="container mx-auto clearfix">
            <p>Download the app & watch the first<br class="hidden sm:inline">
                episode with your kids for FREE today.</p>
            <a class="download-badge" href="https://itunes.apple.com/us/app/drumeo-kids/id1469926955?ls=1" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png" alt="app store img"></a>
            <a class="download-badge" href="https://play.google.com/store/apps/details?id=com.drumeo.drumeokids" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png" alt="google play img"></a>
            <p class="small">If you’re a <a href="/">Drumeo member</a>, you already have full<br class="hidden sm:inline"> access to every episode in your membership.</p>
        </div>
    </section>
    <div class="curved-bottom"></div>
    <section class="music-fun-go text-center">
        <div class="container mx-auto clearfix max-w-3xl lg:max-w-4xl">
            <div>
                <div class="toggle-button music active">
                    <img width="70px" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/icon-music.svg" alt="music icon">
                    <p>MUSIC</p>
                </div>
                <div class="toggle-button fun">
                    <img width="70px" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/icon-fun.svg" alt="clap icon">
                    <p>FUN</p>
                </div>
                <div class="toggle-button on-the-go">
                    <img width="70px" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/icon-on-the-go.svg" alt="car icon">
                    <p>ON-THE-GO</p>
                </div>
            </div>

            <div class="float-left w-full px-3 sm:px-4 no-padding topic-wrap music">
                <h1>Music<br class="inline sm:hidden"> Starts Here</h1>
                <h2>Your kids will experience different styles <br class="inline sm:hidden">
                    of music through fun characters and stories.</h2>
                <img class="hidden sm:inline" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/music-image.jpg" alt="music image">
                <img class="inline sm:hidden" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/music-image-m.jpg" alt="music image mobile">
                <br>
                <p>Every episode highlights a different genre of music —<br class="inline sm:hidden">
                    introducing your <br class="hidden sm:inline">
                    kids to rock, blues, hip hop, reggae,<br class="inline sm:hidden"> disco, country, salsa, funk, & more.</p>

            </div>
            <div class="float-left w-full px-3 sm:px-4 no-padding topic-wrap fun">
                <h1>Clap Along To<br class="inline sm:hidden"> Fun Rhythms</h1>
                <h2>We all have rhythm inside of us — and these entertaining <br class="inline sm:hidden"> shows were designed<br class="hidden sm:inline">
                    to get kids clapping along and <br class="inline sm:hidden"> boot-chick-cattin’ away to real drum beats.</h2>

                <img src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/fun-image.jpg" alt="fun image">
                <br>
                <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 mb-5 sm:mb-0">
                    <p><strong><img height="22px" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/icon-fun.svg" alt="clap icon"> Clap-Attack</strong><br>
                        ...clapping to various rhythms.</p>
                </div>
                <div class="float-left w-full px-3 sm:px-4 sm:w-1/3 mb-5 sm:mb-0">
                    <p><strong><img height="22px" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/icon-bassdrum.svg" alt="bass drum icon"> "Boot-Chick-Cat"</strong><br>
                        ...vocally to real drum beats.</p>
                </div>
                <div class="float-left w-full px-3 sm:px-4 sm:w-1/3">
                    <p><strong><img height="22px" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/icon-party.svg" alt="party icon"> Dance Party</strong><br>
                        ...with their favorite characters.</p>
                </div>
            </div>
            <div class="float-left w-full px-3 sm:px-4 no-padding topic-wrap on-the-go">
                <h1>Take Drumming<br class="inline sm:hidden"> Everywhere You Go</h1>
                <h2>Stream or download every episode <br class="inline sm:hidden">
                    from the “Drumeo Kids” app.</h2>
                <img class="autoplay-video" data-open="trailer2" src="https://dpwjbsxqtam5n.cloudfront.net/app/for-kids/on-the-go-image.jpg" alt="on the go image">
                <p>Inside the Drumeo Kids app, every episode<br class="inline sm:hidden"> can be streamed or downloaded — perfect for <br>
                    morning shows, road trip entertainment, or<br class="inline sm:hidden"> wherever your kids have time to clap and dance!</p>
                <div class="reveal large" id="trailer2" data-reveal data-reset-on-close="false">
                    <div class="aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="" data-lazy-load-url="https://www.youtube.com/embed/TQ11sNPtEc0?autoplay=1" frameborder="0" allowfullscreen allow="autoplay" title="on the go video"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="final-pitch text-center kids-app">
        <div class="container mx-auto clearfix max-w-5xl">
            <h1>Download The App  <br class="inline sm:hidden">For Free Today</h1>
            <a class="download-badge" href="https://itunes.apple.com/us/app/drumeo-kids/id1469926955?ls=1" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png" alt="app store img"></a>
            <a class="download-badge" href="https://play.google.com/store/apps/details?id=com.drumeo.drumeokids" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png" alt="google play img"></a>
            <p class="small"><em><a href="/"><strong>Drumeo Members:</strong></a> You already have full access to every episode inside Drumeo. If you’d <br class="hidden sm:inline">
                prefer the Drumeo Kids app experience, you’ll need to download this app and add episodes separately.</em></p>
        </div>
    </section>

    <div class="reveal large" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/364175064?autoplay=1" frameborder="0" allowfullscreen allow="autoplay" title="10year-video"></iframe>
        </div>
    </div>

    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(document).foundation();

            var $slide = $('.topic-wrap'),
                $slideToggle = $('.toggle-button');

            var current = 0;

            $slide.first().addClass('active');
            $slideToggle.first().addClass('active');

            var updateIndex = function (current) {
                $slide.removeClass('active');
                $slideToggle.removeClass('active');

                $slide.eq(current).addClass('active');
                $slideToggle.eq(current).addClass('active');
            };

            var autoplay = setInterval(function () {
                if(current < 2){
                    current++;
                    updateIndex(current);
                }
                else {
                    current = 0;
                    updateIndex(current);
                }
            }, 10000);

            $slideToggle.on('click', function (e) {
                e.stopPropagation();
                e.preventDefault();
                updateIndex($slideToggle.index($(this)));
                current = $slideToggle.index($(this));
                clearInterval(autoplay);
            });
        });
    </script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
