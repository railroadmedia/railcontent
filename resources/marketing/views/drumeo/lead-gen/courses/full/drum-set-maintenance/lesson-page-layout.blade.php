@php
  require_once(resource_path('views/lead-gen/courses/full/drum-set-maintenance/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <title>@yield('title') - David Raouf | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/og-image.jpg" style="display: none;">
    <meta property="og:title" content="David Raouf - Drum Set Maintenance">
    <meta property="og:description" content="Sign up on this page and you’ll get 7 videos with David Raouf that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/drum-set-maintenance/">
@stop

@section('total-lesson', '7')

@section('lesson-index', '/drum-set-maintenance/course-index/')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3 lg:w-1/4')
