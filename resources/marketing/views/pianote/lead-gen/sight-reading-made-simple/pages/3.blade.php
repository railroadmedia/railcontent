@extends('pianote.lead-gen.sight-reading-made-simple.lesson-layout')

@section('sub-title')
    The Bass Clef
@stop()

@section('caption')
    What to play with your left hand
@stop()

@section('video', '//player.vimeo.com/video/333199433')

@section('current-lesson-number', 3)

@section('previous')
    /sight-reading-made-simple/lessons/2
@endsection

@section('next')
    /sight-reading-made-simple/lessons/4
@endsection

@section('prev-thumb', 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb2.jpg')

@section('next-thumb', 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb4.jpg')

@section('lesson-description')
    <p class="mb-4">
        Welcome to lesson three! It’s time to use our left hand and learn the Bass Clef. This is the Bass Clef:
    </p>

    <img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/bass-clef-symbol-1.png" alt="bass-clef-symbol">

    <p>
        It tells us to play with our left hand. Just like the Treble Clef, the Bass Clef lives on a staff, with five lines and four spaces. And just like the Treble Clef, those lines and spaces each represent one note on the keyboard.
        <br><br> But here is where things get different. The lines and spaces are NOT the same notes as the treble clef.
    </p>

    <div class="text-3xl mt-5 mb-2"><strong>All Cows Eat Grass</strong></div>

    <p class="mb-4">
        Again, we can use some easy-to-remember phrases to learn what the lines and spaces are. For the lines, we can say Good Boys Deserve Fun Always to remember that it’s G, B, D, F, and A.
    </p>

    <img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/bassclef-gbdfa-fun-1.png" alt="bassclef-gbdfa-fun">

    <p class="mb-4">
        For the spaces, we can use the phrase All Cows Eat Grass to remember that the notes are A, C, E, and G.
    </p>

    <img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/bassclef-aceg-1.png" alt="bassclef-aceg">

    <p>
        So if we start at the bottom line of the staff, the notes are G, A, B, C, D, E, F, G, and then we land back on A.
    </p>


    <div class="text-3xl mt-5 mb-2"><strong>Finding Low C</strong></div>

    <p>
        Just like we used Middle C in the Treble Clef as our home base, we will need a home base for our left hand. Remember in lesson one, that was Low C?
        <br><br> On the keyboard, Low C is the C below Middle C. On the bass staff Low C is the second space from the bottom. It is the ‘Cow’ in the phrase we just learned.
    </p>

    <div class="text-3xl mt-5 mb-2"><strong>Time To Practice</strong></div>

    <p>
        Now that we understand which notes are which and we have found our home base, it’s time to explore the patterns we learned in the Treble Clef lesson, but with our left hand! Remember to look for the patterns: if a line moves to a space, it’s going up one step. If it ‘skips’, then we’re going up two steps!
        <br><br> This might take some time to get your head around, and that’s ok! It might help when you see the Treble and Bass Clefs together on one piece of music.
        <br><br> That’s what we’ll look at in the next lesson when we introduce the Grand Staff.
    </p>
@stop()

@php
    $currentLesson = 2;
@endphp
