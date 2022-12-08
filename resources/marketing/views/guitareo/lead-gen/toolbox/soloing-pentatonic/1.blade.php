@extends('guitareo.lead-gen.toolbox.soloing-pentatonic.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/192367837')

@section('current-lesson-number', 1)

@section('next', '/toolbox/lessons/soloing-with-minor-pentatonic-scales/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/604214743-a2a2d2dbf71c181a78cc689f15a40e4a9b2db6ebd36d2fb89494c7424105e737-d?mw=1000&mh=563')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Soloing With Pentatonic Scales Resources",
        "zipURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/minor-pentatonic-scales-1.zip"
    ])
@endsection
