@extends('guitareo.lead-gen.starter-kit.open-chords.lesson')

@section('subtitle')
    Practice Along
@endsection

@section('video', 'https://player.vimeo.com/video/181099162')

@section('current-lesson-number', 5)

@section('previous', '/starter-kit/lessons/open-chords/4')

@section('next', '/starter-kit/lessons/open-chords/6')

@section('prev-thumb', 'https://i.vimeocdn.com/video/589685775-3bc41ce35ee43cff9978895b721468ec236ede3df7367f7ca3c345f24875ae8c-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/589632976-327c955a812ac3fe56effaa3de65a9f9559282a813e1254b212ccd4f6f294fa0-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Practice Along PNG 1",
        "imgURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/open-chords-1/open-a-d-e-major-chords.png"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Practice Along PNG 2",
        "imgURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/open-chords-1/open-chords-1-examples.png"
    ])
@endsection
