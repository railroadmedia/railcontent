@extends('guitareo.lead-gen.toolbox.soloing-pentatonic.lesson')

@section('subtitle')
    Scale Shape 6 1
@endsection

@section('video', 'https://player.vimeo.com/video/192367841')

@section('current-lesson-number', 3)

@section('previous', '/toolbox/lessons/soloing-with-minor-pentatonic-scales/2')

@section('next', '/toolbox/lessons/soloing-with-minor-pentatonic-scales/4')

@section('prev-thumb', 'https://i.vimeocdn.com/video/604214743-a2a2d2dbf71c181a78cc689f15a40e4a9b2db6ebd36d2fb89494c7424105e737-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/603725009-e8f7427a7000b2f90a75fbeba662dcb8055c81c920ed9819670307ab6bd41a97-d?mw=1000&mh=563')

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
