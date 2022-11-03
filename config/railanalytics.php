<?php

return array(
    'local' => [
//        'active-tracking-providers' => ['ga', 'ga4' 'gtm', 'gaw', 'fp', 'im'],
        'active-tracking-providers' => ['ga4', 'gtm', 'ga'],

        'providers' => [
            'google-analytics' =>
                [
                    'tracking-id' => ''
                ],
            'google-analytics-v4' =>
                [
                    'tracking-id' => 'G-CRHFZ2Y73H'
                ],
            'google-tag-manager' =>
                [
                    'tracking-id' => 'GTM-WLQRSWT'
                ],
            'google-adwords' =>
                [
                    'google-conversion-id' => '',
                    'google-conversion-language' => '',
                    'google-conversion-format' => '',
                    'google-conversion-color' => '',
                    'google-conversion-label' => '',
                ],
            'facebook-pixel' =>
                [
                    'pixel-id' => ''
                ],
            'impact' =>
                [
                    'utt-link' => '',
                    'sid' => '',
                    'auth-token' => '',
                    'campaign-id' => '',
                    'tag-action-tracker-id' => '',
                    'api-action-tracker-id' => '',
                    'sign-up-action-tracker-id' => ''
                ]
        ]
    ],
    'beta-testing' => [
//        'active-tracking-providers' => ['ga', 'ga4' 'gtm', 'gaw', 'fp', 'im'],
        'active-tracking-providers' => ['ga4', 'gtm', 'ga'],

        'providers' => [
            'google-analytics' =>
                [
                    'tracking-id' => ''
                ],
            'google-analytics-v4' =>
                [
                    'tracking-id' => 'G-CRHFZ2Y73H'
                ],
            'google-tag-manager' =>
                [
                    'tracking-id' => 'GTM-WLQRSWT'
                ],
            'google-adwords' =>
                [
                    'google-conversion-id' => '',
                    'google-conversion-language' => '',
                    'google-conversion-format' => '',
                    'google-conversion-color' => '',
                    'google-conversion-label' => '',
                ],
            'facebook-pixel' =>
                [
                    'pixel-id' => ''
                ],
            'impact' =>
                [
                    'utt-link' => '',
                    'sid' => '',
                    'auth-token' => '',
                    'campaign-id' => '',
                    'tag-action-tracker-id' => '',
                    'api-action-tracker-id' => '',
                    'sign-up-action-tracker-id' => ''
                ]
        ]
    ],
    'production' => [
//        'active-tracking-providers' => ['ga', 'ga4' 'gtm', 'gaw', 'fp', 'im'],
        'active-tracking-providers' => ['ga4', 'gtm', 'ga'],

        'providers' => [
            'google-analytics' =>
                [
                    'tracking-id' => 'UA-304523-137',

                    // https://support.google.com/optimize/answer/6262084
//                    'optimise-id' => 'GTM-WP9MPV8', // if set to null, optimise code not be rendered
                    'optimise-id' => null, // if set to null, optimise code not be rendered
                ],
            'google-analytics-v4' =>
                [
                    'tracking-id' => 'G-ZR2SNWTTGM'
                ],
            'google-tag-manager' =>
                [
                    'tracking-id' => 'GTM-KFF3NW7'
                ],
            'google-adwords' =>
                [
                    'google-conversion-id' => '',
                    'google-conversion-language' => '',
                    'google-conversion-format' => '',
                    'google-conversion-color' => '',
                    'google-conversion-label' => '',
                ],
            'facebook-pixel' =>
                [
                    'pixel-id' => ''
                ],
            'impact' =>
                [
                    'utt-link' => '',
                    'sid' => '',
                    'auth-token' => '',
                    'campaign-id' => '',
                    'tag-action-tracker-id' => '',
                    'api-action-tracker-id' => '',
                    'sign-up-action-tracker-id' => ''
                ]
        ]
    ]
);
