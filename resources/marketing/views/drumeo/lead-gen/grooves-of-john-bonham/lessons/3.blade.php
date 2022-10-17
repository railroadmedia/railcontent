@extends('drumeo.lead-gen.grooves-of-john-bonham.lesson-page-layout')

@section('title')
    "Fool In The Rain"
@stop

@section('video', '//player.vimeo.com/video/320571012')

@section('lesson-number', '3')

@section('previous')
    /grooves-of-john-bonham/lessons/2
@stop

@section('next')
    /grooves-of-john-bonham/lessons/4
@stop

@section('prev-thumb', 'https://d1923uyy6spedc.cloudfront.net/221064-card-thumbnail-maxres-1551454221')

@section('next-thumb', 'https://d1923uyy6spedc.cloudfront.net/221066-card-thumbnail-maxres-1551455602')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "#2a Hi-Hat Groove",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221111-sheet-image-1551465999.svg",
        "soundslice" => "200372",
        "score" => true
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "#2b Ride Groove",
        "assignmentID" => 'songSC2',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221112-sheet-image-1551466569.svg",
        "soundslice" => "200375",
        "score" => true
    ])
@stop
