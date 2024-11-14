@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | The Free Stuff</title>
    <meta property="og:title" content="Musora | The Free Stuff">

    <meta name="description" content="Sign up to get access to FREE lessons, giveaways, exclusive discounts and any other cool stuff we do.">
    <meta property="og:description" content="Sign up to get access to FREE lessons, giveaways, exclusive discounts and any other cool stuff we do.">

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
    <style>

        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        form ::-webkit-input-placeholder, form ::-moz-placeholder, form :-ms-input-placeholder, form :-moz-placeholder {
            color:#777
        }

        .giveaway-form input, .giveaway-form button {
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
            .giveaway-form input, .giveaway-form button {
                font-size:19px;
                margin:0 auto
            }
        }

        @media (min-width:1024px) {
            .giveaway-form input, .giveaway-form button {
                font-size:23px
            }
        }

        .giveaway-form button {
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
        .giveaway-form input, .giveaway-form button {
            line-height:40px;
            height: 40px;
        }
        @media (min-width: 40em) {
            .giveaway-form input, .giveaway-form button {
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
        .giveaway-form input {
            margin-bottom: 8px;
        }
    </style>
@endsection


<!-- Main -->
@section('layout-body')

    <header class="px-5 sm:px-6 py-8 sm:py-12 lg:py-20 text-black" style="background-color:#FAFAFA;">
        <div class="container mx-auto max-w-6xl">
            <div class="flex flex-col lg:flex-row items-center lg:items-start">
                <div class="w-full lg:w-5/12 px-6 text-center">
                    <img class="w-full object-cover max-w-lg lg:max-w-full mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/musora/membership/app-page/header.png" alt="Musora Coaches Image">
                </div>
                <div class="w-full lg:w-6/12 text-center lg:text-left">
                    <h1 class="uppercase lg:pt-10"><strong>The Free Stuff</strong></h1>
                    <p class="leading-tight pb-4 lg:pb-6">
                        Sign up below to get access to FREE lessons, <br class="block sm:hidden"> giveaways,<br class="hidden sm:inline-block"> exclusive discounts and any other<br class="block sm:hidden">  cool stuff we do.
                    </p>
                    <div class="w-full sm:w-10/12 lg:w-full mx-auto">
                        @include("_partials.components.forms.sign-up-form-options", [
                            "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Youtube Resources',
                            "formId" => "Musora - Engagement - Trigger - Youtube Resources - WebForm",
                            "buttonText" => "GET THE FREE THINGS",
                            'stacked' => false,
                            "checkboxTitle" => "Preferred Instrument",
                            "minimalForm" => true,
                            "buttonColor" => "bg-musora text-black",
                            "checkboxItems" => ['Guitar' => 'Guitar', 'Piano' => 'Piano', 'Drums' => 'Drums', 'Singing' => 'Singing'],
                            "redirectURL" => '/youtube/free-resources',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="text-white px-4 md:px-10 py-10 sm:py-12" style="background-color:#101520;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-col sm:flex-row items-center">
                <div class="w-full sm:w-1/2 text-left px-2 sm:px-0 mb-4 sm:mb-0">
                    <h1 class="uppercase leading-none mb-4"><strong>Linkin Park Cymbal Giveaway</strong></h1>
                    <p class="leading-normal">
                        We're giving away the entire set of Istanbul cymbals that Brandon used in the video to ONE lucky winner
                    </p>
                </div>
                <div class="w-full sm:w-1/2 text-center sm:text-left giveaway-form">
                    @include("drumeo.lead-gen.partials.sign-up-form", [
                        "recaptchaKey" => $recaptchaKey,
                        "formName" => 'Cymbal Giveaway',
                        "formId" => "Drumeo - Engagement - Trigger - Cymbal Giveaway - Web Form",
                        "buttonText" => "I WANT TO WIN",
                        "nameInput" => "Your Name",
                        "stacked" => true,
                        "minimalForm" => true,
                        "buttonColor" => "bg-musora text-black",
                        "redirectUrl" => "https://www.musora.com/thank-you",
                    ])
                </div>
            </div>
        </div>
    </section>
      @php
        $benefits = [
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/app-page/giveaways.png', 'title' => 'Exclusive Giveaways'],
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/app-page/resources.png', 'title' => 'Free gifts & resources'],
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/app-page/free-lessons.png', 'title' => 'Free lessons'],
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/musora/membership/app-page/50_off-gold.jpg', 'title' => 'exclusive discounts'],
        ];
    @endphp

    <section class="container max-w-4xl mx-auto bg-white px-4 md:px-10">
        <div  class="grid grid-cols-2 gap-6 py-10 md:py-20">
                @foreach ($benefits as $benefit)
                    <div class="text-center">
                        <img src="{{ $benefit['image'] }}" alt="{{ $benefit['title'] }}" class="mx-auto rounded-xl">
                        <h5 class="mt-2 uppercase"><strong>{{ $benefit['title'] }}</strong></h5>
                    </div>
                @endforeach
        </div>
    </section>

    <section class="px-5 sm:px-6 py-8 sm:py-16 lg:py-24 text-black" style="background-color:#FEAD36;">
        <div class="container mx-auto max-w-6xl">
            <div class="flex flex-col justify-center items-center">
                <div class="w-full text-center">
                <h1 class="leading-tight uppercase"><strong>We know you<br class="block sm:hidden">  love free stuff</strong></h1>
                    <p class="leading-tight mt-2 pb-4 lg:pb-6">
                        Sign up below for free lessons, giveaways,<br class="block sm:hidden">  offers & more. There’s literally no reason not to!
                    </p>
                    <div class="w-full sm:w-10/12 lg:w-1/2 mx-auto">
                        @include("_partials.components.forms.sign-up-form-options", [
                            "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Youtube Resources',
                            "formId" => "Musora - Engagement - Trigger - Youtube Resources - WebForm2",
                            "buttonText" => "GET THE FREE THINGS",
                            'stacked' => false,
                            "checkboxTitle" => "Preferred Instrument",
                            "minimalForm" => true,
                            "buttonColor" => "bg-black text-white",
                            "checkboxItems" => ['Guitar' => 'Guitar', 'Piano' => 'Piano', 'Drums' => 'Drums', 'Singing' => 'Singing'],
                            "theme" => "black",
                            "redirectURL" => '/youtube/free-resources',
                        ])
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
