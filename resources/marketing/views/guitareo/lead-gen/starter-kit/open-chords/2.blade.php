@extends('guitareo.lead-gen.starter-kit.open-chords.lesson')

@section('subtitle')
    Basic Chording Technique
@endsection

@section('video', 'https://player.vimeo.com/video/181099098')

@section('current-lesson-number', 2)

@section('previous', '/starter-kit/lessons/open-chords/1')

@section('next', '/starter-kit/lessons/open-chords/3')

@section('prev-thumb', 'https://i.vimeocdn.com/video/589593047-4a148264b860a4e19d36f24ad68b407f7321b5433591c7db0a823a3321e5b527-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/589656864-fef38a0f9706127ed6364a8f7f6d9d8a1efe4dd0ce82dc16f320c7571fcb503d-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Basic Chording Technique PNG",
        "imgURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/open-chords-1/open-a-d-e-major-chords.png"
    ])
@endsection
