@extends('guitareo.lead-gen.toolbox.legato.lesson')

@section('subtitle')
    Musical Application
@endsection

@section('video', 'https://player.vimeo.com/video/193949188')

@section('current-lesson-number', 8)

@section('previous', '/toolbox/lessons/legato-hammer-ons-pull-offs/7')

@section('prev-thumb', 'https://i.vimeocdn.com/video/606426087-990a8b74c5f261003e19880e932252fda8aa0041844cd4a9404b7c2e1f14e67a-d?mw=1000&mh=563')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track No Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/legato-technique-1-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track With Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/legato-technique-1-click.mp3"
    ])
@endsection
