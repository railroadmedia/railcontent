@extends('pianote._partials.global-layout')

@section('global-head')
    <title>30-Day Blues Piano | Pianote</title>
    <meta property="og:title" content="30-Day Blues Piano | Pianote">

    <meta name="description" content="30 days to better piano chords.">
    <meta property="og:description" content="30 days to better piano chords.">

    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">

    <style>
        .text-yellow {
            color: #FFB500;
        }

        .slick-2 .slick-track {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .slick-2 .slick-arrow {
            background: none !important;
            border: 1px solid #000008;
            padding: 4px 7px;
            top: 50%;
            bottom: unset;
        }

        .slick-2 .slick-arrow.slick-prev {
            left: 0px;
        }

        .slick-2 .slick-arrow.slick-next {
            right: 0px;
        }

        .slick-2 .slick-arrow.slick-prev::before, .slick-2 .slick-arrow.slick-next::before {
            font-size: 12px;
        }

        .slick-2 .slick-arrow.slick-prev:hover, .slick-2 .slick-arrow.slick-next:hover {
            background: none;
        }

        .slick-2 .slick-arrow.slick-prev::before, .slick-2 .slick-arrow.slick-next::before {
            color: #000008;
        }

        @media (min-width: 640px) {
            .slick-2 .slick-arrow.slick-prev {
                left: -50px;
            }

            .slick-2 .slick-arrow.slick-next {
                right: -50px;
            }
        }

        @media (min-width: 768px) {
            .slick-2 .slick-arrow.slick-prev::before, .slick-2 .slick-arrow.slick-next::before {
                font-size: 16px;
            }

            .slick-2 .slick-arrow {
                padding: 7px 11px;
            }

            .slick-2 .slick-arrow.slick-prev {
                left: -80px;
            }

            .slick-2 .slick-arrow.slick-next {
                right: -80px;
            }
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav')

    <section class="px-4 py-10 sm:py-14 lg:py-16 text-center" style="background:#F1F7FE;">
        <div class="mx-auto">
            <h2 class="leading-tight mb-2">
                You’ve done the hard part.<br>
                <strong>Keep the momentum going!</strong>
            </h2>
            <h5 class=" text-pianote uppercase"><strong>GET UNLIMITED PIANO LESSONS FOR A YEAR + 10 FREE BONUSES</strong></h5>
            <div class="w-full mx-auto my-8 px-3" style="max-width:920px;">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full reset-on-close bg-black" src="//player.vimeo.com/video/867234191" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <p class="leading-relaxed px-3 my-5 text-left" style="width: 100%; max-width: 700px;">
                Take a bow.
                <br><br>
                For the past 30 days, you’ve been building amazing habits, playing some amazing Blues, and having a ton of fun on the piano.
                <br><br>
                <strong>You should be proud.</strong>
                <br><br>
                And if you’re wondering what to do next, we’ve got you covered. Because we want to make your next steps just as fun (and easy) as the first ones.
                <br><br>
                So here’s your exclusive offer. Join Pianote today and you’ll get:
            </p>
            <ul class="pl-4 mx-auto text-left rounded-xl text-white px-3 py-4" style="width: 100%; max-width: 700px; background-color:#0D1627;">
                <li class="flex items-start mb-1">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    Unlimited access to step-by-step lessons</li>
                <li class="flex items-start mb-1">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    Personal support from Kevin, Lisa and all the teachers✓ Continued access to the community forums and Live events</li>
                <li class="flex items-start mb-1">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    A library of 1000 songs at your fingertips, complete with backing tracks✓ A set of beautiful color posters explaining the essential music theory</li>
                <li class="flex items-start mb-1">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    The Ultimate Guide to Piano Chords & Scales</li>
                <li class="flex items-start mb-1">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    The Pianote Practice Planner so you can keep this streak alive</li>
                <li class="flex items-start mb-1">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    Lifetime access to 2 digital courses to continue your chording journey (Piano Riffs & Fills, The Power of Chords)</li>
                <li class="flex items-start mb-1">
                    <span class="mr-2"><i class="fas fa-check pt-1 mr-2 text-pianote"></i></span>
                    Access to singing, guitar, or drum lessons included for as long as you remain a member (try them yourself or share with a friend)</li>
            </ul>
            <p class="leading-relaxed px-3 mt-5 text-left" style="width: 100%; max-width: 700px;">
                Plus…
                 <br><br>
                We’ll discount your first year by $63 as a special thank you, and you’ll have 90 days to try it risk-free.
                 <br><br>
                But this offer is only available until midnight, October 8th.
                <br><br>
                So click below and keep your progress going!
            </p>
            <div class="px-3 md:px-0 mt-5">
                {{--                            <a class="join blue w-full sm:w-auto max-w-xs sm:max-w-full anchor-slide" href="#customize-section">SEE THE DEAL</a>--}}
                <a class="join sold-out w-full sm:w-auto max-w-xs sm:max-w-full">SOLD OUT</a>
            </div>
        </div>
    </section>


    @include("pianote.sales.partials._footer")
    @include('_partials.components.countdown',[
        'countdownDate' => '2023-04-01 00:00:00',
        'promoVersion' => false
    ])
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
