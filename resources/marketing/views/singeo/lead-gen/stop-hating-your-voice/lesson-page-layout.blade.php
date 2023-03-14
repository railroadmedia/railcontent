@extends('singeo.lead-gen.partials._lesson-page-layout')

@section('styles')
    @parent
    <meta name="robots" content="noindex">
    <title>@yield('title') | How To Stop Hating Your Voice</title>
    <meta property="og:title" content="How To Stop Hating Your Voice">
    <meta name="description" content="Learn to love your voice in 3 easy lessons!"/>
    <meta property="og:description" content="Learn to love your voice in 3 easy lessons!">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,q_60,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/stop-hating-your-voice/fb-share-image.jpg">
    <meta property="og:url" content="https://www.singeo.com/stop-hating-your-voice/">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/lead-gen.css') }}">
@stop

@section('title', 'How To Stop Hating Your Voice')

@section('all-lesson-link', '/stop-hating-your-voice/lessons')

@section('total-lesson-number', 3)

@section('assets')
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Download All MP3 Exercises",
        "zipURL" => "https://d21xeg6s76swyd.cloudfront.net/lead-gen/stop-hating-your-voice/mp3s.zip"
    ])
@endsection

@section('lesson-tiles')
    @php
        $lessons = [
            [
                'img' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/stop-hating-your-voice/thumb-1.png',
                'title' => 'IT’S NORMAL!',
                'desc' => 'Everyone hates their voice. But it’s completely normal! In this lesson, you’ll learn the ONE thing you can do that will instantly make you sound better.',
                'href' => '/stop-hating-your-voice/lessons/1'
            ],
            [
                'img' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/stop-hating-your-voice/thumb-2.png',
                'title' => 'GET CONTROL',
                'desc' => 'Your voice uses muscles. And when you strengthen them, you gain control of how you sound. This lesson will show you how to sing stronger, and sound better.',
                'href' => '/stop-hating-your-voice/lessons/2'
            ],
            [
                'img' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/stop-hating-your-voice/thumb-3.png',
                'title' => 'FIND YOUR NEW VOICE',
                'desc' => 'Put your exercises to work and sing a real song. Notice how much better and more confident you’ll sound after only a few short lessons!',
                'href' => '/stop-hating-your-voice/lessons/3'
            ],
        ];
    @endphp

    <div class="flex flex-wrap justify-center text-left mx-auto max-w-2xl lg:max-w-5xl">
        @foreach ($lessons as $lesson)
            <a href="{{ $lesson['href'] }}" class="flex lg:flex-auto w-full md:w-1/2 lg:w-1/3 px-2 md:px-3 mb-7 md:mb-10 step">
                <div class="rounded-xl overflow-hidden" style="background: linear-gradient(to bottom, #153044 56%, #252646); ">
                    <div class="aspect-16:9 w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://www.musora.com/musora-cdn/image/width=800,quality=85/{{ $lesson['img'] }});">
                        <i class="fas fa-play bg-singeo rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h4 class="px-4 mt-4 mb-2 uppercase font-bebas">{{ $lesson['title'] }}</h4>

                    <p class="px-4 pb-4 opacity-70">{!! $lesson['desc'] !!}</p>
                </div>
            </a>
        @endforeach
    </div>
@endsection
