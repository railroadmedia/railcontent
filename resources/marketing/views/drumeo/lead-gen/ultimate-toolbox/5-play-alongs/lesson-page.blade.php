@php
  require_once(resource_path('views/lead-gen/ultimate-toolbox/5-play-alongs/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
  <meta name="robots" content="noindex">
  <title>@yield('title') | 5 Play Alongs | Drumeo</title>
  <meta name="description" content="The ultimate toolbox to jump start your drumming! Sign up for these free resources to expand your drumming education today.">

  <!-- Social Media -->
  <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/og-image.jpg" style="display: none;">
  <meta property="og:title" content="The Ultimate Drumming Toolbox | Drumeo">
  <meta property="og:description" content="Sign up for these free resources to expand your drumming education today.">
  <meta property="og:url" content="https://www.drumeo.com/ultimate-toolbox">
@endsection

@section('total-lesson', '5')

@section('lesson-tile-width', 'w-1/2 md:w-1/3 lg:w-1/5')

@section('lesson-index', '/ultimate-toolbox/5pa')
