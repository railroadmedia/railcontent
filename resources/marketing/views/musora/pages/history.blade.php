@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | Today In Music History</title>
    <meta property="og:title" content="Musora | Today In Music History">

    <meta name="description" content="Subscribe for bi-weekly deep dives into the untold and forgotten moments of music history.">
    <meta property="og:description" content="Subscribe for bi-weekly deep dives into the untold and forgotten moments of music history.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/membership/homepage/2023/share-image3.jpg">

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
        .ajax-form input {
        margin-bottom: 8px;
    }
    </style>
@endsection


<!-- Main -->
@section('layout-body')

    <header class="header-image px-5 sm:px-6 py-8 sm:py-16 lg:py-24 bg-no-repeat text-white" style="background-color:#faf8f5;">
        <div class="container mx-auto max-w-4xl">
            <div class="w-full px-10">
                <img class="w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/musora/lead-gen/playlist/header-history.webp" alt="Playlist Image">
            </div>
            <h6 class="leading-relaxed py-4 lg:py-8 text-black text-center font-black">
                Subscribe for bi-weekly deep dives into the untold & <br class="hidden sm:block"> forgotten moments of music history.
            </h6>
            <div class="w-full sm:w-2/3 lg:w-2/4 mx-auto leading-relaxed">
                @include("_partials.components.forms.sign-up-form-options", [
                    "recaptchaKey" => $recaptchaKey,
                    "formName" => 'Today in Music History',
                    "formId" => "Musora - Engagement - Trigger - Today in Music History - WebForm", 
                    "buttonText" => "SIGN UP",
                    "nameInput" => "Your Name",
                    "stacked" => true,
                    "buttonColor" => "bg-musora text-black",
                ])
            </div>
        </div>
    </header>

@stop