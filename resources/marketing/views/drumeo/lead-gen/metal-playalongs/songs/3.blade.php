@extends('drumeo.lead-gen.metal-playalongs.lesson-page-layout')

@section('title')
    Double Bass (With Alex Rüdinger)
@stop

@section('video', '//player.vimeo.com/video/546106139')

@section('lesson-number', '3')

@section('previous')
    /metal-playalongs/songs/2
@stop

@section('next')
    /metal-playalongs/songs/4
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Nightmares.jpg')

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Basic+Metal.jpg')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "imgURL" => "https://d1923uyy6spedc.cloudfront.net/play-alongs-aug-2021/drumeo-pa-double-bass-01.svg",
    ])
@stop
