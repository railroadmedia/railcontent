@extends('drumeo.lead-gen.fastest-way-to-get-faster.lesson-page')

@section('title')
    Day 1 - Paradiddle Madness
@stop

@section('video', 'https://www.youtube.com/embed/URG4sD7HjwA')

@section('lesson-number', '1')

@section('next', '/faster/2')

@section('next-thumb', 'https://img.youtube.com/vi/6N658525ULs/maxresdefault.jpg')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "Paradiddle Madness",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/01-paradiddle-madness.png",
    ])
    <br>
    <p class="text-left hide">
        Most of what we play on the drums is simply a combination of singles and double strokes - and that’s why I love the practicality of today’s Paradiddle Madness exercise.
        <br><br> The first pattern is a triple paradiddle played around the kit, starting on the snare and moving down the three toms. If you only have two toms, you can play double the notes on the snare drum and floor tom. Next, we have a double paradiddle in a bar of 3 / 4. Just like the triple paradiddle, this one also moves down and back up the drum-set. Finally, there is the single paradiddle that moves between the snare and hi-tom.
        <br><br> Once you have practiced each pattern individually, you can play them all together in sequence with each other. Remember to start at a slower tempo of at least 60 bpm and increase your speed in 5 bpm intervals.
    </p>
@stop
