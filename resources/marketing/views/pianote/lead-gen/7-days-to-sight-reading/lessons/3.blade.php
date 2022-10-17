@extends('pianote.lead-gen.7-days-to-sight-reading.lesson-page')

@section('subtitle', 'Intervals')

@section('video', '//player.vimeo.com/video/753902457')

@section('current-lesson-number', 3)

@section('previous')
    /7-days-to-sight-reading/lessons/day-2
@endsection

@section('next')
    /7-days-to-sight-reading/lessons/day-4
@endsection

@section('prev-thumb', 'https://i.vimeocdn.com/video/1514991832-c6408142816720371226a0e44c32cc5048dc1af7241b408f5d3d30b096b75dcc-d?mw=700&mh=393')

@section('next-thumb', 'https://i.vimeocdn.com/video/1515022546-b4bbbf0ece20333790cb8151f2c395c255825aebaa02b871cbeaaf53046e19ff-d?mw=1000&mh=563')

@section('assets')
    @include('pianote.lead-gen.partials._assignment-resources', [
        "title" => "Day 3 Exercise",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%203001-1664655618.svg",
        "soundslice" => "955569",
        "score" => true,
        "defaultOpen" => true
    ])
@endsection
