@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/hand-technique/lessons.php'))
@endphp

@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Hand Technique - The Motions Of Drumming | Drumeo</title>
    <meta property="og:title" content="Hand Technique - The Motions Of Drumming">
    <meta property="og:url" content="https://www.drumeo.com/hand-technique/">
@stop

@section('content')
    <header class="header" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/dtme/bg.jpg);">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="text-center">
                <img class="series-logo slim mx-auto" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/dtme/logo-slim.png" alt="Hand Technique">
                <h1 class="hidden">Hand Technique</h1>
            </div>
        </div>
    </header>

    <section class="lesson-grid">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="thumbnail-wrap grid gap-4 grid-cols-2 sm:grid-cols-3">
                @foreach ($lessons as $lesson)
                    <div class="w-full">
                        @include("drumeo.lead-gen.partials.thumbnail-signup", [
                            "url" => $lesson['url'],
                            "image" => $lesson['image'],
                            "title" => $lesson['title']
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop
