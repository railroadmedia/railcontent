@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/courses/full/sucherman-sound/lessons.php'))
@endphp


@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <title>@yield('title') - Todd Sucherman | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/sucherman-sound/bg.jpg" style="display: none;">
    <meta property="og:title" content="Todd Sucherman - How To Become A  Good Sounding Drummer">
    <meta property="og:description" content="Sign up on this page and you’ll get 5 videos with Todd Sucherman that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/sucherman-sound/">
@stop

@section('total-lesson', '5')

@section('lesson-index', '/sucherman-sound/course-index/')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3')

@section('offers')
    @include('drumeo.lead-gen.courses.full.michael-jackson-grooves._related-courses')
@endsection
