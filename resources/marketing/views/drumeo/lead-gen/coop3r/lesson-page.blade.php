@php
  require_once(resource_path('views/lead-gen/coop3r/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>@yield('title') | How To Start Playing Drums | Drumeo</title>
    <meta name="description" content="Get 5 free video lessons with YouTube-star COOP3RDRUMM3R, covering everything you need to start learning the drums for the very first time!">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    <meta property="og:title" content="How To Start Playing Drums | Drumeo">
    <meta property="og:description" content="Get 5 free video lessons with YouTube-star COOP3RDRUMM3R, covering everything you need to start learning the drums for the very first time!">
    <meta property="og:url" content="https://www.drumeo.com/coop3rdrumm3r/">
@stop

@section('total-lesson', 5)

@section('lesson-index', '/coop3rdrumm3r/lessons')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/4')
