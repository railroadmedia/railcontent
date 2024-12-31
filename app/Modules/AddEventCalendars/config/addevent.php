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
                'boot-camps' => 'SE143004',
                'chord-and-scale' => 'jH143005',
                'course' => 'pQ142503',
                'learning-path' => 'CO143006',
                'question-and-answer' => 'NC142504',
                'quick-tips' => 'Wg142505',
                'recording' => 'wq142506',
                'student-review' => 'Mk143007',
                'podcasts' => 'Eu292158',
                'song' => 'Li142502',
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

    // the "uniquekeys" array should only be filled with the programmaticaly-generate output of the
    // getCalendarIdsForBrandSite function of Musora's AddEventCommand. See Musora's README for instructions
    // (NOTES FROM LEGACY VERSION, NEEDS UPDATING)
    'drumeo' => [
        'uniquekeys' => [
            // drumeo
            'brand-overview' => 'GP142387',
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
            'by-coach' => [
                'aaron-edgar' => 'st405268',
                'aric-improta' => 'yj315306',
                'ash-pearson' => 'KI405270',
                'benny-greb' => 'da405263',
                'billy-cobham' => 'Oy405260',
                'brandon-toews' => 'gy405259',
                'bruce-becker' => 'CX405258',
                'carson-gant' => 'zn405247',
                'dave-atkinson' => 'Iz405271',
                'dennis-chambers' => 'Vr405256',
                'domino-santantonio' => 'BW315303',
                'dorothea-taylor' => 'du315305',
                'glen-sobel' => 'ri405239',
                'hannah-welton' => 'nC405254',
                'issah-contractor' => 'KM405267',
                'jack-thomas' => 'QI405238',
                'jared-falk' => 'hl315310',
                'jim-riley' => 'Ox405264',
                'john-wooton' => 'NO315307',
                'jost-nickel' => 'GO405253',
                'juan-mendoza' => 'bV405244',
                'julia-geaman' => 'Ri405252',
                'kaz-rodriguez' => 'uV315309',
                'kyle-radomsky' => 'NQ405266',
                'larnell-lewis' => 'iq315304',
                'mark-kelso' => 'Aa405262',
                'matt-mcguire' => 'Yy405234',
                'michael-schack' => 'UD315308',
                'mike-michalkow' => 'rq405272',
                'mike-sleath' => 'sv405240',
                'pat-petrillo' => 'YR405265',
                'rob-brown' => 'XV405237',
                'ryan-van-poederooyen' => 'gZ405235',
                'samantha-landa' => 'Yc405243',
                'seamus-evely' => 'Ik405248',
                'sharon-ransom' => 'CV405233',
                'steve-lyman' => 'yL405245',
                'taylor-gordon' => 'JQ405246',
                'todd-sucherman' => 'vo315302',
                'tommy-igoe' => 'Qe405250',
                'victor-guidera' => 'px405249',
            ],
        ],
    ],
    'pianote' => [
        'uniquekeys' => [
            // pianote
            'brand-overview' => 'be142408',
            'by-type' => [
                'boot-camps' => 'SE143004',
                'chord-and-scale' => 'jH143005',
                'course' => 'pQ142503',
                'learning-path' => 'CO143006',
                'question-and-answer' => 'NC142504',
                'quick-tips' => 'Wg142505',
                'recording' => 'wq142506',
                'student-review' => 'Mk143007',
                'podcasts' => 'Eu292158',
                'song' => 'Li142502',
            ],
            'by-coach' => [
                'brett-ziegler' => 'ek405282',
                'cassi-falk' => 'vA405281',
                'jesus-molina' => 'Dl405276',
                'jordan-leibel' => 'XN405283',
                'kenny-werner' => 'Fs405280',
                'kevin-castro' => 'uy405278',
                'lisa-witt' => 'Bj405284',
                'sam-vesely' => 'FB405279',
                'victoria-theodore' => 'wM405277',
            ],
        ],
    ],
    'guitareo' => [
        'uniquekeys' => [
            // guitareo
            'brand-overview' => 'IJ142407',
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
            'by-coach' => [
                'ayla-tesler-mabe' => 'Ab405289',
                'chelsea-amber' => 'Zh405290',
                'kent-shores' => 'wf405287',
                'nate-savage' => 'yE405291',
                'rob-scallon' => 'Ob405288',
            ],
        ],
    ],
    'singeo' => [
        'uniquekeys' => [
            // singeo
            'brand-overview' => 'bk354284',
            'by-type' => [
                'learning-path' => 'vX354281',
                'quick-tips' => 'cR354213',
                'question-and-answer' => 'IT354214',
                'course' => 'KJ354215',
                'boot-camps' => 'Cx354282',
                'song' => 'bD354283',
            ],
            'by-coach' => [
                'darcy-d' => 'Pa405293',
                'julia-ziegler' => 'YQ405292',
                'lisa-witt' => 'zb405294',
            ],
        ],
    ],
];
