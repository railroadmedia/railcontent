@extends('pianote._partials.global-layout')

@section('global-head')
    <title>New Student Welcome Party | Pianote</title>
    <meta name="description" content="Lisa and Sam are SO excited to welcome you to the Pianote community and this event is going to be so much fun!">
    <!-- Social Media -->
    <meta property="og:title" content="New Student Welcome Party">
    <meta property="og:description" content="Lisa and Sam are SO excited to welcome you to the Pianote community and this event is going to be so much fun!">
    <meta property="og:url" content="https://www.pianote.com/welcome-party/">


    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
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
    @include('pianote.sales.partials._nav')

    <div class="title-wrap">
        <div class="container mx-auto">
            <div class="text-wrap text-center">
                <img style="width: 100%;border-radius:10px;" src="https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/welcome-party.jpg">
                <h1>Thanks for confirming!</h1>
                <p>Your spot is now confirmed! Thanks for RSVPing for our Pianote New Student Welcome Party! Lisa and Sam are SO excited to welcome you to the Pianote community and this event is going to be so much fun!
                    <br><br>
                    You’ll receive an email confirmation in the next 24 hours.
                </p>
                <a class="join smaller" href="/members">Go To Member's Area &raquo;</a>
            </div>
        </div>
    </div>

    @include("pianote.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
@stop
