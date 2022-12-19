@extends('pianote.lead-gen.7-days-to-sight-reading.lesson-page')

@section('subtitle', 'Chords & Arpeggios')

@section('video', '//player.vimeo.com/video/753922961')

@section('current-lesson-number', 5)

@section('previous')
    /7-days-to-sight-reading/lessons/day-4
@endsection

@section('next')
    /7-days-to-sight-reading/lessons/day-6
@endsection

@section('prev-thumb', 'https://i.vimeocdn.com/video/1515022546-b4bbbf0ece20333790cb8151f2c395c255825aebaa02b871cbeaaf53046e19ff-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/1515029395-1756cc1c94bc47e78f4cd3249b0ac33a05b5eca857bc64ace7374eee99741f18-d?mw=1000&mh=563')

@section('assets')
    @include('pianote.lead-gen.partials._assignment-resources', [
        "title" => "Day 5 Exercise",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%205001-1664655725.svg",
        "soundslice" => "955571",
        "score" => true,
        "defaultOpen" => true
    ])
@endsection
