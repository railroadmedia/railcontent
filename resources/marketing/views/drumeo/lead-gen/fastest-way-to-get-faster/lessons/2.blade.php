@extends('drumeo.lead-gen.fastest-way-to-get-faster.lesson-page')

@section('title')
    Day 2 - The Buddy Bruiser
@stop

@section('video', 'https://www.youtube.com/embed/6N658525ULs')

@section('lesson-number', '2')

@section('previous', '/faster/1')

@section('next', '/faster/3')

@section('prev-thumb', 'https://img.youtube.com/vi/URG4sD7HjwA/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/AxLiCX13xGI/maxresdefault.jpg')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "The Buddy Bruiser",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/02-the-buddy-bruiser.png",
    ])
    <br>
    <p class="text-left hide">
        I can’t say for certain that Buddy Rich played this exact fill, but it sure sounds like something he would do, especially when it’s played super fast.
        <br><br> The exercise is played using triplets and will again help increase your speed and movement around the drum-set. Most drummers are very good at playing groups of four around the kit and always leading each of those groupings with their dominant hand. Well, that’s going to change right now. When you move from drum to drum you’ll be changing the lead hand. I know it looks easy, but it’s not when you push it faster and faster!
        <br><br> You can start this one a little faster at 70-80 bpm and move up in increments of 5 bpm at a time as you become comfortable with the pattern.
    </p>
@stop
