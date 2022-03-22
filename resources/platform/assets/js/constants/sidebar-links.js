export default function() {
    return {
        sections: [
            {
                links: [
                    {
                        name: 'Home',
                        url: '/members',
                        icon: 'home',
                        active: true,
                    },
                    {
                        name: 'Method',
                        url: '/members/method',
                        icon: 'method',
                        active: false,
                    },
                    {
                        name: 'Songs',
                        url: '/members/songs',
                        icon: 'headphones',
                        active: false,
                    },
                    {
                        name: 'Coaches',
                        url: '/members/coaches',
                        icon: 'whistle',
                        active: false,
                    }
                ]
            },
            {
                links: [
                    {
                        name: 'Packs',
                        url: '/members/packs',
                        icon: 'box',
                        active: false,
                    },
                    {
                        name: 'Quick Tips',
                        url: '/members/quick-tips',
                        icon: 'light-bulb',
                        active: false,
                    },
                    {
                        name: 'Student Focus',
                        url: '/members/student-focus',
                        icon: 'person-plus',
                        active: false,
                    },
                    {
                        name: 'Live',
                        url: '/members/live',
                        icon: 'play-circle',
                        active: false,
                    },
                ]
            }
        ],
        brandSections: [
            {
                brand: 'singeo',
                links: [
                    {
                        name: 'Routines',
                        url: '/members/routines',
                        icon: 'home',
                        active: false,
                    },
                ]
            },
            {
                brand: 'guitareo',
                links: [
                    {
                        name: 'Lessons',
                        url: '/members/lessons',
                        icon: 'acoustic-guitar',
                        active: false,
                    },
                    {
                        name: 'Play Alongs',
                        url: '/members/lessons',
                        icon: 'eigth-notes',
                        active: false,
                    },
                    {
                        name: 'Chords & Scales',
                        url: '/members/chords-scales',
                        icon: 'guitar-tabs',
                        active: false,
                    },
                    {
                        name: 'Archives',
                        url: '/members/archives',
                        icon: 'archives',
                        active: false,
                    },
                ]
            },
            {
                brand: 'pianote',
                links: [
                    {
                        name: 'Foundation',
                        url: '/members/foundation',
                        icon: 'foundation',
                        active: false,
                        viewBox: '0 0 27 27',
                    },
                    {
                        name: 'Podcast',
                        url: '/members/podcast',
                        icon: 'podcast',
                        active: false,
                    },
                    {
                        name: 'Bootcamps',
                        url: '/members/bootcamps',
                        icon: 'keys',
                        active: false,
                    },
                ]
            },
            {
                brand: 'drumeo',
                    links: [
                    {
                        name: 'Play-Alongs',
                        url: '/members/play-alongs',
                        icon: 'eigth-notes',
                        active: false,
                    },
                    {
                        name: 'Rudiments',
                        url: '/members/rudiments',
                        icon: 'drum',
                        active: false,
                    },
                    {
                        name: 'Shows',
                        url: '/members/shows',
                        icon: 'shows',
                        active: false,
                    },
                ]
            },
        ]
    }
}