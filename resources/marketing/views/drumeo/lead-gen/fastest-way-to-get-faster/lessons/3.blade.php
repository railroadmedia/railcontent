@extends('drumeo.lead-gen.fastest-way-to-get-faster.lesson-page')

@section('title')
    Day 3 - The Forearm Crusher
@stop

@section('video', 'https://www.youtube.com/embed/AxLiCX13xGI')

@section('lesson-number', '3')

@section('previous', '/faster/2')

@section('next', '/faster/4')

@section('prev-thumb', 'https://img.youtube.com/vi/6N658525ULs/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/MbscOsXBwtU/maxresdefault.jpg')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "The Forearm Crusher",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/03-the-forearm-crusher.png",
    ])

    <br>
    <p class="text-left hide">
        This warm-up is not something I created; I was first inspired to practice it when hanging out with Larnell Lewis (check him out if you haven’t).
        <br><br> It’s a simple exercise that consists of one bar of single strokes, one bar double strokes, and one bar single paradiddle. You’re probably saying to yourself, “well, that’s easy!” But it’s not as easy as you think if you force yourself to focus on the right things. Start off just by familiarizing yourself with the individual patterns, then move on to playing them in sequence.
        <br><br> When playing, focus on getting the singles, doubles, and paradiddles to all sound totally even. If I was listening to you practice, I should have trouble discerning when you were switching between stickings. Once you can seamlessly switch between the stickings, start to speed this up and move it around the kit. You’re going to notice huge improvements!
    </p>
@stop
