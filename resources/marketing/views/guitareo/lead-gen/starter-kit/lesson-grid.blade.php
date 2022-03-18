@extends('guitareo.lead-gen.starter-kit.starter-kit-layout')

@section('body-content')
    @include('guitareo.lead-gen.starter-kit.partials._header', [
        "noBack" => true,
    ])

    @php
        $header = 'Beginner Guitar Lessons';

        $lessons = [
            [
                'Url' => '/starter-kit/lessons/fundamentals',
                'badgeText' => 'course #1',
                'details' => '7 Videos / 21 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/fundamentals.jpg',
                'title' => 'Guitar Fundamentals',
            ],
            [
                'Url' => '/starter-kit/lessons/using-a-tuner/',
                'badgeText' => 'course #2',
                'singleLesson' => true,
                'details' => '1 Video / 8 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/tuner.jpg',
                'title' => 'Using An Electronic Tuner',
            ],
            [
                'Url' => '/starter-kit/lessons/open-chords',
                'badgeText' => 'course #3',
                'details' => '6 Videos / 38 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/open-chords.jpg',
                'title' => 'Open Chords',
            ],
            [
                'Url' => '/starter-kit/lessons/strumming',
                'badgeText' => 'course #4',
                'details' => '7 Videos / 27 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/strumming.jpg',
                'title' => 'Strumming',
            ],
            [
                'Url' => '/starter-kit/lessons/heartbreak-avenue',
                'badgeText' => 'course #5',
                'details' => '7 Videos / 18 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/heartbreak.jpg',
                'title' => 'Heartbreak Avenue',
            ],
            [
                'Url' => '/starter-kit/lessons/whats-next',
                'badgeText' => 'course #6',
                'singleLesson' => true,
                'details' => '1 Videos / 5 Minutes',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/whats-next.jpg',
                'title' => 'What&apos;s Next?',
            ],
        ];
    @endphp

    @include('guitareo.lead-gen.partials.lesson-grid1')
@endsection
