@extends('guitareo.lead-gen.starter-kit.heartbreak.lesson')

@section('subtitle')
    The Chords
@endsection

@section('video', 'https://player.vimeo.com/video/173407380')

@section('current-lesson-number', 2)

@section('previous', '/starter-kit/lessons/heartbreak-avenue/1')

@section('next', '/starter-kit/lessons/heartbreak-avenue/3')

@section('prev-thumb', 'https://i.vimeocdn.com/video/579719510-d42a7ccc8fdc9225fe0761fa316407cb177b0bc0c1c55587ffcf07c0c12984f9-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/579721441-172eae1d0cc0194ce02060afa04d49cb39af77e4f8b4cd811555bc037dfd3637-d?mw=1100&mh=619')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "The Chords PNG",
        "imgURL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/images/heartbreak-chords.png"
    ])
@endsection
