@extends('drumeo.lead-gen.free-playalongs.lesson-page-layout')

@section('title')
    Funky NASA (Raghav Mehrotra)
@stop

@section('video', '//player.vimeo.com/video/371460235')

@section('lesson-number', '3')

@section('previous')
    /free-playalongs/songs/2
@stop

@section('next')
    /free-playalongs/songs/4
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/Rashid-williams-Rock-out.png')

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/thomas-pridgen-hypnotized.png')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/236563-sheet-image-1573086392.svg",
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/funky-nasa/funky-nasa-drums-false-click-false.mp3"
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "MP3 With Metronome",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/funky-nasa/funky-nasa-drums-false-click-true.mp3"
    ])
@stop
