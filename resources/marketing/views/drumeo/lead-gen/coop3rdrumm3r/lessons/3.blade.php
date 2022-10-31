@extends('drumeo.lead-gen.coop3rdrumm3r.lesson-page')

@section('title')
    How To Practice
@stop

@section('video', '//player.vimeo.com/video/149675118')

@section('lesson-number', '3')

@section('previous', '/coop3rdrumm3r/2-drum-theory')

@section('next', '/coop3rdrumm3r/4-grooves')

@section('prev-thumb', 'https://i.vimeocdn.com/video/548962045-245c563e3dc6c0dfc39ffcd73ea0818c46579c70cf31b71c5f5ddf969b23580e-d?mw=1200&mh=675')

@section('next-thumb', 'https://i.vimeocdn.com/video/548963870-f2b45bc2cf148787602cd2dd0cd604ee6df16a75b28d4b303eb01ff3e5a77c53-d?mw=1200&mh=675')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "How to practice",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/3-how-to-practice.pdf",
    ])
@stop
