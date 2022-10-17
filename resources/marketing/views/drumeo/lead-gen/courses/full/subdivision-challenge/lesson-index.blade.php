@php
  require_once(resource_path('views/lead-gen/courses/full/subdivision-challenge/lessons.php'))
@endphp

@extends('drumeo.lead-gen.courses.full.lesson-index')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Anika Nilles - Subdivision Challenge | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/subdivision-challenge/og-image.jpg"
            style="display: none;">
    <meta property="og:title" content="Anika Nilles - Subdivision Challenge">
    <meta property="og:description"
            content="Sign up on this page and you’ll get 5 videos with Anika Nilles that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/subdivision-challenge/">
@stop

@section('custom-header', 'slim shadow hide-free rich')

@section('bg-image', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/subdivision-challenge/header.jpg')

@section('logo-text')
    <h4 class="text-yellow"><strong>ANIKA NILLES'</strong></h4>
    <h2>SUBDIVISION</h2>
    <h3>CHALLENGE</h3>
@endsection
