@extends('drumeo.lead-gen.linear-drumming.lesson-page')

@section('title')
    Rock Tom Grooves​
@stop

@section('video', '//player.vimeo.com/video/158554381')

@section('lesson-number', '3')

@section('previous')
    /linear-drumming/2-dance-pop/
@endsection

@section('next')
    /linear-drumming/4-gospel/
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/560726966-41e3db31ccbccda9d6a259160f07ed51c064dbbfb09a3e56a12e9065b9043655-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/560727540-477b10caa006c5bd1c67b666ca5ff8408b56e302acfdeffc32513f649aa716bb-d_640')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Rock Tom Grooves​​",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/cooperdrummer/03-rock-tom-grooves.pdf",
    ])
@stop
