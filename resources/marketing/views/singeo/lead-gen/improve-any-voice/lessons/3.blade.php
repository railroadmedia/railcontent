@extends('singeo.lead-gen.improve-any-voice.lesson-page-layout')

@section('subtitle')
    The Perfect Balance Exercise
@stop

@section('video', '//player.vimeo.com/video/543823544')

@section('current-lesson-number', 3)

@section('previous')
    /improve-any-voice/lessons/2
@stop

@section('next')
    /improve-any-voice/lessons/4
@stop

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-2.png')

@section('next-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-4.png')

@section('assets')
    @parent

    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "VVV Exercise (Lower Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/2-vvv-lower.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833682",
    ])
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "VVV Exercise (Higher Octave)",
        "mp3URL" => "https://singeo.s3.amazonaws.com/lead-gen/4-exercises/2-vvv-higher.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833795",
    ])
@stop
