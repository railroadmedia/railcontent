@extends('guitareo.lead-gen.starter-kit.strumming.lesson')

@section('subtitle')
    Upstrokes
@endsection

@section('video', 'https://player.vimeo.com/video/182874372')

@section('current-lesson-number', 4)

@section('previous', '/starter-kit/lessons/strumming/3')

@section('next', '/starter-kit/lessons/strumming/5')

@section('prev-thumb', 'https://i.vimeocdn.com/video/592844038-489afcf8b1244ee2e12f4a540354127044ece36d8be1a560759ca3bc41eb62da-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/591974785-81125dcce7f73d7cbb21e43caebbf61d4116f251993562206e35f328203681f9-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Strumming Examples 1-4 PDF",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/strumming-1-examples.pdf"
    ])
@endsection
