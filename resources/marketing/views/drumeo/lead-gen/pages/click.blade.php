@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Thank You | Drumeo</title>
    <meta name="description" content="You clicked the link! You'll continue to receive emails from us.">
    <!-- Social Media -->
    <meta property="og:title" content="Thank You">
    <meta property="og:description" content="You clicked the link! You'll continue to receive emails from us.">
    <meta property="og:url" content="https://www.drumeo.com/click/">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>
        .title-wrap {
            text-align:center;
            width:100%;
            margin:0 auto;
            padding:40px 10px 70px;
        }

        .title-wrap h1 {
            font:700 27px/1.2em "Bebas Neue", sans-serif;
            margin:0 auto;
            text-transform:uppercase;
        }

        .title-wrap p {
            font:400 14px/1.5em "Open Sans", sans-serif;
            margin:10px auto 25px;
        }

        @media only screen and (min-width:40em) {
            .title-wrap {
                padding:250px 10px;
            }

            .title-wrap h1 {
                font-size:36px;
            }

            .title-wrap p {
                font-size:15px;
            }
        }

        @media only screen and (min-width:64em) {
            .title-wrap {
                padding:210px 10px;
            }

            .title-wrap h1 {
                font-size:45px;
            }

            .title-wrap p {
                font-size:20px;
                margin:10px auto 30px;
            }
        }

        .social-media a {
            background:#0b76db;
            color:#FFF;
            border-radius:50%;
            display:inline-block;
            text-align:center;
            margin:0 4px;
            width:50px;
            height:50px;
            line-height:50px;
            font-size:26px;
        }

        @media (min-width:40em) {
            .social-media a {
                width:70px;
                height:70px;
                line-height:70px;
                font-size:35px;
            }
        }

        @media (min-width:64em) {
            .social-media a {
                width:90px;
                height:90px;
                line-height:90px;
                font-size:45px;
            }
        }

        .social-media a:hover {
            background:#0f84f2;
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <div class="row title-wrap">
        <div class="columns">

            <h1>Thank you!</h1>
            <p>You clicked the link! You'll continue to receive emails from us.<br class="show-for-medium">
                In the meantime, make sure to give us a follow on your <br class="show-for-medium">
                favorite social media channels for some drum lessons and inspiration.</p>
            <div class="social-media">
                <a href="https://instagram.com/drumeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://facebook.com/drumeo/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
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
