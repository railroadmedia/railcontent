@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/drum-fills/lessons.php'))
@endphp


@extends('drumeo.lead-gen.drum-beats.free-series-layout')

@section('meta')
    @parent
    <title>@yield('title') | How to Play Drum Fills</title>

    <meta name="description"
          content="Learn 20 beginner rock drum fills with Jared Falk of Drumeo. This is a free sample course, similar to the courses you'd get when you join Drumeo.">
    <meta name="robots" content="noindex">
    <meta property="og:url" content="https://www.drumeo.com/drum-fills/"/>
    <meta property="og:title" content="How to Play Drum Fills"/>
    <meta property="og:description"
          content="Learn 20 beginner rock drum fills with Jared Falk of Drumeo. This is a free sample course, similar to the courses you'd get when you join Drumeo."/>
    <meta property="og:image" content="1.png"/>
@stop

@section('heading')
    @parent
    <div class="toolbox-header">
        <div class="container mx-auto lg:max-w-6xl">
            <div class="px-4 toolbox-title">
                <div class="main-title">Free Beginner Drum Lessons</div>

                <h1>How to Play Drum Fills</h1>
            </div>
        </div>
    </div>
@stop

@section('page-body')
    <div class="container mx-auto lg:max-w-6xl">
        <div class="lesson-grid px-4 grid sm:grid-cols-3 sm:gap-6">
            @foreach ($lessons as $lesson)
                @include('drumeo.lead-gen.drum-beats.._video-link',[
                    "lessonUrl" => $lesson['url'],
                    "lessonImg" => $lesson['image'],
                    "lessonTitle" => $lesson['title']
                ])
            @endforeach
        </div>
    </div>
@stop
