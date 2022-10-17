@extends('drumeo.lead-gen.metal-playalongs.lesson-page-layout')

@section('title')
    The Marzear Labyrinth (Derek Roddy)
@stop

@section('video', '//player.vimeo.com/video/201214928')

@section('lesson-number', '1')

@section('next')
    /metal-playalongs/songs/2
@stop

@section('next-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Nightmares.jpg')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "imgURL" => "https://dz5i3s4prcfun.cloudfront.net/00-archive/jpegs/drumeo-pa206-the-marzear-labyrinth.png",
    ])
@stop
