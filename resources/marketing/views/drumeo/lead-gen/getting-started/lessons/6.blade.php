@extends('drumeo.lead-gen.getting-started.lesson-page')

@section('title')
    Your First Drum Beats
@stop

@section('video', '//player.vimeo.com/video/90056797')

@section('lesson-number', '6')

@section('previous', '/getting-started/5-basic-counting')

@section('next', '/getting-started/7-your-first-fill')

@section('prev-thumb', 'https://i.vimeocdn.com/video/470777467-95f29a8b2d8d254c258715092af748a95cc20e933239e63dd10280948d0c1807-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/469067095-0284183a7b530d903528db71ba826503cddfe27567da138ac67ff1e29f9f8e21-d?mw=1000&mh=563')

@section('assets')
    @parent

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Playing Your First Beat",
        "zipURL" => "https://dzryyo1we6bm3.cloudfront.net/gsotd/6-playing-your-first-beat.zip",
    ])
@stop
