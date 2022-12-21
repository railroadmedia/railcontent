@extends('pianote.lead-gen.7-days-to-sight-reading.lesson-page')

@section('subtitle', 'Musical Patterns')

@section('video', '//player.vimeo.com/video/753900349')

@section('current-lesson-number', 2)

@section('previous')
    /7-days-to-sight-reading/lessons/day-1
@endsection

@section('next')
    /7-days-to-sight-reading/lessons/day-3
@endsection

@section('prev-thumb', 'https://i.vimeocdn.com/video/1514990478-1456b975745f9f80d5f75f3eca5d0d5b24930da81e55f26d553518f58ced95e7-d?mw=700&mh=393')

@section('next-thumb', 'https://i.vimeocdn.com/video/1514994059-2e6973658803a10097d0352b6243bd708a7e4d39146a679b9016cf79132d67a3-d?mw=1000&mh=563')

@section('assets')
    @include('pianote.lead-gen.partials._assignment-resources', [
        "title" => "Day 2 Exercise",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%202001-1664655543.svg",
        "soundslice" => "955562",
        "score" => true,
        "defaultOpen" => true
    ])
@endsection
