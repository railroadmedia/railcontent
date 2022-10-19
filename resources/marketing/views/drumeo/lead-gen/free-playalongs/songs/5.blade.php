@extends('drumeo.lead-gen.free-playalongs.lesson-page-layout')

@section('title')
    Drum-E-O (Kaz Rodriguez)
@stop

@section('video', '//player.vimeo.com/video/558181220')

@section('lesson-number', '5')

@section('previous')
    /free-playalongs/songs/4
@stop

@section('next')
    /free-playalongs/songs/6
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/thomas-pridgen-hypnotized.png')

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/glen-sobel-7-8-rock.png')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/306212-sheet-image-1623079844.svg",
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/drum-e-o/drum-e-o-drums-false-click-false.mp3"
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 With Metronome",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/drum-e-o/drum-e-o-drums-false-click-true.mp3"
    ])
@stop
