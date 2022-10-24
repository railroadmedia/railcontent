@extends('guitareo.lead-gen.starter-kit.heartbreak.lesson')

@section('subtitle')
    Song A Section
@endsection

@section('video', 'https://player.vimeo.com/video/173407381')

@section('current-lesson-number', 4)

@section('previous', '/starter-kit/lessons/heartbreak-avenue/3')

@section('next', '/starter-kit/lessons/heartbreak-avenue/5')

@section('prev-thumb', 'https://i.vimeocdn.com/video/579721441-172eae1d0cc0194ce02060afa04d49cb39af77e4f8b4cd811555bc037dfd3637-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/579717931-3018a79aef1565ee77392ce824cf987f56fc0b69c9a84809197e886dbaba2a1b-d?mw=1100&mh=619')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Tabs & Sheet Music",
        "pdfURL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/pdf/heartbreak-avenue.pdf"
    ])
@endsection
