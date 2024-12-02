<?php

return [
    'options' => [
        'drumeo' => [
            'gears' => ['Acoustic Kit', 'E-Kit', 'Practice Pad'],
            'experience' => ['Level 1', 'Level 2-3', 'Level 4-6', 'Level 7-10'],
            'topics' => ['Hands', 'Feet', 'Grooves', 'Fills', 'Independence', 'Rudiments', 'Composition', 'Performance', 'Drumline', 'Theory', 'Recording', 'Electronic Drums', 'Creativity'],
            'genres' => ['Rock', 'Pop', 'Jazz', 'Blues', 'Country', 'Metal', 'Funk', 'Soul', 'Christian', 'Hip-Hop/Rap'],
            'goals' => [
                "Learn as many songs as possible",
                "Stick to a consistent practice routine",
                "Improve drumming technique",
                "Learn drumming theory",
                "Explore techniques, genres, and styles"
              ]
        ],
        'pianote' => [
            'gears' => ['Electric Keyboard', 'Digital Piano', 'Acoustic Piano', 'MIDI Controller'],
            'experience' => ['Level 1', 'Level 2-3', 'Level 4-6', 'Level 7-10'],
            'topics' => ['Hand Independence', 'Technique', 'Sight Reading', 'Creativity', 'Performance', 'Scales', 'Exercises', 'Improvisation', 'Chording', 'Intervals', 'Practice', 'Speed', 'I’m unsure'],
            'genres' => ['Classical', 'Rock', 'Pop', 'Jazz', 'Blues', 'Country', 'Metal', 'Funk', 'Soul', 'Christian', 'Hip-Hop/Rap'],
            'goals' => [
                "Learn as many songs as possible",
                "Stick to a consistent practice routine",
                "Improve piano technique",
                "Learn piano theory",
                "Explore techniques, genres, and styles"
              ]
        ],
        'guitareo' => [
            'gears' => ['Acoustic Guitar', 'Electric Guitar'],
            'experience' => ['Level 1', 'Level 2-3', 'Level 4-6', 'Level 7-10'],
            'topics' => ['Chords', 'Fingerstyle', 'Gear', 'Guitar Essentials', 'Improvisation & Soloing', 'Picking', 'Rhythm', 'Scales', 'Songwriting', 'Technique', 'Theory & Ear Training', 'I’m unsure'],
            'genres' => ['Rock', 'Pop', 'Jazz', 'Blues', 'Country', 'Metal', 'Funk', 'Soul', 'Christian', 'Hip-Hop/Rap'],
            'goals' => [
                'Learn as many songs as possible',
                'Stick to a consistent practice routine',
                'Improve guitar technique',
                'Learn guitar theory',
                'Explore techniques, genres and styles'
            ]
        ],
        'singeo' => [
            'gears' => ['High Voice', 'Low Voice'],
            'experience' => ['Level 1', 'Level 2-3', 'Level 4-6', 'Level 7-10'],
            'topics' => ['Pitch', 'Vibrato', 'Warm-Ups', 'Routines', 'Exercises', 'Scales', 'Performance', 'Harmony', 'Ear Training', 'Articulation', 'Confidence', 'Songwriting', 'Songs', 'I’m unsure'],
            'genres' => ['Rock', 'Pop', 'Jazz', 'Blues', 'Country', 'Metal', 'Funk', 'Soul', 'Christian', 'Hip-Hop/Rap'],
            'goals' => [
                'Learn as many songs as possible',
                'Stick to a consistent practice routine',
                'Improve singing technique',
                'Learn singing theory',
                'Explore techniques, genres and styles'
            ]
        ]
    ],
    'default_tasks' => [
        [
            'title' => 'Take a Tour',
            'hook' => 'take-a-tour',
            'description' => 'Discover our top features',
            'icon' => 'map',
            'expires_in_days' => 30,
        ],
        [
            'title' => 'Complete Your Account',
            'hook' => 'complete-your-account',
            'description' => 'Unlock your recommended lessons',
            'icon' => 'profile',
        ],
        [
            'title' => 'Introduce Yourself',
            'hook' => 'introduce-yourself',
            'description' => 'Connect with other musicians',
            'icon' => 'forum',
        ],
        [
            'title' => 'Start the METHOD',
            'hook' => 'start-the-method',
            'description' => 'Follow a 10-level curriculum',
            'icon' => 'path',
        ],
    ],
    'default_playlists' => [
        'drumeo' => [
            'New' => [639114],
            'Beginner' => [639134],
            'Intermediate' => [639136],
            'Advanced' => [639140],
            'Expert' => [639141],
        ],
        'pianote' => [
            'New' => [639170, 639177],
            'Beginner' => [639172, 639177],
            'Intermediate' => [639173],
            'Advanced' => [639175],
            'Expert' => [639175],
        ],
        'guitareo' => [
            // TODO: update playlist ids once they are created
            'New' => [639184],
            'Beginner' => [639186],
            'Intermediate' => [639187],
            'Advanced' => [639188],
            'Expert' => [639188],
        ],
        'singeo' => [
            'New' => [639190],
            'Beginner' => [639190],
            'Intermediate' => [639192],
            'Advanced' => [639193],
            'Expert' => [639193],
        ],
    ],
];
