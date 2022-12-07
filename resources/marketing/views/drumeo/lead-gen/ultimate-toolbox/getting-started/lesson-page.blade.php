@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/ultimate-toolbox/getting-started/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>@yield('title') | Getting Started on The Drums | Drumeo</title>
    <meta name="description" content="The ultimate toolbox to jump start your drumming! Sign up for these free resources to expand your drumming education today.">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/og-image.jpg" style="display: none;">
    <meta property="og:title" content="The Ultimate Drumming Toolbox | Drumeo">
    <meta property="og:description" content="Sign up for these free resources to expand your drumming education today.">
    <meta property="og:url" content="https://www.drumeo.com/ultimate-toolbox">
@endsection

@section('total-lesson', '10')

@section('lesson-index', '/ultimate-toolbox/gsotd')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/5')

@section('offers')
    @include('drumeo.lead-gen.partials._free-trial-offer')
@endsection
