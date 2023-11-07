@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Easy Rudiment Playlist | Drumeo</title>
    <meta property="og:title" content="Easy Rudiment Playlist | Drumeo">

    <meta name="description" content="Save on your Drumeo Membership + get FREE bonuses.">
    <meta property="og:description" content="Save on your Drumeo Membership + get FREE bonuses.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/share-image-drumeo.jpg">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
@endsection


@section('global-body')
    @include('drumeo.sales.partials._nav', [
        'subscriptionVersion' => true,
        'scrollToJoin' => true,
    ])

    <div class="flex flex-col min-h-screen">
        <section class="container max-w-5xl mx-auto bg-slate-50 w-full mb-20">
            <div class="flex flex-col items-center pt-20">
                <img class='w-28 sm:w-48'
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/logo-blue.png"
                    alt="logo drumeo">
                <img class="w-60 sm:w-96"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/membership/rudiments-book/rudiments-book.png"
                    alt="rudiments book">
                <h2 class="text-center py-10 text-3xl md:text-6xl"><strong>Choose your platform</strong></h2>
                <div class="flex-row items-center text-white leading-loose">
                    <div class="flex justify-center">
                        <a href="https://music.apple.com/ca/artist/drumeo/1707098843" target="_blank"
                            x-data="{ isHovered: false }">
                            <button class="text-xl sm:text-2xl rounded-full w-40 sm:w-56 md:w-72 h-12 sm:h-16 mx-2"
                                style="background: #2EBD59" @mouseenter="isHovered = true" @mouseleave="isHovered = false"
                                :style="{ filter: isHovered ? 'brightness(120%)' : 'brightness(100%)' }">
                                <i class="fas fa-brands fa-spotify text-white"></i> <strong> Spotify </strong>
                            </button>
                        </a>

                        <a href="https://open.spotify.com/artist/7pxX1NadzHWfzSXyAPO2ha" target="_blank"
                            x-data="{ isHovered: false }">
                            <button class="bg-black text-xl sm:text-2xl uppercase rounded-full w-40 sm:w-56 md:w-72 h-12 sm:h-16 mx-2"
                                style="background: #000000" @mouseenter="isHovered = true" @mouseleave="isHovered = false"
                                :style="{ 'background-color': isHovered ? '#323232' : '#000000' }">
                                <i class="fas fa-brands fa-apple"></i> <strong> Music </strong>
                            </button>
                        </a>
                    </div>
                </div>
        </section>
    </div>

    @include('drumeo.sales.partials._footer', [
        'minimal' => true,
    ])

    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script async type="text/javascript"
        src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@endsection



