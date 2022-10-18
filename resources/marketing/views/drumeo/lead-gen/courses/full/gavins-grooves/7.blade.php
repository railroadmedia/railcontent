@extends('drumeo.lead-gen.courses.full.gavins-grooves.lesson-page-layout')

@section('title')
    Gavin Harrison &amp; 05Ric - "Life"
@stop

@section('video', '//player.vimeo.com/video/239903253')

@section('lesson-number', '7')

@section('previous')
    /gavins-grooves/course-index/6-anesthetize
@stop

@section('next')
    /gavins-grooves/course-index/8-conclusion
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/663015884-7fd13b20a200561822ac99fb248b5653dbdbcb366a193a198bb117377f087c16-d?mw=1200&mh=675')

@section('next-thumb', 'https://i.vimeocdn.com/video/663016828-3d4605b90d40133d5b7d594f7b2ac2c66adeffa4d4a25ee51e8782626e37e494-d?mw=1200&mh=675')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Life",
        "imgURL" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gavins-grooves/life.png"
    ])
@endsection
