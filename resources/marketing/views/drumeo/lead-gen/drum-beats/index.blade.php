@extends('drumeo.lead-gen.drum-beats.free-series-layout')

@section('meta')
    @parent
    <title>How to Play Rock Drum Beats</title>
    <meta name="description"
          content="Learn 20 beginner rock drum beats with Jared Falk of Drumeo. This is a free sample course, similar to the courses you'd get when you join Drumeo.">
    <meta name="robots" content="noindex">
    <meta property="og:url" content="https://www.drumeo.com/drum-beats/"/>
    <meta property="og:title" content="How to Play Rock Drum Beats"/>
    <meta property="og:description"
          content="Learn 20 beginner rock drum beats with Jared Falk of Drumeo. This is a free sample course, similar to the courses you'd get when you join Drumeo."/>
    <meta property="og:image" content="https://s3.amazonaws.com/drumeo-packs/drum-fills/drum-beats.jpg"/>
@stop

@section('heading')
    @parent
    <div class="toolbox-header">
        <div class="container mx-auto lg:max-w-6xl">
            <div class="px-4 toolbox-title">
                <div class="main-title">Free Beginner Drum Lessons</div>

                <h1>How to Play Rock Drum Beats</h1>
            </div>
        </div>
    </div>
@stop

@section('page-body')
    <div class="container mx-auto lg:max-w-6xl">
        <div class="lesson-grid px-4 grid sm:grid-cols-3 sm:gap-6">
            @include('lead-gen.drum-beats.._video-link',[
                "lessonUrl" => "/drum-beats/1/",
                "lessonImg" => "https://img.youtube.com/vi/kclUtptKsT8/maxresdefault.jpg",
                "lessonTitle" => "Part 1"
            ])
            @include('lead-gen.drum-beats.._video-link',[
                "lessonUrl" => "/drum-beats/2",
                "lessonImg" => "https://img.youtube.com/vi/gfMtxzhJwm4/maxresdefault.jpg",
                "lessonTitle" => "Part 2"
            ])
            @include('lead-gen.drum-beats.._video-link',[
                "lessonUrl" => "/drum-beats/3",
                "lessonImg" => "https://img.youtube.com/vi/8h8dYx0O-y0/maxresdefault.jpg",
                "lessonTitle" => "Part 3"
            ])
            @include('lead-gen.drum-beats.._video-link',[
                "lessonUrl" => "/drum-beats/4",
                "lessonImg" => "https://img.youtube.com/vi/G0oVrJigVyY/maxresdefault.jpg",
                "lessonTitle" => "Part 4"
            ])
            @include('lead-gen.drum-beats.._video-link',[
                "lessonUrl" => "/drum-beats/5",
                "lessonImg" => "https://img.youtube.com/vi/-HcuBTP3tIA/maxresdefault.jpg",
                "lessonTitle" => "Play Alongs"
            ])
        </div>
    </div>
@stop
