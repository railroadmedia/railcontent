@extends('guitareo.lead-gen.solo-in-an-hour.lesson-page-layout')

@section('subtitle')
    Playing Your First Solo
@stop

@section('video', '//player.vimeo.com/video/551517718')

@section('current-lesson-number', 5)

@section('previous', '/solo-in-an-hour/lessons/4')

@section('next', '/solo-in-an-hour/lessons/6')

@section('prev-thumb', 'https://i.vimeocdn.com/video/1139536413-5fdaa168e550872eaca08eb21179b6bc3e2eee96f233896b90da17cf2df66464-d?mw=1000&mh=562')

@section('next-thumb', 'https://i.vimeocdn.com/video/1301276875-aabf62485e6cd3b785ee36d6f1a797bd74d9b1f60b9ddad48?mw=1000&mh=562')

@section('lesson-description')
    It’s time to take the fragments of licks that you’ve learned and tie them all together to create your very first solo!
    <br><br>
    This is what we’ve been working towards, and here we are. All in less than an hour!
    <br><br>
@endsection

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Getting some inspiration",
        "subTitle" => "Take everything you learned so far and practice soloing over the jam track.",
        "assignmentID" => "jamTrack",
        "soundslice" => "zwTDc",
    ])
@stop

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3"
    ])
@stop
