@extends('drumeo.lead-gen.grooves-of-john-bonham.lesson-page-layout')

@section('title')
    "Moby Dick"
@stop

@section('video', '//player.vimeo.com/video/320573882')

@section('lesson-number', '10')

@section('previous')
    /grooves-of-john-bonham/lessons/9
@stop

@section('next')
    /grooves-of-john-bonham/lessons/11
@stop

@section('prev-thumb', 'https://d1923uyy6spedc.cloudfront.net/221071-card-thumbnail-maxres-1551456914')

@section('next-thumb', 'https://d1923uyy6spedc.cloudfront.net/221073-card-thumbnail-maxres-1551458585')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "#9a",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221122-sheet-image-1551471371.svg",
        "soundslice" => "200406",
        "score" => true
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "#9b",
        "assignmentID" => 'songSC2',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221123-sheet-image-1551471878.svg",
        "soundslice" => "200408",
        "score" => true
    ])
@stop
