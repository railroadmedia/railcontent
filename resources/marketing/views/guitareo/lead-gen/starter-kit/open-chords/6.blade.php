@extends('guitareo.lead-gen.starter-kit.open-chords.lesson')

@section('subtitle')
    Musical Application
@endsection

@section('video', 'https://player.vimeo.com/video/181099168')

@section('current-lesson-number', 6)

@section('previous', '/starter-kit/lessons/open-chords/5')

@section('prev-thumb', 'https://i.vimeocdn.com/video/589652608-7c69bd63e5ef49d7062cb87520fe4827e27025ea50d753320066755b74c65508-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Musical Application PNG",
        "imgURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/open-chords-1/open-a-d-e-major-chords.png"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Musical Application PDF",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/open-chords-1-examples.pdf"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Musical Application MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/open-chords-1-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Musical Application MP3 w/ Click",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/open-chords-1-click.mp3"
    ])
@endsection
