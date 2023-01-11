@extends('guitareo.lead-gen.acoustic-guitar-jumpstart.lesson-page-layout')

@section('subtitle')
    Learning Songs
@stop

@section('video', '//player.vimeo.com/video/299279143')

@section('current-lesson-number', 6)

@section('previous', '/acoustic-guitar-jumpstart/course-index/5')

@section('next', '/acoustic-guitar-jumpstart/course-index/7')

@section('prev-thumb', 'https://i.vimeocdn.com/video/737361727-b7002ed2a132f4e6138eec3b90a47314ca7d82d31a24908b40c9e13330b07721-d?mw=1200&mh=675')

@section('next-thumb', 'https://i.vimeocdn.com/video/737368212-33be88307072a4bca4a01b530a7f00ac433097e6ea49da74bbf90d3fc9340fe6-d?mw=1200&mh=675')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Full Speed",
        "mp3URL" => "https://s3.amazonaws.com/guitareo/acoustic-jump-start/jambalaya.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Slow Speed",
        "mp3URL" => "https://s3.amazonaws.com/guitareo/acoustic-jump-start/jambalaya-slow.mp3"
    ])
@endsection
