@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/dtme/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <title>@yield('title') | Drum Technique Made Easy | Drumeo</title>
    <meta name="description" content="Drum Technique Made Easy is a 26-week online course with Bruce Becker.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-technique-made-easy/thumbnail.jpg" style="display: none;">
    <meta property="og:description" content="Drum Technique Made Easy is a 26-week online course with Bruce Becker.">
    <meta property="og:url" content="https://www.drumeo.com/drum-technique-made-easy/1-five-technique-myths/">
@stop

@section('total-lesson', '3')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3')
