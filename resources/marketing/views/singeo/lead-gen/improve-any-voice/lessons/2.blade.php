@extends('singeo.lead-gen.improve-any-voice.lesson-page-layout')

@section('title')
    The Most Useful Vocal Exercise
@stop

@section('video')
    <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/543823457" frameborder="0" allowfullscreen></iframe>
@stop

@section('lesson-number', 'Lesson 2 of 7')

@section('previous')
    /improve-any-voice/lessons/1
@stop

@section('next')
    /improve-any-voice/lessons/3
@stop

@section('prev-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-1.png')

@section('next-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-3.png')

@section('assets')
    @include('singeo.lead-gen.improve-any-voice._assignment-resources', [
        "title" => "Bubble Exercise (Lower Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/1-bubble-lower.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833904",
    ])
    @include('singeo.lead-gen.improve-any-voice._assignment-resources', [
        "title" => "Bubble Exercise (Higher Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/1-bubble-higher.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833751",
    ])
@stop
