@extends('guitareo.lead-gen.partials._lesson-page-layout')

@section('title', 'Getting Started On The Eletric Guitar')

@section('meta-description', 'Pick up your guitar and start playing today!')

@section('image', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/og-image.jpg')

@section('url', 'https://www.guitareo.com/free-electric-guitar-lessons/')

@section('all-lesson-link', '/free-electric-guitar-lessons/lessons')

@section('lesson-total-number', 6)

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Course Resources",
        "zipURL" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-electric-guitar-lessons/free-electric-guitar-lessons.zip"
    ])
@stop
