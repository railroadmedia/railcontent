@extends('drumeo.lead-gen.free-playalongs.lesson-page-layout')

@section('title')
    The Check In (Jost Nickel)
@stop

@section('video', '//player.vimeo.com/video/541721200')

@section('lesson-number', '1')

@section('next')
    /free-playalongs/songs/2
@stop

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/Rashid-williams-Rock-out.png')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/301539-sheet-image-1619782863.svg",
        "soundslice" => "WR3Dc",
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://s3.amazonaws.com/drumeo/play-along-resources/the-check-in/the-check-in-drums-false-click-false.mp3"
    ])
@stop
