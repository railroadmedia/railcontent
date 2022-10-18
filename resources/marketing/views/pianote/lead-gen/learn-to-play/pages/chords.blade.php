@extends('pianote.lead-gen.learn-to-play.lesson-layout')

@section('subtitle', 'How to Play Chords')

@section('caption', 'Let’s look at how to play chords.  A chord is a combination of three or more notes played in unison.')

@section('video', 'https://www.youtube.com/embed/sb9RNEhMauw/')

@section('current-lesson-number', 2)

@section('previous')
    /my-lessons/how-to-play-piano
@endsection

@section('next')
    /my-lessons/strengthening-your-hands
@endsection

@section('prev-thumb', 'https://img.youtube.com/vi/UMSQ831_74k/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/s54At63Ee5o/maxresdefault.jpg')

@section('lesson-description')
    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <p>
                <strong>Let’s look at how to play chords.  A chord is a combination of three or more notes played in unison.</strong>  The easiest chord to learn is the Major Triad.  Every Major triad you’ll come across is built out of the 1st, 3rd, and 5th notes of a major scale.  We’ll look at C major triad as our first chord.  The C major triad is built up of the notes C - E - G.
            </p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/02/c-major-triad.jpg',
            "imgAlt" => "c-major-triad",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/02/c-major-triad.mp4',
        ])
    </div>

    <br class="lg:hidden">

    <div class="flex flex-col lg:flex-row mb-4">
        <p class="w-full lg:w-1/2">
            In the right hand, you play the chord with fingers 1 - 3 - 5.  When you’re practicing chords, be sure to keep your fingers rounded so that you’re playing the keyboard with the balls of your fingertips.  This will allow your hands to have maximum power, control and accuracy while playing.
        </p>


        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/02/left-hand-c-major-triad.jpg',
            "imgAlt" => "left-hand-c-major-triad",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/02/left-hand-c-major-triad.mp4',
        ])
    </div>

    <br class="lg:hidden">

    <p class="mb-4">
        The left hand chord fingerings for a major triad are also pretty intuitive.  You play with finger 5 on C, 3 on E, and 1 on G.
    </p>

    <p class="mb-4">
        To practice these chords, you can play them in either solid or broken forms.  When playing a chord in solid form, you’re playing all notes in the chord at once.  When playing a chord in broken form, you’re playing all the notes in the chord separately in a sequence.  Both are great ways to practice these chords and build muscle strength as well!  <strong>Be sure to practice your chords both solid and broken as you’re strengthening different skills with each.</strong>
    </p>
@endsection
