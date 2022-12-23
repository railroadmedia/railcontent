@extends('pianote.lead-gen.7-days-to-sight-reading.lesson-page')

@section('subtitle', 'Understanding Rhythm')

@section('video', '//player.vimeo.com/video/753925248')

@section('current-lesson-number', 6)

@section('previous')
    /7-days-to-sight-reading/lessons/day-5
@endsection

@section('next')
    /7-days-to-sight-reading/lessons/day-7
@endsection

@section('prev-thumb', 'https://i.vimeocdn.com/video/1515026590-10472ccad6746bedd5723115849cd66091c9570505f00d57b58e54bcb9ba2730-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/1515033645-4566ef735c380776158a57e4a67a136cdd43f98667b8c102edf237d7fd3eecb8-d?mw=1000&mh=563')

@section('assets')
    @include('pianote.lead-gen.partials._assignment-resources', [
        "title" => "Day 6 Exercise",
        "assignmentID" => 'songSC',
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/7%20Days%20To%20SIght%20Reading%20-%206001-1664655781.svg",
        "soundslice" => "955573",
        "score" => true,
        "defaultOpen" => true
    ])
@endsection
