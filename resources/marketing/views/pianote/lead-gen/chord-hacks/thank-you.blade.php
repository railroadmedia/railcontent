@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <title>Chord Hacks | Pianote</title>
    <meta property="og:title" content="Chord Hacks">

    <meta name="description" content="The easiest way to learn beautiful piano chords.">
    <meta property="og:description" content="The easiest way to learn beautiful piano chords.">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/chord-hacks">
@endsection

@section('head')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
@endsection

@section('page-body')
    <div class="overflow-hidden text-white px-3 py-5 sm:py-7 lg:py-12" style="background-color:#000a1e;">
        <div class="container mx-auto max-w-2xl clearfix">
            <div class="text-center sm:px-3">
                <img class="h-6 sm:h-9 lg:h-10" src="https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/logo.svg">
                <h2 class="my-5"><i class="fal fa-check-circle text-pianote"></i> <strong>Success!</strong> Check your email.</h2>
                <h6 class="text-light-navy leading-normal">You will receive an email from team@pianote.com within 10 minutes with your lessons. Good luck! And if you don’t receive that email for some funky reason, please check your spam folder or re-enter your email address again.</h6>
                <div class="w-full relative mx-auto inline-block rounded-xl mb-7 bg-contain bg-top bg-no-repeat lazyload" style="padding-bottom: 77%;" data-bg="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/chord-hacks/2023/header-image-m.png"></div>
                <p class="leading-tight mb-5">In the meantime, subscribe on YouTube & get more of our free piano lessons!</p>
                <a target="_blank" href="https://youtube.com/user/pianolessonscom" class="hover:opacity-80 transition-opacity"><p class="rounded-xl text-white inline-block px-4" style="background-color:#cd201f;"><i class="fab fa-youtube mr-1"></i> YouTube</p></a>
            </div>
        </div>
    </div>

@stop
