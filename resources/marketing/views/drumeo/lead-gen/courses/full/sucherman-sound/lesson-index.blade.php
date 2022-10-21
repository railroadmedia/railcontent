@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/courses/full/sucherman-sound/lessons.php'))
@endphp

@extends('drumeo.lead-gen.courses.full.lesson-index')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Todd Sucherman - How To Become A  Good Sounding Drummer | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/sucherman-sound/bg.jpg" style="display: none;">
    <meta property="og:title" content="Todd Sucherman - How To Become A  Good Sounding Drummer">
    <meta property="og:description" content="Sign up on this page and you’ll get 5 videos with Todd Sucherman that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/sucherman-sound/">
@stop
@section('styles')
    @parent
    <style>
        .header.catalogue .row {
            background-size:1200px;
            background-position:center 30%;
        }
    </style>
@stop
@section('custom-header', 'shadow hide-free')

@section('bg-image', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/sucherman-sound/bg.jpg')

@section('logo-text')
    <h2>Todd Sucherman</h2>
    <h3>How To Become A <u>Good<br class="inline sm:hidden"> Sounding</u> Drummer</h3>
@endsection
