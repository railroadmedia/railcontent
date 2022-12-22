@extends('drumeo.lead-gen.faster.lesson-page')

@section('title')
    Day 5 - Crazy Crossover
@stop

@section('video', 'https://www.youtube.com/embed/liDmsVjp2wE')

@section('lesson-number', '5')

@section('previous', '/faster/4')

@section('next', '/faster/6')

@section('prev-thumb', 'https://img.youtube.com/vi/MbscOsXBwtU/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/55yHSKYj_6k/maxresdefault.jpg')

@section('assets')
    @include('drumeo.lead-gen.partials._assignment-resources', [
        "title" => "Crazy Crossovers",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/05-crazy-crossovers.png",
    ])

    <br>
    <p class="text-left hide">
        Drumming isn’t all about crossovers and showmanship, but they sure look cool and are fun to practice! I don’t use crossovers that much while I’m playing the drums, but they’ve been extremely helpful for me while warming up or practicing speed - they’re a great way to get some exercise and you’ll definitely break a sweat as you speed it up!
        <br><br> The first pattern is just a simple 16 note crossover fill. Play this as a single stroke roll and go slowly to start. The last thing you want to do is bash your knuckles with a drumstick.
        <br><br> For the second exercise we’re going to increase the complexity by using 16th note triplets. Again, play all single strokes when practicing these. Start off by learning the pattern then practice playing it as a one-bar fill.
        <br><br> The final pattern is definitely the most challenging. Normally I have just used this pattern as a 10-note single stroke grouping - but for the sake of keeping this as a one-bar fill, I decided to turn it into 32nd notes - so the main pattern repeats three times and ends with two extra 32nd notes. Start this off at 50 bpm and increase tempo only when you are very comfortable with the pattern played to a metronome.
    </p>
@stop
