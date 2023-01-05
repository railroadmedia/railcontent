@extends('guitareo.lead-gen.starter-kit.heartbreak.lesson')

@section('subtitle')
    Song Structure
@endsection

@section('video', 'https://player.vimeo.com/video/173407385')

@section('current-lesson-number', 6)

@section('previous', '/starter-kit/lessons/heartbreak-avenue/5')

@section('next', '/starter-kit/lessons/heartbreak-avenue/7')

@section('prev-thumb', 'https://i.vimeocdn.com/video/579717931-3018a79aef1565ee77392ce824cf987f56fc0b69c9a84809197e886dbaba2a1b-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/579725313-42acb2d2bae42d6ed67e86fdaad705aded0de5412035e9721862d66e7cd7e71d-d?mw=1100&mh=619')

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
