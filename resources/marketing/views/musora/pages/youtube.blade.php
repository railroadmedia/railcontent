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

    <header class="px-5 sm:px-6 py-8 sm:py-16 lg:py-24 text-black" style="background-color:#FAFAFA;">
        <div class="container mx-auto max-w-6xl">
            <div class="flex flex-col lg:flex-row items-center lg:items-start">
                <div class="w-full lg:w-5/12 px-6">
                    <img class="w-full object-cover" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/musora/membership/app-page/header.png" alt="Musora Coaches Image">
                </div>
                <div class="w-full lg:w-6/12 text-center lg:text-left">
                    <h1 class="uppercase pt-10 text-4xl md:text-5xl text-7xl"><strong>The Free Stuff</strong></h1>
                    <p class="tracking-tight pb-4 lg:pb-6">
                        Sign up below to get access to FREE lessons, giveaways, <br class="block sm:hidden"> exclusive discounts and any other cool stuff we do.
                    </p>
                    <div class="w-full sm:w-10/12 lg:w-full mx-auto">
                        @include("_partials.components.forms.sign-up-form-options", [
                            "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Free Music Lessons For Life',
                            "formId" => "Musora - Engagement - Trigger - Free Music Lessons For Life - WebForm", //TODO: Update form ID
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
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/app-page/header.png', 'title' => 'Exclusive Giveaways'],
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/app-page/header.png', 'title' => 'Free gifts & resources'],
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/app-page/header.png', 'title' => 'Free lessons'],
            ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/app-page/header.png', 'title' => 'exclusive discounts'],
        ];
    @endphp

    <section class="container max-w-4xl mx-auto bg-white">
        <div  class="grid grid-cols-2 gap-4 py-10 md:py-20">
                @foreach ($benefits as $benefit)
                    <div class="text-center">
                        <img src="{{ $benefit['image'] }}" alt="{{ $benefit['title'] }}" class="mx-auto">
                        <h5 class="mt-2 uppercase"><strong>{{ $benefit['title'] }}</strong></h5>
                    </div>
                @endforeach
        </div>
    </section>

    <section class="px-5 sm:px-6 py-8 sm:py-16 lg:py-24 text-black" style="background-color:#FEAD36;">
        <div class="container mx-auto max-w-6xl">
            <div class="flex flex-col justify-center items-center">
                <div class="w-full text-center">
                <h1 class="uppercase pt-10 text-4xl md:text-5xl lg:text-6xl"><strong>We know you love free stuff</strong></h1>
                    <p class="tracking-tight pb-4 lg:pb-6">
                        Sign up below for free lessons, giveaways, offers & more. <br class="block sm:hidden"> There’s literally no reason not to!
                    </p>
                    <div class="w-full sm:w-10/12 lg:w-1/2 mx-auto">
                        @include("_partials.components.forms.sign-up-form-options", [
                            "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Free Music Lessons For Life',
                            "formId" => "Musora - Engagement - Trigger - Free Music Lessons For Life - WebForm2", //TODO: Update form ID
                            "buttonText" => "GET THE FREE THINGS",
                            'stacked' => false,
                            "checkboxTitle" => "Preferred Instrument",
                            "minimalForm" => true,
                            "buttonColor" => "bg-black text-white",
                            "checkboxItems" => ['Guitar' => 'Guitar', 'Piano' => 'Piano', 'Drums' => 'Drums', 'Singing' => 'Singing'],
                            "theme" => "black",
                            "checkboxPosition"=>'bottom',
                            "redirectURL" => "/thank-you",
                        ])
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
