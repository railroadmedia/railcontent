@php
    require_once(resource_path('marketing/views/pianote/lead-gen/learn-to-play/lessons.php'))
@endphp

@extends('pianote.lead-gen.learn-to-play.layout')

@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>Learn to Play Piano</title>
@stop()

@section('page-body')
    <div class="promo-heading-background container-fluid no-padding" style="background: url(https://d2vyvo0tyx8ig5.cloudfront.net/backgrounds/background-1.jpg) 50%/cover no-repeat;">
        <div class="container promo-heading series mx-auto py-10 md:py-12 lg:max-w-6xl lg:py-16">
            <img class="learn-to-play-logo" src="https://d2vyvo0tyx8ig5.cloudfront.net/learn-piano/logo.png" alt="learn-to-play-logo">
        </div>
    </div>

    <section style="background: linear-gradient(to bottom, #00101d 60%, #171427);">
        <div class="container series-boxes mx-auto lg:max-w-6xl">
            <div class="w-full text-center">
                <div class="large-body py-7 text-white"><strong>Click Any Lesson Below to Get Started</strong></div>
            </div>

            @include('pianote.lead-gen.partials.series1')

            <div class="box w-full with-video px-4">
                <a href="/my-lessons/how-to-write-a-song">
                    <i class="fas fa-play-circle"></i>
                    <img class="md:hidden" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/how-to-write-a-song.png">
                    <img class="hidden md:inline" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/how-to-write-a-song-wide.png">
                </a>
            </div>
        </div>
    </section>

    @include('pianote.lead-gen.partials._7-day-trial-offer')
@stop
