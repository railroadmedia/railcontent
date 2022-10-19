@extends('drumeo.lead-gen.free-playalongs.lesson-page-layout')

@section('title')
    Tony Coleman Shuffle (Tony Coleman)
@stop

@section('video', '//player.vimeo.com/video/342294294')

@section('lesson-number', '8')

@section('previous')
    /free-playalongs/songs/7
@stop

@section('next')
    /free-playalongs/songs/9
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/sarah-thawer-straight-reggae.png')

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/todd-sucherman-just-a-second.png')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/226671-sheet-image-1560530045.svg",
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/tony-coleman-shuffle/tony-coleman-shuffle-drums-false-click-false.mp3"
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 With Metronome",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/tony-coleman-shuffle/tony-coleman-shuffle-drums-false-click-true.mp3"
    ])
@stop
