@extends('singeo.lead-gen.improve-any-voice.lesson-page-layout')

@section('subtitle')
    The Full Vocal Routine
@stop

@section('video', '//player.vimeo.com/video/543823702')

@section('current-lesson-number', 6)

@section('previous')
    /improve-any-voice/lessons/5
@stop

@section('next')
    /improve-any-voice/lessons/7
@stop

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-5.png')

@section('next-thumb', 'https://i.vimeocdn.com/video/1125685312-50e2683c4aae37fd0bde953dcd962a8ec505a43e31c100ab92f3fb258424342c-d_800')

@section('assets')
    @parent

    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Full Routine (Lower Octave)",
        "mp3URL" => "https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/full-routine-lower.mp3",
        "defaultOpen" => true,
        "vimeo" => "543823736",
    ])
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Full Routine (Higher Octave)",
        "mp3URL" => "https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/full-routine-higher.mp3",
        "defaultOpen" => true,
        "vimeo" => "543823329",
    ])
@stop
