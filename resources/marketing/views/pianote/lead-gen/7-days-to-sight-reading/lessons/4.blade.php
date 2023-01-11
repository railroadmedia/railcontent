@extends('pianote.lead-gen.7-days-to-sight-reading.lesson-page')

@section('subtitle', 'Play a Song')

@section('video', '//player.vimeo.com/video/753917225')

@section('current-lesson-number', 4)

@section('previous')
    /7-days-to-sight-reading/lessons/day-3
@endsection

@section('next')
    /7-days-to-sight-reading/lessons/day-5
@endsection

@section('prev-thumb', 'https://i.vimeocdn.com/video/1514994059-2e6973658803a10097d0352b6243bd708a7e4d39146a679b9016cf79132d67a3-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/1515026590-10472ccad6746bedd5723115849cd66091c9570505f00d57b58e54bcb9ba2730-d?mw=1000&mh=563')

@section('assets')
    @include('pianote.lead-gen.partials._assignment-resources', [
        "title" => "Day 4 Exercise",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%204001-1664655669.svg",
        "soundslice" => "955570",
        "score" => true,
        "defaultOpen" => true
    ])
@endsection
