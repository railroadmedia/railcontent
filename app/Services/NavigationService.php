<?php

namespace App\Services;

class NavigationService
{
    /**
     * @return array|string[][][]
     */
    public static function getSidebarSections()
    {
        $user = user();
        if (empty($user)) {
            return [];
        }
        $shopName = brand() == 'drumeo' ? 'drumshop' : 'shop';
        if ($user->isPackOnlyOwner() || !$user->isAMember() || $user->isAnExpiredMember()) {
            return [
                [ // section
                    [
                        'name' => 'Home',
                        'path' => '/'.brand(),
                        'icon' => 'home',
                    ],
                    [
                        'name' => 'Shop',
                        'path' => get_legacy_brand_base_url().'/'.$shopName,
                        'icon' => 'cart',
                    ]
                ],
                [ // section
                    [
                        'name' => 'Packs',
                        'path' => '/'.brand().'/packs',
                        'icon' => 'box',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Forums',
                        'path' => '/'.brand().'/forums',
                        'icon' => 'messages',
                    ],

                ],
            ];
        }

        $methodurl = match(brand()) {
            'drumeo' => 'drumeo-method/241247',
            'pianote' => 'pianote-method/276693',
            'guitareo' => 'guitareo-method/333652',
            'singeo' => 'singeo-method/308514'
        };

        $homeSection = [
            [
                'name' => 'Home',
                'path' => '/'.brand(),
                'icon' => 'home',
            ],
            [
                'name' => 'Method',
                'path' => '/'.brand().'/method/'.$methodurl,
                'icon' => 'method',
            ],
            [
                'name' => 'Songs',
                'path' => '/'.brand().'/songs',
                'icon' => 'headphones',
            ],
            [
                'name' => 'Workouts',
                'path' => '/'.brand().'/workouts',
                'icon' => 'workouts',
            ],
        ];

        $commonContentSection = [
            [
                'name' => 'Packs',
                'path' => '/'.brand().'/packs',
                'icon' => 'box',
            ],
            [
                'name' => 'Courses',
                'path' => '/'.brand().'/courses',
                'icon' => 'academic-cap',
            ],
            [
                'name' => 'Quick Tips',
                'path' => '/'.brand().'/quick-tips',
                'icon' => 'light-bulb',
            ],
            [
                'name' => 'Student Focus',
                'path' => '/'.brand().'/student-focus',
                'icon' => 'person-plus',
            ],
            [
                'name' => 'Live',
                'path' => '/'.brand().'/live',
                'icon' => 'play-circle',
            ],
            [
                'name' => brand().' Schedule',
                'path' => '/'.brand().'/schedule/',
                'icon' => 'calendar',
            ]
        ];

        $forumAndShopSection =
            [
                [
                    'name' => 'Forums',
                    'path' => '/'.brand().'/forums',
                    'icon' => 'messages',
                ],

                [
                    'name' => 'Shop',
                    'path' => get_legacy_brand_base_url() . '/'.$shopName,
                    'icon' => 'cart',
                ]
            ];

        if (brand() === 'drumeo') {
            $commonContentSection = array_merge(
                $commonContentSection,
                [
                        [
                            'name' => 'Play-Alongs',
                            'path' => '/'.brand().'/play-alongs',
                            'icon' => 'eigth-notes',
                        ],
                        [
                            'name' => 'Rudiments',
                            'path' => '/'.brand().'/rudiments',
                            'icon' => 'drum',
                        ],
                        [
                            'name' => 'Shows',
                            'path' => '/'.brand().'/shows',
                            'icon' => 'shows',
                        ],
                        [
                            'name' => 'Coaches',
                            'path' => '/'.brand().'/coaches',
                            'icon' => 'whistle',
                        ]
                    ]
            );
            $navData = [
                $homeSection,
                $commonContentSection,
                $forumAndShopSection
            ];
            return $navData;
        } elseif (brand() === 'pianote') {
            $commonContentSection = array_merge(
                $commonContentSection,
                [
                    [
                        'name' => 'Song Tutorials',
                        'path' => '/'.brand().'/song-tutorials',
                        'icon' => 'play-progress',
                    ],
                    [
                        'name' => 'Podcast',
                        'path' => '/'.brand().'/podcasts',
                        'icon' => 'podcast',
                    ],
                    [
                        'name' => 'Bootcamps',
                        'path' => '/'.brand().'/bootcamps',
                        'icon' => 'keys',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/'.brand().'/coaches',
                        'icon' => 'whistle',
                    ]
                ]
            );
            $navData = [
                $homeSection,
                $commonContentSection,
                $forumAndShopSection
            ];
            return $navData;
        } elseif (brand() === 'guitareo') {
            $commonContentSection = array_merge(
                $commonContentSection,
                [
                    [
                        'name' => 'Play-Alongs',
                        'path' => '/'.brand().'/play-alongs',
                        'icon' => 'eigth-notes',
                    ],
                    [
                        'name' => 'Lessons',
                        'path' => '/'.brand().'/lessons',
                        'icon' => 'electric-guitar',
                    ],
                    [
                        'name' => 'Chords',
                        'path' => '/'.brand().'/courses/chord-resources/391634',
                        'icon' => 'guitar-tabs',
                    ],
                    [
                        'name' => 'Archives',
                        'path' => '/'.brand().'/archives',
                        'icon' => 'archives',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/'.brand().'/coaches',
                        'icon' => 'whistle',
                    ]
                ]
            );
            $navData = [
                $homeSection,
                $commonContentSection,
                $forumAndShopSection
            ];
            return $navData;
        } elseif (brand() === 'singeo') {
            $commonContentSection = array_merge(
                $commonContentSection,
                [
                    [
                        'name' => 'Routines',
                        'path' => '/'.brand().'/routines',
                        'icon' => 'routines',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/'.brand().'/coaches',
                        'icon' => 'whistle',
                    ]
                ]
            );
            $navData = [
                $homeSection,
                $commonContentSection,
                $forumAndShopSection
            ];
            return $navData;
        }

        return [];
    }

    public static function getSidebarSectionsJson(): string
    {
        return json_encode(self::getSidebarSections());
    }

    /**
     * @return string[]
     */
    public static function getUserDropDownLinks(): array
    {
        if (empty(user())) {
            return [];
        }

        return [
            'dashboardPageUrl' => '/'.brand().'/profile/'.user()->id.'/dashboard',
            'notificationsPageUrl' => '/'.brand().'/notifications',
            'playlistsPageUrl' => '/',
            'schedulePageUrl' => '/'.brand().'/schedule',
            'applyForReviewPageUrl' => '/',
            'settingsPageUrl' => '/'.brand().'/profile/'.user()->id.'/settings/profile',
            'supportPageUrl' => '/'.brand().'/support',
            'logoutPageUrl' => '/user-management-system/logout/cookie',
        ];
    }

    public static function getUserDropDownLinksJson(): string
    {
        return json_encode(self::getUserDropDownLinks());
    }
}
