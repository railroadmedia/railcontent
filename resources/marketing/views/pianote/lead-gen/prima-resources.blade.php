@php
    require_once(resource_path('marketing/views/drumeo/lead-gen/pages/awards-data.php'))
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    <title>Prima Resources | Pianote</title>
    <meta property="og:title" content="Pianote Prima Resources">

    <meta name="description" content="">
    <meta property="og:description" content="">

    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d2vyvo0tyx8ig5.cloudfront.net/sales/2023/share-image-pianote2.jpg" style="display: none;">

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
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav')
    <section class="py-10 md:py-16 px-4 sm:px-6">
        <div class="container mx-auto max-w-5xl">
            <h1 class="leading-tight mb-4"><strong>unboxing</strong></h1>
            <h1 class="leading-tight mb-4"><strong>how to videos</strong></h1>
            <h1 class="leading-tight mb-4"><strong>manual download</strong></h1>
        </div>
    </section>

    @include("pianote.sales.partials._footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
