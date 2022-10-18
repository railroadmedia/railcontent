@extends('drumeo.lead-gen.getting-started.lesson-page')

@section('title')
    Basic Counting
@stop

@section('video', '//player.vimeo.com/video/91367890')

@section('lesson-number', '5')

@section('previous', '/getting-started/4-reading-drum-notation')

@section('next', '/getting-started/6-your-first-beat')

@section('prev-thumb', 'https://i.vimeocdn.com/video/469050062-930904bdcfd1f34a6b5d2a0264cfe3a81b7deac917bcf6b785e5dfe66460532a-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/469052552-33deecae0570b09577411a972fa6f80334c930dd68b498e57f1509505b3b3f4b-d?mw=1000&mh=563')

@section('assets')
    @parent

    @include('lead-gen.partials._assignment-resources', [
        "title" => "Basic Counting",
        "pdfURL" => "https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/5-basic-counting.jpg",
    ])
@stop
