@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <meta name="robots" content="noindex">

    <title>Success! | Guitar Chords for Hit Songs</title>
    <meta name="description" content=""/>

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/confirmation-image.jpg">
    <meta property="og:title" content="Play Your First Song On The Guitar | Guitar Chords for Hit Songs">
    <meta property="og:url" content="https://www.guitareo.com/chords-for-hit-songs/thank-you">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/song-in-an-hour.css') }}">
    <style>
        .hero-header:after {
            content:none;
        }
    </style>
@stop

@section('body')
    <section class="py-10" style="background: #010D18;">
        <div class="max-w-2xl mx-auto text-center text-white px-4 md:px-0">
            <img class="h-24 md:h-32 mb-8 inline-block lazyload" data-src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/logo.png" alt="logo">
            <h2>
                <span class="text-guitareo"><i class="fad fa-check-circle" aria-hidden="true"></i></span>
                <strong>Success!</strong> <br class="inline md:hidden">Check your email!
            </h2>
            <p class="my-4">You will receive an email shortly from Ayla with your free lessons. Have fun!</p>
            <img class="lazyload rounded-xl mb-4" data-src="https://guitareo.s3.amazonaws.com/lead-gen/chords-for-hit-songs/confirmation-image.jpg" alt="confirmation image">
            <p class="mb-2">In the meantime, follow us on social media to get more free guitar lessons.</p>

            <div class="social-links text-white">
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble youtube text-white" href="https://www.youtube.com/user/guitarlessonscom" style="background: #cd201f;"><i class="fab fa-youtube"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble facebook text-white" href="https://www.facebook.com/guitareoofficial" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble instagram text-white" href="https://www.instagram.com/guitareoofficial/" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </section>
@endsection
