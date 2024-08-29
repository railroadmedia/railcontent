<!DOCTYPE html>
<html lang="en">
<head>
    {!! \App\Analytics\Tracker::headTop() !!}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    @include('_partials.layout.favicons.musora-favicons')

    <meta name="robots" content="noindex">
    <title>The Playlist | Musora</title>

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

        .ajax-form input, .ajax-form button {
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
            .ajax-form input, .ajax-form button {
                font-size:19px;
                margin:0 auto
            }
        }

        @media (min-width:1024px) {
            .ajax-form input, .ajax-form button {
                font-size:23px
            }
        }

        .ajax-form button {
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

<body class="h-screen bg-musora-black text-white ">
{!! \App\Analytics\Tracker::bodyTop() !!}

<section class="text-center flex items-center h-full w-full px-2 sm:px-4">
    <div class="w-full max-w-4xl mx-auto">
        <h1 class="font-bebas font-bold leading-none text-4xl sm:text-5xl">
            <span class="hidden sm:inline">Get a new playlist & interview <br>delivered to your inbox every month!</span>
            <span class="inline sm:hidden">Get a New Playlist &  <br> Interview every Month!</span>
        </h1>
        <h5 class="leading-normal mb-3 md:mb-4 opacity-70">
            <span class="hidden sm:inline">And subscribe to enter a monthly draw for the chance<br> to win a $1000 gift card for new music gear!</span>
            <span class="inline sm:hidden">+ Subscribe for a chance to win a $1000 <br>music gear gift card in our monthly draw!</span>
        </h5>
        @include("drumeo.lead-gen.partials.sign-up-form", [
            "recaptchaKey" => $recaptchaKey,
            "formName" => 'The Playlist - Musora Newsletter',
            "formId" => "Musora - Engagement - Trigger - The Playlist - Musora Newsletter - WebForm",
            "buttonText" => "Sign Up",
            "minimalForm" => true,
            "buttonColor" => "bg-musora text-black",
        ])
    </div>
</section>

{!! \App\Analytics\Tracker::bodyBottom() !!}
</body>
</html>
