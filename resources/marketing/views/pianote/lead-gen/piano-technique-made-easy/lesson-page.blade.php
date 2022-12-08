@php
  require_once(resource_path('marketing/views/pianote/lead-gen/piano-technique-made-easy/lessons.php'))
@endphp

@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">

    @parent
@endsection

@section('title', 'Piano Technique Made Easy')

@section('meta-description', 'Master the fundamentals -- so you can play anything you want on the piano.')

@section('meta-img', 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/og-image.jpg')

@section('meta-url', 'https://www.pianote.com/piano-technique-made-easy')

@section('lesson-logo', 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-technique-made-easy/logo.png')

@section('lesson-total-number', 3)

@section('series')
    @include('pianote.lead-gen.partials._lesson-tiles',[
        'width' => 'w-1/2 sm:w-1/3',
    ])
@endsection
