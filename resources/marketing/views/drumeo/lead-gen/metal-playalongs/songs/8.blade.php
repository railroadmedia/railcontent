@extends('drumeo.lead-gen.metal-playalongs.lesson-page-layout')

@section('title')
    Brotherhood Of The Snake (Gene Hoglan)
@stop

@section('video', '//player.vimeo.com/video/274582283')

@section('lesson-number', '8')

@section('previous')
    /metal-playalongs/songs/7
@stop

@section('next')
    /metal-playalongs/songs/9
@stop

@section('prev-thumb', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/metal-playalongs/Opus+I+Excerpt%2C+No.5.jpg')

@section('next-thumb', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/metal-playalongs/Teratogenesis.jpg')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Song Chart",
        "imgURL" => "https://d1923uyy6spedc.cloudfront.net/drumeo-pa225-brotherhood-of-the-snake.png",
    ])
@stop
