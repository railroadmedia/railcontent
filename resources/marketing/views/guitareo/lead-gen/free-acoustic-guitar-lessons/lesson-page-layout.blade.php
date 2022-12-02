@extends('guitareo.lead-gen.partials._lesson-page-layout')

@section('title', 'Getting Started On The Acoustic Guitar')

@section('meta-description', 'Pick up your guitar and start playing today!')

@section('image', 'https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/og-image.jpg')

@section('url', 'https://www.guitareo.com/free-acoustic-guitar-lessons/')

@section('lesson-logo')
    <img class="tw-mx-auto tw-inline-block tw-h-10 sm:tw-h-20" src="https://cdn.musora.com/image/fetch/w_448,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/logo.png" alt="lesson-logo">
@endsection

@section('all-lesson-link', '/free-acoustic-guitar-lessons/lessons')

@section('lesson-total-number', 6)

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Course Resources",
        "zipURL" => "https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/getting-started-on-the-acoustic-guitar.zip"
    ])
@endsection
