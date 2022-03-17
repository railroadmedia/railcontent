@extends('guitareo.lead-gen.guitar-tricks.lesson-page-layout')

@php
    $title = 'Skill #2 - Palm Muting';
    $video = '//player.vimeo.com/video/476482409';
    $previous = '/guitar-tricks/your-videos/3-shampoo';
    $next = '/guitar-tricks/your-videos/5-truck';
    $resources = '
        <strong>Skill 2: Palm Muting</strong>
        <br><br>

        Palm muting is a cross-genre skill, but today we need you to put it to work in a country themed truck commercial. To get yourself in the mood for this skill you’ll need to imagine a dusty porch, a rocking chair, and some tumbleweeds rolling across your homestead.
        <br><br>
        Y’all ready?

        <ol class="text-sm leading-7">
            <li>Learn the E Major Chord</li>
            <li>Practice the placement of your palm for ultimate chunky muting </li>
            <li>Practice alternating between strumming and palm muting</li>
            <li>Wait for checks in the mail</li>
        </ol>

        <p>When you’re ready to perform, it’s time to make the jingle:</p>

        <ol class="text-sm leading-7">
            <li>Download the full truck ad MP3 to hear what the jingle track sounds like with guitar.</li>
            <li>Download the Playthrough MP3 where YOU will play the guitar part.</li>
            <li>Click through to the <a href="/guitar-tricks/your-videos/5-truck">next video</a> to see the advertisement come to life!</li>
        </ol>

        <a style="background:linear-gradient(180deg,#ffd500,#ffb600) !important; border-color:#ffd500;" href="https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/TruckJingle-Playthrough.mp3" target="_blank" class="download-button big">Playthrough MP3</a>
        <a style="background:linear-gradient(180deg,#ffd500,#ffb600) !important; border-color:#ffd500;" href="https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/TruckJingle-FullAd.mp3" target="_blank" class="download-button big">Full Ad MP3</a>
        <a style="background:linear-gradient(180deg,#ffd500,#ffb600) !important; border-color:#ffd500;" href="https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/TruckJingle-SheetMusic.pdf" target="_blank" class="download-button big">Sheet Music PDF</a>
    ';
@endphp