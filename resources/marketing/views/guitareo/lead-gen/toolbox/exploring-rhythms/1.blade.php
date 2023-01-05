@extends('guitareo.lead-gen.toolbox.exploring-rhythms.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/179472223')

@section('current-lesson-number', 1)

@section('next', '/toolbox/lessons/exploring-guitar-rhythms/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/587459414-b15d0999348fb4ebc25467d8289ab0e162b6c66767eab2697c9edb2787c71290-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Reading Rhythms 1 Resources",
        "zipURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/reading-rhythms-1.zip"
    ])
@endsection
