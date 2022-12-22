@extends('guitareo.lead-gen.solo-in-an-hour.lesson-page-layout')

@section('subtitle')
    What About Soloing In Other Keys?
@stop

@section('video', '//player.vimeo.com/video/551517736')

@section('current-lesson-number', 6)

@section('previous', '/solo-in-an-hour/lessons/5')

@section('next', '/solo-in-an-hour/lessons/7')

@section('prev-thumb', 'https://i.vimeocdn.com/video/1301277567-c7534c605249a9a84856d69ca7222a8a9bb5dd3b1e066643c?mw=1000&mh=562')

@section('next-thumb', 'https://i.vimeocdn.com/video/1141503595-cd09b4777d9c0f51bf68a566bcc257c0ad80224077a43fd886e986c136bdcef8-d?mw=1000&mh=562')

@section('lesson-description')
    In case you haven’t realized... not all music is in the same key.
    <br><br>
    But once you know how to solo in one key, you’ll know how to solo in any key. Ayla will show you how.
    <br><br>
@endsection

@section('assignments')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Soloing in different keys",
        "subTitle" => "Apply everything you learned so far about soloing to these new keys.",
        "assignmentID" => "jamTrack",
        "soundslice" => "1HTDc",
    ])
@stop

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track - Key of C",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/303786-resource-1621453970.mp3"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Jam Track - Key of E",
        "mp3URL" => "https://d1923uyy6spedc.cloudfront.net/303787-resource-1621453625.mp3"
    ])
@stop
