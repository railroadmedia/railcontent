@extends('guitareo.lead-gen.toolbox.legato.lesson')

@section('subtitle')
    Series Overview
@endsection

@section('video', 'https://player.vimeo.com/video/193950412')

@section('current-lesson-number', 1)

@section('next', '/toolbox/lessons/legato-hammer-ons-pull-offs/2')

@section('next-thumb', 'https://i.vimeocdn.com/video/606309781-e7ed5d98eb34e3c52e0a6b033d40bc15808ea1109437421b0c2132b6ef28c78e-d?mw=1100&mh=619')

@section('assets')
    @parent

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Legato Hammer Ons &amp; Pull Offs Resources",
        "zipURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/zips/legato-technique-1.zip"
    ])
@endsection
