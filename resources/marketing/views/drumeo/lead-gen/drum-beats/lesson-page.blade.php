@php
  require_once(resource_path('views/lead-gen/drum-beats/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    @parent
    <title>@yield('title') | How to Play Rock Drum Beats</title>

    <meta name="description"
          content="Learn 20 beginner rock drum beats with Jared Falk of Drumeo. This is a free sample course, similar to the courses you'd get when you join Drumeo.">
    <meta name="robots" content="noindex">
    <meta property="og:url" content="https://www.drumeo.com/drum-beats/"/>
    <meta property="og:title" content="How to Play Rock Drum Beats"/>
    <meta property="og:description"
          content="Learn 20 beginner rock drum beats with Jared Falk of Drumeo. This is a free sample course, similar to the courses you'd get when you join Drumeo."/>
    <meta property="og:image" content="https://s3.amazonaws.com/drumeo-packs/drum-fills/drum-beats.jpg"/>
@stop

@section('total-lesson', '5')

@section('lesson-index', '/drum-beats')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/4')

@section('offers')
    @include('drumeo.lead-gen.partials._free-trial-offer')
@endsection
