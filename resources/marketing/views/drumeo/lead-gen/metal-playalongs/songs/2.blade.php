@extends('drumeo.lead-gen.metal-playalongs.lesson-page-layout')

@section('title')
    Nightmares (Jared Falk)
@stop

@section('video', '//player.vimeo.com/video/286086238')

@section('lesson-number', '2')

@section('previous')
    /metal-playalongs/songs/1
@stop

@section('next')
    /metal-playalongs/songs/3
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/The+Marzear+Labyrinth.jpg')

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Double+Bass.jpg')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "assignmentID" => 'songSC',
        "imgURL" => "https://d1923uyy6spedc.cloudfront.net/drumeo-pa231-nightmares.svg",
    ])
@stop
