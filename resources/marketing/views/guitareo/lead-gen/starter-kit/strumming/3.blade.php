@extends('guitareo.lead-gen.starter-kit.strumming.lesson')

@section('subtitle')
    Downstrokes
@endsection

@section('video', 'https://player.vimeo.com/video/182874375')

@section('current-lesson-number', 3)

@section('previous', '/starter-kit/lessons/strumming/2')

@section('next', '/starter-kit/lessons/strumming/4')

@section('prev-thumb', 'https://i.vimeocdn.com/video/592099106-ea1574b1f75a519a835317488b9b42387ff9ce1b5585bdc433e3c769f97bd324-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/591974884-50339e825985ece7d67531d673aea30011d7f17386a7c3ab466c480d5790110a-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Strumming Examples 1-4 PDF",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/strumming-1-examples.pdf"
    ])
@endsection
