@extends('guitareo.lead-gen.starter-kit.open-chords.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/181099081')

@section('current-lesson-number', 1)

@section('next', '/starter-kit/lessons/open-chords/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/589622533-6c155ed671dfc5c0391c5a82888729703d4223e538866d144d56a35ddd67b58d-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Open Chords Resources",
        "zipURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/open-chords-1.zip"
    ])
@endsection
