@extends('guitareo.lead-gen.partials._lesson-page-layout')

@section('title', 'Guitareo')

@section('meta-description', "Sign up on this page and you'll get a guided beginner guitar course with Nate Savage designed specifically for acoustic guitarists.")

@section('image', 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/6.jpg')

@section('url', 'https://www.guitareo.com/acoustic-guitar-jumpstart/')

@section('all-lesson-link', '/acoustic-guitar-jumpstart/course-index')

@section('lesson-total-number', 8)

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Course Resources",
        "zipURL" => "https://s3.amazonaws.com/guitareo/acoustic-jump-start/acoustic-guitar-jump-start.pdf"
    ])
@endsection
