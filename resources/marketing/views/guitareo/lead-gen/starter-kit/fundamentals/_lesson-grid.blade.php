@php
    $header = 'Guitar Fundamentals';

    $lessons = [
        [
            'Url' => '/starter-kit/lessons/fundamentals/1',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/5759e4e-fundamentals1-scaled@2x.jpg',
            'accessButton' => 'Series Overview',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/fundamentals/2',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/5759e4e-fundamentals2-scaled@2x.jpg',
            'accessButton' => 'Parts Of The Acoustic Guitar',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/fundamentals/3',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/5759e4e-fundamentals3-scaled@2x.jpg',
            'accessButton' => 'Parts Of The Electric Guitar',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/fundamentals/4',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/5759e4d-fundamentals4-scaled@2x.jpg',
            'accessButton' => 'How To Hold The Guitar',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/fundamentals/5',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/5759e4d-fundamentals5-scaled@2x.jpg',
            'accessButton' => 'Numbering Systems',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/fundamentals/6',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/5759e4d-fundamentals6-scaled@2x.jpg',
            'accessButton' => 'Names Of The Open Strings',
            'singleLesson' => true,
        ],
        [
            'Url' => '/starter-kit/lessons/fundamentals/7',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/5759e4d-fundamentals7-scaled@2x.jpg',
            'accessButton' => 'Series Review',
            'singleLesson' => true,
        ],
    ];
@endphp

@include('guitareo.lead-gen.partials.lesson-grid1')