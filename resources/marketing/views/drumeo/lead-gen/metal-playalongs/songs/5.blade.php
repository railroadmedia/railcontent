@extends('drumeo.lead-gen.metal-playalongs.lesson-page-layout')

@section('title')
    Hypnotized (Thomas Pridgen)
@stop

@section('video', '//player.vimeo.com/video/266779491')

@section('lesson-number', '5')

@section('previous')
    /metal-playalongs/songs/4
@stop

@section('next')
    /metal-playalongs/songs/6
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Basic+Metal.jpg')

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Resurrection+Through+Fire.jpg')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "imgURL" => "https://d1923uyy6spedc.cloudfront.net/drumeo-pa224-hypnotized.png",
    ])
@stop
