@extends('guitareo.lead-gen.starter-kit.strumming.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/182874374')

@section('current-lesson-number', 1)

@section('next', '/starter-kit/lessons/strumming/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/592099106-ea1574b1f75a519a835317488b9b42387ff9ce1b5585bdc433e3c769f97bd324-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Strumming Resources",
        "zipURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/strumming-1.zip"
    ])
@endsection
