@php
    require_once(resource_path('marketing/views/drumeo/lead-gen/pages/awards-data.php'))
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Pianote Awards 2023 Winners | Pianote</title>
    <meta property="og:title" content="Pianote Awards 2023 Winners">

    <meta name="description" content="The Pianote Awards recognizes outstanding keyboard musicians across a multitude of styles, genres, and platforms.">
    <meta property="og:description" content="The Pianote Awards recognizes outstanding keyboard musicians across a multitude of styles, genres, and platforms.">

    <meta property="og:url" content="https://www.pianote.com/awards/">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/awards/awards-logo.webp" style="display: none;">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong, td strong {
            font-weight: 900;
        }
        h1, h2, h3, h4, h5, h6, li, p {
            font-weight: 400;
            line-height: 1em;
            font-family: 'Open Sans', sans-serif;
            margin: 0 auto;
        }
        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size: 50%;
            top: -0.75em;
        }
        h1 {
            line-height: 1.2em;
            font-size: 30px;
        }
        @media (min-width: 768px) {
            h1 {
                font-size: 36px;
            }
        }
        @media (min-width: 1024px) {
            h1 {
                font-size: 48px;
            }
        }
        h2 {
            line-height: 1.2em;
            font-size: 24px;
        }
        @media (min-width: 768px) {
            h2 {
                font-size: 30px;
            }
        }
        @media (min-width: 1024px) {
            h2 {
                font-size: 36px;
            }
        }
        h3 {
            font-size: 20px;
        }
        @media (min-width: 768px) {
            h3 {
                font-size: 24px;
            }
        }
        @media (min-width: 1024px) {
            h3 {
                font-size: 30px;
            }
        }
        h4 {
            font-size: 18px;
        }
        @media (min-width: 768px) {
            h4 {
                font-size: 20px;
            }
        }
        @media (min-width: 1024px) {
            h4 {
                font-size: 24px;
            }
        }
        h5 {
            font-size: 16px;
        }
        @media (min-width: 768px) {
            h5 {
                font-size: 18px;
            }
        }
        @media (min-width: 1024px) {
            h5 {
                font-size: 20px;
            }
        }
        h6 {
            font-size: 15px;
        }
        @media (min-width: 768px) {
            h6 {
                font-size: 16px;
            }
        }
        @media (min-width: 1024px) {
            h6 {
                font-size: 18px;
            }
        }
        p, li {
            line-height: 1.6em;
            font-size: 15px;
        }
        @media (min-width: 1024px) {
            p, li {
                font-size: 16px;
            }
        }

        .text-light-navy {
            color: #a1afc9;
        }
        .chrome {
            background:#222 -webkit-gradient(linear, left top, right top, from(#222), to(#222), color-stop(0.5, #fff)) 0 0 no-repeat;
            background-image:-webkit-linear-gradient(-40deg, transparent 0%, transparent 40%, #fff 50%, transparent 60%, transparent 100%);
            background-size:100px;
            -webkit-background-clip:text;
            animation:3s shine infinite linear;
            color:rgba(255, 255, 255, 0.8);
        }
        .items-start:nth-child(even) .chrome {
            animation-delay: 0.8s;
        }
        @-webkit-keyframes shine {
            0% {
                background-position:-20%;
            }
            10% {
                background-position:top left;
            }
            90% {
                background-position:top right;
            }
            100% {
                background-position:120%;
            }
        }
    </style>
@stop

@section('body-data')
    x-data="{
        year: 2023,
        yearOpen: true,
        legacyOpen: true,
    }"
@endsection

@section('global-body')
    @include('pianote.sales.partials._nav')

    <header class="text-white py-8 sm:py-14 lg:py-16 px-4" style="background:
    linear-gradient(to bottom, #150305, #3B0D0A, #431118,
    #120300, #370D07);">
        <div class="container mx-auto max-w-5xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full sm:w-1/2 lg:w-5/12 text-center">
                    <picture>
                        <source media="(min-width: 1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/marketing/pianote/lead-gen/awards/awards-logo.webp">
                        <source media="(min-width: 640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/340x0/filters:quality(95)/marketing/pianote/lead-gen/awards/awards-logo.webp">
                        <img class="h-28 sm:h-36 lg:h-44" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/270x0/filters:quality(95)/marketing/pianote/lead-gen/awards/awards-logo.webp">
                    </picture>
                    <h1 class="my-1.5 sm:my-3 font-bebas text-5xl sm:text-6xl lg:text-7xl" style="color:#fff"><span style="color: #3b0f14;-webkit-text-stroke: 1px #fff;">2023</span> WINNERS</h1>
                    <p class="hidden sm:inline-block text-left max-w-sm px-4">The Pianote Awards recognizes outstanding keyboard musicians across a multitude of styles, genres, and platforms. Artists are shortlisted by Pianote and winners are voted in by the global piano community.</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-7/12">
                    <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                        <iframe class="absolute w-full h-full" allowfullscreen allow="autoplay" title="pianote-video"
                            src="https://www.youtube.com/embed/w8RLK6GXxm0"></iframe>
                    </div>
                    <p class="text-center inline-block sm:hidden mx-auto mt-3 sm:mt-0">The Pianote Awards recognizes outstanding keyboard musicians across a multitude of styles, genres, and platforms. Artists are shortlisted by Pianote and winners are voted in by the global piano community.</p>
                </div>
            </div>
        </div>
    </header>
    <section class="text-white py-20 sm:px-5" style="background-color:#000;">
        <div class="container mx-auto max-w-5xl">
            <div style="background-color:#1A0506;">
                <div class="relative overflow-hidden mb-16 sm:mb-24 transition-all duration-200 max-h-full">
                    <div class="py-8 sm:py-14 px-4 sm:px-8 lg:px-12 ">
                        @foreach($pianoteAwards2023 as $videoModal)
                            @include("drumeo.lead-gen.pages._awards-row")
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center">
                <h6><strong>Follow us to find out when the <br class="inline sm:hidden"> next voting season is starting!</strong></h6>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble youtube text-white" href="https://youtube.com/user/pianolessonscom" style="background: #cd201f;"><i class="fab fa-youtube"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble facebook text-white" href="https://facebook.com/pianoteofficial" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble instagram text-white" href="https://instagram.com/pianoteofficial" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </section>

    @include("pianote.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

@stop
