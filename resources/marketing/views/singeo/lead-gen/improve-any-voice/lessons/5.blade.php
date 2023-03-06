@extends('singeo.lead-gen.improve-any-voice.lesson-page-layout')

@section('subtitle')
    The Range Builder Exercise
@stop

@section('video', '//player.vimeo.com/video/543823668')

@section('current-lesson-number', 5)

@section('previous')
    /improve-any-voice/lessons/4
@stop

@section('next')
    /improve-any-voice/lessons/6
@stop

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-4.png')

@section('next-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-6.png')

@section('assets')
    @parent

    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Nay Exercise (Lower Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/4-nay-lower.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833733",
    ])
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Nay Exercise (Higher Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/4-nay-higher.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833880",
    ])
@stop
