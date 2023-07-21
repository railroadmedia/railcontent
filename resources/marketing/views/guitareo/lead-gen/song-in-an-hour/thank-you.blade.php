@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <meta name="robots" content="noindex">

    <title>Success! | 1-Hour Challenge</title>
    <meta name="description" content="Rob Scallon will lead you on a guitar adventure with 9 free videos to gain the fundamentals, transition between chords, and play a full song from start to finish. Are you up for the challenge?"/>

    <meta property="og:image" content="https://d122ay5chh2hr5.cloudfront.net/lead-gen/song-in-an-hour/og-image.jpg">
    <meta property="og:title" content="Play Your First Song On The Guitar | 1-Hour Challenge">
    <meta property="og:description" content="Play your first song on the guitar, start to finish, in an hour -- even if you’ve never played before.">
    <meta property="og:url" content="https://www.guitareo.com/song-in-an-hour/">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/song-in-an-hour.css') }}">
    <style>
        .hero-header:after {
            content:none;
        }
    </style>
@stop

@section('body')
    <header class="hero-header text-center px-3 py-5 md:py-6 lg:py-16 relative text-white" style="background: linear-gradient(180deg, #010611, #10052b);">
        <div class="container mx-auto relative z-10">
            <img class="logo guitar-quest mx-auto mb-2 sm:mb-5" src="https://www.musora.com/musora-cdn/image/width=220,q_60,quality=95/https://d122ay5chh2hr5.cloudfront.net/shop/logos/guitar-quest-logo.png"><br>
            <img class="logo mx-auto mb-7 md:mb-10" src="https://www.musora.com/musora-cdn/image/width=640,q_60,quality=95/https://d122ay5chh2hr5.cloudfront.net/lead-gen/song-in-an-hour/logo-purple.png"><br>

            <h2><span class="text-yellow"><i class="fad fa-check-circle"></i></span> <strong>Success!</strong> <br class="inline md:hidden">Check your email!</h2>
            <p class="mt-4 mb-8 leading-relaxed md:leading-loose" style="max-width: 670px;">You will receive an email from <strong>Rob Scallon (Guitareo)</strong> within 10 minutes with your SONG IN AN HOUR CHALLENGE. Good luck! And if you don’t receive that email for some funky reason, please check your spam folder or re-enter your email address again.</p>
            <h5 class="text-yellow"><i class="fas fa-angle-down"></i> <strong>WHILE YOU’RE WAITING, 1 VITAL TIP<br class="inline md:hidden">  FOR NEW GUITARISTS</strong> <i class="fas fa-angle-down"></i></h5>
            <div class="mx-auto" style="max-width:560px;">
                <div class="aspect-16:9 w-full relative mt-5 mb-7">
                    <iframe class="absolute w-full h-full rounded-lg inset-0" src="//player.vimeo.com/video/522101902" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>

            <div class="social-links text-white">
                <h5><strong>Follow us wherever you hang out:</strong></h5>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble youtube text-white" href="https://www.youtube.com/user/guitarlessonscom" style="background: #cd201f;"><i class="fab fa-youtube"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble facebook text-white" href="https://www.facebook.com/guitareoofficial" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble instagram text-white" href="https://www.instagram.com/guitareoofficial/" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </header>
@stop
