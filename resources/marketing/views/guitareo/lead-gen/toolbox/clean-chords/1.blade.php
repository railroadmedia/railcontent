@extends('guitareo.lead-gen.toolbox.clean-chords.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/167285840')

@section('current-lesson-number', 1)

@section('next', '/toolbox/lessons/making-chords-sound-clean/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/571588650-226d0470ef0933e688d23f1eeea79a05ef7c716af832f9b2e1cfb4df736ef306-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Making Chords Sounds Clean Resources",
        "zipURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/making-chords-sound-clean.zip"
    ])
@endsection
