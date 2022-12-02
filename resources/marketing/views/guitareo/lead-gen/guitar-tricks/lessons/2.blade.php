@extends('guitareo.lead-gen.guitar-tricks.lesson-page-layout')

@section('subtitle')
    Skill #1 - Vibrato
@stop

@section('video', '//player.vimeo.com/video/476482371')

@section('current-lesson-number', 2)

@section('previous', '/guitar-tricks/your-videos/1-intro')

@section('next', '/guitar-tricks/your-videos/3-shampoo')

@section('prev-thumb', 'https://i.vimeocdn.com/video/997054724-4d463ff2db28c0ea62592effdb7f09a1df500854a839741b2a5caacecae484f6-d?mw=1200&mh=675')

@section('next-thumb', 'https://i.vimeocdn.com/video/997056488-b8a318adb6981c3394bb2cc8ca65108ddafb390dec5f63c2fb4c058b0d7a97c8-d?mw=1000&mh=562')

@section('lesson-description')
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
@endsection

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Playthrough MP3",
        "mp3URL" => "https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/ShampooJingle-Playthrough.mp3"
    ])
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Full Ad MP3",
        "mp3URL" => "https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/ShampooJingle-FullAd.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Sheet Music PDF",
        "pdfURL" => "https://guitareo.s3.amazonaws.com/guitarquest/2-Simple-Guitar-Tricks/ShampooJingle-SheetMusic.pdf"
    ])
@endsection
