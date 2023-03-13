@extends('singeo.lead-gen.improve-any-voice.lesson-page-layout')

@section('subtitle')
    The Most Useful Vocal Exercise
@stop

@section('video', '//player.vimeo.com/video/543823457')

@section('current-lesson-number', 2)

@section('previous')
    /improve-any-voice/lessons/1
@stop

@section('next')
    /improve-any-voice/lessons/3
@stop

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-1.png')

@section('next-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-3.png')

@section('assets')
    @parent

    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Bubble Exercise (Lower Octave)",
        "mp3URL" => "https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/1-bubble-lower.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833904",
    ])
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Bubble Exercise (Higher Octave)",
        "mp3URL" => "https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/1-bubble-higher.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833751",
    ])
@stop
