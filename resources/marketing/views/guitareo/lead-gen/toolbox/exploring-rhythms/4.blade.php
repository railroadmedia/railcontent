@extends('guitareo.lead-gen.toolbox.exploring-rhythms.lesson')

@section('subtitle')
    Whole & Half Note Exercises 2
@endsection

@section('video', 'https://player.vimeo.com/video/179472230')

@section('current-lesson-number', 4)

@section('previous', '/toolbox/lessons/exploring-guitar-rhythms/3')

@section('next', '/toolbox/lessons/exploring-guitar-rhythms/5')

@section('prev-thumb', 'https://i.vimeocdn.com/video/588524938-7cb7cd4f02d4a50be81b94f5822b510367f04aed9ec0f2703631fd4dfa2bc07b-d?mw=1100&mh=619')

@section('next-thumb', 'https://i.vimeocdn.com/video/587449342-817583dd41b64204a4d0825b54404bbfce3a890636df031759353638a5913b3d-d?mw=1100&mh=619')

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Reading Rhythm Examples 1-10 - PNG",
        "imgURL" => "https://guitarlessons-com.s3.amazonaws.com/guitar-lessons-resources/graphics/reading-rhythms-1/reading-rhythms-1-10.png"
    ])
@endsection
