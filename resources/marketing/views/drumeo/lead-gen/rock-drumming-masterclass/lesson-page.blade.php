@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/rock-drumming-masterclass/lessons.php'))
@endphp

@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <title>@yield('title') | Rock Drumming Masterclass | Drumeo</title>
    <meta name="description" content="The Rock Drumming Masterclass is a 26-week online course with Todd Sucherman.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/rock-drumming-masterclass/og-image.jpg" style="display: none;">
    <meta property="og:description" content="The Rock Drumming Masterclass is a 26-week online course with Todd Sucherman.">
    <meta property="og:url" content="https://www.drumeo.com/rock-drumming-masterclass/most-underrated-drummer">
@stop

@section('total-lesson', '3')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3')

@section('lesson-description')
    @include('drumeo.lead-gen.partials._a-link-button',[
        'containerStyles' => 'mt-8',
        'href' => '/rock-drumming-masterclass',
        'text' => 'Rock Drumming Masterclass'
    ])
@endsection

