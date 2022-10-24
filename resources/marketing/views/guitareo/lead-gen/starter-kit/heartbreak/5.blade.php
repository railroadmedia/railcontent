@extends('guitareo.lead-gen.starter-kit.heartbreak.lesson')

@section('subtitle')
    Song B Section
@endsection

@section('video', 'https://player.vimeo.com/video/173407383')

@section('current-lesson-number', 5)

@section('previous', '/starter-kit/lessons/heartbreak-avenue/4')

@section('next', '/starter-kit/lessons/heartbreak-avenue/6')

@section('prev-thumb', 'https://i.vimeocdn.com/video/579718599-099c8d821bbd6f38cb7aa55f7b3c50ea2e990489f903a6821a2e7653f6049f1d-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/579711765-2decd6304436925813433c7bec1f5dba5e6b0297bee4e4a3d0326bb72f97dc6d-d?mw=1100&mh=619')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Tabs & Sheet Music",
        "pdfURL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/pdf/heartbreak-avenue.pdf"
    ])
@endsection
