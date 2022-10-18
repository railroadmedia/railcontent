@extends('pianote.lead-gen.learn-to-play.lesson-layout')

@section('subtitle', 'How to Play Other Chords In The Major Keys')

@section('caption', 'Now that you know the basics of creating chords, you can build all sorts of different chords within the major scale.')

@section('video', 'https://www.youtube.com/embed/-_MkQ3qJkWc/')

@section('current-lesson-number', 8)

@section('previous')
    /my-lessons/chord-inversions
@endsection

@section('next')
    /my-lessons/all-about-arpeggios
@endsection

@section('prev-thumb', 'https://img.youtube.com/vi/8WyHzHCp2R8/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/X5KiGk1ZCfE/maxresdefault.jpg')

@section('lesson-description')
    <p class="mb-4">
        <strong>Now that you know the basics of creating chords, you can build all sorts of different chords within the major scale,</strong> easily making all sorts of new sounding triads, built entirely out of that major scale!
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <p class="w-full lg:w-1/2">
            If you take that basic triad form, you can walk up the C major scale, making triads out of each chord.  Starting with the C chord, move each finger up one white key, making a chord that consists of notes D-F-A.  If you think this chord sounds quite different from C major, that’s because it’s a totally different type of chord called a minor chord.  These chords sound a lot sadder, more mysterious than their major counterparts.
        </p>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/d-minor-chord.jpg',
            "imgAlt" => "d-minor-chord",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/d-minor-chord.mp4',
        ])
    </div>

    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <br class="visible-lg">
            <p>
                If you continue to walk up the scale making chords in this manner you’ll create another minor chord based off the notes E-G-B, creating an E minor chord.
            </p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
           "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/e-minor-chord.jpg',
           "imgAlt" => "e-minor-chord",
           "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/e-minor-chord.mp4',
        ])
    </div>

    <br><br class="hidden lg:inline">

    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <br class="visible-lg">
            <p>The next two chords are the 4th and 5th chords in the major key.  You’re already familiar with the F and G major triads.</p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
           "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/f-major-and-g-major-chords.jpg',
           "imgAlt" => "f-major-and-g-major-chords",
           "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/f-major-and-g-major-chords.mp4',
       ])
    </div>

    <br><br class="hidden lg:inline">

    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <br class="visible-lg">
            <p>The final triad you can make walking up the major scale is a unique sounding chord, the half-diminished chord.  This chord is made from the notes B-D-F.</p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
           "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/b-half-diminished-chord.jpg',
           "imgAlt" => "b-half-diminished-chord",
           "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/08/b-half-diminished-chord.mp4',
       ])
    </div>

    <br><br class="hidden lg:inline">

    <p class="mb-4">
        <strong>Now that you have access to all these chords, experiment with combining them in different ways to create your own chord progressions, working entirely within the major key!</strong>
    </p>

@endsection
