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
                            "formId" => "Musora - Engagement - Trigger - Youtube Resources - WebForm", //TODO: Update form ID
                            "buttonText" => "GET THE FREE THINGS",
                            'stacked' => false,
                            "checkboxTitle" => "Preferred Instrument",
                            "minimalForm" => true,
                            "buttonColor" => "bg-musora text-black",
                            "checkboxItems" => ['Guitar' => 'Guitar', 'Piano' => 'Piano', 'Drums' => 'Drums', 'Singing' => 'Singing'],
                        ])
                    </div>
                </div>
            </div>
        </div>
    </header>
      @php
        $benefits = [
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/app-page/giveaways.png', 'title' => 'Exclusive Giveaways'],
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/app-page/resources.png', 'title' => 'Free gifts & resources'],
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/app-page/free-lessons.png', 'title' => 'Free lessons'],
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/app-page/50_off-gold.jpg', 'title' => 'exclusive discounts'],
        ];
    @endphp

    <section class="container max-w-4xl mx-auto bg-white px-4">
        <div  class="grid grid-cols-2 gap-4 py-10 md:py-20">
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
                            "formId" => "Musora - Engagement - Trigger - Youtube Resources - WebForm2", //TODO: Update form ID
                            "buttonText" => "GET THE FREE THINGS",
                            'stacked' => false,
                            "checkboxTitle" => "Preferred Instrument",
                            "minimalForm" => true,
                            "buttonColor" => "bg-black text-white",
                            "checkboxItems" => ['Guitar' => 'Guitar', 'Piano' => 'Piano', 'Drums' => 'Drums', 'Singing' => 'Singing'],
                            "theme" => "black",
                            "redirectURL" => "/thank-you",
                        ])
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
