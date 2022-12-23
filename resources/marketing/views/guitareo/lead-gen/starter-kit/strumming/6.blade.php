@extends('guitareo.lead-gen.starter-kit.strumming.lesson')

@section('subtitle')
    Practice Along
@endsection

@section('video', 'https://player.vimeo.com/video/182874376')

@section('current-lesson-number', 6)

@section('previous', '/starter-kit/lessons/strumming/5')

@section('next', '/starter-kit/lessons/strumming/7')

@section('prev-thumb', 'https://i.vimeocdn.com/video/591974785-81125dcce7f73d7cbb21e43caebbf61d4116f251993562206e35f328203681f9-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/591975257-b4d7193d3e95396cc398aab2a0514cc96265797f5e44e2ac59fd9b3f81a9c15b-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Strumming Examples 1-4 PDF",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/strumming-1-examples.pdf"
    ])
@endsection
