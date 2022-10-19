@extends('drumeo.lead-gen.grooves-of-john-bonham.lesson-page-layout')

@section('title')
    "Good Times Bad Times"
@stop

@section('video', '//player.vimeo.com/video/320571796')

@section('lesson-number', '5')

@section('previous')
    /grooves-of-john-bonham/lessons/4
@stop

@section('next')
    /grooves-of-john-bonham/lessons/6
@stop

@section('prev-thumb', 'https://d1923uyy6spedc.cloudfront.net/221066-card-thumbnail-maxres-1551455602')

@section('next-thumb', 'https://d1923uyy6spedc.cloudfront.net/221068-card-thumbnail-maxres-1551456070')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "#4",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221115-sheet-image-1551466942.svg",
        "soundslice" => "200378",
        "score" => true
    ])
@stop
