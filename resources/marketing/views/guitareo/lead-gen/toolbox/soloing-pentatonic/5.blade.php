@extends('guitareo.lead-gen.toolbox.soloing-pentatonic.lesson')

@section('subtitle')
    Sing The Notes
@endsection

@section('video', 'https://player.vimeo.com/video/192367848')

@section('current-lesson-number', 5)

@section('previous', '/toolbox/lessons/soloing-with-minor-pentatonic-scales/4')

@section('next', '/toolbox/lessons/soloing-with-minor-pentatonic-scales/6')

@section('prev-thumb', 'https://i.vimeocdn.com/video/603725009-e8f7427a7000b2f90a75fbeba662dcb8055c81c920ed9819670307ab6bd41a97-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/603752760-ded001121e940d534ce72d84aef1a8de95456371579c0bef56b137e5856db00b-d?mw=1000&mh=563')

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
