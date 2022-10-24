@extends('drumeo.lead-gen.ultimate-toolbox.bass-drum-bootcamp.lesson-page')

@section('lesson-title')
    The Swivel Technique
@stop

@section('video', '//player.vimeo.com/video/88288483')

@section('lesson-number', '3')

@section('previous')
    /ultimate-toolbox/bdbc/2
@stop

@section('next')
    /ultimate-toolbox/bdbc/4
@stop

@section('prev-thumb', 'https://i.vimeocdn.com/video/466887795-041cbe3b0281e34f89d71e308ab681f62eacf14b61d16c63eedb7e544a282df0-d_640')

@section('next-thumb', 'https://i.vimeocdn.com/video/513296207-2dbe056a4adb4245aaa999da6f7b169fad09f5fc8364e1d5d6b659822c54245e-d_640')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "PDF",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-swivel-technique.pdf",
    ])

    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "MP3s",
        "zipURL" => "https://dzryyo1we6bm3.cloudfront.net/ultimate-toolbox/bdbc/the-swivel-technique.zip",
    ])
@stop
