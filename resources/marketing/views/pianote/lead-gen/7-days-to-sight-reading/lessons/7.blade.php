@extends('pianote.lead-gen.7-days-to-sight-reading.lesson-page')

@section('subtitle', 'Putting it All Together')

@section('video', '//player.vimeo.com/video/753928040')

@section('current-lesson-number', 7)

@section('previous')
    /7-days-to-sight-reading/lessons/day-6
@endsection

@section('prev-thumb', 'https://i.vimeocdn.com/video/1515029395-1756cc1c94bc47e78f4cd3249b0ac33a05b5eca857bc64ace7374eee99741f18-d?mw=1000&mh=563')

@section('assets')
    @include('pianote.lead-gen.partials._assignment-resources', [
        "title" => "Day 7 Exercise",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%207001-1664655908.svg",
        "soundslice" => "955575",
        "score" => true,
        "defaultOpen" => true
    ])
@endsection
