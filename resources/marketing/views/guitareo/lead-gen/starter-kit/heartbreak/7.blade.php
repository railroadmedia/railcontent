@extends('guitareo.lead-gen.starter-kit.heartbreak.lesson')

@section('subtitle')
    Performance
@endsection

@section('video', 'https://player.vimeo.com/video/173407378')

@section('current-lesson-number', 7)

@section('previous', '/starter-kit/lessons/heartbreak-avenue/6')

@section('prev-thumb', 'https://i.vimeocdn.com/video/579711765-2decd6304436925813433c7bec1f5dba5e6b0297bee4e4a3d0326bb72f97dc6d-d?mw=1100&mh=619')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Full Band Jam Track",
        "mp3URL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/mp3/heartbreak-avenue-full-band.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Tabs & Sheet Music",
        "pdfURL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/pdf/heartbreak-avenue.pdf"
    ])
@endsection
