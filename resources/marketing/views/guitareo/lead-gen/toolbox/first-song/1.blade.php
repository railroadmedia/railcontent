@extends('guitareo.lead-gen.toolbox.first-song.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/167499055')

@section('current-lesson-number', 1)

@section('next', '/toolbox/lessons/playing-your-first-song/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/571838353-d17d268e6a4c50464e5b0dc79411f4e2c9d9558898cf0313639f116551ea8135-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Playing Your First Song Resources",
        "zipURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/playing-your-first-song.zip"
    ])
@endsection
