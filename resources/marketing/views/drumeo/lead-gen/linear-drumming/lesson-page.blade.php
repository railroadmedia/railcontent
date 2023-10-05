@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/linear-drumming/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>@yield('title') | Linear Drumming | Drumeo</title>
    <meta name="description" content="In this exclusive video series, you'll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">
    <meta property="og:title" content="Linear Drumming | Drumeo">
    <meta property="og:description" content="In this exclusive video series, you'll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!">
    <meta property="og:url" content="https://www.drumeo.com/linear-drumming/">
@stop

@section('total-lesson', '5')

@section('lesson-index', '/linear-drumming/lessons')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3')

@section('offers')
    @include('drumeo.lead-gen.partials._free-trial-offer')
@endsection

