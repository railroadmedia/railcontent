@extends('drumeo.lead-gen.free-playalongs.lesson-page-layout')

@section('title')
    Just A Second (Todd Sucherman)
@stop

@section('video', '//player.vimeo.com/video/534524172')

@section('lesson-number', '9')

@section('previous')
    /free-playalongs/songs/8
@stop

@section('prev-thumb', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/free-playalongs/tony-coleman-shuffle.png')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/drumeo-pa-just-a-second-01.svg",
        "soundslice" => "thQDc",
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/just-a-second-pa-no-drums-no-click.mp3"
    ])
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 With Metronome",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/just-a-second-pa-no-drums-click.mp3"
    ])
@stop
