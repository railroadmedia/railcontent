@extends('emails.layout')

@section('page-body')
    <style>
        span.label {font-weight: bold;}
        p.box {border:1px solid grey; padding:10px; margin: 2px 0 10px 0;}
        li {margin-bottom:15px;}
        ul {list-style:none;}
    </style>
    <div>
        <h1>Submission to "How Can We Help?" form</h1>

        <ul>
            <li><span class="label">Student id:</span> {{ $studentId }}</li>

            <li><a href="https://admin.musora.com/admin#/users/{{ $studentId }}">Click here to go to MusoraCenter page for student.</a></li>

            <li>
                <span class="label">Student's email address:</span>
                <p class="box">{{ $studentEmail }}</p>
{{--                <p style="margin:6px 30px;">{{ $studentEmail }}</p>--}}
            </li>

            <li>
                <span class="label">From the options presented, the student selected to following as what they would like help with:</span>
                <p class="box"><i>{{ $helpIssueText }}</i></p>
{{--                <i>{{ $helpIssueText }}</i>--}}
            </li>

            <li>
                <div>
                    <span class="label">Additional comments typed by the student in the available text box:</span>
                    <p class="box">{{ $textInput }}</p>
                </div>
            </li>
        </ul>
    </div>
@stop
