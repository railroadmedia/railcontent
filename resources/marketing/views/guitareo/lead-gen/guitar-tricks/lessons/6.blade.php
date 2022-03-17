@extends('guitareo.lead-gen.guitar-tricks.lesson-page-layout')

@php
    $title = 'What’s Next...';
    $video = '//player.vimeo.com/video/476482505';
    $previous = '/guitar-tricks/your-videos/5-truck';
    $resources = '
        <strong>Mission Complete. You’ve done it!</strong>
        <br><br>
        You’ve learned vibrato & palm muting.<br>
        You’ve sold shampoo & trucks.
        <br><br>
        But you know there’s more…
        <br><br>
        So if you’ve enjoyed this journey, then check out Rob’s FULL guitar course, GuitarQuest.
        <br><br>
        Take the skills you’ve just learned, and add to them as you:

        <ul class="text-sm leading-7">
            <li>Join a band</li>
            <li>Realize you should probably know how to play guitar if you’re going to be the guitarist in the band</li>
            <li>Play your first show at an empty bar gig</li>
            <li>Develop your musical career</li>
            <li>Sell out!</li>
        </ul>
        
        <p>Claim your exclusive GuitarQuest discount below, and continue the Quest today.
            <br><br>
            <a href="/guitar-quest-discount-tricks">www.Guitareo.com/guitar-quest-discount-tricks</a>
        </p>
    ';
@endphp