@extends('guitareo.lead-gen.partials._lesson-page-layout')

@section('title', 'Getting Started On The Acoustic Guitar')

@section('meta-description', 'Pick up your guitar and start playing today!')

@section('image', 'https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/og-image.jpg')

@section('url', 'https://www.guitareo.com/free-acoustic-guitar-lessons/')

@section('lesson-logo')
    <img class="tw-mx-auto tw-inline-block tw-h-10 sm:tw-h-20" src="https://www.musora.com/musora-cdn/image/width=448,quality=85/https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/logo.png" alt="lesson-logo">
@endsection

@section('all-lesson-link', '/free-acoustic-guitar-lessons/lessons')

@section('lesson-total-number', 6)

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Course Resources",
        "zipURL" => "https://d122ay5chh2hr5.cloudfront.net/lead-gen/free-acoustic-guitar-lessons/getting-started-on-the-acoustic-guitar.zip"
    ])
@endsection
