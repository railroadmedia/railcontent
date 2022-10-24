@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/coop3r/lessons.php'))
@endphp


@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>How To Start Playing Drums | Drumeo</title>
    <meta name="description" content="Get 5 free video lessons with YouTube-star COOP3RDRUMM3R, covering everything you need to start learning the drums for the very first time!">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2022/og-image.jpg" style="display: none;">
    <meta property="og:title" content="How To Start Playing Drums | Drumeo">
    <meta property="og:description" content="Get 5 free video lessons with YouTube-star COOP3RDRUMM3R, covering everything you need to start learning the drums for the very first time!">
    <meta property="og:url" content="https://www.drumeo.com/coop3rdrumm3r/">
@stop

@section('styles')
    <style>
        .lesson-grid .lesson-grid-item .top-image .top-left-badge {
            background:#bb2025;
        }
    </style>
@stop

@section('content')
    <header class="header" style="background-image:url({{ cdn('headers/9.jpg') }});">
        <div class="container px-4 max-w-6xl mx-auto">
            <div class="text-center">
                <img class="series-logo slim mx-auto" src="{{ cdn('lead-gen/coop3r/coop3r-logo2.png') }}" alt="How To Start Playing Drums">
                <h1 class="hidden">How To Start Playing Drums</h1>
            </div>
        </div>
    </header>


    <section class="lesson-grid">
        <div class="container px-4 max-w-6xl mx-auto">
            <h1>Want to play the drums like COOP3RDRUMM3R?</h1>
            <p>In this exclusive video series, you'll get his best tips for how YOU can start playing the drums right away!</p>
            <div class="thumbnail-wrap grid grid-cols-2 gap-4 sm:grid-cols-3">
                @foreach ($lessons as $key => $lesson)
                    <div class="w-full">
                        @include("drumeo.lead-gen.partials.thumbnail-signup", [
                            "url" => $lesson['url'],
                            "image" => $lesson['image'],
                            "badge" => 'Lesson #' . strval($key + 1),
                            "title" => $lesson['title']
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
