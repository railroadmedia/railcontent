@extends('guitareo.lead-gen.toolbox.sight-reading.lesson')

@section('subtitle')
    Whole & Half Note Exercises 2
@endsection

@section('video', 'https://player.vimeo.com/video/179247807')

@section('current-lesson-number', 5)

@section('previous', '/toolbox/lessons/sight-reading-essentials/4')

@section('next', '/toolbox/lessons/sight-reading-essentials/6')

@section('prev-thumb', 'https://i.vimeocdn.com/video/587146392-6842aed594f959ca1fd60565f6eb283973aa8cfd0ce83f8c770f3fb834dac58f-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/587133642-19b52faf6290df95551fc796bc5de172dc19b38e4a0361cebad079376cd891ca-d?mw=1000&mh=563')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Reading Music 1 Examples 1-12",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/reading-music-1-examples-1-12.pdf"
    ])
@endsection
