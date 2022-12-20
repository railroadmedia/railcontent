@extends('pianote.lead-gen.learn-to-play.lesson-layout')

@section('subtitle', 'Strengthening Your Hands')

@section('caption', 'Now that you’ve learned a little about scales and chords, it’s time to build your hand strength up so you can play with fluidity and control.')

@section('video', 'https://www.youtube.com/embed/s54At63Ee5o/')

@section('current-lesson-number', 3)

@section('previous')
    /my-lessons/how-to-play-chords
@endsection

@section('next')
    /my-lessons/play-g-major
@endsection

@section('prev-thumb', 'https://img.youtube.com/vi/sb9RNEhMauw/maxresdefault.jpg')

@section('next-thumb', 'https://img.youtube.com/vi/0PP-PofEpew/maxresdefault.jpg')

@section('lesson-description')
    <p class="mb-4">
        <strong>Now that you’ve learned a little about scales and chords, it’s time to build your hand strength up so you can play with fluidity and control.</strong>
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <p class="w-full lg:w-1/2">
            A simple way to build up strength in each finger is to simply place your hands on the keyboard as if you were going to play a scale and walk up the first 5 notes, focusing directly on each finger as it’s playing the note.  This will give you a sense of how it feels to move each finger independently, and will help to build up those muscles in each finger that are needed to play the piano.
        </p>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/03/finger-exercise-3.jpg',
            "imgAlt" => "finger-exercise-3",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/03/finger-exercise-3.mp4',
        ])
    </div>

    <br class="lg:hidden">

    <p class="mb-4">
        Another area to focus on with early finger exercises is perfecting that thumbtuck technique.  A great way to do this is to walk up a scale to the point where the thumbtuck happens and then walk back down.
    </p>

    <div class="flex flex-col lg:flex-row mb-4">
        <p class="w-full lg:w-1/2">
            Once you’re feeling warmed up and confident, you can challenge yourself by practicing your scales and other exercises with both hands at once.  Make sure that you’re very comfortable with each hand separately before trying to tackle any scale or exercise hands together!  Remember, fingerings and technique are very important so make sure to prioritize the proper fingerings while practicing both hands together.
        </p>

        @include('pianote.lead-gen.learn-to-play.elements.gif', [
            "gifImage" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/03/2-handed-scale.jpg',
            "imgAlt" => "2-handed-scale",
            "gifVideo" => 'https://d2vyvo0tyx8ig5.cloudfront.net/quick-start/gifs/03/2-handed-scale.mp4',
        ])
    </div>

    <br class="lg:hidden">

    <p class="mb-4">
        Incorporating exercises like these in your practice regimen will keep your fingerings and technique in tiptop shape, and build good habits for you as a player!  <strong>So whenever you’re practicing, always keep in mind not only what you’re playing, but also how you’re playing it.</strong>
    </p>
@endsection
