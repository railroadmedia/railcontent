@extends('drumeo.lead-gen.free-playalongs.lesson-page-layout')

@section('title')
    7/8 Rock (Glen Sobel)
@stop

@section('video', '//player.vimeo.com/video/546105932')

@section('lesson-number', '6')

@section('previous')
    /free-playalongs/songs/5
@stop

@section('next')
    /free-playalongs/songs/7
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/kaz-rodriguez-drum-e-o.png')

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/sarah-thawer-straight-reggae.png')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/drumeo-pa-7-8-rock-01.svg",
        "soundslice" => "3x-Dc",
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/7-8-rock-pa-no-drums-no-click.mp3"
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "MP3 With Metronome",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/7-8-rock-pa-no-drums-click.mp3"
    ])
@stop
