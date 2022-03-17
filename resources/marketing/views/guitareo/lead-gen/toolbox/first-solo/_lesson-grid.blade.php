@php
    $header = 'Playing Your First Guitar Solo';
    $accessButtonColor = 'blue';

    $lessons = [
        [
            'Url' => '/toolbox/lessons/playing-your-first-guitar-solo/1',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/7d6d0ce-solo1-scaled@2x.jpg',
            'accessButton' => 'Series Overview',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-guitar-solo/2',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/dd7399b-solo2-scaled@2x.jpg',
            'accessButton' => 'How Rhythm Works',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-guitar-solo/3',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/78c1cb6-solo3-scaled@2x.jpg',
            'accessButton' => 'Basic Picking Technique',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-guitar-solo/4',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/f8e9378-solo4-scaled@2x.jpg',
            'accessButton' => 'Basic Fretting Technique',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-guitar-solo/5',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/f0e0838-solo5-scaled@2x.jpg',
            'accessButton' => 'A2 D2 Melody #1',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-guitar-solo/6',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/d2c18b3-solo6-scaled@2x.jpg',
            'accessButton' => 'A2 D2 Melody #2',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-guitar-solo/7',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/7b1b8ed-solo7-scaled@2x.jpg',
            'accessButton' => 'Practice Along',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/playing-your-first-guitar-solo/8',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/ea4f37b-solo8-scaled@2x.jpg',
            'accessButton' => 'Musical Application',
            'singleLesson' => true,
        ],
    ];
@endphp

@include('guitareo.lead-gen.partials.lesson-grid1')