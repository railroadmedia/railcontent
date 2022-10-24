@php
    $header = 'Playing Your First Song';
    $accessButtonColor = 'blue';

    $lessons = [
        [
            'Url' => '/toolbox/lessons/playing-your-first-song/1',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/d8fb62e-first-song1-scaled@2x.jpg',
            'accessButton' => 'Series Overview',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-song/2',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/d50f5fd-first-song2-scaled@2x.jpg',
            'accessButton' => 'The Open A2 Chord',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-song/3',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/164159e-first-song3-scaled@2x.jpg',
            'accessButton' => 'The Open D2 Chord',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-song/4',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/2311975-first-song4-scaled@2x.jpg',
            'accessButton' => 'How Rhythm Works',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-song/5',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/31cb31d-first-song5-scaled@2x.jpg',
            'accessButton' => 'Simple Strumming',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-song/6',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/2cb88f0-first-song6-scaled@2x.jpg',
            'accessButton' => 'Changing Chords',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-song/7',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/f278220-first-song7-scaled@2x.jpg',
            'accessButton' => 'Dress Up Your Strumming',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-song/8',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/226aa05-first-song8-scaled@2x.jpg',
            'accessButton' => 'Practice Along',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-song/9',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/6fdc396-first-song9-scaled@2x.jpg',
            'accessButton' => 'Musical Application',
            'singleLesson' => true,
        ],
    ];
@endphp

@include('guitareo.lead-gen.partials.lesson-grid1')
