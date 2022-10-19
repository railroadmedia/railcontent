@php
  require_once(resource_path('views/lead-gen/fastest-way-to-get-faster/lessons.php'))
@endphp

@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Fastest Way To Get Faster</title>
    <meta name="description" content="Jared Falk's 10-day routine that will help you rapidly improve your speed around the kit.">

    <meta property="og:url" content="https://www.drumeo.com/faster/">
    <meta property="og:image" content="https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Fastest Way To Get Faster">
    <meta property="og:description" content="Jared Falk's 10-day routine that will help you rapidly improve your speed around the kit.">
@stop

@section('content')

    <header class="header" style="background-image: url(https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/bg.jpg);">
        <div class="container max-6-xl mx-auto px-4">
            <div class="text-center">
                <img class="series-logo slim mx-auto" src="https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/logo.png" alt="Fastest Way To Get Faster">
                <h1 class="hidden">Fastest Way To Get Faster</h1>
            </div>
        </div>
    </header>

    <section class="lesson-grid">
        <div class="container max-6-xl mx-auto px-4">
            <h1>Jared Falk's 10-Day Plan For Faster Hands & Feet</h1>
            <p>The Fastest Way To Get Faster is a 10-Day routine that will help you rapidly improve your speed around the kit. You will need to practice hard, you will need to stick with it, and you might need to push yourself harder than usual - but it's been created to deliver results.</p>
            <div class="thumbnail-wrap grid gap-4 grid-cols-2 md:grid-cols-3">
                @foreach ($lessons as $key => $lesson)
                    <div class="w-full">
                        @include("drumeo.lead-gen.partials.thumbnail-signup", [
                            "url" => $lesson['url'],
                            "image" => $lesson['image'],
                            "badge" => "Day #" . strval($key + 1),
                            "title" => $lesson['title']
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </section>


@stop
