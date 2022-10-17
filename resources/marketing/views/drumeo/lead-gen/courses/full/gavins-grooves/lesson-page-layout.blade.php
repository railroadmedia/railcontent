@php
  require_once(resource_path('views/lead-gen/courses/full/gavins-grooves/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <title>@yield('title') - Gavin Harrison | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Gavin Harrison - The Grooves Of Porcupine Tree">
    <meta property="og:description" content="Sign up on this page and you’ll get 8 videos with Gavin Harrison that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/gavins-grooves/">
@stop

@section('total-lesson', '8')

@section('lesson-index', '/gavins-grooves/course-index/')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/4')

@section('offers')
    @include('lead-gen.courses.full.michael-jackson-grooves._related-courses')
@endsection
