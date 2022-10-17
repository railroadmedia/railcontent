@extends('pianote.lead-gen.learn-to-play.lesson-layout')

@section('subtitle', 'How to Play G-Major')

@section('caption', 'It’s time to switch things up and learn a new key, G-Major.')

@section('video', 'https://www.youtube.com/embed/0PP-PofEpew/')

@section('current-lesson-number', 4)

@section('previous')
    /my-lessons/strengthening-your-hands
@endsection

@section('next')
    /my-lessons/play-f-major
@endsection

@section('prev-thumb', 'https://img.youtube.com/vi/s54At63Ee5o/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/K4rl7HCjunw/maxresdefault.jpg')

@section('lesson-description')
    <p class="mb-4">
        <strong>Up to this point, you’ve been looking at the piano via the key of C major.  Now it’s time to switch things up and learn a new key, G major.</strong>  The G major scale has a lot of similarities to the C major scale, except for one important  new feature: the addition of a new kind of note called a sharp note.  To sharpen any note, all you have to do is take any note and raise it by one semitone.  To do this, simply take your natural note and play the key directly above it.  In the case of G major, the note you’ll have to sharpen is the 7th note in the scale, creating F-sharp, played with that black key between F and G.
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <div class="w-full lg:w-1/2">
            <br class="visible-lg">
            <p>
                Pay special attention to the sound of the sharpened 7th note climbing up to the 8th note.  This is an essential sound you’ll hear in all major scales, so training your ear to identify it will help you tremendously in the future.
            </p>
        </div>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => cdn('quick-start/gifs/04/g-major-scale.jpg'),
            "imgAlt" => "g-major-scale",
            "gifVideo" => cdn('quick-start/gifs/04/g-major-scale.mp4'),
        ])
    </div>

    <br>

    <p class="mb-4">
        Making a G Major chord is also very simple.  It’s built just like the C major triad, but starting with G as the bottom.  <strong>So the notes are G - B - D, played with fingers 1 - 3- 5 in the right hand and 5 - 3 - 1 in the left hand.</strong>
    </p>
@endsection
