@include('bladesora::members.navigation.public-nav', [
    "logo" => "https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png",
    "themeColor" => "drumeo",
    "links" => [
        "Member Login" => [
            "icon" => "fas fa-sign-in",
            "url" => url()->route('members.home'),
        ],
        "Contact" => [
            "icon" => "fas fa-phone",
            "url" => '/contact',
        ],
        "Drumeo" => [
            "icon" => "icon-courses",
            "url" => '/',
        ],
        "Drum Shop" => [
            "icon" => "fas fa-tag",
            "children" => [
                "All Products" => [
                    "url" => '/drumshop',
                ],
                "Best Beginner Drum Book" => [
                    "url" => '/drumshop/beginner-book',
                ],
                "P4 Practice Pad" => [
                    "url" => '/drumshop/practice-pad-full',
                ],
                "Video Drum Lessons" => [
                    "url" => '/lessons/',
                ],
                "Clothing & Merchandise" => [
                    "url" => '/clothing/',
                ],
            ],
        ],
        "Free Resources" => [
            "icon" => "fas fa-play-circle",
            "children" => [
                "Getting Started On The Drums"=> [
                    "url" => "/getting-started/",
                ],
                "40 Drum Rudiments"=> [
                    "url" => "/beat/rudiments/",
                ],
                "The Drumeo Podcast"=> [
                    "url" => "/beat/podcasts/",
                ],
                "Free Video Drum Lessons"=> [
                    "url" => "/beat/videos/",
                ],
                "Free Articles For Drummers"=> [
                    "url" => "/beat/articles/",
                ],
                "How To Play Drums"=> [
                    "url" => "/beat/how-to-play-drums/",
                ],
            ],
        ],
    ]
])


