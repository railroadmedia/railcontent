@extends('drumeo.lead-gen.metal-playalongs.lesson-page-layout')

@section('title')
    Resurrection Through Fire (Jason Bittner)
@stop

@section('video', '//player.vimeo.com/video/151171143')

@section('lesson-number', '6')

@section('previous')
    /metal-playalongs/songs/5
@stop

@section('next')
    /metal-playalongs/songs/7
@stop

@section('prev-thumb', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/metal-playalongs/Hypnotized.jpg')

@section('next-thumb', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/metal-playalongs/Opus+I+Excerpt%2C+No.5.jpg')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "imgURL" => "https://d1923uyy6spedc.cloudfront.net/1515589078-drumeo-pa140-resurrection-through-fire.png",
    ])
@stop
