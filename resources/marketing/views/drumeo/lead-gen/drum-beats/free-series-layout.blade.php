@extends('drumeo._partials.global-layout')

@section('global-head')
    @yield('meta')

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">

    @yield('styles')
    <style>
        .toolbox-header {
            display:block;
            background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/bg.jpg);
            background-size:cover;
            background-position:center center;
            text-align:center;
            padding:45px 0 15px;
        }

        .toolbox-title .main-title {
            color:#FFFF99;
            margin:0 auto 5px;
            font:italic 300 18px/1em "Open Sans", sans-serif;
            text-shadow:-1px 1px 1px rgba(0, 0, 0, 0.4);
        }

        .toolbox-title h1 {
            color:#FFF;
            margin:0 auto;
            font:700 35px/1em "Bebas Neue", sans-serif;
            text-shadow:-1px 1px 1px rgba(0, 0, 0, 0.4);
            text-transform:uppercase;
        }

        .toolbox-title h1 a {
            color:#FFF;
        }

        .toolbox-title p {
            color:#FFF;
            font:400 15px/1.2em "Open Sans", sans-serif;
            text-shadow:-1px 1px 1px rgba(0, 0, 0, 0.4);
            margin:10px auto 7px;
        }

        @media only screen and (min-width:40em) {
            .toolbox-header {
                padding:65px 0 30px;
            }

            .toolbox-title .main-title {
                font-size:32px;
            }

            .toolbox-title h1 {
                font-size:48px;
            }

            .toolbox-title p {
                font-size:22px;
                margin:10px auto 15px;
            }
        }

        @media only screen and (min-width:64em) {
            .toolbox-header {
                padding:75px 0 40px;
            }

            .toolbox-title .main-title {
                font-size:40px;
            }

            .toolbox-title h1 {
                font-size:60px;
            }
        }

        body {
            background:#fff;
        }

        .lesson-grid {
            margin:20px auto;
        }

        .grid-item-container {
            margin:0 auto 20px;
        }

        .grid-item-container a {
            display:block;
            background:#eee;
            filter:drop-shadow(0 0 5px rgba(0, 0, 0, .25));
            width:100%;
            max-width: 320px;
            margin: 0 auto;
            border-radius:5px;
        }

        .grid-item-container a img {
            width:100%;
            border-radius: 5px 5px 0 0;
        }

        .grid-item-container .title {
            font:400 18px/1em "Open Sans", sans-serif;
            margin:0 auto;
            text-align:center;
            padding:10px;
            color:#000;
        }

        .title p {
            font:400 30px/1.2em "Open Sans", sans-serif;
        }

        .title .sub {
            font:400 16px/1em "Open Sans", sans-serif;
        }

        .download-resources {
            font:400 16px/70px "Open Sans", sans-serif;
            background:#1E7DA7;
            color:#fff;
            text-align:center;
            margin:20px 1.5% 10px;
            padding:0;
            width:97%;
        }

        .download-resources:hover {
            color:#fff;
            background:#2498CB;
        }

        .download-resources img {
            margin:0 10px 0 0;
            width:40px;
        }

        @media only screen and (min-width:40em) {

            .title p {
                font:400 45px/1.3em "Open Sans", sans-serif;
            }

            .title .sub {
                font:400 21px/1.2em "Open Sans", sans-serif;
            }

            .grid-item-container {
                margin:0 auto 30px;
            }

            .grid-item-container .title {
                font-size:13px;
            }

            .download-resources {
                font:400 36px/70px "Open Sans", sans-serif;
            }

            .download-resources img {
                width:69px;
            }
        }

        @media only screen and (min-width:64em) {

            .title p {
                font:700 50px/1.3em "Open Sans", sans-serif;
            }

            .title .sub {
                font:400 26px/1.4em "Open Sans", sans-serif;
            }
            .grid-item-container .title {
                font-size:18px;
            }
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    @yield('heading')

    @yield('page-body')

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    @yield('scripts')
@stop
