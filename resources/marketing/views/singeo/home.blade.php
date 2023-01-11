@extends('singeo._partials.layout')

<!-- Content -->
@section('layout-body')

    <!-- Hero Component -->
    @component('_partials.components.hero-section', [
        "backgroundImage" => "https://musora-web-platform.s3.amazonaws.com/singeo/homepage/singeo-hero.jpg",
        "gradientClasses" => "from-[#1a0239] to-[#1a0239]"
    ])
        @slot('content')
            <div class="max-w-md">
{{--                <h1 class="text-white font-extrabold leading-tight max-w-xs md:max-w-md lg:max-w-2xl mx-auto md:mx-0 md:text-3xl lg:text-4xl">Your complete guide to confident singing.</h1>--}}
                <p class="leading-normal text-blue-100 text-shadow-4 mt-3 md:mt-5 mb-5 md:mb-7 text-lg">Online singing lessons for any voice & vocal coaches to support you every step of the way.</p>
                <a href="/" class="btn-primary bg-singeo">Get Strarted</a>
            </div>
        @endslot
    @endcomponent

@stop
