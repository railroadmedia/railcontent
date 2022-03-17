@extends('guitareo.lead-gen.acoustic-guitar-jumpstart.lesson-page-layout')

@php
    $title = 'Learning Songs';
    $video = '//player.vimeo.com/video/299279143';
    $previous = '/acoustic-guitar-jumpstart/course-index/5';
    $next = '/acoustic-guitar-jumpstart/course-index/7';
    $resources = '
        <strong>Full Speed</strong><br>
        <audio class="w-full" src="https://s3.amazonaws.com/guitareo/acoustic-jump-start/jambalaya.mp3" controls></audio>
        <br><br>
        <strong>Slow Speed</strong><br>
        <audio class="w-full" src="https://s3.amazonaws.com/guitareo/acoustic-jump-start/jambalaya-slow.mp3" controls></audio>
        <br><br>
    ';
@endphp