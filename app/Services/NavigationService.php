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
                        'path' => get_legacy_brand_base_url() . '/shop',
                        'icon' => 'cart',
                    ]
                ],
                [ // section
                    [
                        'name' => brand() === 'singeo' ? 'Courses' : 'Packs',
                        'path' => brand() === 'singeo' ? '/'.brand().'/courses' : '/'.brand().'/packs',
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

        if (brand() === 'drumeo') {
            $navData = [
                [ // section
                    [
                        'name' => 'Home',
                        'path' => '/'.brand(),
                        'icon' => 'home',
                    ],
                    [
                        'name' => 'Method',
                        'path' => '/'.brand().'/method/drumeo-method/241247',
                        'icon' => 'method',
                    ],
                    'songs' => [
                        'name' => 'Songs',
                        'path' => '/'.brand().'/songs',
                        'icon' => 'headphones',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/'.brand().'/coaches',
                        'icon' => 'whistle',
                    ],
                ],
                [ // section
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
                    ],
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
                ],
                [ // section
                    [
                        'name' => 'Forums',
                        'path' => '/'.brand().'/forums',
                        'icon' => 'messages',
                    ],
                    
                    [
                        'name' => 'Shop',
                        'path' => get_legacy_brand_base_url() . '/shop',
                        'icon' => 'cart',
                    ]
                ],
            ];
            return $navData;
        } elseif (brand() === 'pianote') {
            $navData = [
                [ // section
                    [
                        'name' => 'Home',
                        'path' => '/'.brand(),
                        'icon' => 'home',
                    ],
                    [
                        'name' => 'Method',
                        'path' => '/'.brand().'/method/pianote-method/276693',
                        'icon' => 'method',
                    ],
                    'songs' => [
                        'name' => 'Songs',
                        'path' => '/'.brand().'/songs',
                        'icon' => 'headphones',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/'.brand().'/coaches',
                        'icon' => 'whistle',
                    ],
                ],
                [ // section
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
                    ],
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
                ],
                [ // section
                    [
                        'name' => 'Forums',
                        'path' => '/'.brand().'/forums',
                        'icon' => 'messages',
                    ],
                    
                    [
                        'name' => 'Shop',
                        'path' => get_legacy_brand_base_url() . '/shop',
                        'icon' => 'cart',
                    ]
                ],
            ];
            return $navData;
        } elseif (brand() === 'guitareo') {
            $navData = [
                [ // section
                    [
                        'name' => 'Home',
                        'path' => '/'.brand(),
                        'icon' => 'home',
                    ],
                    [
                        'name' => 'Method',
                        'path' => '/'.brand().'/method/guitareo-method/333652',
                        'icon' => 'method',
                    ],
                    'songs' => [
                        'name' => 'Songs',
                        'path' => '/'.brand().'/songs',
                        'icon' => 'headphones',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/'.brand().'/coaches',
                        'icon' => 'whistle',
                    ],
                ],
                [ // section
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
                    ],
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
                        'name' => '500 Songs',
                        'path' => '/'.brand().'/packs/500-songs-in-5-days/233612/introduction/233941',
                        'icon' => '500-songs',
                    ],
                    [
                        'name' => 'Chords',
                        'path' => '/'.brand().'/chords-scales',
                        'icon' => 'guitar-tabs',
                    ],
                    [
                        'name' => 'Archives',
                        'path' => '/'.brand().'/archives',
                        'icon' => 'archives',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Forums',
                        'path' => '/'.brand().'/forums',
                        'icon' => 'messages',
                    ],
                    
                    [
                        'name' => 'Shop',
                        'path' => get_legacy_brand_base_url() . '/shop',
                        'icon' => 'cart',
                    ]
                ],
            ];
            return $navData;
        } elseif (brand() === 'singeo') {
            $navData = [
                [ // section
                    [
                        'name' => 'Home',
                        'path' => '/'.brand(),
                        'icon' => 'home',
                    ],
                    [
                        'name' => 'Method',
                        'path' => '/'.brand().'/method/singeo-method/308514',
                        'icon' => 'method',
                    ],
                    'songs' => [
                        'name' => 'Songs',
                        'path' => '/'.brand().'/songs',
                        'icon' => 'headphones',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/'.brand().'/coaches',
                        'icon' => 'whistle',
                    ],
                ],
                [ // section
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
                    ],
                    [
                        'name' => 'Routines',
                        'path' => '/'.brand().'/routines',
                        'icon' => 'routines',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Forums',
                        'path' => '/'.brand().'/forums',
                        'icon' => 'messages',
                    ],
                    
                    [
                        'name' => 'Shop',
                        'path' => get_legacy_brand_base_url() . '/shop',
                        'icon' => 'cart',
                    ]
                ],
            ];
            return $navData;
        }

        return [];
    }

    /**
     * @return string
     */
    public static function getSidebarSectionsJson()
    {
        return json_encode(self::getSidebarSections());
    }

    /**
     * @return string[]
     */
    public static function getUserDropDownLinks()
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

    /**
     * @return string
     */
    public static function getUserDropDownLinksJson()
    {
        return json_encode(self::getUserDropDownLinks());
    }
}
