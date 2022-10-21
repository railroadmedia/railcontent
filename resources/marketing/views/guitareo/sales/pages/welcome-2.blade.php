@extends('guitareo._partials.global-layout')

@section('meta')
    @parent
    <title>3 Steps To Success On The Guitar | Guitareo.com</title>
    <meta name="description" content=""/>

    <meta property="og:url" content="https://www.guitareo.com/welcome/2"/>
    <meta property="og:title" content="3 Steps To Success On The Guitar"/>
    <meta property="og:description" content=""/>
    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/sales/og-image3.jpg"/>
@stop()

@section('styles')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/tailwind-helpers.css') }}">
    <link href="{{ asset('marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">
    <style>
        .expired {
            padding:30px 0 70px;
        }
        @media (min-width:40em) {
            .expired {
                padding:80px 0;
            }
        }
        @media (min-width:64em) {}
        .expired h1 {
            font:700 25px/1.2em "Open Sans", sans-serif;
            margin:0 auto 15px;
        }

        @media (min-width:40em) {
            .expired h1 {
                font-size:31px;
            }
        }

        @media (min-width:64em) {
            .expired h1 {
                font-size:40px;
                margin:0 auto 25px;
            }
        }

        .expired p {
            font:400 16px/1.5em "Open Sans", sans-serif;
            margin:0 auto 15px;
        }

        @media (min-width:40em) {
            .expired p {
                margin:0 auto 20px;
            }
        }

        @media (min-width:64em) {
            .expired p {
                font-size:19px;
                margin:0 auto 35px;
            }
        }

        .expired .join {
            display:inline-block;
            font:700 20px/1em "Roboto Condensed", sans-serif;
            text-transform:uppercase;
            background:#00C9AC;
            border-radius:5px;
            color:#FFF;
            padding:17px 7%;
            cursor:pointer;
        }

        @media (min-width:40em) {
            .expired .join {
                font-size:28px;
            }
        }

        .expired .join:hover {
            background:#00e0bf;
        }
    </style>
@stop()

@section('scripts')
    @parent
    <script src="{{ asset('marketing/parcel/guitareo/nav-footer.js') }}"></script>
@stop()

@section('content')
    @include("guitareo.sales.partials._nav")

    <section class="expired text-center">
        <div class="container mx-auto">
            <h1>3 Steps To Success<br class="inline md:hidden">
                On The Guitar</h1>
            <div class="tw-aspect-16:9 w-full relative mt-5 mb-7">
                <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/282035391" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
            <a href="/members" class="join">Guitareo Member’s Area  &raquo;</a>
        </div>
    </section>

    @include("guitareo.sales.partials._footer")
@stop
