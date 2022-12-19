@extends('guitareo.lead-gen.toolbox.first-solo.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/168665897')

@section('current-lesson-number', 1)

@section('next', '/toolbox/lessons/playing-your-first-guitar-solo/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/573424079-03d9c9c82cacf53aa89ad3affcc9722701ea257d7e5570f97e69db94e2e92ef4-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Playing Your First Solo Resources",
        "zipURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/playing-your-first-solo.zip"
    ])
@endsection
