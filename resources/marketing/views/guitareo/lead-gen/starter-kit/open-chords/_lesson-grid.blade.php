@php
    $header = 'Open Chords';

    $lessons = [
        [
            'Url' => '/starter-kit/lessons/open-chords/1',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/c25469a-open1-card-scaled@2x.jpg',
            'accessButton' => 'Series Overview',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/open-chords/2',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/83c29dc-open12-scaled@2x.jpg',
            'accessButton' => 'Basic Chording Technique',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/open-chords/3',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/38efba1-open13-scaled@2x.jpg',
            'accessButton' => 'Open A, D, & E Major Chords',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/open-chords/4',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/30d7297-open14-scaled@2x.jpg',
            'accessButton' => 'Changing Between A, D, & E Major',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/open-chords/5',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/7a4225d-open15-scaled@2x.jpg',
            'accessButton' => 'Practice Along',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/open-chords/6',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/106681b-open26-scaled@2x.jpg',
            'accessButton' => 'Musical Application',
            'singleLesson' => true,
        ],
    ];
@endphp

@include('guitareo.lead-gen.partials.lesson-grid1')
