@extends('singeo.lead-gen.improve-any-voice.lesson-page-layout')

@section('title')
    The Range Builder Exercise
@stop

@section('video')
    <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/543823668" frameborder="0" allowfullscreen></iframe>
@stop

@section('lesson-number', 'Lesson 5 of 7')

@section('previous')
    /improve-any-voice/lessons/4
@stop

@section('next')
    /improve-any-voice/lessons/6
@stop

@section('prev-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-4.png')

@section('next-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-6.png')

@section('assets')
    @include('singeo.lead-gen.improve-any-voice._assignment-resources', [
        "title" => "Nay Exercise (Lower Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/4-nay-lower.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833733",
    ])
    @include('singeo.lead-gen.improve-any-voice._assignment-resources', [
        "title" => "Nay Exercise (Higher Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/4-nay-higher.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833880",
    ])
@stop