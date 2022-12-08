@extends('guitareo.lead-gen.solo-in-an-hour.lesson-page-layout')

@php
    $title = 'Building A Lick Vocabulary';
    $video = '//player.vimeo.com/video/551517691';
    $previous = '/solo-in-an-hour/lessons/3';
    $next = '/solo-in-an-hour/lessons/5';
    $resources = "
        Now that you’ve gotten comfortable with the minor pentatonic scale, it’s time to start exploring and discovering your own melodies.
        <br><br>
        With these 3 boxed and ready licks, you’ll start to build momentum towards creating your very own solo.
    ";
@endphp

@section('subtitle')
    Building A Lick Vocabulary
@stop

@section('video', '//player.vimeo.com/video/551517691')

@section('current-lesson-number', 4)

@section('previous', '/solo-in-an-hour/lessons/3')

@section('next', '/solo-in-an-hour/lessons/5')

@section('prev-thumb', 'https://i.vimeocdn.com/video/1139535443-ad392c08d478b87c3e4872c6f2b1407f6b08c2359ccd4383bddbbfa9db353a64-d?mw=1000&mh=562')

@section('next-thumb', 'https://i.vimeocdn.com/video/1301277567-c7534c605249a9a84856d69ca7222a8a9bb5dd3b1e066643c?mw=1000&mh=562')

@section('lesson-description')
    Now that you’ve gotten comfortable with the minor pentatonic scale, it’s time to start exploring and discovering your own melodies.
    <br><br>
    With these 3 boxed and ready licks, you’ll start to build momentum towards creating your very own solo.
    <br><br>
@endsection

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Build a lick vocabulary",
        "subTitle" => "Play each lick on their own. Play each lick to the backing track. Play each lick to the backing track but try adding some extra notes.",
        "assignmentID" => "jamTrack",
        "soundslice" => "zwTDc",
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Lick #1",
        "assignmentID" => "exercise1",
        "soundslice" => "HzTDc",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/303809-sheet-image-1621355502.svg"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Lick #2",
        "assignmentID" => "exercise2",
        "soundslice" => "TzTDc",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/303810-sheet-image-1621355918.svg"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Lick #3",
        "assignmentID" => "exercise3",
        "soundslice" => "GzTDc",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/303811-sheet-image-1621355953.svg"
    ])
@stop

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Sheet Music",
        "pdfURL" => "https://d1923uyy6spedc.cloudfront.net/303808-resource-1621447122.pdf"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3"
    ])
@stop
