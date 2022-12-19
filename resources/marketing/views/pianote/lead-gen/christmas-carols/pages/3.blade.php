@extends('pianote.lead-gen.christmas-carols.pages.lesson-page')

@section('subtitle', 'O Holy Night')

@section('video', '//player.vimeo.com/video/305099707')

@section('current-lesson-number', 3)

@section('previous')
    /christmas-carols/songs/joy-to-the-world
@endsection

@section('next')
    /christmas-carols/songs/silent-night
@endsection

@section('prev-thumb', 'https://i.vimeocdn.com/video/739825865-4c89073d9c65071a47f1652a08cf4474d2ac67e6d8ad8e817654e94d7ab23169-d?mw=1000&mh=563')

@section('next-thumb', 'https://i.vimeocdn.com/video/1304879449-80aaedac3f4043ba20a4934eeda1bf8a438c81a7ef08fe1e1?mw=1000&mh=563')

@section('lesson-description')
    <div class="w-full px-2 md:px-3 text-center">
        <a class="join smaller w-full sm:w-1/2 mx-auto" href="https://pianote.s3.amazonaws.com/lead-gen/christmas-carols/sheet-music/o-holy-night.pdf">Download The Sheet Music</a>
    </div>
@endsection
