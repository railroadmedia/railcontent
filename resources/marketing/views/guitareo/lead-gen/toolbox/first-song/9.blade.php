@extends('guitareo.lead-gen.toolbox.first-song.lesson')

@section('subtitle')
    Musical Application
@endsection

@section('video', 'https://player.vimeo.com/video/167499060')

@section('current-lesson-number', 9)

@section('previous', '/toolbox/lessons/playing-your-first-song/8')

@section('prev-thumb', 'https://i.vimeocdn.com/video/571840719-d07290be5f2f6cb056a8927a8d305a86f13c61126443f419bafa49e78a0b1a14-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "A2 D2 Groove No Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/a2-d2-groove-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "A2 D2 Groove Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/a2-d2-groove-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "A2 D2 Groove Notation - PDF",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/a2-d2-groove.pdf"
    ])
@endsection
