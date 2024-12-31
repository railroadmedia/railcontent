<?php

return [
    'api-token' => env('ADD_EVENT_API_TOKEN'),

    'brands-enabled' => [
        'drumeo',
        'pianote',
        'guitareo',
        'singeo',
    ],

    'brands-with-overview-calendar' => [
        'drumeo',
        'pianote',
        'guitareo',
        'singeo',
    ],

    'type-specific-calendar-nice-names-by-type' => [ // this defines what content types to include
        'drumeo' => [
            'course' => 'Courses',
            'gear-guides' => 'Gear Guides',
            'live' => 'Live Lessons',
            'performances' => 'Performances',
            'play-along' => 'Play Alongs',
            'podcasts' => 'The Drumeo Podcast',
            'question-and-answer' => 'Q&A',
            'quick-tips' => 'Quick Tips',
            'solos' => 'Solos',
            'student-focus' => 'Student Focus',
            'challenges' => 'Challenges',
            'coach-stream' => 'Coach Streams',
            'student-collaborations' => 'Student Collaborations',
        ],
        'pianote' => [
            'boot-camps' => 'Boot Camps',
            'chord-and-scale' => 'Chords & Scales',
            'course' => 'Courses',
            'learning-path' => 'Learning Paths',
            'question-and-answer' => 'Q&As',
            'quick-tips' => 'Quick Tips',
            'recording' => 'Recordings',
            'student-review' => 'Student Reviews',
            'podcasts' => 'The Pianote Podcast',
            'song' => 'Songs',
        ],
        'guitareo' => [
            'courses' => 'Courses',
            'play-alongs' => 'Play Alongs',
            'archives' => 'Archives',
            'chords-scales' => 'Chords & Scales',
            'entertainment' => 'Entertainment',
            'question-and-answer' => 'Question & Answer',
            'quick-tips' => 'Quick Tips',
            'student-review' => 'Student Review',
        ],
        'singeo' => [
            'learning-path' => 'Learning Paths',
            'quick-tips' => 'Quick Tips',
            'question-and-answer' => 'Q&As',
            'course' => 'Courses',
            'boot-camps' => 'Boot Camps',
            'song' => 'Songs',
        ]
    ],

    // `php artisan AddEventCommand` and select "getCalendarIds" to get nicely formatted info to paste below

    'uniquekeys-by-brand' => [
        'drumeo' => [ // run `php artisan AddEventCommand drumeo`, select "getCalendarIdsForMusora" and paste output in this array
            // drumeo
            'by-type' => [
                'course' => 'rE106805',
                'gear-guides' => 'Lj106807',
                'live' => 'zL106808',
                'performances' => 'mJ106810',
                'play-along' => 'bl142390',
                'podcasts' => 'Ma142927',
                'question-and-answer' => 'nN142908',
                'quick-tips' => 'oW142391',
                'solos' => 'Op142984',
                'student-focus' => 'Fd142393',
            ],

        ],
        'pianote' => [ // run `php artisan AddEventCommand pianote`, select "getCalendarIdsForMusora" and paste output in this array
            // pianote
            'by-type' => [
                'question-and-answer' => 'NC142504',
            ],
        ],
        'guitareo' => [ // run `php artisan AddEventCommand guitareo`, select "getCalendarIdsForMusora" and paste output in this array
            // guitareo
            'by-type' => [
                'courses' => 'DF143014',
                'play-alongs' => 'sQ143016',
                'archives' => 'QS143017',
                'chords-scales' => 'lA143018',
                'entertainment' => 'yz142399',
                'question-and-answer' => 'zC371299',
                'quick-tips' => 'dU371298',
                'student-review' => 'Bm371935',
            ],
        ],
        'singeo' => [ // run `php artisan AddEventCommand singeo`, select "getCalendarIdsForMusora" and paste output in this array
            // singeo
            'by-type' => [
                'learning-path' => 'vX354281',
                'quick-tips' => 'cR354213',
                'question-and-answer' => 'IT354214',
                'course' => 'KJ354215',
                'boot-camps' => 'Cx354282',
                'song' => 'bD354283',
            ],
        ],
    ],
];
