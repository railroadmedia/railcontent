@extends('guitareo._partials.global-layout')

@section('meta')
    <title>New Student Welcome Party | Guitareo</title>
    <meta property="og:title" content="New Student Welcome Party">

    <meta name="description" content="Your spot is confirmed! Thanks for RSVPing for our Guitareo New Student Welcome Party!">
    <meta property="og:description" content="Your spot is confirmed! Thanks for RSVPing for our Guitareo New Student Welcome Party!">

    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1400,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/welcome-party-kent.jpg"/>
    <meta property="og:url" content="https://www.guitareo.com/welcome-party/">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('/tailwindcss/tailwind.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}">

    <style>
        .text-blue {
            color:#0b76db;
        }

        .text-white {
            color:#fff;
        }

        .title-wrap {
            background:linear-gradient(00deg, #011a33, #000c17);
            color:#fff;
            width:100%;
            margin:0 auto;
            padding:20px 20px;
        }

        .title-wrap .text-wrap {
            max-width:700px;
            margin:0 auto;
        }

        .title-wrap h1 {
            font:700 27px/1.2em "Roboto Condensed", sans-serif;
            margin:15px auto;
            text-transform:uppercase;
            text-align:center;
        }

        .title-wrap p, .title-wrap li {
            font:400 14px/1.5em "Open Sans", sans-serif;
            margin:10px auto 25px;
        }

        .join.smaller {
            padding:8px 12px;
            font-size:13px;
        }

        @media only screen and (min-width:40em) {
            .title-wrap {
                padding:50px 30px;
            }

            .title-wrap h1 {
                font-size:36px;
                margin:20px auto;
            }

            .title-wrap p, .title-wrap li {
                font-size:15px;
            }

            .join.smaller {
                font-size:14px;
                padding:13px 30px;
            }
        }

        @media only screen and (min-width:64em) {
            .title-wrap {
                padding:60px 10px;
            }

            .title-wrap h1 {
                font-size:45px;
            }

            .title-wrap p, .title-wrap li {
                font-size:17px;
                margin:10px auto 30px;
            }
        }
    </style>
@stop


@section('navigation')
    @include("guitareo.sales.partials._nav")
@stop

@section('content')
    <div class="title-wrap">
        <div class="container mx-auto">
            <div class="text-wrap">
                <img class="w-full rounded-xl" src="https://cdn.musora.com/image/fetch/w_1400,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/welcome-party-kent.jpg">
                <h1>Thanks for confirming!</h1>
                <p>Your spot is confirmed! Thanks for RSVPing for our Guitareo New Student Welcome Party! We are all so excited to welcome you into the Guitareo community. Kent (your in-house coach) is really looking forward to meeting you and eager to chat about the incredible things you will learn to play on the guitar!
                   <br><br>
                    You’ll receive an email confirmation in the next 24 hours.</p>
                <div class="text-center">
                    <a class="join smaller mx-auto" href="/members">go to members area &raquo;</a>
                </div>
            </div>
        </div>
    </div>

    @include("guitareo.sales.partials._footer")
@stop

@section('scripts')
    <script type="text/javascript" src="/marketing/parcel/guitareo/nav-footer.js"></script>
@stop
