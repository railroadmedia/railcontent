@extends('guitareo.lead-gen.guitar-tricks.lesson-page-layout')

@php
    $title = 'Skill #1 - Vibrato';
    $video = '//player.vimeo.com/video/476482371';
    $previous = '/guitar-tricks/your-videos/1-intro';
    $next = '/guitar-tricks/your-videos/3-shampoo';
    $resources = '
        <strong>Skill 1: Vibrato</strong>
        <br><br>
        Vibrato is your new secret weapon. It’s going to be unique to you, and you need to lovingly hone your skills with it over time.
        <br><br>
        But we don’t have that kind of time.
        <br><br>
        We’ve got a commercial soundtrack to add audio to!
        <br><br>
        Here’s your quick reference guide to vibrato:
        <ol class="text-sm leading-7">
            <li>Grab a guitar </li>
            <li>Put your fingers on the strings</li>
            <li>Hit a note</li>
            <li>Shake the note (from the wrist)</li>
        </ol>
        <p>
            We’re ready to go.
            <br><br>
            Add some delay and reverb to your guitar sound if you have it, and let’s go make this commercial.
        </p>

        <a style="background:linear-gradient(180deg,#ffd500,#ffb600) !important; border-color:#ffd500;" href="https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/ShampooJingle-Playthrough.mp3" target="_blank" class="download-button big">Playthrough MP3</a>
        <a style="background:linear-gradient(180deg,#ffd500,#ffb600) !important; border-color:#ffd500;" href="https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/ShampooJingle-FullAd.mp3" target="_blank" class="download-button big">Full Ad MP3</a>
        <a style="background:linear-gradient(180deg,#ffd500,#ffb600) !important; border-color:#ffd500;" href="https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/ShampooJingle-SheetMusic.pdf" target="_blank" class="download-button big">Sheet Music PDF</a>
    ';
@endphp