@extends('guitareo.lead-gen.starter-kit.open-chords.lesson')

@section('subtitle')
    Changing Between A, D, & E Major
@endsection

@section('video', 'https://player.vimeo.com/video/181099154')

@section('current-lesson-number', 4)

@section('previous', '/starter-kit/lessons/open-chords/3')

@section('next', '/starter-kit/lessons/open-chords/5')

@section('prev-thumb', 'https://i.vimeocdn.com/video/589656864-fef38a0f9706127ed6364a8f7f6d9d8a1efe4dd0ce82dc16f320c7571fcb503d-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/589652608-7c69bd63e5ef49d7062cb87520fe4827e27025ea50d753320066755b74c65508-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Changing Between A, D, & E Major PDF",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/open-chords-1-examples.pdf"
    ])
@endsection
