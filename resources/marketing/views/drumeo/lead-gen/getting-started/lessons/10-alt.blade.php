@extends('drumeo.lead-gen.getting-started.lesson-page')

@section('title')
    Building Your Practice Routine
@stop

@section('video', '//player.vimeo.com/video/98739417')

@section('lesson-number', '10')

@section('previous', '/getting-started/9-your-first-song')

@section('prev-thumb', 'https://i.vimeocdn.com/video/469064749-45eff4eb5b9f1b79db2ad813ae966cd1139460c5fbf0610ae28a277a6a9b1416-d?mw=1000&mh=563')

@section('assets')
    @parent

    @include('lead-gen.partials._assignment-resources', [
        "title" => "Developing a Practice Routine",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/gsotd/10-developing-a-practice-routine.pdf",
    ])
@stop
