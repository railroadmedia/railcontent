@extends('guitareo.lead-gen.toolbox.sight-reading.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/179247804')

@section('current-lesson-number', 1)

@section('next', '/toolbox/lessons/sight-reading-essentials/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/587139107-0fce8f93d6b6bc4cb60da70ccefccbe74cde43f6e71dd0cbad5999ece1b5a76b-d?mw=1000&mh=563')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Sight Reading Essentials Resources",
        "zipURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/reading-music-1.zip"
    ])
@endsection
