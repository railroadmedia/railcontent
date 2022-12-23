@extends('pianote.lead-gen.learn-to-play.lesson-layout')

@section('subtitle', 'How to Play F-Major')

@section('caption', 'Let’s look at the key of F-Major. F-Major features a flat note in its key signature.')

@section('video', 'https://www.youtube.com/embed/K4rl7HCjunw/')

@section('current-lesson-number', 5)

@section('previous')
    /my-lessons/play-g-major
@endsection

@section('next')
    /my-lessons/minor-keys
@endsection

@section('prev-thumb', 'https://img.youtube.com/vi/0PP-PofEpew/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/EtHao8Hi4ac/maxresdefault.jpg')

@section('lesson-description')
    <p class="mb-4">
        <strong>Let’s look at the key of F major.  F major features a flat note in its key signature.</strong>  Flattening a note works in much the same way as sharpening a note, except this time you’ll be lowering a note by a semitone.  The special flat note in F major is B-flat.  That means playing the black key between notes A and B.
    </p>


    <p class="mb-4">
        The reason why we need to add sharps and flats to certain keys is because there is a formula that all major scales follow.  Without this formula all of your scales will sound slightly off in one way or another.  Let’s take a look at how this formula works to give us that major scale sound.  We can break any scale down into a series of full-tones and semitones.  You’ve already learned about semitones via sharps and flats.  A full-tone step is two piano keys apart.  For example, the jump from E to F is a semitone jump, as there's not black key in between..
    </p>

    <img class="piano-img w-full" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/graphics/full-tone-semi-tone.jpg}" alt="full-tone-semi-tone">

    <p class="mb-4">
        A major scale is mostly made up of fulltones with two big exceptions.  There are semitone jumps between notes 3-4 and notes 7-8 of every major scale.  If you look closely at the pattern of the keyboard from starting on F, you can see why we need to flatten the fourth note, B in order for the scale to work within that formula.  As long as you remember those two semitone ‘jump-points’ you can play that major scale pattern in any key!
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <p class="w-full lg:w-1/2">
            Because of this B-flat note, there’s a slight change in the fingering pattern needed in order to play the F major scale accurately. <strong>All that you need to change is instead of playing 1-2-3 and then thumbtucking to reset your hands on the 4th note, this time you’ll play 1-2-3-4 and THEN thumbtuck to reset your hand on the 5th note.</strong>
        </p>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/05/f-major-scale.jpg',
            "imgAlt" => "f-major-scale",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/05/f-major-scale.mp4',
        ])
    </div>
@endsection
