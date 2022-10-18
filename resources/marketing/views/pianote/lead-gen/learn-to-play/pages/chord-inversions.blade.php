@extends('pianote.lead-gen.learn-to-play.lesson-layout')

@section('subtitle', 'How to Play Chord Inversions')

@section('caption', 'Chord inversions are a way to take these same chords you’ve already learned, and restacking the order of the notes in the chord.')

@section('video', 'https://www.youtube.com/embed/8WyHzHCp2R8/')

@section('current-lesson-number', 7)

@section('previous')
    /my-lessons/minor-keys
@endsection

@section('next')
    /my-lessons/other-chords
@endsection

@section('prev-thumb', 'https://img.youtube.com/vi/EtHao8Hi4ac/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/-_MkQ3qJkWc/maxresdefault.jpg')

@section('lesson-description')
    <p class="mb-4">
        <strong>Now that you’ve learned all about chord inversions and how to form the basic triads, let’s talk about chord inversions.</strong>  Chord inversions are a way to take these same chords you’ve already learned, and restacking the order of the notes in the chord.  This serves two purposes.  First, chord inversions can change the sound of the chord.  Second, chord inversions are a great way to move from different chords smoothly without having to make great jumps across the keyboard.
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <br class="visible-lg">
            <p>Let’s take a closer look at the C major triad.  The C major chord is built up of C, E, and G.  But we can take this same chord and play it with E in the base, then G, and C on top.  This chord is called C 1st inversion.</p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-1st-inversion.jpg',
            "imgAlt" => "c-1st-inversion",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-1st-inversion.mp4',
        ])
    </div>

    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <br class="visible-lg">
            <p>We can play the C major triad in another way as well.  If we put the G in the bass, then play C and E on top, we create C 2nd inversion</p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-2nd-inversion.jpg',
            "imgAlt" => "c-2nd-inversion",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-2nd-inversion.mp4',
        ])
    </div>

    <br>

    <p class="mb-4">
        When playing a chord in 2nd inversion, your fingering should alter slightly.  In the right hand, you play fingers 1-2-5 and in the left hand you play 5-2-1 to best voice each chord.
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <br class="visible-lg">
            <p>With knowledge of these chord inversions, it is much easier to create chords on the keyboard and move from chord to chord.  It’s also a great practice exercise to play all the chord inversions in one pass, moving up and down the keyboard.</p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
           "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-triads-exercise.jpg',
           "imgAlt" => "c-triads-exercise",
           "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/07/c-triads-exercise.mp4',
       ])
    </div>

    <br>

    <p class="mb-4">
        <strong>Now that you know how to create these chord inversions, you can take these principles and create chord inversions for the other chords you know!</strong>
    </p>

@endsection
