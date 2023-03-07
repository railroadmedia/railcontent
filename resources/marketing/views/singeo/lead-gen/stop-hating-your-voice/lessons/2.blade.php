@extends('singeo.lead-gen.stop-hating-your-voice.lesson-page-layout')

@section('subtitle')
    Get Control
@stop

@section('video', 'https://www.youtube.com/embed/MY-9Svljta0?rel=0&showinfo=0')

@section('current-lesson-number', 2)

@section('previous')
    /stop-hating-your-voice/lessons/1
@stop

@section('next')
    /stop-hating-your-voice/lessons/3
@stop

@section('prev-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/stop-hating-your-voice/thumb-1.png')

@section('next-thumb', 'https://www.musora.com/musora-cdn/image/width=800,q_60,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/stop-hating-your-voice/thumb-3.png')

@section('description')
    You’ll get control of your voice after this lesson. Follow along with these exercises to build a stronger voice you can be proud of.
@stop

@section('assets')
    @parent

    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Practice Along (Lower Octave)",
        "mp3URL" => "https://d21xeg6s76swyd.cloudfront.net/lead-gen/stop-hating-your-voice/practice-along-lower.mp3",
        "defaultOpen" => true,
    ])
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Practice Along (Higher Octave)",
        "mp3URL" => "https://d21xeg6s76swyd.cloudfront.net/lead-gen/stop-hating-your-voice/practice-along-higher.mp3",
        "defaultOpen" => true,
    ])
@stop
