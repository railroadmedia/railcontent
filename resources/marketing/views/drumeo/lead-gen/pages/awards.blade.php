@php
    require_once(resource_path('marketing/views/drumeo/lead-gen/pages/awards-data.php'))
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Drumeo Awards 2022 Winners | Drumeo</title>
    <meta property="og:title" content="Drumeo Awards 2022 Winners">

    <meta name="description" content="The Drumeo Awards highlights inspirational drummers at the top of their game.">
    <meta property="og:description" content="The Drumeo Awards highlights inspirational drummers at the top of their game.">

    <meta property="og:url" content="https://www.drumeo.com/awards/">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/beat/awards/fb-share-image.jpg" style="display: none;">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    <style>

        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h1, h2, h3, h4, h5, h6, li, p {
            font-family:Open Sans, sans-serif;
            font-weight:400;
            line-height:1em;
            margin:0 auto
        }

        h1 sup, h2 sup, h3 sup, h4 sup, h5 sup, h6 sup, li sup, p sup {
            font-size:50%;
            top:-.75em
        }

        h1 {
            font-size:24px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h1 {
                font-size:36px
            }
        }

        @media (min-width:1024px) {
            h1 {
                font-size:48px
            }
        }

        h2 {
            font-size:20px;
            line-height:1.2em
        }

        @media (min-width:768px) {
            h2 {
                font-size:30px
            }
        }

        @media (min-width:1024px) {
            h2 {
                font-size:36px
            }
        }

        h3 {
            font-size:18px
        }

        @media (min-width:768px) {
            h3 {
                font-size:24px
            }
        }

        @media (min-width:1024px) {
            h3 {
                font-size:30px
            }
        }

        h4 {
            font-size:16px
        }

        @media (min-width:768px) {
            h4 {
                font-size:20px
            }
        }

        @media (min-width:1024px) {
            h4 {
                font-size:24px
            }
        }

        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }

        h6 {
            font-size:15px
        }

        @media (min-width:768px) {
            h6 {
                font-size:16px
            }
        }

        @media (min-width:1024px) {
            h6 {
                font-size:18px
            }
        }

        li, p {
            font-size:15px;
            line-height:1.6em
        }

        @media (min-width:1024px) {
            li, p {
                font-size:16px
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
            color:rgba(252, 208, 91, 0.8);
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
        year: 2022,
        yearOpen: true,
        legacyOpen: true,
    }"
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <section class="text-white py-8 sm:py-14 lg:py-16 px-4 bg-cover bg-top lazyload" style="background-color:#000;" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=85/https://dpwjbsxqtam5n.cloudfront.net/beat/awards/header-bg.jpg">
        <div class="container mx-auto max-w-5xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full sm:w-1/2 lg:w-5/12 text-center">
                    <img class="h-28 sm:h-36 lg:h-44 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://dpwjbsxqtam5n.cloudfront.net/beat/awards/drumeo-awards-logo.png">
                    <h1 class="my-1.5 sm:my-3 font-bebas text-5xl sm:text-6xl lg:text-7xl" style="color:#fcd05b"><span x-text="year" style="color: #0c0b0b;-webkit-text-stroke: 1px #fcd05b;"></span> WINNERS</h1>
                    <p class="hidden sm:inline-block text-left max-w-sm px-4">The Drumeo Awards highlights inspirational drummers at the top of their game. Learn about this year's winners below.</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-7/12">
                    <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                        <iframe class="absolute w-full h-full" x-bind:src="year === 2021 ? 'https://www.youtube.com/embed/4Nt6t0E-5jg' : year === 2022 && 'https://www.youtube.com/embed/p2FVUMYO-6k'" frameborder="0" allowfullscreen allow="autoplay" title="drumeo-video"></iframe>
                    </div>
                    <p class="text-center inline-block sm:hidden mx-auto mt-3 sm:mt-0">The Drumeo Awards highlights inspirational drummers at the top of their game. Learn about this year's winners below.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-white pb-20 sm:px-5" style="background-color:#02050e;">
        <div class="container mx-auto max-w-5xl">
            <div class="py-4 text-right">
                <select class="bg-transparent rounded-full w-auto border-white border py-2 px-6 year-select" x-on:change="year = Number($event.target.value)">
                    <option class="bg-black text-white selectable-option" disabled selected>Select Year...</option>
                    <option class="bg-black text-white" value="2022">2022 Winners</option>
                    <option class="bg-black text-white" value="2021">2021 Winners</option>
                </select>
            </div>
            <div class="py-6 sm:py-8 px-4 sm:px-8 lg:px-12" style="background-color:#272727;">
                <img class="h-14 sm:h-20 lg:h-24 -mt-12 sm:-mt-16 mb-3 lg:mb-6 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://dpwjbsxqtam5n.cloudfront.net/beat/awards/drummer-of-the-year-logo.png">
                <div class="md:flex md:justify-between">
                    <p class="leading-tight max-w-xl m-0">Drumeo’s Drummer Of The Year awards - chosen by you, the community - celebrate those who stand out in different musical styles, and recognize exceptional performances, recordings, and your favorite drummer overall.</p>
                    <div class="text-center mt-4 md:mt-0">
                        <i :class="yearOpen && 'rotate-180'" class="fa-solid fa-chevron-down cursor-pointer transform" @click="yearOpen = !yearOpen"></i>
                    </div>
                </div>
            </div>

            <div x-cloak x-bind:class="year !== 2022 && 'hidden'" style="background-color:#1c1a1d;">
                <div :class="!yearOpen ? 'max-h-0' : 'max-h-full'" class="relative overflow-hidden mb-16 sm:mb-24 transition-all duration-200">
                    <div class="py-8 sm:py-14 px-4 sm:px-8 lg:px-12 ">
                        @foreach($yearAwards2022 as $videoModal)
                            <div class="flex items-start {{--award-container cursor-pointer--}} relative @if(empty($videoModal['last-child'])) border-b pb-7 sm:pb-10 mb-7 sm:mb-10 @endif" style="border-color:#404040">
                                <img class="hidden sm:block h-52 lg:h-72 rounded-xl {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/{{ $videoModal['image'] }}" alt="{{ $videoModal['winner'] }}">
                                <div class="sm:pl-6">
                                    <h3 class="text-center sm:text-left uppercase font-bebas chrome" {{--style="color: #fcd05b;"--}}>{{ $videoModal['award'] }}</h3>
                                    <img class="block sm:hidden h-52 mx-auto my-3 {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/{{ $videoModal['image'] }}">
                                    <div {{--class="blur-wrap transition duration-500 filter blur"--}}>
                                        <h5 class="text-center sm:text-left my-2"><strong>{{ $videoModal['winner'] }}</strong></h5>
                                        <p class="leading-tight text-light-navy">{!! $videoModal['description'] !!}</p>
                                    </div>
                                </div>
                                {{--<h2 class="text-shadow-4 chrome absolute top-28 sm:top-1/2 left-0 sm:left-1/3 transform -translate-y-1/2 font-bebas pl-1 sm:pl-9">CLICK TO REVEAL WINNER</h2>--}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div x-cloak x-bind:class="year !== 2021 && 'hidden'" style="background-color:#1c1a1d;">
                <div :class="!yearOpen ? 'max-h-0' : 'max-h-full'" class="relative overflow-hidden mb-16 sm:mb-24 transition-all duration-200">
                    <div class="py-8 sm:py-14 px-4 sm:px-8 lg:px-12 ">
                        @foreach($yearAwards2021 as $videoModal)
                            <div class="flex items-start {{--award-container cursor-pointer--}} relative @if(empty($videoModal['last-child'])) border-b pb-7 sm:pb-10 mb-7 sm:mb-10 @endif" style="border-color:#404040">
                                <img class="hidden sm:block h-52 lg:h-72 rounded-xl {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/{{ $videoModal['image'] }}" alt="{{ $videoModal['winner'] }}" alt="{{ $videoModal['winner'] }}">
                                <div class="sm:pl-6">
                                    <h3 class="text-center sm:text-left uppercase font-bebas chrome" {{--style="color: #fcd05b;"--}}>{{ $videoModal['award'] }}</h3>
                                    <img class="block sm:hidden h-52 mx-auto my-3 {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/{{ $videoModal['image'] }}" alt="{{ $videoModal['winner'] }}" alt="{{ $videoModal['winner'] }}">
                                    <div {{--class="blur-wrap transition duration-500 filter blur"--}}>
                                        <h5 class="text-center sm:text-left my-2"><strong>{{ $videoModal['winner'] }}</strong></h5>
                                        <p class="leading-tight text-light-navy">{!! $videoModal['description'] !!}</p>
                                    </div>
                                </div>
                                {{--<h2 class="text-shadow-4 chrome absolute top-28 sm:top-1/2 left-0 sm:left-1/3 transform -translate-y-1/2 font-bebas pl-1 sm:pl-9">CLICK TO REVEAL WINNER</h2>--}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="py-6 sm:py-8 px-4 sm:px-8 lg:px-12" style="background-color:#272727;">
                <img class="h-14 sm:h-20 lg:h-24 -mt-12 sm:-mt-16 mb-3 lg:mb-6 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=900,quality=85/https://dpwjbsxqtam5n.cloudfront.net/beat/awards/legacy-awards-logo.png">
                <div class="md:flex md:justify-between">
                    <p class="leading-tight max-w-xl m-0">These Legacy awards - chosen by a panel of industry experts - honor today’s drummers while paying tribute to the awards’ legendary namesakes.</p>
                    <div class="text-center mt-4 md:mt-0">
                        <i :class="legacyOpen && 'rotate-180'" class="fa-solid fa-chevron-down cursor-pointer transform" @click="legacyOpen = !legacyOpen"></i>
                    </div>
                </div>

            </div>

            <div x-bind:class="year !== 2022 && 'hidden'" style="background-color:#1c1a1d;">
                <div :class="!legacyOpen ? 'max-h-0' : 'max-h-full'" class="relative overflow-hidden mb-8 sm:mb-12 transition-all duration-200">
                    <div class="py-8 sm:py-14 px-4 sm:px-8 lg:px-12">
                        @foreach($legacyAwards2022 as $videoModal)
                            <div class="flex items-start {{--award-container cursor-pointer--}} relative @if(empty($videoModal['last-child'])) border-b pb-7 sm:pb-10 mb-7 sm:mb-10 @endif" style="border-color:#404040">
                                <img class="hidden sm:block h-52 lg:h-72 rounded-xl {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/{{ $videoModal['image'] }}" alt="{{ $videoModal['winner'] }}">
                                <div class="sm:pl-6">
                                    <h3 class="text-center sm:text-left uppercase font-bebas chrome" {{--style="color: #fcd05b;"--}}>{{ $videoModal['award'] }}</h3>
                                    <img class="block sm:hidden h-52 mx-auto my-3 {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/{{ $videoModal['image'] }}" alt="{{ $videoModal['winner'] }}">
                                    <div {{--class="blur-wrap transition duration-500 filter blur"--}}>
                                        <h5 class="text-center sm:text-left my-2"><strong>{{ $videoModal['winner'] }}</strong></h5>
                                        <p class="leading-tight text-light-navy">{!! $videoModal['description'] !!}</p>
                                    </div>
                                </div>
                                {{--<h2 class="text-shadow-4 chrome absolute top-28 sm:top-1/2 left-0 sm:left-1/3 transform -translate-y-1/2 font-bebas pl-1 sm:pl-9">CLICK TO REVEAL WINNER</h2>--}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div x-bind:class="year !== 2021 && 'hidden'" style="background-color:#1c1a1d;">
                <div :class="!legacyOpen ? 'max-h-0' : 'max-h-full'" class="relative overflow-hidden mb-8 sm:mb-12 transition-all duration-200">
                    <div class="py-8 sm:py-14 px-4 sm:px-8 lg:px-12">
                        @foreach($legacyAwards2021 as $videoModal)
                            <div class="flex items-start {{--award-container cursor-pointer--}} relative @if(empty($videoModal['last-child'])) border-b pb-7 sm:pb-10 mb-7 sm:mb-10 @endif" style="border-color:#404040">
                                <img class="hidden sm:block h-52 lg:h-72 rounded-xl {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/{{ $videoModal['image'] }}" alt="{{ $videoModal['winner'] }}">
                                <div class="sm:pl-6">
                                    <h3 class="text-center sm:text-left uppercase font-bebas chrome" {{--style="color: #fcd05b;"--}}>{{ $videoModal['award'] }}</h3>
                                    <img class="block sm:hidden h-52 mx-auto my-3 {{--transition duration-500 filter blur brightness-75--}} lazyload" data-src="https://www.musora.com/musora-cdn/image/width=600,quality=85/{{ $videoModal['image'] }}" alt="{{ $videoModal['winner'] }}">
                                    <div {{--class="blur-wrap transition duration-500 filter blur"--}}>
                                        <h5 class="text-center sm:text-left my-2"><strong>{{ $videoModal['winner'] }}</strong></h5>
                                        <p class="leading-tight text-light-navy">{!! $videoModal['description'] !!}</p>
                                    </div>
                                </div>
                                {{--<h2 class="text-shadow-4 chrome absolute top-28 sm:top-1/2 left-0 sm:left-1/3 transform -translate-y-1/2 font-bebas pl-1 sm:pl-9">CLICK TO REVEAL WINNER</h2>--}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center">
                <h6><strong>Follow us to find out when the <br class="inline sm:hidden"> next voting season is starting!</strong></h6>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble youtube text-white" href="https://www.youtube.com/freedrumlessons/" style="background: #cd201f;"><i class="fab fa-youtube"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble facebook text-white" href="https://facebook.com/drumeo/" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                <a target="_blank" class="transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 social-bubble instagram text-white" href="https://instagram.com/drumeoofficial/" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$('.award-container').on('click', function () {--}}
                {{--$(this).removeClass('cursor-pointer').find('img').removeClass('blur brightness-75').addClass('blur-0 brightness-100');--}}
                {{--$(this).find('.blur-wrap').removeClass('blur');--}}
                {{--$(this).find('.chrome').addClass('hidden');--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@stop
