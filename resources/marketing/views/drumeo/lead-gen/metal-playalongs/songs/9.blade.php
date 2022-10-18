@extends('drumeo.lead-gen.metal-playalongs.lesson-page-layout')

@section('title')
    Teratogenesis (Ash Pearson)
@stop

@section('video', '//player.vimeo.com/video/154760938')

@section('lesson-number', '9')

@section('previous')
    /metal-playalongs/songs/8
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Brotherhood+Of+The+Snake.jpg')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "imgURL" => "https://d1923uyy6spedc.cloudfront.net/1515594241-drumeo-pa143-teratogenesis.png",
    ])
@stop
