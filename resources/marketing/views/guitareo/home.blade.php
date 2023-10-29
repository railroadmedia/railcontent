@extends('guitareo._partials.layout')

<!-- Content -->
@section('layout-body')

    <!-- Hero Component -->
    @component('_partials.components.hero-section', [
        "backgroundImage" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/guitareo/membership/homepage/2023/guitareo-hero.jpg",
        "gradientClasses" => "from-[#032829] to-[#032829]"
    ])
        @slot('content')
            <div class="max-w-md">
                <h1 class="text-white font-extrabold leading-tight max-w-xs md:max-w-md lg:max-w-2xl mx-auto md:mx-0 md:text-3xl lg:text-4xl">Online guitar lessons that care about you.</h1>
                <p class="leading-normal text-blue-100 text-shadow-4 mt-3 md:mt-5 mb-5 md:mb-7 text-lg">More than online lessons, you'll always have access to real coaches to answer your biggest questions, keep you motivated, and make sure you reach your goals.</p>
                <a href="/" class="btn-primary bg-guitareo">Get Strarted</a>
            </div>
        @endslot
    @endcomponent

@stop
