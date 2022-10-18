@extends('drumeo.lead-gen.grooves-of-john-bonham.lesson-page-layout')

@section('title')
    "Immigrant Song"
@stop

@section('video', '//player.vimeo.com/video/320572228')

@section('lesson-number', '7')

@section('previous')
    /grooves-of-john-bonham/lessons/6
@stop

@section('next')
    /grooves-of-john-bonham/lessons/8
@stop

@section('prev-thumb', 'https://d1923uyy6spedc.cloudfront.net/221068-card-thumbnail-maxres-1551456070')

@section('next-thumb', 'https://d1923uyy6spedc.cloudfront.net/221070-card-thumbnail-maxres-1551456686')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "#6",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221117-sheet-image-1551467473.svg",
        "soundslice" => "200381",
        "score" => true
    ])
@stop
