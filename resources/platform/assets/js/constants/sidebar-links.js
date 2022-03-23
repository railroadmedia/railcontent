export default function() {
    return {
        sections: [
            {
              links: [
                {
                  name: 'Home',
                  path: '/members',
                  icon: 'home',
                },
                {
                  name: 'Method',
                  path: '/members/method',
                  icon: 'method',
                },
                {
                  name: 'Songs',
                  path: '/members/songs',
                  icon: 'headphones',
                },
                {
                  name: 'Coaches',
                  path: '/members/coaches',
                  icon: 'whistle',
                }
              ]
            },
            {
              links: [
                {
                  name: 'Packs',
                  path: '/members/packs',
                  icon: 'box',
                },
                {
                  name: 'Quick Tips',
                  path: '/members/quick-tips',
                  icon: 'light-bulb',
                },
                {
                  name: 'Student Focus',
                  path: '/members/student-focus',
                  icon: 'person-plus',
                },
                {
                  name: 'Live',
                  path: '/members/live',
                  icon: 'play-circle',
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
                path: '/members/routines',
                icon: 'routines',
                viewBox:"0 0 29 29"
            },
            ]
        },
        {
            brand: 'guitareo',
            links: [
            {
                name: 'Lessons',
                path: '/members/lessons',
                icon: 'acoustic-guitar',
                viewBox:"0 0 20 22",
                width: "22",
                height: "35",
            },
            {
                name: 'Play Alongs',
                path: '/members/lessons',
                icon: 'eigth-notes',
            },
            {
                name: 'Chords & Scales',
                path: '/members/chords-scales',
                icon: 'guitar-tabs',
            },
            {
                name: 'Archives',
                path: '/members/archives',
                icon: 'archives',
            },
            ]
        },
        {
            brand: 'pianote',
            links: [
            {
                name: 'Foundation',
                path: '/members/foundation',
                icon: 'foundation',
                viewBox: '0 0 27 27',
            },
            {
                name: 'Podcast',
                path: '/members/podcast',
                icon: 'podcast',
            },
            {
                name: 'Bootcamps',
                path: '/members/bootcamps',
                icon: 'keys',
            },
            ]
        },
        {
            brand: 'drumeo',
            links: [
            {
                name: 'Play-Alongs',
                path: '/members/play-alongs',
                icon: 'eigth-notes',
            },
            {
                name: 'Rudiments',
                path: '/members/rudiments',
                icon: 'drum',
            },
            {
                name: 'Shows',
                path: '/members/shows',
                icon: 'shows',
                viewBox: '0 0 30 27'
            },
            ]
        },
        ]
    }
}