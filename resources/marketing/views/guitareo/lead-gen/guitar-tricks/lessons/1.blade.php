@extends('guitareo.lead-gen.guitar-tricks.lesson-page-layout')

@php
    $title = 'Introduction';
    $video = '//player.vimeo.com/video/476482334';
    $next = '/guitar-tricks/your-videos/2-vibrato';
    $resources = '
        <strong>Thank goodness you’re here! We have a mission.</strong>
        <br><br>
        You’ve been learning to play guitar, and now your band has to sell-out in order to afford some new gear.
        <br><br>
        We’ve got two things to do:<br>
        1. Sell Trucks<br>
        2. Sell Shampoo<br>
        <br><br>
        But first we’ll need to learn some guitar techniques to create the ultimate sales jingles.
        <br><br>
        Today we’ll learn to use <strong>vibrato</strong> and <strong>palm muting</strong> in a musical way to get those trucks off the lot and the shampoo off the shelves.
        <br><br>
        Onwards, to vibrato.
    ';
@endphp