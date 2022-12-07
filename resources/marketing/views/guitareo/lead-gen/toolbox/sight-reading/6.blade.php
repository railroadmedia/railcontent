@extends('guitareo.lead-gen.toolbox.sight-reading.lesson')

@section('subtitle')
    Musical Application
@endsection

@section('video', 'https://player.vimeo.com/video/179247814')

@section('current-lesson-number', 6)

@section('previous', '/toolbox/lessons/sight-reading-essentials/5')

@section('prev-thumb', 'https://i.vimeocdn.com/video/587134161-bb709c3f2912d7d80963d37fa3147e00f05d31f90b3bfcd7cdb9c089682da8e1-d?mw=1000&mh=563')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Reading Music 1 Song - PDF",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/reading-music-1-song.pdf"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Reading Music 1 Song No Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/reading-music-1-song-no-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Reading Music 1 Song Click - MP3",
        "mp3URL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/mp3s/reading-music-1-song-click.mp3"
    ])
@endsection
