@php
    $header = 'Exploring Guitar Rhythms';
    $accessButtonColor = 'blue';

    $lessons = [
        [
            'Url' => '/toolbox/lessons/exploring-guitar-rhythms/1',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/0ea46d5-rhythms11-scaled@2x.jpg',
            'accessButton' => 'Series Overview',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/exploring-guitar-rhythms/2',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/871f253-rhythms12-scaled@2x.jpg',
            'accessButton' => 'How Rhythm Works',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/exploring-guitar-rhythms/3',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/94b392e-rhythms13-scaled@2x.jpg',
            'accessButton' => 'Whole &amp; Half Note Ex. 1',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/exploring-guitar-rhythms/4',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/8e6e00f-rhythms14-scaled@2x.jpg',
            'accessButton' => 'Whole &amp; Half Note Ex. 2',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/exploring-guitar-rhythms/5',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/0f5367c-rhythms15-scaled@2x.jpg',
            'accessButton' => 'Musical Application',
            'singleLesson' => true,
        ],
    ];
@endphp

@include('guitareo.lead-gen.partials.lesson-grid1')
