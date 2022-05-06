<?php

namespace App\Services;

class NavigationService
{
    /**
     * @return array|string[][][]
     */
    public static function getSidebarSections()
    {
        if (empty(user())) {
            return [];
        }

        if (brand() === 'drumeo') {
            return [
                [ // section
                    [
                        'name' => 'Home',
                        'path' => '/' . brand(),
                        'icon' => 'home',
                    ],
                    [
                        'name' => 'Method',
                        'path' => '/' . brand() . '/method/drumeo-method/241247',
                        'icon' => 'method',
                    ],
                    [
                        'name' => 'Songs',
                        'path' => '/' . brand() . '/songs',
                        'icon' => 'headphones',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/' . brand() . '/coaches',
                        'icon' => 'whistle',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Packs',
                        'path' => '/' . brand() . '/packs',
                        'icon' => 'box',
                    ],
                    [
                        'name' => 'Courses',
                        'path' => '/' . brand() . '/courses',
                        'icon' => 'academic-cap',
                    ],
                    [
                        'name' => 'Quick Tips',
                        'path' => '/' . brand() . '/quick-tips',
                        'icon' => 'light-bulb',
                    ],
                    [
                        'name' => 'Student Focus',
                        'path' => '/' . brand() . '/student-focus',
                        'icon' => 'person-plus',
                    ],
                    [
                        'name' => 'Live',
                        'path' => '/' . brand() . '/live',
                        'icon' => 'play-circle',
                    ],
                    [
                        'name' => 'Play-Alongs',
                        'path' => '/' . brand() . '/play-alongs',
                        'icon' => 'eigth-notes',
                    ],
                    [
                        'name' => 'Rudiments',
                        'path' => '/' . brand() . '/rudiments',
                        'icon' => 'drum',
                    ],
                    [
                        'name' => 'Shows',
                        'path' => '/' . brand() . '/shows',
                        'icon' => 'shows',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Forums',
                        'path' => '/' . brand() . '/forums',
                        'icon' => 'messages',
                    ],
                    [
                        'name' => 'My List',
                        'path' => '/' . brand() . '/my-list',
                        'icon' => 'playlist',
                    ],
                ],
            ];
        } elseif (brand() === 'pianote') {
            return [
                [ // section
                    [
                        'name' => 'Home',
                        'path' => '/' . brand(),
                        'icon' => 'home',
                    ],
                    [
                        'name' => 'Method',
                        'path' => '/' . brand() . '/method/pianote-method/276693',
                        'icon' => 'method',
                    ],
                    [
                        'name' => 'Songs',
                        'path' => '/' . brand() . '/songs',
                        'icon' => 'headphones',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/' . brand() . '/coaches',
                        'icon' => 'whistle',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Packs',
                        'path' => '/' . brand() . '/packs',
                        'icon' => 'box',
                    ],
                    [
                        'name' => 'Courses',
                        'path' => '/' . brand() . '/courses',
                        'icon' => 'academic-cap',
                    ],
                    [
                        'name' => 'Quick Tips',
                        'path' => '/' . brand() . '/quick-tips',
                        'icon' => 'light-bulb',
                    ],
                    [
                        'name' => 'Student Focus',
                        'path' => '/' . brand() . '/student-focus',
                        'icon' => 'person-plus',
                    ],
                    [
                        'name' => 'Live',
                        'path' => '/' . brand() . '/live',
                        'icon' => 'play-circle',
                    ],
                    [
                        'name' => 'Podcast',
                        'path' => '/' . brand() . '/podcast',
                        'icon' => 'podcast',
                    ],
                    [
                        'name' => 'Bootcamps',
                        'path' => '/' . brand() . '/bootcamps',
                        'icon' => 'keys',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Forums',
                        'path' => '/' . brand() . '/forums',
                        'icon' => 'messages',
                    ],
                    [
                        'name' => 'My List',
                        'path' => '/' . brand() . '/my-list',
                        'icon' => 'playlist',
                    ],
                ],
            ];
        } elseif (brand() === 'guitareo') {
            return [
                [ // section
                    [
                        'name' => 'Home',
                        'path' => '/' . brand(),
                        'icon' => 'home',
                    ],
                    [
                        'name' => 'Method',
                        'path' => '/' . brand() . '/method/guitareo-method/333652',
                        'icon' => 'method',
                    ],
                    [
                        'name' => 'Songs',
                        'path' => '/' . brand() . '/songs',
                        'icon' => 'headphones',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/' . brand() . '/coaches',
                        'icon' => 'whistle',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Lessons',
                        'path' => '/' . brand() . '/lessons',
                        'icon' => 'electric-guitar',
                    ],
                    [
                        'name' => 'Packs',
                        'path' => '/' . brand() . '/packs',
                        'icon' => 'box',
                    ],
                    [
                        'name' => 'Courses',
                        'path' => '/' . brand() . '/courses',
                        'icon' => 'academic-cap',
                    ],
                    [
                        'name' => 'Quick Tips',
                        'path' => '/' . brand() . '/quick-tips',
                        'icon' => 'light-bulb',
                    ],
                    [
                        'name' => 'Student Focus',
                        'path' => '/' . brand() . '/student-focus',
                        'icon' => 'person-plus',
                    ],
                    [
                        'name' => 'Live',
                        'path' => '/' . brand() . '/live',
                        'icon' => 'play-circle',
                    ],
                    [
                        'name' => '500 Songs',
                        'path' => '/' . brand() . '/lessons',
                        'icon' => '500-songs',
                    ],
                    [
                        'name' => 'Chords & Scales',
                        'path' => '/' . brand() . '/chords-scales',
                        'icon' => 'guitar-tabs',
                    ],
                    [
                        'name' => 'Archives',
                        'path' => '/' . brand() . '/archives',
                        'icon' => 'archives',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Forums',
                        'path' => '/' . brand() . '/forums',
                        'icon' => 'messages',
                    ],
                    [
                        'name' => 'My List',
                        'path' => '/' . brand() . '/my-list',
                        'icon' => 'playlist',
                    ],
                ],
            ];
        } elseif (brand() === 'singeo') {
            return [
                [ // section
                    [
                        'name' => 'Home',
                        'path' => '/' . brand(),
                        'icon' => 'home',
                    ],
                    [
                        'name' => 'Method',
                        'path' => '/' . brand() . '/method/singeo-method/308514',
                        'icon' => 'method',
                    ],
                    [
                        'name' => 'Songs',
                        'path' => '/' . brand() . '/songs',
                        'icon' => 'headphones',
                    ],
                    [
                        'name' => 'Coaches',
                        'path' => '/' . brand() . '/coaches',
                        'icon' => 'whistle',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Packs',
                        'path' => '/' . brand() . '/packs',
                        'icon' => 'box',
                    ],
                    [
                        'name' => 'Courses',
                        'path' => '/' . brand() . '/courses',
                        'icon' => 'academic-cap',
                    ],
                    [
                        'name' => 'Quick Tips',
                        'path' => '/' . brand() . '/quick-tips',
                        'icon' => 'light-bulb',
                    ],
                    [
                        'name' => 'Student Focus',
                        'path' => '/' . brand() . '/student-focus',
                        'icon' => 'person-plus',
                    ],
                    [
                        'name' => 'Live',
                        'path' => '/' . brand() . '/live',
                        'icon' => 'play-circle',
                    ],
                    [
                        'name' => 'Routines',
                        'path' => '/' . brand() . '/routines',
                        'icon' => 'routines',
                    ],
                ],
                [ // section
                    [
                        'name' => 'Forums',
                        'path' => '/' . brand() . '/forums',
                        'icon' => 'messages',
                    ],
                    [
                        'name' => 'My List',
                        'path' => '/' . brand() . '/my-list',
                        'icon' => 'playlist',
                    ],
                ],
            ];
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
            'dashboardPageUrl' => '/' . brand() . '/profile/' . user()->id . '/dashboard',
            'notificationsPageUrl' => '/',
            'playlistsPageUrl' => '/',
            'schedulePageUrl' => '/',
            'applyForReviewPageUrl' => '/',
            'settingsPageUrl' => '/' . brand() . '/profile/' . user()->id . '/settings/profile',
            'supportPageUrl' => '/' . brand() . '/support',
            'shopPageUrl' => 'https://' . brand() . '.com/shop',
            'logoutPageUrl' => '/usora/deauthenticate',
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
