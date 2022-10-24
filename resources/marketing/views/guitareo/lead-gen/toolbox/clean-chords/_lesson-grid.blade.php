@php
    $header = 'Making Chords Sound Clean';
    $accessButtonColor = 'blue';

    $lessons = [
        [
            'Url' => '/toolbox/lessons/making-chords-sound-clean/1',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/955e454-clean1-scaled@2x.jpg',
            'accessButton' => 'Series Overview',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/making-chords-sound-clean/2',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/70c4a09-clean2-scaled@2x.jpg',
            'accessButton' => 'Clean Chord Technique Tips',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/making-chords-sound-clean/3',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/baac0a6-clean3-scaled@2x.jpg',
            'accessButton' => 'Remembering Chord Shapes',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/making-chords-sound-clean/4',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/01d81e5-clean4-scaled@2x.jpg',
            'accessButton' => 'Practice Along',
            'singleLesson' => true,
        ],
        [
            'Url' => '/toolbox/lessons/making-chords-sound-clean/5',
            'imgUrl' => 'https://guitarlessons-com.s3.amazonaws.com/guitar-lessons/95fdfff-clean5-scaled@2x.jpg',
            'accessButton' => 'Musical Application',
            'singleLesson' => true,
        ],
    ];
@endphp

@include('guitareo.lead-gen.partials.lesson-grid1')
