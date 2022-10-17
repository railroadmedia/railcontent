@php
  require_once(resource_path('views/lead-gen/drum-fills/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <title>How to Play Drum Fills</title>

    <meta name="description"
          content="Learn 20 beginner rock drum fills with Jared Falk of Drumeo. This is a free sample course, similar to the courses you'd get when you join Drumeo.">
    <meta name="robots" content="noindex">
    <meta property="og:url" content="https://www.drumeo.com/drum-fills/"/>
    <meta property="og:title" content="How to Play Drum Fills"/>
    <meta property="og:description"
          content="Learn 20 beginner rock drum fills with Jared Falk of Drumeo. This is a free sample course, similar to the courses you'd get when you join Drumeo."/>
    <meta property="og:image" content="https://s3.amazonaws.com/drumeo-packs/drum-fills/1.png"/>
@stop

@section('total-lesson', '5')

@section('lesson-index', '/drum-fills')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3')

@section('offers')
    @include('lead-gen.partials._free-trial-offer')
@endsection
