@php
  require_once(resource_path('views/lead-gen/courses/full/gavins-grooves/lessons.php'))
@endphp

@extends('drumeo.lead-gen.courses.full.lesson-index')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Gavin Harrison - The Grooves Of Porcupine Tree | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/og-image.jpg"
            style="display: none;">
    <meta property="og:title" content="Gavin Harrison - The Grooves Of Porcupine Tree">
    <meta property="og:description"
            content="Sign up on this page and you’ll get 8 videos with Gavin Harrison that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/gavins-grooves/">
@stop

@section('bg-image', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/gavin-bg.jpg')

@section('logo-text')
    <h2>Gavin Harrison</h2>
    <h3>The Grooves Of Porcupine Tree</h3>
@endsection
