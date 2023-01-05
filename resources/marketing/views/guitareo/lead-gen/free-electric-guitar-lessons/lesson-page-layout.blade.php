@extends('guitareo.lead-gen.partials._lesson-page-layout')

@section('title', 'Getting Started On The Eletric Guitar')

@section('meta-description', 'Pick up your guitar and start playing today!')

@section('image', 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/og-image.jpg')

@section('url', 'https://www.guitareo.com/free-electric-guitar-lessons/')

@section('all-lesson-link', '/free-electric-guitar-lessons/lessons')

@section('lesson-total-number', 6)

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Course Resources",
        "zipURL" => "https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/free-electric-guitar-lessons.zip"
    ])
@stop
