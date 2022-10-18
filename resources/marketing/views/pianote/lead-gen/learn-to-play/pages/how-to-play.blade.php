@extends('pianote.lead-gen.learn-to-play.lesson-layout')

@section('subtitle', 'How to Play Piano')

@section('caption', 'Learning to play piano can seem like a pretty big challenge for a beginner.')

@section('video', 'https://www.youtube.com/embed/UMSQ831_74k/')

@section('current-lesson-number', 1)

@section('next')
    /my-lessons/how-to-play-chords
@endsection

@section('next-thumb', 'https://img.youtube.com/vi/UMSQ831_74k/maxresdefault.jpg')

@section('lesson-description')

    <p class="mb-4">
        <strong>Learning to play piano can seem like a pretty big challenge for a beginner.  You might be staring at your keyboard right now, wondering ‘where do I even start?’</strong>
    </p>

    <p class="mb-4">
        But don’t let all those keys intimidate you!  Making sense of the keyboard is actually quite simple, you just have to know what to look out for.
    </p>

    <h4 class="font-bold mb-3">Identifying Octaves</h4>

    <p class="mb-4">
        The first thing we’ll do is break the piano down into more manageable chunks.  If you look closely at the keyboard, you’ll see that there is actually a pattern to how the keys are laid out.  They’re laid out in such a way that after 12 keys the notes repeat themselves.  We call this sequence of 12 keys an Octave.  A traditional 88 key piano can be split up into just 7 octaves.  Learning to identify this octave pattern is crucial for finding your way around the keyboard.
    </p>

    <h4 class="font-bold mb-3">Finding Middle C</h4>

    <p class="mb-4">
        Now that you know how to split your piano up into discrete octaves, finding specific notes is easy!  Let’s start with the most important note on the piano, Middle C.  How do we find it?  Take a look at the black keys of the piano, and notice how there’s a pattern of black keys across the whole keyboard, alternating between groupings of three black keys and two black keys.
    </p>

    <div class="text-center">
        <img class="piano-img mx-auto" src="https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/graphics/2-octaves.jpg" alt="2-octaves">
    </div>

    <p class="mb-4">
    To find any ‘C’ note, simply take that grouping of two black keys and play the white key just below the lowest black key.  You can see this pattern across the whole keyboard, so if you want to find a ‘C’ note anywhere, all you have to do is find that grouping of two black keys!
    </p>

    <p class="mb-4">
    Middle C is the fourth ‘C’ note from the bottom of the piano.  Take special note of it as it’ll be your home base for learning the entire instrument.
    </p>

    <div class="flex flex-col lg:flex-row">
        <div class="w-full lg:w-1/2">
            <h4 class="font-bold mb-3">Naming the Notes</h4>

            <p class="mb-4">
                Knowing middle C is one thing, but what about all those other notes in the octave?  These notes are all given letters as well.  For now, just focus on the white keys.  Walking up from middle C, the note order is D, E, F, G, A, B, and then the octave pattern repeats with C again.
            </p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/c-major-scale.jpg',
            "imgAlt" => "c-major-scale",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/c-major-scale.mp4',
        ])
    </div>

    <div class="flex flex-col lg:flex-row">
        <div class="w-full lg:w-1/2">
            <h4 class="font-bold mb-3">Number The Fingers</h4>

            <p class="mb-4">In order to play the piano to the best of our ability, you need to be sure to play with the proper fingerings.  The first step to proper fingerings is to number the fingers themselves.  For both hands the fingerings go from #1 for thumbs to #5 for the pinky finger.</p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/fingers.jpg',
            "imgAlt" => "fingers",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/fingers.mp4',
        ])
    </div>

    <h4 class="font-bold mb-3">Playing Scales</h4>

    <p class="mb-4">
    Now that you know the numbers for your fingers and the names of the notes, you can apply your knowledge to play a C major scale.  The C major scale consists of eight notes from C to the C in the octave above.  This means that you’ll need to learn some special finger techniques to get your five fingers to play an eight note sequence fluidly.
    </p>

    <p class="mb-4">
    The fingering pattern in the right hand is 1, 2, 3, 1, 2, 3, 4, 5.  Notice how there’s a fingering reset between the 3rd and 4th notes of the scale.  In order to play this order of fingerings fluidly, you’ll need to master a technique called the thumbtuck.  A thumbtuck involves curling your thumb under your hand in order to play reposition your hand and continue playing a phrase.  Although it may seem simple, the thumbtuck is one of the most important skills in a pianist’s bag of tricks, so make sure you’re always aware of it during your practice sessions!
    </p>

    <div class="flex flex-col lg:flex-row">
        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/thumbtuck.jpg',
            "imgAlt" => "thumbtuck",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/thumbtuck.mp4',
        ])

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/left-hand-thumbtuck.jpg',
            "imgAlt" => "left-hand-thumbtuck",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/01/left-hand-thumbtuck.mp4',
        ])
    </div>

    <br>

    <p class="mb-4">
    When playing scales in the left hand, all the same rules apply, except our hands are mirrored.  This means the fingering pattern is 5, 4, 3, 2, 1, 3, 2, 1.  Keep an eye out for that fingertuck between notes 5 and 6.  It’s a similar motion to the right hand, but this time your middle finger will cross over to continue playing the scale.
    </p>

    <p class="mb-4">
    Practicing scales is just one of the many ways you’ll build confidence and musicality as a piano player.  When you’re practicing them make sure you’ve got your technique and fingerings consistently solid.  <strong>Prioritizing good technique in your early days as a piano player will pay off HUGELY moving forward!</strong>
    </p>

@endsection

@php
    $currentLesson = 0;
@endphp
