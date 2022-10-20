@extends('guitareo.lead-gen.toolbox.soloing-pentatonic.lesson')

@section('subtitle')
    Emphasizing The Root Notes
@endsection

@section('video', 'https://player.vimeo.com/video/192367842')

@section('current-lesson-number', 4)

@section('previous', '/toolbox/lessons/soloing-with-minor-pentatonic-scales/3')

@section('next', '/toolbox/lessons/soloing-with-minor-pentatonic-scales/5')

@section('prev-thumb', 'https://i.vimeocdn.com/video/603758552-1d739849b6b194737f20e972373c0e90721a612513975a6d087cd6b7b38607e4-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/603734323-e525808dc95e402526d3659bc06bbb42af04eec843597f20bbdbfa1884f79f61-d?mw=1000&mh=563')

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
