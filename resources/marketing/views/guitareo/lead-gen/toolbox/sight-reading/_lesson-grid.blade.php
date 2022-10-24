@php
    $header = 'Sight Reading Essentials';
    $accessButtonColor = 'blue';

    $lessons = [
        [
            'Url' => '/toolbox/lessons/sight-reading-essentials/1',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/90eef6a-reading11-scaled@2x.jpg',
            'accessButton' => 'Series Overview',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/sight-reading-essentials/2',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/7608643-reading12-scaled@2x.jpg',
            'accessButton' => 'Reading Basics',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/sight-reading-essentials/3',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/c717f50-reading13-scaled@2x.jpg',
            'accessButton' => 'Natural Notes On E &amp; B',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/sight-reading-essentials/4',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/6bb677d-reading14-scaled@2x.jpg',
            'accessButton' => 'Whole &amp; Half Note Ex. 1',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/sight-reading-essentials/5',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/f49fc0b-reading15-scaled@2x.jpg',
            'accessButton' => 'Whole &amp; Half Note Ex. 2',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/sight-reading-essentials/6',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/7befe55-reading16-scaled@2x.jpg',
            'accessButton' => 'Musical Application',
            'singleLesson' => true,
        ],
    ];
@endphp

@include('guitareo.lead-gen.partials.lesson-grid1')
