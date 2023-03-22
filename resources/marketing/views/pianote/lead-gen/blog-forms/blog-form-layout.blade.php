<!DOCTYPE html>
<html lang="en">
<head>
{{--    {!! \App\Analytics\Tracker::headTop() !!}--}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">

    <meta name="robots" content="noindex">
    <title>@yield('title') | Pianote</title>

    <base target="_parent">
    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <style>
        body {
            height:100vh;
            position:relative;
        }
        h1 strong, h2 strong, h3 strong, h4 strong, h5 strong, h6 strong {
            font-weight:900
        }

        h5 {
            font-weight:400;
            line-height:1em;
            font-family:"Open Sans", sans-serif;
            margin:0 auto;
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

        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        form ::-webkit-input-placeholder, form ::-moz-placeholder, form :-ms-input-placeholder, form :-moz-placeholder {
            color:#777
        }

        .infusion-form input, .infusion-form button {
            font:400 18px/45px "Open Sans", sans-serif;
            height:45px;
            background:#eee;
            color:#999;
            border-radius:100px;
            padding:7px 20px;
            margin:0 auto 10px;
            transition:all .2s ease-in;
            box-shadow:none;
            text-align:inherit;
            border:none
        }

        @media (min-width:640px) {
            .infusion-form input, .infusion-form button {
                font-size:19px;
                margin:0 auto
            }
        }

        @media (min-width:1024px) {
            .infusion-form input, .infusion-form button {
                font-size:23px
            }
        }

        .infusion-form button {
            font-family:"Roboto Condensed", sans-serif;
            font-weight:700;
            text-transform:uppercase;
            margin:0 auto!important;
            text-align:center;
            display:block;
            cursor:pointer;
            border:none;
            width:100%;
            padding:0;
            color:#fff;
            background:#f61a30
        }

        .infusion-form button:hover {
            background:#f73346
        }
        form input, form button {
            line-height:40px;
            height: 40px;
        }
        @media (min-width: 40em) {
            form input, form button {
                height: 52px;
                line-height: 52px;
            }
        }
        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:10px;
        }
        @media (min-width: 40em) {
            .thank-you-box.active {
                padding: 12px;
            }
        }
    </style>

    @include('_partials.layout._fonts')
    @include('_partials.layout.favicons.pianote-favicons')

{{--    {!! \App\Analytics\Tracker::trackPageView() !!}--}}
{{--    {!! \App\Analytics\Tracker::headBottom() !!}--}}
</head>

<body
    @if(!empty($darkBg))
        class="bg-musora-black text-white"
    @endif
>

{{--{!! \App\Analytics\Tracker::bodyTop() !!}--}}

<section class="text-center absolute top-1/2 left-1/2 w-full px-3 sm:px-4" style="transform:translate(-50%,-50%)">
    <div class="max-w-4xl mx-auto">
        @yield('subtitle')
        @yield('form')
    </div>
</section>

{{--{!! \App\Analytics\Tracker::bodyBottom() !!}--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
</body>
@include("pianote.lead-gen.impact-email-sign-up-tracker")
</html>
