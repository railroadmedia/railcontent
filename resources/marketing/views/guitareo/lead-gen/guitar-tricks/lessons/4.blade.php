@extends('guitareo.lead-gen.guitar-tricks.lesson-page-layout')

@section('subtitle')
    Skill #2 - Palm Muting
@stop

@section('video', '//player.vimeo.com/video/476482409')

@section('current-lesson-number', 4)

@section('previous', '/guitar-tricks/your-videos/3-shampoo')

@section('next', '/guitar-tricks/your-videos/5-truck')

@section('prev-thumb', 'https://i.vimeocdn.com/video/997056488-b8a318adb6981c3394bb2cc8ca65108ddafb390dec5f63c2fb4c058b0d7a97c8-d?mw=1000&mh=562')

@section('next-thumb', 'https://i.vimeocdn.com/video/997057977-34a12c51aaa79cda646d8186793fcf677beb1610e4801404fc2e49247f4221d2-d?mw=1000&mh=562')

@section('lesson-description')
    <strong>Skill 2: Palm Muting</strong>
    <br><br>

    Palm muting is a cross-genre skill, but today we need you to put it to work in a country themed truck commercial. To get yourself in the mood for this skill you’ll need to imagine a dusty porch, a rocking chair, and some tumbleweeds rolling across your homestead.
    <br><br>
    Y’all ready?

    <ol class="text-sm leading-7">
        <li>Learn the E Major Chord</li>
        <li>Practice the placement of your palm for ultimate chunky muting </li>
        <li>Practice alternating between strumming and palm muting</li>
        <li>Wait for checks in the mail</li>
    </ol>

    <p>When you’re ready to perform, it’s time to make the jingle:</p>

    <ol class="text-sm leading-7">
        <li>Download the full truck ad MP3 to hear what the jingle track sounds like with guitar.</li>
        <li>Download the Playthrough MP3 where YOU will play the guitar part.</li>
        <li>Click through to the <a href="/guitar-tricks/your-videos/5-truck">next video</a> to see the advertisement come to life!</li>
    </ol>
@endsection

@section('assets')
    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Playthrough MP3",
        "mp3URL" => "https://d122ay5chh2hr5.cloudfront.net/guitarquest/2-Simple-Guitar-Tricks/TruckJingle-Playthrough.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Full Ad MP3",
        "mp3URL" => "https://d122ay5chh2hr5.cloudfront.net/guitarquest/2-Simple-Guitar-Tricks/TruckJingle-FullAd.mp3"
    ])

    @include('guitareo.lead-gen.partials._assignment-resources', [
        "title" => "Sheet Music PDF",
        "pdfURL" => "https://d122ay5chh2hr5.cloudfront.net/guitarquest/2-Simple-Guitar-Tricks/TruckJingle-SheetMusic.pdf"
    ])
@endsection
