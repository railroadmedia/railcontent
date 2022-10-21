@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/courses/full/drum-set-maintenance/lessons.php'))
@endphp

@extends('drumeo.lead-gen.courses.full.lesson-index')

@section('meta')
    <meta name="robots" content="noindex">
    <title>David Raouf - Drum Set Maintenance | Drumeo</title>
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/og-image.jpg"
            style="display: none;">
    <meta property="og:title" content="David Raouf - Drum Set Maintenance">
    <meta property="og:description"
            content="Sign up on this page and you’ll get 7 videos with David Raouf that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/drum-set-maintenance/">
@stop
@section('custom-header', 'slim shadow hide-free rich')

@section('bg-image', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/drum-set-maintenance/header-gradient.jpg')

@section('logo-text')
    <h3>Must-Know</h3>
    <h2>Drum Grooves</h2>
    <h4 class="text-yellow">WITH DAVID RAOUF</h4>
@endsection
