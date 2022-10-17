@extends('drumeo.lead-gen.grooves-of-john-bonham.lesson-page-layout')

@section('title')
    Bonham Triplets
@stop

@section('video', '//player.vimeo.com/video/320571470')

@section('lesson-number', '4')

@section('previous')
    /grooves-of-john-bonham/lessons/3
@stop

@section('next')
    /grooves-of-john-bonham/lessons/5
@stop

@section('prev-thumb', 'https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/Raghav-mehrotra-funky-nasa.png')

@section('next-thumb', 'https://d1923uyy6spedc.cloudfront.net/221067-card-thumbnail-maxres-1551455704')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "#3",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221113-sheet-image-1551466800.svg",
        "soundslice" => "200376",
        "score" => true
    ])
@stop
