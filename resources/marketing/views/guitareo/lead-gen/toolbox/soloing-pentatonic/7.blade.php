@extends('guitareo.lead-gen.toolbox.soloing-pentatonic.lesson')

@section('subtitle')
    Minor Pentatonic Scale Licks
@endsection

@section('video', 'https://player.vimeo.com/video/192367840')

@section('current-lesson-number', 7)

@section('previous', '/toolbox/lessons/soloing-with-minor-pentatonic-scales/6')

@section('next', '/toolbox/lessons/soloing-with-minor-pentatonic-scales/8')

@section('prev-thumb', 'https://i.vimeocdn.com/video/603752760-ded001121e940d534ce72d84aef1a8de95456371579c0bef56b137e5856db00b-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/603732916-b6c37cba3ed9f5399e25f43eaa155ccd7639863e02f5f5495c0a1b2a90053964-d?mw=1000&mh=563')

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
