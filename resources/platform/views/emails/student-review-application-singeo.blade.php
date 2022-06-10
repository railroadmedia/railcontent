@extends('emails.layout')

@section('page-body')
    <style>
        h3{font-size:1.3em}
    </style>
    <div>
        <p>{{$input['sender'] }} has requested a student-focus review!

        <h3>Student Progress info</h3>
        <p>{{$input['student-progress-info']}}</p>

        <h3>What is your goal as a singer?</h3>
        <p>{{$input['goal']}}</p>

        <h3>What is one skill you'd like to improve on?</h3>
        <p>{{$input['improvement']}}</p>

        <h3>What is your biggest weakness as a singer?</h3>
        <p>{{$input['weakness']}}</p>

        <h3>Tell us about your submission. What are you playing and what would you like the instructor to focus on?</h3>
        <p>{{$input['instructor_focus']}}</p>

        <h3>Youtube Video URL</h3>
        <p>{{$input['youtube_url']}}</p>
    </div>
@stop
