@extends('pianote._partials.layout')

<!-- Content -->
@section('layout-body')

    <!-- Hero Component -->
    @component('_partials.components.hero-section', [
        "backgroundImage" => "https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-hero.jpg",
        "gradientClasses" => "from-[#29050f] to-[#29050f]"
    ])
        @slot('content')
            <div class="max-w-md">
                <h1 class="text-white font-extrabold leading-tight max-w-xs md:max-w-md lg:max-w-2xl mx-auto md:mx-0 md:text-3xl lg:text-4xl">Learn the piano anytime with real teachers.</h1>
                <p class="leading-normal text-blue-100 text-shadow-4 mt-3 md:mt-5 mb-5 md:mb-7 text-lg">
                    <b class="uppercase">Technology Meets Tradition:</b>
                    Online video lessons you can watch anytime, with support from real teachers every step of the way.
                </p>
                <a href="/" class="btn-primary bg-pianote">Get Strarted</a>
            </div>
        @endslot
    @endcomponent

@stop
