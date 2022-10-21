@extends('guitareo.lead-gen.solo-in-an-hour.lesson-page-layout')

@section('subtitle')
    The Most Important Scale For Soloing
@stop

@section('video', '//player.vimeo.com/video/551517629')

@section('current-lesson-number', 2)

@section('previous', '/solo-in-an-hour/lessons/1')

@section('next', '/solo-in-an-hour/lessons/3')

@section('prev-thumb', 'https://i.vimeocdn.com/video/1301279869-7bd9d86ad2f6e5b64479fc42feeff3f1337f412ce97a66145?mw=1000&mh=562')

@section('next-thumb', 'https://i.vimeocdn.com/video/1139535443-ad392c08d478b87c3e4872c6f2b1407f6b08c2359ccd4383bddbbfa9db353a64-d?mw=1000&mh=562')

@section('lesson-description')
    In this lesson, Ayla’s going to show you the most important scale for learning how to solo.
    <br><br>
    With even just a few of these notes, you’ll see how quickly it is to solo over all types of different music.
    <br><br>
@endsection

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Practice With A Jam Track",
        "subTitle" => "Use Soundslice to work on the exercises from this lesson in a musical setting.",
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
