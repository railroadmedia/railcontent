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