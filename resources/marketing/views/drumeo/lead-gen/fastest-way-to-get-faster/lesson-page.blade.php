@php
  require_once(resource_path('views/lead-gen/fastest-way-to-get-faster/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>@yield('title') | Fastest Way To Get Faster | Drumeo</title>

    <meta name="description" content="Jared Falk's 10-day routine that will help you rapidly improve your speed around the kit.">

    <meta property="og:url" content="https://www.drumeo.com/faster/">
    <meta property="og:image" content="https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Fastest Way To Get Faster">
    <meta property="og:description" content="Jared Falk's 10-day routine that will help you rapidly improve your speed around the kit.">
@stop

@section('total-lesson', '10')

@section('lesson-index', '/faster/lessons/')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/4')

@section('offers')
    @include('drumeo.lead-gen.partials._free-trial-offer')
@endsection

