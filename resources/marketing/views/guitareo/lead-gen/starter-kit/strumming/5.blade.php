@extends('guitareo.lead-gen.starter-kit.strumming.lesson')

@section('subtitle')
    Downstrokes & Upstrokes Together
@endsection

@section('video', 'https://player.vimeo.com/video/182874373')

@section('current-lesson-number', 5)

@section('previous', '/starter-kit/lessons/strumming/4')

@section('next', '/starter-kit/lessons/strumming/6')

@section('prev-thumb', 'https://i.vimeocdn.com/video/591974884-50339e825985ece7d67531d673aea30011d7f17386a7c3ab466c480d5790110a-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/591974955-505af73ef5c1deeae618d697e0e9caa7acf1e47392596a7d863fc1c4cae5b3ed-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Strumming Examples 1-4 PDF",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/strumming-1-examples.pdf"
    ])
@endsection
