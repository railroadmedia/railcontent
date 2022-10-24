@extends('guitareo.lead-gen.toolbox.first-solo.lesson')

@section('subtitle')
    Musical Application
@endsection

@section('video', 'https://player.vimeo.com/video/168665894')

@section('current-lesson-number', 8)

@section('previous', '/toolbox/lessons/playing-your-first-guitar-solo/7')

@section('prev-thumb', 'https://i.vimeocdn.com/video/573460326-6d78bdb725f89ef8a9cf9bbe8198380174563a28bb4134b01a022964fa2262df-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "A2 D2 Progression No Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/a2-d2-progression-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "A2 D2 Progression Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/a2-d2-progression-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Examples 1 &amp; 2 - PDF",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/exercises-1-and-2.pdf"
    ])
@endsection
