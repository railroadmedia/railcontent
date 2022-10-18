@extends('drumeo.lead-gen.free-playalongs.lesson-page-layout')

@section('title')
    Straight Reggae (Sarah Thawer)
@stop

@section('video', '//player.vimeo.com/video/471541648')

@section('lesson-number', '7')

@section('previous')
    /free-playalongs/songs/6
@stop

@section('next')
    /free-playalongs/songs/8
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/glen-sobel-7-8-rock.png')

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/tony-coleman-shuffle.png')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/drumeo-pa-reggae-02.svg",
        "soundslice" => "9s-Dc",
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "MP3",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/reggae-straight-pa-no-drums-no-click.mp3"
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "MP3 With Metronome",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/reggae-straight-pa-no-drums-click.mp3"
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "MP3 (Swung)",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/reggae-swing-pa-no-drums-no-click-1630077317.mp3"
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "MP3 (Swung) With Metronome",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/reggae-swing-pa-no-drums-click-1630077276.mp3"
    ])
@stop
