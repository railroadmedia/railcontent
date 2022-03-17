@php
    $header = 'Strumming';

    $lessons = [
        [
            'Url' => '/starter-kit/lessons/strumming/1',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/0fbeaaa-strumming11-scaled@2x.jpg',
            'accessButton' => 'Series Overview',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/strumming/2',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/02d7920-strumming12-scaled@2x.jpg',
            'accessButton' => 'Basic Strumming Technique',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/strumming/3',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/9a6fb4a-strumming13-scaled@2x.jpg',
            'accessButton' => 'Downstrokes',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/strumming/4',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/d77b95c-strumming14-scaled@2x.jpg',
            'accessButton' => 'Upstrokes',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/strumming/5',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/ce03f8c-strumming15-scaled@2x.jpg',
            'accessButton' => 'Downstrokes & Upstrokes Together',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/strumming/6',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/2a59e23-strumming16-scaled@2x.jpg',
            'accessButton' => 'Practice Along',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/strumming/7',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/d79425e-strumming17-scaled@2x.jpg',
            'accessButton' => 'Musical Application',
            'singleLesson' => true,
        ],
    ];
@endphp

@include('guitareo.lead-gen.partials.lesson-grid1')
