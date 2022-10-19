@php
  require_once(resource_path('views/lead-gen/courses/full/michael-jackson-grooves/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <title>@yield('title') - The Grooves Of Michael Jackson | Drumeo</title>
    <meta property="og:image" content="https://s3.amazonaws.com/drumeoblog/beat/wp-content/uploads/2019/10/24202002/IMG_0237-1-2400x1260.jpg" style="display: none;">
    <meta property="og:title" content="The Grooves Of Michael Jackson">
    <meta property="og:description" content="In this 10-video series, you’ll learn Michael Jackson’s most iconic drum grooves firsthand from the man who brought them to life in arenas around the world.">
    <meta property="og:url" content="https://www.drumeo.com/grooves-of-michael-jackson/">
@stop

@section('total-lesson', '10')

@section('lesson-index', '/michael-jackson-grooves/course-index/')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/4')

@section('offers')
    @include('drumeo.lead-gen.courses.full.michael-jackson-grooves._related-courses')
@endsection
