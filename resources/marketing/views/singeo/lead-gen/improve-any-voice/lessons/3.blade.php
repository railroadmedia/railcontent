@extends('singeo.lead-gen.improve-any-voice.lesson-page-layout')

@section('title')
    The Perfect Balance Exercise
@stop

@section('video')
    <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/543823544" frameborder="0" allowfullscreen></iframe>
@stop

@section('lesson-number', 'Lesson 3 of 7')

@section('previous')
    /improve-any-voice/lessons/2
@stop

@section('next')
    /improve-any-voice/lessons/4
@stop

@section('prev-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-2.png')

@section('next-thumb', 'https://cdn.musora.com/image/fetch/w_800,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-4.png')

@section('assets')
    @include('singeo.lead-gen.improve-any-voice._assignment-resources', [
        "title" => "VVV Exercise (Lower Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/2-vvv-lower.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833682",
    ])
    @include('singeo.lead-gen.improve-any-voice._assignment-resources', [
        "title" => "VVV Exercise (Higher Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/2-vvv-higher.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833795",
    ])
@stop