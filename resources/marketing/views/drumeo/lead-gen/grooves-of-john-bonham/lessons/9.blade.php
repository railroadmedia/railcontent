@extends('drumeo.lead-gen.grooves-of-john-bonham.lesson-page-layout')

@section('title')
    "Rock And Roll"
@stop

@section('video', '//player.vimeo.com/video/320573002')

@section('lesson-number', '9')

@section('previous')
    /grooves-of-john-bonham/lessons/8
@stop

@section('next')
    /grooves-of-john-bonham/lessons/10
@stop

@section('prev-thumb', 'https://d1923uyy6spedc.cloudfront.net/221070-card-thumbnail-maxres-1551456686')

@section('next-thumb', 'https://d1923uyy6spedc.cloudfront.net/221072-card-thumbnail-maxres-1551457382')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "#8 Intro",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221120-sheet-image-1551470522.svg",
        "soundslice" => "200401",
        "score" => true
    ])
    @include('lead-gen.partials._assignment-resources', [
        "title" => "#8b Outro",
        "assignmentID" => 'songSC2',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221121-sheet-image-1551470787.svg",
        "soundslice" => "200402",
        "score" => true
    ])
@stop
