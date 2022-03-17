@extends('guitareo.lead-gen.guitar-tricks.lesson-page-layout')

@php
    $title = 'Shampoo Jingle';
    $video = '//player.vimeo.com/video/476482393';
    $previous = '/guitar-tricks/your-videos/2-vibrato';
    $next = '/guitar-tricks/your-videos/4-palm-muting';
    $resources = '
        <strong>Mission 1: Shampoo Ad Performance</strong>
        <br><br>
        This is it! The moment you’ve been waiting for -- all of your hard work pays off and the advertisement comes to life.
        <br><br>
        Use the technique we studied in painstaking depth in the last video, and put it to work now. Your wallet depends on it!
        <br><br>
        <strong>Quick Tip:</strong> The note you are performing the vibrato on is on the 11th fret of the G string. Which one is the G string? The 3rd from the bottom!
        <br><br>
        Once you’ve locked in the best vibrato performance of your life carry on to the next video to learn trick #2.
    ';
@endphp
