@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/courses/full/must-know-grooves/lessons.php'))
@endphp

@extends('drumeo.lead-gen.courses.full.lesson-index')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Rich Redmond - Must-Know Drum Grooves | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/og-image.jpg"
            style="display: none;">
    <meta property="og:title" content="Rich Redmond - Must-Know Drum Grooves">
    <meta property="og:description"
            content="Sign up on this page and you’ll get 9 videos with Rich Redmond that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/must-know-grooves/">
@stop

@section('custom-header', 'slim shadow hide-free rich')

@section('bg-image', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/header.jpg')

@section('logo-text')
    <h3>Must-Know</h3>
    <h2>Drum Grooves</h2>
    <h4 class="text-blue">WITH RICH REDMOND</h4>
@endsection
