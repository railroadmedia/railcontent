@extends('pianote._partials.global-layout')

@section('global-head')
    <title>The New Pianote App</title>
    <meta name="description" content="Piano Lessons At Your Fingertips Wherever You Go. Whatever You Use.">

    <!-- Social Media -->
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">
    <meta property="og:title" content="The New Pianote App">
    <meta property="og:description" content="Piano Lessons At Your Fingertips Wherever You Go. Whatever You Use.">
    <meta property="og:url" content="https://www.pianote.com/app/">

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-app-pianote.css') }}" rel="stylesheet">
@stop

@section('global-body')
    @include('pianote.sales.partials._nav')

    <section class="trailer-section text-center">
        <div class="container mx-auto">
            <p><img src="https://d2vyvo0tyx8ig5.cloudfront.net/app/pianote-app-icon.png" alt="Red Pianote logo with rounded corners."> The New Pianote App</p>
            <h1>Piano Lessons At Your Fingertips<br>
                <strong>Wherever You Go.<br class="inline lg:hidden"> Whatever You Use.</strong></h1>
            <div class="ipad-phone">
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/app/header.png" alt="Woman with short platnium hair showing hand playing chord on piano. Pianote logo in red. Screenshot of Pianote mobile app.">
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
            <a class="download-badge" href="https://apps.apple.com/us/app/musora/id1619053766?ppid=afddd5f6-fbc3-46c9-b6e4-6c9e6a6936af" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png" alt="Black “download on Apple app store” button."></a>
            <a class="download-badge" href="https://play.google.com/store/apps/details?id=com.musoraapp&listing=pianote_previews" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png" alt="Black “get it on Google Play” button."></a>
            <p class="small">Not a member? <a class="text-blue" href="/">Click here to join Pianote</a>.</p>
        </div>
    </section>
    <section class="learn-play-watch text-center">
        <div class="container mx-auto clearfix">
            <div class="float-left w-full topic-wrap learn">
                <h1>Learn</h1>
                <h2>Take your lessons wherever you go. Learn from the best teachers <br class="hidden md:inline">
                    on your schedule. Your perfect lesson is just a tap away.</h2>
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/app/learn.png" alt="Pianote mobile app with circular headshots of Pianote coaches around it.">
            </div>
            <div class="float-left w-full topic-wrap watch">
                <h1>Practice</h1>
                <h2>Make your practice session count. Play-along exercises to show you <br class="hidden md:inline">
                    EXACTLY what to play. Progress-tracking to record where you left off <br class="hidden md:inline">
                    and what to learn next.</h2>
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/app/practice.png" alt="Screenshot of Pianote play-along feature showing hands and sheet music on iPad screen.">
            </div>
            <div class="float-left w-full topic-wrap play">
                <h1>Play</h1>
                <h2>Get access to your favorite song tutorials and downloadable music<br class="hidden md:inline">
                    so you can play your favorite songs wherever, whenever.</h2>
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/app/play.png" alt="Pianote mobile app showing songs with floating album covers around it.">
            </div>
            <div class="float-left w-full topic-wrap connection">
                <h1>No Connection? <span style="display:inline-block">No Problem!</span></h1>
                <h2>Download your lessons and videos when you’re in WiFi range and <br class="hidden md:inline">
                    watch them without having to use your precious data. Every lesson<br class="hidden md:inline">
                    and tutorial in the Pianote App is downloadable to your device.</h2>
                <img src="https://d2vyvo0tyx8ig5.cloudfront.net/app/no-connection.png" alt="Pianote mobile app showing hands playing piano surrounded by pictures of Lisa playing piano.">
            </div>
        </div>
    </section>
    <section class="final-pitch text-center">
        <div class="container mx-auto clearfix">
            <h1>The Ultimate Online <br class="inline lg:hidden"> Piano Lessons Experience<sup>&trade;</sup></h1>
            <div class="float-left w-full md:w-1/2 px-2 md:px-3 option-wrap">
                <p>MEMBERS</p>
                <h4>Take your membership everywhere<br> with the Pianote app.</h4>
                <a class="download-badge" href="https://apps.apple.com/us/app/musora/id1619053766?ppid=afddd5f6-fbc3-46c9-b6e4-6c9e6a6936af" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/download-on-app-store-button.png" alt="Black “download on Apple app store” button."></a>
                <a class="download-badge" href="https://play.google.com/store/apps/details?id=com.musoraapp&listing=pianote_previews" target="_blank"><img src="https://dpwjbsxqtam5n.cloudfront.net/app/google-play-button.png" alt="Black “get it on Google Play” button"></a>
            </div>
            <div class="float-left w-full md:w-1/2 px-2 md:px-3 option-wrap">
                <p>NOT A MEMBER?</p>
                <h4>We’ll help you learn the piano<br> faster, easier, and better.</h4>
                <a class="join blue" href="/">EXPLORE PIANOTE &raquo;</a>
            </div>
        </div>
    </section>


    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
