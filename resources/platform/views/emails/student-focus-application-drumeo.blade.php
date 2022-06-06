@extends('emails.layout')

@section('page-body')
<style>
    h3{font-size:1.3em}
</style>
<div>
    <p>{{$input['sender'] }} has requested a student-focus review!</p>

    <h3>What is your current drumming skill level?</h3>
    <p>{{$input['experience']}}</p>

    <h3>What is one aspect of your drumming you'd like to improve on?</h3>
    <p>{{$input['improvement']}}</p>

    <h3>What is your biggest weakness as a drummer?</h3>
    <p>{{$input['weakness']}}</p>

    <h3>What would you like the instructor to focus on?</h3>
    <p>{{$input['instructor_focus']}}</p>

    <h3>What is your goal as a drummer?</h3>
    <p>{{$input['goal']}}</p>

    <h3>Youtube Video URL</h3>
    <p>{{$input['youtube_url']}}</p>
</div>
@stop
