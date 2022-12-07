@php
  require_once(resource_path('marketing/views/pianote/lead-gen/piano-in-5-days/lessons.php'))
@endphp

@extends('pianote.lead-gen.partials._lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    @parent
@endsection

@section('subtitle', '5 Days to Playing Piano')

@section('meta-description', 'Start learning how to play the piano in just 5 days!')

@section('meta-img', 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/og-image.jpg')

@section('meta-url', 'https://www.pianote.com/piano-in-5-days')

@section('lesson-logo', 'https://pianote.s3.amazonaws.com/lead-gen/piano-in-5-days/logo.png')

@section('lesson-index-url', '/piano-in-5-days/lessons')

@section('lesson-total-number', 17)

@section('offers')
    @include('pianote.lead-gen.partials._7-day-trial-offer')
@endsection
