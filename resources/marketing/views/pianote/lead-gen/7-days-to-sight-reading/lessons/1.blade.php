@extends('pianote.lead-gen.7-days-to-sight-reading.lesson-page')

@section('subtitle', 'The Basics')

@section('video', '//player.vimeo.com/video/753899485')

@section('current-lesson-number', 1)

@section('next')
    /7-days-to-sight-reading/lessons/day-2
@endsection

@section('next-thumb', 'https://i.vimeocdn.com/video/1514991832-c6408142816720371226a0e44c32cc5048dc1af7241b408f5d3d30b096b75dcc-d?mw=700&mh=393')

@section('assets')
    @include('pianote.lead-gen.partials._assignment-resources', [
        "title" => "Day 1 Exercise",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%201001-1664655393.svg",
        "soundslice" => "955555",
        "score" => true,
        "defaultOpen" => true
    ])
@endsection
