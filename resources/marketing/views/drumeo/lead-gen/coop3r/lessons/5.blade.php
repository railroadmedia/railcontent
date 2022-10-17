@extends('drumeo.lead-gen.coop3r.lesson-page')

@section('title')
    Starter Fills
@stop

@section('video', '//player.vimeo.com/video/149674630')

@section('lesson-number', '5')

@section('previous', '/coop3rdrumm3r/4-grooves')

@section('prev-thumb', 'https://i.vimeocdn.com/video/548963870-f2b45bc2cf148787602cd2dd0cd604ee6df16a75b28d4b303eb01ff3e5a77c53-d?mw=1200&mh=675')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Starter fills",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/5-starter-fills.pdf",
    ])
@stop
