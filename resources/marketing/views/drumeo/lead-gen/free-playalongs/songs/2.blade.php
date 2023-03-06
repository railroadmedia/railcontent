@extends('drumeo.lead-gen.free-playalongs.lesson-page-layout')

@section('title')
    Rock Out (Rashid Williams)
@stop

@section('video', '//player.vimeo.com/video/370373250')

@section('lesson-number', '2')

@section('previous')
    /free-playalongs/songs/1
@stop

@section('next')
    /free-playalongs/songs/3
@stop

@section('prev-thumb', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/free-playalongs/jost-nickel-the-check-in.png')

@section('next-thumb', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/free-playalongs/Raghav-mehrotra-funky-nasa.png')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/236722-sheet-image-1573314094.svg",
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/rock-out/rock-out-drums-false-click-false.mp3"
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 With Metronome",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/rock-out/rock-out-drums-false-click-true.mp3"
    ])
@stop
