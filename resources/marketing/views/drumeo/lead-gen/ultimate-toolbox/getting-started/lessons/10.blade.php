@extends('drumeo.lead-gen.ultimate-toolbox.getting-started.lesson-page')

@section('title')
    Lesson 10: Building Your Practice Routine
@stop

@section('video', '//player.vimeo.com/video/90068634')

@section('lesson-number', '10')

@section('previous')
    /ultimate-toolbox/gsotd/1
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/469064749-45eff4eb5b9f1b79db2ad813ae966cd1139460c5fbf0610ae28a277a6a9b1416-d_640')

@section('assets')
    @include('lead-gen.partials._assignment-resources',[
        'title' => 'PDF',
        'pdfURL' => 'https://dzryyo1we6bm3.cloudfront.net/gsotd/10-developing-a-practice-routine.pdf',
    ])
@stop
