@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/courses/full/michael-jackson-grooves/lessons.php'))
@endphp

@extends('drumeo.lead-gen.courses.full.lesson-index')

@section('meta')
    <meta name="robots" content="noindex">
    <title>The Grooves Of Michael Jackson | Drumeo</title>
    <meta property="og:image"
            content="https://s3.amazonaws.com/drumeoblog/beat/wp-content/uploads/2019/10/24202002/IMG_0237-1-2400x1260.jpg"
            style="display: none;">
    <meta property="og:title" content="The Grooves Of Michael Jackson">
    <meta property="og:description"
            content="In this 10-video series, you’ll learn Michael Jackson’s most iconic drum grooves firsthand from the man who brought them to life in arenas around the world.">
    <meta property="og:url" content="https://www.drumeo.com/grooves-of-michael-jackson/">
@stop

@section('custom-header', 'slim shadow hide-free')

@section('bg-image', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/michael-jackson-grooves/header.jpg')

@section('logo-text')
    <h2>Jonathan Moffett</h2>
    <h3>The Grooves Of Michael Jackson</h3>
@endsection
