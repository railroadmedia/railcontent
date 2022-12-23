@extends('guitareo.lead-gen.starter-kit.partials._lesson-page-layout')

@section('lesson-total-number', 7)

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "All Lesson Resources",
        "zipURL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/zip/heartbreak-avenue.zip"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track w/ Click",
        "mp3URL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/mp3/heartbreak-avenue-no-rhythm-guitar-click.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track No Click",
        "mp3URL" => "https://guitarskillaccelerator-com.s3.amazonaws.com/media/mp3/heartbreak-avenue-no-rhythm-guitar-no-click.mp3"
    ])
@endsection
