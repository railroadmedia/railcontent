@extends('guitareo.lead-gen.toolbox.changing-chords.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/167037192')

@section('current-lesson-number', 1)

@section('next', '/toolbox/lessons/changing-chords-smoothly/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/571269669-6d043dd73cc383be25744e4aed12c6ad20f1a94fc0aebf3f0cca4de9ff5f3154-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Changing Chords Smoothly Resources",
        "zipURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/changing-chords-smoothly.zip"
    ])
@endsection
