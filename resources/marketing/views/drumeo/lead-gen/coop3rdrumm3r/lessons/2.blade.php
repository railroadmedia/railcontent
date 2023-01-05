@extends('drumeo.lead-gen.coop3rdrumm3r.lesson-page')

@section('title')
    Drum Theory
@stop

@section('video', '//player.vimeo.com/video/149674628')

@section('lesson-number', '2')

@section('previous', '/coop3rdrumm3r/1-the-drum-set')

@section('next', '/coop3rdrumm3r/3-practice')

@section('prev-thumb', 'https://i.vimeocdn.com/video/551839388-a432e655008cce35ee73cec69639b3c801281023879f6a54a323f112782e7ef3-d?mw=1200&mh=675')

@section('next-thumb', 'https://i.vimeocdn.com/video/551839496-2316746236b066eb501ca6b120f2afb0e5d1a77dab1ee4902541021bbf2ebf79-d?mw=1200&mh=675')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Drum theory",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/2-drum-theory.pdf",
    ])
@stop
