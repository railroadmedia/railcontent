@extends('pianote._partials.global-layout')

@section('global-head')
    <title>The New Pianote App</title>
    <meta name="description" content="Piano Lessons At Your Fingertips Wherever You Go. Whatever You Use.">

    <!-- Social Media -->
    <meta property="og:image" content="https://pianote.s3.amazonaws.com/sales/2023/share-image-pianote.jpg" style="display: none;">
    <meta property="og:title" content="The New Pianote App">
    <meta property="og:description" content="Piano Lessons At Your Fingertips Wherever You Go. Whatever You Use.">
    <meta property="og:url" content="https://www.pianote.com/app/">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/pianote/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/pianote/nav-footer.css') }}">
    <link href="{{ asset('/marketing/parcel/pianote/sales-app.css') }}" rel="stylesheet">
@stop

@section('global-body')
    @include('pianote._partials._nav')

    <section class="trailer-section text-center">
        <div class="container mx-auto">
            <p><img src="https://pianote.s3.amazonaws.com/app/pianote-app-icon.png"> The New Pianote App</p>
            <h1>Piano Lessons At Your Fingertips<br>
                <strong>Wherever You Go.<br class="inline lg:hidden"> Whatever You Use.</strong></h1>
            <div class="ipad-phone">
                <img src="https://pianote.s3.amazonaws.com/app/header.png">
                <img class="preview" src="https://dpwjbsxqtam5n.cloudfront.net/app/preview-the-app.svg">
                <i class="fas fa-play autoplay-video" data-open="trailer"></i>
            </div>
        </div>
    </section>

    <div class="reveal large text-center" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/500649054?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <section class="download-pitch text-center">
        <div class="container mx-auto">
            <p>Put your piano teacher in your pocket. Take your video lessons, <br class="hidden md:inline">
                song tutorials, and practice sessions anywhere you go.</p>
            <a class="download-badge" href="https://itunes.apple.com/us/app/pianote-mobile/id1500496457?ls=1" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png"></a>
            <a class="download-badge" href="https://play.google.com/store/apps/details?id=com.pianote2" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png"></a>
            <p class="small">Not a member? <a class="text-blue" href="/">Click here to join Pianote</a>.</p>
        </div>
    </section>
    <section class="learn-play-watch text-center">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full topic-wrap learn">
                <h1>Learn</h1>
                <h2>Take your lessons wherever you go. Learn from the best teachers <br class="hidden md:inline">
                    on your schedule. Your perfect lesson is just a tap away.</h2>
                <img src="https://pianote.s3.amazonaws.com/app/learn.png">
            </div>
            <div class="float-left w-full topic-wrap watch">
                <h1>Practice</h1>
                <h2>Make your practice session count. Play-along exercises to show you <br class="hidden md:inline">
                    EXACTLY what to play. Progress-tracking to record where you left off <br class="hidden md:inline">
                    and what to learn next.</h2>
                <img src="https://pianote.s3.amazonaws.com/app/practice.png">
            </div>
            <div class="float-left w-full topic-wrap play">
                <h1>Play</h1>
                <h2>Get access to your favorite song tutorials and downloadable music<br class="hidden md:inline">
                    so you can play your favorite songs wherever, whenever.</h2>
                <img src="https://pianote.s3.amazonaws.com/app/play.png">
            </div>
            <div class="float-left w-full topic-wrap connection">
                <h1>No Connection? <span style="display:inline-block">No Problem!</span></h1>
                <h2>Download your lessons and videos when you’re in WiFi range and <br class="hidden md:inline">
                    watch them without having to use your precious data. Every lesson<br class="hidden md:inline">
                    and tutorial in the Pianote App is downloadable to your device.</h2>
                <img src="https://pianote.s3.amazonaws.com/app/no-connection.png">
            </div>
        </div>
    </section>
    <section class="final-pitch text-center">
        <div class="container mx-auto clearfix">
            <h1>The Ultimate Online <br class="inline lg:hidden"> Piano Lessons Experience<sup>&trade;</sup></h1>
            <div class="float-left w-full md:w-1/2 px-2 md:px-3 option-wrap">
                <p>MEMBERS</p>
                <h4>Take your membership everywhere<br> with the Pianote app.</h4>
                <a class="download-badge" href="https://itunes.apple.com/us/app/pianote-mobile/id1500496457?ls=1" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png"></a>
                <a class="download-badge" href="https://play.google.com/store/apps/details?id=com.pianote2" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png"></a>
            </div>
            <div class="float-left w-full md:w-1/2 px-2 md:px-3 option-wrap">
                <p>NOT A MEMBER?</p>
                <h4>We’ll help you learn the piano<br> faster, easier, and better.</h4>
                <a class="join blue" href="/">EXPLORE PIANOTE &raquo;</a>
            </div>
        </div>
    </section>


    @include('pianote._partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/pianote/nav-footer.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
