@extends('pianote.lead-gen.learn-to-play.lesson-layout')

@section('subtitle', 'How to Write a Song')

@section('caption', 'Writing a song might seem hard at first, but it’s actually quite easy when you break it down into its basic components.')

@section('video', 'https://www.youtube.com/embed/UcIx_Ca30G8/')

@section('current-lesson-number', 10)

@section('previous')
    /my-lessons/all-about-arpeggios
@endsection

@section('prev-thumb', 'https://img.youtube.com/vi/X5KiGk1ZCfE/maxresdefault.jpg')

@section('lesson-description')
    <p class="mb-4">
        <strong>Writing a song might seem hard at first, but it’s actually quite easy when you break it down into its basic components.</strong>
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <br class="visible-lg">
            <p>
                First, start off with a simple chord progression.  A great progression to use is the I-IV-V progression. It’ll make for a great progression for the first section of your song.
            </p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
           "gifImage" => cdn('quick-start/gifs/10/i-iv-v-progression-triads.jpg'),
           "imgAlt" => "i-iv-v-progression-triads",
           "gifVideo" => cdn('quick-start/gifs/10/i-iv-v-progression-triads.mp4'),
        ])
    </div>

    <br>

    <p class="mb-4">
        This progression makes a great verse, but it’s just a start.  Every great verse needs a chorus.  When writing your own chorus, remember that simpler is better.  You don’t necessarily need a whole new set of chords for the chorus to sound distinctive from the verse.  Try using the chords you already know!  In this short video series, not only have you learned the C, F and G major chords, but you’ve also learned your first minor chord, A minor.  Swapping from a major progression to a minor progression is a good way to separate the verse from the chorus.
    </p>

    <p class="mb-4">
        Working with chords is one thing, but you’ll also need some cool melody ideas to use over those chords.  As always, remember that less is more for melodies.  Try basing your melodies off the third note in your root chord.  The third note in any triad is the most important note for determining whether that chord is a major or a minor chord.  In this case, that root chord is C major, and the third note of that chord is E.
    </p>

    <p class="mb-4">
        Of course, there are countless ways to write a song.  These ideas are just a couple ways to get you started.  But above all, never be afraid to experiment!  Writing a great song is first and foremost about writing a song that means something to you.  <strong>What emotions or feelings are you trying to express through music? As a songwriter, use your musical technique and theory knowledge and see what you come up with!</strong>
    </p>

@endsection
