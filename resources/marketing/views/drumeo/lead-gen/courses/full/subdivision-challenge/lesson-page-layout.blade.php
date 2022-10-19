@php
  require_once(resource_path('views/lead-gen/courses/full/subdivision-challenge/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <title>@yield('title') - Anika Nilles | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/subdivision-challenge/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Anika Nilles - Subdivision Challenge">
    <meta property="og:description" content="Sign up on this page and you’ll get 5 videos with Anika Nilles that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/subdivision-challenge/">
@stop

@section('total-lesson', '5')

@section('lesson-index', '/subdivision-challenge/course-index/')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3')

@section('offers')
    @include('drumeo.lead-gen.courses.full.michael-jackson-grooves._related-courses')
@endsection
