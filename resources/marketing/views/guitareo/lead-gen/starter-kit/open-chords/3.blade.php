@extends('guitareo.lead-gen.starter-kit.open-chords.lesson')

@section('subtitle')
    Open A, D, & E Major Chords
@endsection

@section('video', 'https://player.vimeo.com/video/181099143')

@section('current-lesson-number', 3)

@section('previous', '/starter-kit/lessons/open-chords/2')

@section('next', '/starter-kit/lessons/open-chords/4')

@section('prev-thumb', 'https://i.vimeocdn.com/video/589622533-6c155ed671dfc5c0391c5a82888729703d4223e538866d144d56a35ddd67b58d-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/589685775-3bc41ce35ee43cff9978895b721468ec236ede3df7367f7ca3c345f24875ae8c-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Basic Chording Technique PNG",
        "imgURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/open-chords-1/open-a-d-e-major-chords.png"
    ])
@endsection
