@extends('drumeo.lead-gen.fastest-way-to-get-faster.lesson-page')

@section('title')
    Day 4 - Do You Even Math?
@stop

@section('video', 'https://www.youtube.com/embed/MbscOsXBwtU')

@section('lesson-number', '4')

@section('previous', '/faster/3')

@section('next', '/faster/5')

@section('prev-thumb', 'https://img.youtube.com/vi/AxLiCX13xGI/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/liDmsVjp2wE/maxresdefault.jpg')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Do you Even Math",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/04-do-you-even-math.png",
    ])

    <br>
    <p class="text-left hide">
        Okay, it’s not a very good title but hopefully I caught your attention and you are reading this wondering what I was thinking!?
        <br><br> This is one of my favorite ways to practice my speed and fluidity around the kit. The first pattern is in 2/4, you play two notes on each drum moving down to the floor tom and then back to the snare. Each following pattern uses the exact same format. You’ll start with groups of two, then move to four, six, and eights.
        <br><br> When practicing this as a sequence or individually, you’ll notice that one of the hardest parts is to re-start the pattern back on the snare. Since you have to come over from the floor tom it can cause a traffic jam between the right and left hands. Just start slowly with this at 60 bpm and speed up at increments of 5 bpm.
    </p>
@stop
