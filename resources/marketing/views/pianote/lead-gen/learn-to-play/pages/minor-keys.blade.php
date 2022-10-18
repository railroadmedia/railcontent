@extends('pianote.lead-gen.learn-to-play.lesson-layout')

@section('subtitle', 'Minor Keys')

@section('caption', 'We’ve learned so much about major chords and scales, but what about minor chords?')

@section('video', 'https://www.youtube.com/embed/EtHao8Hi4ac/')

@section('current-lesson-number', 6)

@section('previous')
    /my-lessons/play-f-major
@endsection

@section('next')
    /my-lessons/chord-inversions
@endsection

@section('prev-thumb', 'https://img.youtube.com/vi/K4rl7HCjunw/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/8WyHzHCp2R8/maxresdefault.jpg')

@section('lesson-description')
    <p class="mb-4">
        <strong>We’ve learned so much about major chords and scales, but what about minor chords?</strong> For every chord and scale that you’ve learned so far, there is a relative minor chord.  The good news is you’ve already learned everything you need to know to play minor chords and scales.  That’s because every minor chord and scale is based off of the notes used in a major chord or scale.  Since you’ve already learned about the C major, G major, and F major chords, you can easily learn the relative minor of these three chords!  Let’s start with finding the relative minor of the C major chord.
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <br class="visible-lg">
            <p>To find the relative minor key, all you have to do is count up to the 6th note in the C major scale.  Try walking the C major scale up to its 6th note, landing on A.</p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/walk-from-a-c.jpg',
            "imgAlt" => "walk-from-a-c",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/walk-from-a-c.mp4',
        ])
    </div>

    <br>

    <p class="mb-4">
        If you start a scale on note A using the same notes as the C major scale, you’ll play an entirely different sounding scale called the A minor scale.  You can even use the same fingerings to play it in the both hands!
    </p>

    <p class="mb-4">
        If you want to find the relative minors of the other keys you’ve learned, all you have to do is count up to the 6th note of that major scale!  Using this rule, you can see that the relative minor of G is E minor, and the relative minor of F is D minor.  Remember, each of these relative minors use the exact same notes as their relative major counterparts.
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <br class="visible-lg">
            <p>
                What about minor chords?  They follow a very similar principle as the major chords.  All minor triads are based on the 1st, 3rd and 5th note of the minor scale.  This means that the A minor triad is comprised of notes A-C-E
            </p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/a-minor-triad.jpg',
            "imgAlt" => "a-minor-triad",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/a-minor-triad.mp4',
        ])
    </div>

    <div class="flex flex-col lg:flex-row lg:mt-3 mb-4">
        <br>
        <p class="small-body text-center w-full lg:w-1/2">
            The E minor triad is composed of notes E-G-B
        </p>

        <p class="small-body text-center w-full lg:w-1/2 hidden lg:block">
            The D minor triad is composed of notes D-F-A
        </p>
    </div>

    <div class="flex flex-col lg:flex-row mb-4">
        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/e-minor-triad.jpg',
            "imgAlt" => "e-minor-triad",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/e-minor-triad.mp4',
        ])

        <br>

        <p class="small-body text-center lg:hidden">The D minor triad is composed of notes D-F-A</p>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/d-minor-triad.jpg',
            "imgAlt" => "d-minor-triad",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/06/d-minor-triad.mp4',
        ])
    </div>

    <br>

    <p class="mb-4">
        Now that you know some chords and scales in the minor keys, you have any entirely new sound palette to practice, experiment and play with!  A good way to get these new sounds under your fingers is to jump back and forth between the major chord and its relative minor chord.  <strong>Not only will you be practicing the chords themselves, but you’ll also be working on your ear training, helping your ear identify the relationship between major and minor chords.</strong>
    </p>
@endsection
