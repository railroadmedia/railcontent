@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/grooves-of-john-bonham/lessons.php'))
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    <meta name="robots" content="noindex">
    <title>@yield('title') | Grooves Of John Bonham | Drumeo</title>
    <meta property="og:title" content="Grooves Of John Bonham | Drumeo">
    <meta name="description" content="The ultimate breakdown of Led Zeppelin’s famous drum grooves. (FREE)">
    <meta property="og:description" content="The ultimate breakdown of Led Zeppelin’s famous drum grooves. (FREE)">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/lead-gen/grooves-of-john-bonham/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/grooves-of-john-bonham/">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
        .edge-pitch {top:40px;}
        @media (min-width: 768px) {  .edge-pitch {top:56px;}  }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <div class="shim w-full block h-11 sm:h-9" style="background-color:#010a2b;"></div>
    <a href="/choose-plan" class="edge-pitch block text-center w-full whitespace-nowrap z-20 py-2 sm:py-1 fixed mx-auto bg-black text-white">
        <div class="container mx-auto">
            <div class="text-center sm:text-left inline-block align-middle hover:opacity-90 transition-opacity duration-300">
                <img class="align-middle w-auto mr-2 h-6 hidden sm:inline-block" src="https://cdn.musora.com/image/fetch/w_300,q_60,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png" alt="edge-logo">
                <p class="inline-block align-middle mx-auto text-xs leading-tight">Get {{ Prices::$drumeoLessons }}+ more drum lessons & song breakdowns<br> inside Drumeo. Click here for a FREE trial.</p>
            </div>
        </div>
    </a>

    <header class="text-white text-center py-14 md:py-16 lg:py-24 px-4 md:px-6 relative" style="background: #030d17 url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/bg-customize.jpg) center center/cover;">
        <div class="container mx-auto relative z-10">
            <h4>BREAKING DOWN THE GROOVES OF</h4>
            <h1 class="tracking-widest lg:tracking-wider my-0.5"><strong>JOHN BONHAM</strong></h1>
            <h6 class="text-yellow-400 uppercase">With Brian Tichy</h6>
        </div>
        {{--<div class="absolute top-0 left-0 right-0 bottom-0 z-0" style="background:linear-gradient(to bottom, transparent, rgba(11, 118, 219, 0.5));"></div>--}}
    </header>
    <section class="text-center text-white relative py-8 md:py-10 lg:py-16 px-4" style="background-color:#010a2b;">
        <div class="container mx-auto">
            <div class="album-grid flex flex-wrap justify-center max-w-2xl lg:max-w-5xl mx-auto">
                @foreach($lessons as $lesson)
                    <a href="{{ $lesson['url'] }}" class="w-1/2 sm:w-1/3 px-2 md:px-3 mb-5 md:mb-7">
                        <div class="relative autoplay-video cursor-pointer overflow-hidden rounded-md border-2" style="border-color:#2d384e;">
                            <i class="absolute top-1/2 left-1/2 fas fa-play play-button" style="margin: -39px;"></i>
                            <div class="aspect-16:9 w-full bg-contain bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_550,q_auto:best/{{ $lesson['image'] }}"></div>
                        </div>
                        <h5 class="mt-3 mb-1"><strong>{{ $lesson['title'] }}</strong></h5>
                        {{--<p class="text-light-navy leading-tight">{{ $lesson['descriptions'] }}</p>--}}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials._free-trial-offer')

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
