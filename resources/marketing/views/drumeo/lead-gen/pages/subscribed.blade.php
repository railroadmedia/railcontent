@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Thank you! | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">
    @include('_partials.layout._fonts')
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>

        p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:15px auto;
        }

        @media (min-width:40em) {
            p {
                font-size:19px;
                margin:20px auto;
            }
        }

        @media (min-width:64em) {
            p {
                font-size:23px;
            }
        }

        h2 {
            font:700 30px/1em "Bebas Neue", sans-serif;
            text-transform:uppercase;
            color:#0b76db;
        }

        @media (min-width:40em) {
            h2 {
                font-size:40px;
            }
        }

        @media (min-width:64em) {
            h2 {
                font-size:50px;
            }
        }

        p em {
            line-height:1.4em;
            max-width:550px;
            display:inline-block;
            font-size:12px;
        }

        @media (min-width:40em) {
            p em {
                font-size:14px;
            }
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <div class="text-center container mx-auto max-w-5xl py-56 sm:py-96">
        <h2>Success!</h2>
        <p><em>You've been successfully subscribed. <br class="show-for-medium">
                Check your inbox soon for great emails from Drumeo.</em></p>
        <a class="join blue smaller" href="https://www.musora.com/drumeo">Members Area</a>
    </div>
    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
