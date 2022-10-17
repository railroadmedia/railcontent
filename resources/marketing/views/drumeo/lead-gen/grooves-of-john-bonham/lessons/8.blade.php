@extends('drumeo.lead-gen.grooves-of-john-bonham.lesson-page-layout')

@section('title')
    "Stairway To Heaven"
@stop

@section('video', '//player.vimeo.com/video/320572518')

@section('lesson-number', '8')

@section('previous')
    /grooves-of-john-bonham/lessons/7
@stop

@section('next')
    /grooves-of-john-bonham/lessons/9
@stop

@section('prev-thumb', 'https://d1923uyy6spedc.cloudfront.net/221069-card-thumbnail-maxres-1551456169')

@section('next-thumb', 'https://d1923uyy6spedc.cloudfront.net/221071-card-thumbnail-maxres-1551456914')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "#7a Solo Groove",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221118-sheet-image-1551468088.svg",
        "soundslice" => "200384",
        "score" => true
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "#7b Fill",
        "assignmentID" => 'songSC2',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221119-sheet-image-1551468294.svg",
        "soundslice" => "200386",
        "score" => true
    ])
@stop
