@extends('drumeo.lead-gen.grooves-of-john-bonham.lesson-page-layout')

@section('title')
    "Black Dog"
@stop

@section('video', '//player.vimeo.com/video/320572050')

@section('lesson-number', '6')

@section('previous')
    /grooves-of-john-bonham/lessons/5
@stop

@section('next')
    /grooves-of-john-bonham/lessons/7
@stop

@section('prev-thumb', 'https://d1923uyy6spedc.cloudfront.net/221067-card-thumbnail-maxres-1551455704')

@section('next-thumb', 'https://d1923uyy6spedc.cloudfront.net/221069-card-thumbnail-maxres-1551456169')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "#5",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221116-sheet-image-1551467292.svg",
        "soundslice" => "200380",
        "score" => true
    ])
@stop
