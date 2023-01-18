@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Lifetime Members Masterclass with Lisa Witt</title>
    <meta property="og:title" content="Lifetime Members Masterclass with Lisa Witt">

    <meta name="description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee." />
    <meta property="og:description" content="Online singing lessons for any voice & vocal coaches to support you every step of the way. 90-Day Guarantee."/>

    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
    <meta property="og:image" content="https://singeo.s3.amazonaws.com/sales/2023/share-image-singeo.jpg"/>

    @include('_partials.layout._fonts')
    @include('_partials.layout._tailwindcdn')

    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">

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

        body {
            counter-reset: timeline;
        }
        .join.smaller {
            font-size: 18px;
            padding: 16px 25px;
        }

        @media (min-width: 768px) {
            .join.smaller {
                padding: 16px 30px;
            }
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <header class="header text-white text-center px-4 sm:px-6 py-14 md:py-20 lg:py-32 relative bg-no-repeat bg-cover bg-top lazyload" style="background-color:#031e3b;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/products/shop-header.jpg">
        <div class="mx-auto relative z-10 max-w-md md:max-w-5xl">
                <h1><strong>Lifetime Members Masterclass</strong></h1>
                <h3>with Lisa Witt</h3>
        </div>
    </header>
    <section class="text-center text-white py-8 md:py-24 px-5 md:px-7" style="background:#00101d ;">
        <div class="container mx-auto text-center max-w-2xl">
            <div class="bg-white text-center rounded-md inline-block overflow-hidden w-14 mr-2 align-middle transition-opacity group-hover:opacity-70">
                <p class="leading-none tracking-tighter text-xs py-1 text-white" style="background-color:#bb3744;"><strong>JAN</strong></p>
                <p class="leading-none text-lg py-1.5 text-black"><strong class="font-black">31</strong></p>
            </div>
            <a target="_blank" class=" @if(Carbon\Carbon::create(2023, 1, 31, 16, 0, 0, 'America/Vancouver') < Carbon\Carbon::now()) sold-out @endif join blue smaller" href="https://us06web.zoom.us/j/82096873355?pwd=Wmdjb25Bc0psRFZQaTV4RTQ2aVNhUT09">Livestream Access - 2 PM PST</a>
        </div>
    </section>

    @include("singeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
