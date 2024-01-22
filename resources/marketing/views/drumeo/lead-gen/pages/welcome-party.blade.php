@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>New Student Welcome Party | Drumeo</title>
    <meta name="description" content="{{--Dave and--}} Kyle can’t wait to welcome you to the Drumeo community!">
    <!-- Social Media -->
    <meta property="og:title" content="New Student Welcome Party">
    <meta property="og:description" content="{{--Dave and--}} Kyle can’t wait to welcome you to the Drumeo community!">
    <meta property="og:url" content="https://www.drumeo.com/welcome-party/">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>
        .text-blue {
            color:#0b76db;
        }
        .text-white {
            color:#fff;
        }
        .title-wrap {
            background: linear-gradient(00deg, #011a33, #000c17);
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
            font:700 27px/1.2em "Bebas Neue", sans-serif;
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
                font-size:16px;
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

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <div class="title-wrap">
        <div class="row">
            <div class="text-wrap text-center">
                <img style="border-radius:10px;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://dpwjbsxqtam5n.cloudfront.net/promos/rocktober/welcome-party-kyle.jpg">
                <h1>Thanks for confirming!</h1>
                <p class="text-left">Your spot is now confirmed! Thanks for RSVPing for your New Student Welcome Party! We can’t wait to welcome you to the Drumeo community and show you how to take your drumming skills to the next level.
                    <br><br>You’ll receive an email confirmation in the next 24 hours.</p>
                <a class="join blue smaller" href="/members">Members Area &raquo;</a>
            </div>
        </div>
    </div>
    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
