@extends('pianote.lead-gen.sight-reading-made-simple.lesson-layout')

@section('sub-title')
    The Grand Staff
@stop()

@section('caption')
    Putting it all together
@stop()

@section('video', '//player.vimeo.com/video/303793096')

@section('current-lesson-number', 4)

@section('previous')
    /sight-reading-made-simple/lessons/3
@endsection

@section('prev-thumb', 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/thumb3.jpg')

@section('lesson-description')
    <p class="mb-4">
        Welcome to the final lesson in this series on Sight-Reading Made Simple.
        <br><br> In this lesson, we are going to combine everything we have learned up until now, and hopefully explain some things that might have been confusing earlier.
        <br><br> To do that, we need to use the Grand Staff:
    </p>

    <img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/grand-staff-blank-1.png" alt="grand-staff-blank">

    <p>
        The Grand Staff is what we use when we play both hands at the same time. Simply put, it’s both the treble and bass staffs joined together.
    </p>

    <div class="text-3xl mt-5 mb-2"><strong>It All Makes Sense</strong></div>

    <p class="mb-4">
        A lot of people ask - why are the notes different in the treble and bass staffs when all the lines and spaces look the same? I mentioned this in the last lesson.
        <br><br> Well, this is why - the Treble and Bass Staffs are not their own separate entities - they are connected in the Grand Staff.
        <br><br> And it all comes back to Middle C. Remember how Middle C is not the actual middle note on the piano? Well, it IS the middle note on the Grand Staff:
    </p>

    <img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/grand-staff-treble-bass-middle-c-1.png" alt="grand-staff-treble-bass-middle-c">

    <p class="mb-4">
        This is where we get the note names for the lines and spaces. From Middle C, when you move up in the treble you get D, then E, F, G, A, and so on.
        <br><br> When you move down in the bass, it goes from C to B, A, G, F, E, D, C and so on
    </p>

    <img class="mb-4" src="https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/assets/grand-staff-all-notes-1.png" alt="grand-staff-all-notes">

    <p>
        So you can see how the musical alphabet moves up and down from the middle! And that is how each line and space gets its note, and why the treble and bass are different.
        <br><br> I do have some practice tips that I think are REALLY important in setting you up for success:
    </p>

    <div class="text-3xl mt-5 mb-2"><strong>Go Slow</strong></div>

    <p>
        This is so important. Especially for new concepts. We want to make sure we are learning things CORRECTLY. Going slow allows us to do that, and to master the concepts. Going slow now will pay off BIG TIME in the future. Otherwise, you risk developing bad habits, and if you go too fast too soon, you might hit a wall and get discouraged.
    </p>

    <div class="text-3xl mt-5 mb-2"><strong>Hands Separately</strong></div>

    <p>
        Another big tip. NEVER practice anything hands together until you can play each hand by itself. This allows you to get comfortable and focus on one thing at a time, so you don’t get overwhelmed and frustrated.
    </p>

    <div class="text-3xl mt-5 mb-2"><strong>Take It In Small Chunks</strong></div>

    <p>
        nd finally, take it in small chunks. Don’t try to play the ENTIRE song the first time. Take it one bar at a time. Play the right hand, then the left hand, and then hands together. Then move on to the next bar. Once you get more comfortable start putting whole lines together. By taking it piece-by-piece you won’t get overwhelmed and you will really get to know the song.
        <br><br> And that’s it! The course is over. Hopefully, by now you understand the basics of rhythm and how to read notes on the staff in both the treble and bass! Now you can read a foreign language while riding a bike and juggling. NO SMALL TASK remember?!
        <br><br> But this is just the start. Hopefully, this has given you a good introduction to these very important concepts. If you’re wondering what to do now, then I cannot speak highly enough of a Pianote membership. Our structured lessons (similar to these) will guide you step-by-step so you always know exactly what to learn, and have FUN doing it.
        <br><br> Thanks again, I truly hope you enjoyed the course! <br><br> Have fun and good luck!
    </p>

@stop()

@php
    $currentLesson = 3;
@endphp
