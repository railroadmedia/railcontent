@extends('guitareo.lead-gen.toolbox.soloing-pentatonic.lesson')

@section('subtitle')
    Practice Along
@endsection

@section('video', 'https://player.vimeo.com/video/192367843')

@section('current-lesson-number', 8)

@section('previous', '/toolbox/lessons/soloing-with-minor-pentatonic-scales/7')

@section('prev-thumb', 'https://i.vimeocdn.com/video/603745117-48a05225c9818977bbe6ec88e43e738093f9881fffef99337e75a9b08e337d99-d?mw=1000&mh=563')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track No Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track With Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/e-minor-pentatonic-static-click.mp3"
    ])
@endsection
