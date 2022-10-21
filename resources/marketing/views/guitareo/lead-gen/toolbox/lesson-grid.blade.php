@extends('guitareo.lead-gen.starter-kit.starter-kit-layout')

@section('body-content')
    @include('guitareo.lead-gen.toolbox._header', [
    "noBack" => true,
    ])

    @php
        $header = "The Guitarist's Toolbox Lessons";

        $lessons = [
            [
                'Url' => '/toolbox/lessons/playing-your-first-song/',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/playing-your-first-song.png',
            ],
            [
                'Url' => '/toolbox/lessons/how-to-tune-a-guitar/',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/how-to-tune-a-guitar.png',
            ],
            [
                'Url' => '/toolbox/lessons/making-chords-sound-clean/',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/making-chords-sound-clean.png',
            ],
            [
                'Url' => '/toolbox/lessons/changing-chords-smoothly/',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/changing-chords-smoothly.png',
            ],
            [
                'Url' => '/toolbox/lessons/sight-reading-essentials/',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/sight-reading-essentials.png',
            ],
            [
                'Url' => '/toolbox/lessons/exploring-guitar-rhythms/',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/exploring-guitar-rhythms.png',
            ],
            [
                'Url' => '/toolbox/lessons/playing-your-first-guitar-solo/',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/playing-your-first-guitar-solo.png',
            ],
            [
                'Url' => '/toolbox/lessons/legato-hammer-ons-pull-offs/',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/legato-hammer-ons-pull-offs.png',
            ],
            [
                'Url' => '/toolbox/lessons/soloing-with-minor-pentatonic-scales/',
                'imgUrl' => 'https://guitareo.s3.amazonaws.com/starter-kit/thumbnails/soloing-with-minor-pentatonic-scales.png',
            ],
        ];
    @endphp

    @include('guitareo.lead-gen.partials.lesson-grid1')

@endsection
