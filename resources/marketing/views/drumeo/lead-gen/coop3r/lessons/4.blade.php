@extends('drumeo.lead-gen.coop3r.lesson-page')

@section('title')
    Starter Grooves
@stop

@section('video', '//player.vimeo.com/video/149674627')

@section('lesson-number', '4')

@section('previous', '/coop3rdrumm3r/3-practice')

@section('next', '/coop3rdrumm3r/5-drum-fills')

@section('prev-thumb', 'https://i.vimeocdn.com/video/551839496-2316746236b066eb501ca6b120f2afb0e5d1a77dab1ee4902541021bbf2ebf79-d?mw=1200&mh=675')

@section('next-thumb', 'https://i.vimeocdn.com/video/551839554-da5d348f09ac3cc5864cc2a4d0651e216216127609a1e657d1e2ba932f673eff-d?mw=1200&mh=675')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Starter grooves",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/4-starter-grooves.pdf",
    ])
@stop
