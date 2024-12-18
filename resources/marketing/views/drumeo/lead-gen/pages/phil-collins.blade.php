@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>The Genesis Of Phil Collins | Drumeo</title>
    <meta property="og:title" content="The Genesis Of Phil Collins | Drumeo">

    <meta name="description" content="We made a free e-book for all of the Phil Collins fans out there – no strings attached.">
    <meta property="og:description" content="We made a free e-book for all of the Phil Collins fans out there – no strings attached.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/lead-gen/phil-collins/header.webp" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <style>
        .join.white.outline {
            background:transparent;
            border:2px solid #fff;
            color:#fff;
            outline-style:none!important;
        }

        .join.white.outline:hover,
        .join.white.outline:focus {
            background:#fff;
            color:#000;
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <section class="px-4 sm:px-6 py-10 sm:py-16 lg:py-20 bg-cover bg-center text-white text-center" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/lead-gen/phil-collins/bg.webp');">
        <div class="container mx-auto max-w-6xl">
            <img class="h-20 sm:h-40 lg:h-48 mx-auto mb-7 sm:mb-10"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/drumeo/lead-gen/phil-collins/phil-collins-logo.svg">
            <img class="w-full"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2300x0/filters:quality(95)/marketing/drumeo/lead-gen/phil-collins/header.webp">
            <div class="my-7 sm:my-10">
                <h2 class="leading-tight mb-4"><strong>Our gift to you.</strong></h2>
                <p class="leading-normal text-left max-w-xl">We made a free e-book for all of the Phil Collins fans out there – no strings attached.
                    <br><br>
                    But first, we just wanted to quickly introduce ourselves. 
                    <br><br>
                    Drumeo exists to inspire drummers and help them reach their goals. And if you’re ever thinking of getting started or improving any skill, we’d love for you to try our lessons where you’ll study and practice alongside many of the best drummers in the world. 
                    <br><br>
                    You can click the big link below to learn more about Drumeo, our teachers, and how we’ll help you reach your goals. And make sure to click the other button for your free gift – it’ll open as a PDF in a new window.
                    <br><br>
                    All the best,
                </p>
            </div>
            <div class="mb-7 sm:mb-10">
                <img class="h-20 sm:h-24 mx-auto mb-3"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/drumeo/lead-gen/phil-collins/brandon-signature.webp">
                <p>Brandon Toews</p>
            </div>
            <br>
            <a class="join white outline smaller mb-2 sm:mb-0 w-3/4 sm:w-auto" href="/">STUDY WITH DRUMEO</a>
            <br class="sm:hidden">
            <a class="join drumeo smaller w-3/4 sm:w-auto" target="_blank" href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/lead-gen/phil-collins/The-Genesis-of-Phil-Collins.pdf">YOUR FREE E-BOOK</a>
        </div>
    </section>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
