@php
  require_once(resource_path('marketing/views/pianote/lead-gen/chord-hacks/lessons.php'))
@endphp

@extends('pianote.lead-gen.chord-hacks.chord-hacks-layout')

@section('meta')
    @parent
    <meta name="robots" content="noindex">
    <title>Chord Hacks | Pianote</title>
@stop()

@section('page-body')

    <header class="header text-center text-white py-12 md:py-18 lg:py-20 px-4 bg-center bg-no-repeat relative" style="background-color:#010519; background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/chord-hacks/bg.jpg);">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <img class="h-6 md:h-10 lg:h-12" src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/{{cdn('chord-hacks/logo.png')}}" alt="cord hacks logo">
        </div>
    </header>

    <div class="text-center text-white py-10 md:py-20 px-4" style="background: linear-gradient(to bottom, #00101d 60%, #171427);">
        <div class="container mx-auto series-boxes">
            <h2 class="font-bold mb-2 text-center"><strong>Learn to play piano<br class="inline sm:hidden"> quicker with chords!</strong></h2>
            <h6 class="leading-normal mx-auto max-w-2xl mb-10">Learning chords is a great way to improve your piano skills without any music theory. And Lisa Witt’s “Chord Hacks” series will show you how to play the most popular chords, so you can play many of your favorite songs on the piano!</h6>
            <div class="box with-video flex flex-wrap items-start justify-center mx-auto md:max-w-2xl lg:max-w-6xl px-0 md:px-2 my-8">
                @foreach ($lessons as $lesson)
                    <a href="{{ $lesson['watchLink'] }}" class="px-2 md:px-4 w-1/2 lg:w-1/3 mb-7">
                        <div class="border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="padding-bottom: 65%;background-image:url({{$lesson['boxImage']}});">
                            @if(!empty($lesson['watchLink']))
                                <i class="fas fa-play-circle"></i>
                            @endif
                        </div>
                        <h6 class="leading-normal"><strong>{{ $lesson['title'] }}</strong></h6>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    @include('pianote.lead-gen.learn-to-play.elements.trial-pitch')
@stop
