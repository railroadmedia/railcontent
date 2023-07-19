@extends('singeo.lead-gen.improve-any-voice.lesson-page-layout')

@section('subtitle')
    The Strength Building, Pitch Accuracy Exercise
@stop

@section('video', '//player.vimeo.com/video/543823601')

@section('current-lesson-number', 4)

@section('previous')
    /improve-any-voice/lessons/3
@stop

@section('next')
    /improve-any-voice/lessons/5
@stop

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=95/https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-3.png')

@section('next-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=95/https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-5.png')

@section('assets')
    @parent

    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Creaky Door Exercise (Lower Octave)",
        "mp3URL" => "https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/3-creaky-door-lower.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833704",
    ])
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Creaky Door Exercise (Higher Octave)",
        "mp3URL" => "https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/3-creaky-door-higher.mp3",
        "defaultOpen" => true,
        "vimeo" => "543833838",
    ])
@stop
