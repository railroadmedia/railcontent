@extends('singeo.lead-gen.improve-any-voice.lesson-page-layout')

@section('title')
    The Strength Building, Pitch Accuracy Exercise
@stop

@section('video')
    <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/543823601" frameborder="0" allowfullscreen></iframe>
@stop

@section('lesson-number', 'Lesson 4 of 7')

@section('previous')
    /improve-any-voice/lessons/3
@stop

@section('next')
    /improve-any-voice/lessons/5
@stop

@section('prev-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-3.png')

@section('next-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-5.png')

@section('assets')
    @include('singeo.lead-gen.improve-any-voice._assignment-resources', [
        "title" => "Creaky Door Exercise (Lower Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/3-creaky-door-lower.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833704",
    ])
    @include('singeo.lead-gen.improve-any-voice._assignment-resources', [
        "title" => "Creaky Door Exercise (Higher Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/3-creaky-door-higher.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833838",
    ])
@stop