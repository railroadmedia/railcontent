<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    @include('_partials.layout.favicons.'.$brand.'-favicons')

    <meta name="robots" content="noindex">
    <title>@yield('title') | {{ ucfirst($brand) }}</title>

    <base target="_parent">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <style>
        h5 {
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
            color:#999;
            border-radius:100px;
            padding:7px 20px;
            margin:0 auto 10px;
            transition:all .2s ease-in;
            box-shadow:none;
            text-align:inherit;
            border: 1px solid;
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
            font-family:"Bebas Neue", sans-serif;
            text-transform:uppercase;
            margin:0 auto!important;
            text-align:center;
            display:block;
            cursor:pointer;
            border:none;
            width:100%;
            padding:0;
            color:#fff;
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

    <link rel="preconnect" href="https://fonts.gstatic.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700;800&family=Bebas+Neue:wght@400&display=swap" rel="stylesheet">

    {!! \App\Analytics\Tracker::trackPageView() !!}

    {!! \App\Analytics\Tracker::headBottom() !!}
</head>

<body class="h-screen @if(!empty($darkBg)) bg-musora-black text-white  @endif ">
{!! \App\Analytics\Tracker::bodyTop() !!}

    <section class="text-center flex items-center h-full w-full px-3 sm:px-4">
        <div class="w-full max-w-4xl mx-auto">
            @yield('subtitle')
            @yield('form')
        </div>
    </section>

{!! \App\Analytics\Tracker::bodyBottom() !!}
</body>
</html>
