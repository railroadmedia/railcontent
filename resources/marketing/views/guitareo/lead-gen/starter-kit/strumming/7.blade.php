@extends('guitareo.lead-gen.starter-kit.strumming.lesson')

@section('subtitle')
    Musical Application
@endsection

@section('video', 'https://player.vimeo.com/video/182874369')

@section('current-lesson-number', 7)

@section('previous', '/starter-kit/lessons/strumming/6')

@section('prev-thumb', 'https://i.vimeocdn.com/video/591974955-505af73ef5c1deeae618d697e0e9caa7acf1e47392596a7d863fc1c4cae5b3ed-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Strumming Examples 1-4 PDF",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/strumming-1-examples.pdf"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 No Click",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/strumming-1-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "MP3 With Click",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/strumming-1-click.mp3"
    ])
@endsection
