@extends('drumeo.lead-gen.fastest-way-to-get-faster.lesson-page')

@section('title')
    Day 7 - The Main Foot Killer
@stop

@section('video', 'https://www.youtube.com/embed/aixl1vCL3Wk')

@section('lesson-number', '7')

@section('previous', '/faster/6')

@section('next', '/faster/8')

@section('prev-thumb', 'https://img.youtube.com/vi/55yHSKYj_6k/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/EEra-3i65yQ/maxresdefault.jpg')

@section('assets')
    @include('lead-gen.partials._assignment-resources', [
        "title" => "The Main Foot Killer",
        "pdfURL" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/png/07-the-main-foot-killer.png",
    ])

    <br>
    <p class="text-left hide">
        Simply playing fast isn’t enough, but it all comes together when you add control. So let’s get your main foot ready for a battle of double-stroke madness that will help you alternate between your lead hand and your main foot for controlled double strokes. (This is a valuable tool to have in your toolbox for that next gig or recording session.)
        <br><br> The first exercise starts with groups of four and the pattern is played in 4/4 timing. Next, the pattern is played in 5/4 using 16th note groups of five, and finally we have groups of seven played as 16th notes in 7/4. I’d recommend using a quarter note click and don’t worry too much about the odd times.
        <br><br> Start off by practicing each pattern individually, then practice them in sequence starting with a 60 bpm click track. If you find that is too fast, feel free to slow it down!
    </p>
@stop
