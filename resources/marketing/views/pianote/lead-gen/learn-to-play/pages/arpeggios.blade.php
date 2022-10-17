@extends('pianote.lead-gen.learn-to-play.lesson-layout')

@section('subtitle', 'All About Arpeggios')

@section('caption', 'Arpeggios are a fun and simple technique to play patterns at the piano.')

@section('video', 'https://www.youtube.com/embed/X5KiGk1ZCfE/')

@section('current-lesson-number', 9)

@section('previous')
    /my-lessons/other-chords
@endsection

@section('next')
    /my-lessons/how-to-write-a-song
@endsection

@section('prev-thumb', 'https://img.youtube.com/vi/-_MkQ3qJkWc/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/UcIx_Ca30G8/maxresdefault.jpg')

@section('lesson-description')
    <p class="mb-4">
        <strong>Arpeggios are a fun and simple technique to play patterns at the piano.</strong>  They are an incredibly useful tool that you can use to play flashy sounding melodies and intricate sounding rhythms.  Even though they might sound complicated to play, they are actually quite easy once you break them down into their basic parts.
    </p>
    <div class="flex flex-col lg:flex-row mb-4">
        <p class="w-full lg:w-1/2">
            To make a C major arpeggio, start out with your hands in root position over C.  The notes you’ll play are C-E-G and the high octave of C, all played like a broken chord.  In order to do this as efficiently as possible, be sure to pay attention to your fingerings.  In the right hand, you should be playing with fingers 1-2-3-5 to make that stretch to the high octave note.
        </p>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
        "gifImage" => cdn('quick-start/gifs/09/right-hand-arpeggio.jpg'),
        "imgAlt" => "right-hand-arpeggio",
        "gifVideo" => cdn('quick-start/gifs/09/right-hand-arpeggio.mp4'),
        ])
    </div>

    <br>

    <p class="mb-4">
        <strong>The left hand features a similar fingering modification:  You should play your left hand arpeggios with fingers 5-3-2-1.</strong>
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <p class="w-full lg:w-1/2">
            You can also take your knowledge of chord inversions and create a simple progression with arpeggios.  Try using arpeggios to create a I-IV-V chord progression, basing your progression off of C in root position, F in 2nd inversion, and G in 2nd inversion.
        </p>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
           "gifImage" => cdn('quick-start/gifs/09/arpeggio-progression.jpg'),
           "imgAlt" => "arpeggio-progression",
           "gifVideo" => cdn('quick-start/gifs/09/arpeggio-progression.mp4'),
       ])
    </div>
@endsection
