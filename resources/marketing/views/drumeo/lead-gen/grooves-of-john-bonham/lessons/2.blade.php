@extends('drumeo.lead-gen.grooves-of-john-bonham.lesson-page-layout')

@section('title')
    "When The Levee Breaks"
@stop

@section('video', '//player.vimeo.com/video/320570725')

@section('lesson-number', '2')

@section('previous')
    /grooves-of-john-bonham/lessons/1
@stop

@section('next')
    /grooves-of-john-bonham/lessons/3
@stop

@section('prev-thumb', 'https://d1923uyy6spedc.cloudfront.net/221063-card-thumbnail-maxres-1551445812')

@section('next-thumb', 'https://d1923uyy6spedc.cloudfront.net/221065-card-thumbnail-maxres-1551454986')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "#1",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/221110-sheet-image-1551465529.svg",
        "soundslice" => "200371",
        "score" => true
    ])
@stop
