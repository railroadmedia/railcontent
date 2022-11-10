@php
    $header = 'How To Tune A Guitar';
    $accessButtonColor = 'blue';

    $lessons = [
        [
            'Url' => '/toolbox/lessons/how-to-tune-a-guitar/1',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/bff9fd5-tune1-scaled@2x.jpg',
            'accessButton' => 'Series Overview',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/how-to-tune-a-guitar/2',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/91ac9a9-tune2-scaled@2x.jpg',
            'accessButton' => 'Open String Names',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/how-to-tune-a-guitar/3',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/53cece6-tune3-scaled@2x.jpg',
            'accessButton' => 'Naturals, Sharps &amp; Flats',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/how-to-tune-a-guitar/4',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/c5d150e-tune4-scaled@2x.jpg',
            'accessButton' => 'Using An Electronic Tuner',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/how-to-tune-a-guitar/5',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/43c0f70-tune5-scaled@2x.jpg',
            'accessButton' => 'Developing Your Ear',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/how-to-tune-a-guitar/6',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/fd428b7-tune6-scaled@2x.jpg',
            'accessButton' => 'Tuning By Ear',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/how-to-tune-a-guitar/7',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/11c7e47-tune7-scaled@2x.jpg',
            'accessButton' => 'Practice Along',
            'singleLesson' => true,
        ],
    ];
@endphp

@include('guitareo.lead-gen.partials.lesson-grid1')
