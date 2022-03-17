@extends('singeo.lead-gen.stop-hating-your-voice.lesson-page-layout')

@section('title')
    Get Control
@stop

@section('video')
    <iframe class="absolute w-full h-full" src="https://www.youtube.com/embed/MY-9Svljta0?rel=0&showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
@stop

@section('lesson-number', 'Lesson 2 of 3')

@section('previous')
    /stop-hating-your-voice/lessons/1
@stop

@section('next')
    /stop-hating-your-voice/lessons/3
@stop

@section('prev-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/its-normal-thumb.jpg')

@section('next-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/find-your-new-voice-thumb.jpg')

@section('description')
    You’ll get control of your voice after this lesson. Follow along with these exercises to build a stronger voice you can be proud of.
@stop

@section('assets')
    @include('singeo.lead-gen.stop-hating-your-voice._assignment-resources', [
        "title" => "Practice Along (Lower Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/practice-along-lower.mp3",
        "defaultOpen" => true,
    ])
    @include('singeo.lead-gen.stop-hating-your-voice._assignment-resources', [
        "title" => "Practice Along (Higher Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/practice-along-higher.mp3",
        "defaultOpen" => true,
    ])
@stop
