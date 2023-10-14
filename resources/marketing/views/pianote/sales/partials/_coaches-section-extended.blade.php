 @php
        $buttons = [
            'Styles', 'Technique', 'Creativity'
        ];

        $courses = [
            [
                'title' => 'Learn any style',
                'images' => [
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/classical-piano.jpg',
                    'title' => 'Classical<br> Piano',
                    'instructor' => 'Victoria Theodore',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/cocktail-piano.jpg',
                    'title' => 'Cocktail<br> Piano',
                    'instructor' => 'Brett Ziegler',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/latin-essentials.jpg',
                    'title' => 'Latin<br> Essentials',
                    'instructor' => 'Kevin Castro',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/worship-piano.jpg',
                    'title' => 'Worship<br> Piano',
                    'instructor' => 'Amberly Martz',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/improvisational-jazz.jpg',
                    'title' => 'Improvisational<br> Jazz',
                    'instructor' => 'Jesús Molina',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/gospel-piano.jpg',
                    'title' => 'Gospel<br> Piano',
                    'instructor' => 'Erskine Hawkins',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/Latin-Jazz.jpg',
                    'title' => 'Latin<br> Jazz',
                    'instructor' => 'Gabriel Palatchi',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/Tango-Piano.jpg',
                    'title' => 'Tango<br> Piano',
                    'instructor' => 'Sangah Noona',
                    ]
                ]
            ],
            [
                'title' => 'Add essential techniques',
                'images' => [
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/piano-technique-made-easy.jpg',
                    'title' => 'Piano Technique<br> Made Easy',
                    'instructor' => 'Cassi Falk',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/faster-fingers.jpg',
                    'title' => 'Faster<br> Fingers',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/hanon-exercises.jpg',
                    'title' => 'Hanon<br> Exercises',
                    'instructor' => 'Cassi Falk',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/de-stupefy-your-left-hand.jpg',
                    'title' => 'De-Stupefy<br> Your Left Hand',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/beautifully-simple-piano-arpeggios.jpg',
                    'title' => 'Beautifully<br> Simple Piano<br> Arpeggios',
                    'instructor' => 'Sangah Noona',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/riffs-fills.jpg',
                    'title' => 'Riffs<br> & Fills',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/7-days-to-sight-reading.jpg',
                    'title' => '7 Days To<br> Sight Reading',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/dexterity-finger-strength.jpg',
                    'title' => 'Dexterity &<br> Finger Strength',
                    'instructor' => 'Cassi Falk',
                    ],
                ]
            ],
            [
                'title' => 'Play more creatively',
                'images' => [
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/playing-piano-beautifully.jpg',
                    'title' => 'Playing Piano<br> Beautifully',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/musical-freedom.jpg',
                    'title' => 'Improvisation &<br> Musical Freedom',
                    'instructor' => 'Jesús Molina',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/the-perfect-arrangement.jpg',
                    'title' => 'The Perfect<br> Arrangement',
                    'instructor' => 'Summer Swee-Singh',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/creative-composition.jpg',
                    'title' => 'Creative<br> Composition',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/pillars-of-improvisation.jpg',
                    'title' => 'Pillars of<br> Improvisation',
                    'instructor' => 'Jordan Leibel',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/the-power-of-chords.jpg',
                    'title' => 'The Power<br> of Chords',
                    'instructor' => 'Lisa Witt',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/creative-song-writing.jpg',
                    'title' => 'Creative<br> Songwriting',
                    'instructor' => 'Josh Dion',
                    ],
                    [
                    'img' => 'marketing/pianote/membership/homepage/2023/rhythmic-playing.jpg',
                    'title' => 'Rhythmic<br> Playing',
                    'instructor' => 'Jay Oliver',
                    ],
                ]
            ],
        ];
    @endphp

   @include('musora.sales.components.coaches-section', [
        'header' => 'Real Teachers,  <br class="sm:hidden">Real Results.',
        'desc' => 'Amplify your skills with exclusive artist <br class="hidden md:inline"> courses + live events with special guests.'
    ])
   




    @php
        $songItems = [
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/pianote/membership/homepage/2023/songs-icon.svg',
                'title' => '1000+ popular songs.',
                'desc' => 'Get note-for-note song breakdowns for every style, era, and skill level. ',
            ],
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/pianote/membership/homepage/2023/tempo-icons.svg',
                'title' => 'Find the perfect tempo.',
                'desc' => 'Slow down any section of a song to make those tricky bars easier. ',
            ],
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/pianote/membership/homepage/2023/loop-icons.svg',
                'title' => 'Loop the hard parts.',
                'desc' => 'Create practice loops to play-through those difficult parts over and over.   ',
            ],
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/pianote/membership/homepage/2023/timing-icons.svg',
                'title' => 'Improve your timing.',
                'desc' => 'Use the built-in-metronome – your new best friend for difficult rhythms.  ',
            ],
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/pianote/membership/homepage/2023/play-it-right-icon.svg',
                'title' => 'Play it right the first time.',
                'desc' => 'Get perfect notation and learn to play accurately from the get-go.',
            ],
            [
                'icon' => 'https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/pianote/membership/homepage/2023/devices-icons.svg',
                'title' => 'Take your songs anywhere.',
                'desc' => 'Accessible on any device, or printable, so you can play any song, any time.    ',
            ],

        ];
    @endphp