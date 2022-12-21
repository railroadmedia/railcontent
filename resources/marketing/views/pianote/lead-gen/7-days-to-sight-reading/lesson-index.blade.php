@php
  require_once(resource_path('marketing/views/pianote/lead-gen/7-days-to-sight-reading/lessons.php'))
@endphp

@extends('pianote.lead-gen.lead-gen-layout-tw')

@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>7 Days to Sight Reading | Pianote</title>
    <meta property="og:title" content="7 Days to Sight Reading | Pianote">
    <meta name="description" content="Learn to read music. Play your favorite songs. Have more fun."/>
    <meta property="og:description" content="Learn to read music. Play your favorite songs. Have more fun.">
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/share_image.jpg">
    <meta property="og:url" content="https://www.pianote.com/7-days-to-sight-reading">
@endsection

@section('head')
    <link href="{{ asset('/marketing/parcel/pianote/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <style>
        header {
            background-image: url('https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/header_m_lesson.jpg');
            background-color: #01050F;
            background-size: 425px;
        }

        @media (min-width: 768px) {
            header {
                background-image: url('https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/header_lessons.jpg');
                background-size: 1150px;
            }
        }

        @media (min-width: 1024px) {
            header {
                background-image: url('https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/header_lessons.jpg');
                background-size: 1260px;
            }
        }
    </style>
@endsection

@section('page-body')
    <header class="bg-no-repeat bg-top py-6 md:py-20">
        <div class="max-w-md md:max-w-3xl mx-auto text-white md:pl-16 lg:pl-0 text-center md:text-left px-4 md:px-0">
            <img class="h-16 mb-96 md:mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_350,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/logo.png" alt="logo">
            <div class="max-w-xs mx-auto md:max-w-full md:mx-0">
                <h3 class="font-extrabold leading-tight mb-4 text-xl md:text-2xl lg:text-3xl text-left">
                    Learn to read music. <br>Play your favorite songs. <br>Have more fun.
                </h3>
                <p class="mb-6 text-left" style="color:#D0E2E7;">
                    Welcome to 7 days of guided lessons and practices <br class="hidden md:inline">to help you learn the language of music.
                </p>
                <p class="flex items-center"><i class="fa-regular fa-hand-pointer mr-2"></i> Tap &nbsp;<b>Day 1</b> &nbsp;To Get Started</p>
            </div>
        </div>
    </header>

    <section class="py-10 md:py-20 px-4" style="background:#F9F9F9;">
        <div class="container mx-auto">
            <div class="flex flex-wrap items-center justify-center mx-auto md:max-w-2xl lg:max-w-6xl my-8">
                @foreach ($lessons as $key => $lesson)
                    <a href="{{ $lesson['watchLink'] }}" class="px-1 md:px-4 w-1/2 lg:w-1/4 mb-7">
                        <div class="bg-white rounded-xl pb-8 overflow-hidden" style="filter:drop-shadow(5px 5px 5px rgba(0, 0, 0, 0.25));">
                            <div class="aspect-16:9 w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative lazyload" data-bg="{{ $lesson['boxImage'] }}">
                            </div>
                            <div class="px-4">
                                <p class="text-pianote">DAY {{$key+1}}</p>
                                <h6 class="leading-normal"><strong>{{ $lesson['title'] }}</strong></h6>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center py-12 md:py-20 text-white bg-center bg-cover lazyload" style="background-color:#000417;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_60,q_auto:best/https://pianote.s3.amazonaws.com/lead-gen/7-days-to-sight-reading/footer_lessons.jpg">
        <div class="max-w-2xl mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <h3 class="mb-6"><strong>Ready for the next step?</strong></h3>
                <p style="color:#D0E2E7;">Get unlimited lessons, detailed song tutorials, and personal support from real teachers with a Pianote membership. Try it free for 7 days.</p>
                <a class="join my-5 md:my-7" href="/choose-your-trial">Start a free trial &raquo;</a>
            </div>
        </div>
    </section>
@endsection
