@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/courses/full/must-know-grooves/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <title>@yield('title') - Rich Redmond | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Rich Redmond - Must-Know Drum Grooves">
    <meta property="og:description" content="Sign up on this page and you’ll get 9 videos with Rich Redmond that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/must-know-grooves/">
@stop

@section('total-lesson', '9')

@section('lesson-index', '/must-know-grooves/course-index/')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/4')

@section('offers')
    @include('drumeo.lead-gen.courses.full.michael-jackson-grooves._related-courses')
@endsection
