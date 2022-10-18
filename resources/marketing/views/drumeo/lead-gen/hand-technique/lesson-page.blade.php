@php
  require_once(resource_path('views/lead-gen/hand-technique/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>@yield('title') | Hand Technique - The Motions Of Drumming | Drumeo</title>
    <meta property="og:title" content="Hand Technique - The Motions Of Drumming">
    <meta property="og:url" content="https://www.drumeo.com/hand-technique/">
@stop

@section('total-lesson', '6')

@section('lesson-index', '/hand-technique/lessons')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3')

@section('assets')
  @include('lead-gen.partials._assignment-resources', [
    "title" => "Lesson Resources",
    "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/courses/pdf/dcb-34.pdf",
  ])
@endsection
