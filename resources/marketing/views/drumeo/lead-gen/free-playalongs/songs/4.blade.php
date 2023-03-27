@extends('drumeo.lead-gen.free-playalongs.lesson-page-layout')

@section('title')
    Hypnotized (Thomas Pridgen)
@stop

@section('video', '//player.vimeo.com/video/266779491')

@section('lesson-number', '4')

@section('previous')
    /free-playalongs/songs/3
@stop

@section('next')
    /free-playalongs/songs/5
@stop

@section('prev-thumb', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/free-playalongs/Raghav-mehrotra-funky-nasa.png')

@section('next-thumb', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/free-playalongs/kaz-rodriguez-drum-e-o.png')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/drumeo-pa224-hypnotized.png",
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/hypnotized/hypnotized-drums-false-click-false.mp3"
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 With Metronome",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/hypnotized/hypnotized-drums-false-click-true.mp3"
    ])
@stop
