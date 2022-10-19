@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>Thank you! | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    @include('drumeo._partials._fonts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="/laravel/public/css/tailwind-helpers.css" rel="stylesheet">
    <link href="{{ asset('/assets/members-area/css/gulp/navigation-sales.css') }}" rel="stylesheet">
    <style>

        p {
            font:400 15px/1.4em "Open Sans", sans-serif;
            margin:0 auto;
        }

        @media (min-width:40em) {
            p {
                font-size:19px;
            }
        }

        @media (min-width:64em) {
            p {
                font-size:23px;
            }
        }

        h2 {
            font:700 30px/1em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            color:#0b76db;
        }

        @media (min-width:40em) {
            h2 {
                font-size:40px;
                margin:20px auto;
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
        <h2>Thank you!</h2>
        <p><em>Your subscription has been confirmed. You've been added to the <br class="show-for-medium">
                30 Day Drummer email communication list and will hear from us soon.</em></p>
    </div>
    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/assets/members-area/js/gulp/navigation-sales.js') }}"></script>
@stop
