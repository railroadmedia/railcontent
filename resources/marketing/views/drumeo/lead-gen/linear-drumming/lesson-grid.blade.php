@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/linear-drumming/lessons.php'))
@endphp

@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Linear Drumming | Drumeo</title>
    <meta name="description" content="In this exclusive video series, you'll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/sales/2023/share-image-drumeo.jpg" style="display: none;">
    <meta property="og:title" content="Linear Drumming | Drumeo">
    <meta property="og:description" content="In this exclusive video series, you'll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!">
    <meta property="og:url" content="https://www.drumeo.com/linear-drumming/">
@stop

@section('styles')
    <style>
        .lesson-grid .lesson-grid-item .top-image .top-left-badge {
            background:#bb2025;
        }
    </style>
@stop

@section('content')
    <header class="header" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/headers/9.jpg);">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="text-center">
                <img class="series-logo slim mx-auto" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/coop3r/coop3r-logo2.png" alt="Linear Drumming">
                <h1 class="hidden">Linear Drumming</h1>
            </div>
        </div>
    </header>


    <section class="lesson-grid">
        <div class="container mx-auto px-4 max-w-6xl">
            <h1>What The Heck Is Linear Drumming?</h1>
            <p>In this exclusive video series, you'll get his best tips on linear drumming and how to apply it to a range of fills, grooves, and styles of music!</p>
            <div class="thumbnail-wrap grid gap-4 grid-cols-2 md:grid-cols-3">
                @foreach ($lessons as $key => $lesson)
                    <div class="w-full">
                        @include("drumeo.lead-gen.partials.thumbnail-signup", [
                            "url" => $lesson['url'],
                            "image" => $lesson['image'],
                            "badge" => "Lesson #" . strval($key + 1),
                            "title" => $lesson['title']
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
