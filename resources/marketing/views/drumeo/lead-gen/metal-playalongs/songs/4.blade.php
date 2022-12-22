@extends('drumeo.lead-gen.metal-playalongs.lesson-page-layout')

@section('title')
    Basic Metal (Mike Michalkow)
@stop

@section('video', '//player.vimeo.com/video/538801358')

@section('lesson-number', '4')

@section('previous')
    /metal-playalongs/songs/3
@stop

@section('next')
    /metal-playalongs/songs/5
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Double+Bass.jpg')

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Hypnotized.jpg')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "imgURL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/drumeo-pa-basic-metal-01.svg",
    ])
@stop
