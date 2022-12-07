@extends('guitareo.lead-gen.solo-in-an-hour.lesson-page-layout')

@section('subtitle')
    What Makes A Good Solo?
@stop

@section('video', '//player.vimeo.com/video/551517661')

@section('current-lesson-number', 3)

@section('previous', '/solo-in-an-hour/lessons/2')

@section('next', '/solo-in-an-hour/lessons/4')

@section('prev-thumb', 'https://i.vimeocdn.com/video/1301279139-beeb14b2d730ba66abb4126de072ea23de0c18c9805e0ca24?mw=1000&mh=562')

@section('next-thumb', 'https://i.vimeocdn.com/video/1139536413-5fdaa168e550872eaca08eb21179b6bc3e2eee96f233896b90da17cf2df66464-d?mw=1000&mh=562')

@section('lesson-description')
    Now that you’ve got the most important scale for soloing in your back pocket, it’s time to ask the serious question - what makes a good solo?
    <br><br>
    In this lesson, we’re going to dive into some classic guitar solos and uncover the secrets of what makes them so great.
    <br><br>
@endsection

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Explore with the minor pentatonic",
        "subTitle" => "Play the minor pentatonic scale over the jam track and see what happens when you try to play different melodies over it.",
        "assignmentID" => "exercise1",
        "soundslice" => "zwTDc",
    ])
@stop

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3"
    ])
@stop
