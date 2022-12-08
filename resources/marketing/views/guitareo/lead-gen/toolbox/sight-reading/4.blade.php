@extends('guitareo.lead-gen.toolbox.sight-reading.lesson')

@section('subtitle')
    Whole & Half Note Exercises 1
@endsection

@section('video', 'https://player.vimeo.com/video/179247806')

@section('current-lesson-number', 4)

@section('previous', '/toolbox/lessons/sight-reading-essentials/3')

@section('next', '/toolbox/lessons/sight-reading-essentials/5')

@section('prev-thumb', 'https://i.vimeocdn.com/video/587145380-4cb9fb9ab5d26f73538e55f7b4d4ea82131b48b864d39a7383e963c803e06df6-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/587134161-bb709c3f2912d7d80963d37fa3147e00f05d31f90b3bfcd7cdb9c089682da8e1-d?mw=1000&mh=563')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Reading Music 1 Examples 1-12",
        "pdfURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/pdfs/reading-music-1-examples-1-12.pdf"
    ])
@endsection
