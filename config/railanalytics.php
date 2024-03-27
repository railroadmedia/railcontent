<?php

return [
    // Middleware group
    'blank_tracking_page_middleware_group_name' => 'web_public',

    // This is used to match the brand key values to the current domains so the right brand is served for a request.
    'brand_domains' => [
        'drumeo.com' => 'drumeo',
        'pianote.com' => 'pianote',
        'guitareo.com' => 'guitareo',
        'singeo.com' => 'singeo',
        'musora.com' => 'musora',
        'brand_1.com' => 'brand_1',
        'brand_2.com' => 'brand_2',
    ],

    // brands
    'musora' => [
        'local' => [
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
                    ],
                'everflow' =>
                    [
                        'base_link' => '',
                        'nid' => '',
                        'verification_token' => '',
                        'conversion_event_id' => '', // This comes from Brands/X/Events
                        'brand_id' => '',
                        'sign-up-action-tracker-id' => ''
                    ]
            ]
        ],
        'beta-testing' => [
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
            'active-tracking-providers' => ['ga4', 'gtm', 'ga', 'im', 'ef'],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-304523-137',
                        'optimise-id' => null,
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
                    ],
                'everflow' =>
                    [
                        'base_link' => '',
                        'nid' => '',
                        'verification_token' => '',
                        'conversion_event_id' => '',
                        'brand_id' => '',
                        'sign-up-action-tracker-id' => ''
                    ]
            ],
        ],
    ],

    'drumeo' => [
        'local' => [
            'active-tracking-providers' => ['ga', 'fp', 'gaw', 'ga4', 'gtm', 'im'],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-96565469-1',
                        'optimise-id' => null
                    ],
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-RD2SJQH0N7'
                    ],
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-5CQBWGQ'
                    ],
                'google-adwords' =>
                    [
                        'google-conversion-id' => '1071462884',
                        'google-conversion-language' => 'en',
                        'google-conversion-format' => '3',
                        'google-conversion-color' => 'ffffff',
                        'google-conversion-label' => 'Uf7cCNeQgHAQ5PP0_gM',
                    ],
                'facebook-pixel' =>
                    [
                        'pixel-id' => '1303177136444246'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3032697-2ca8-4ba5-9bad-ee08c4a7d1ca1',
                        'sid' => 'IRzxwmnLNaMN3032697tSVoYihcdj3Qop1',
                        'auth-token' => 'Dnetdodz2rgZeU.ECRcMmu9heSt_rhwk',
                        'campaign-id' => '14652',
                        'tag-action-tracker-id' => '27554',
                        'api-action-tracker-id' => '27555',
                        'sign-up-action-tracker-id' => ''
                    ],
                //TODO remove this before production
                'everflow' =>
                    [
                        'base_link' => 'https://www.mcqn3fgtrk.com',
                        'nid' => '2809',
                        'verification_token' => 'Wd6qt9rAYSpV9Fm3QYUtBdnra9p4D0',
                        'conversion_event_id' => 1, // This comes from Brands/X/Events
                        'brand_id' => 1,
                        'sign-up-action-tracker-id' => 2
                    ]
            ]
        ],
        'beta-testing' => [
            'active-tracking-providers' => ['ga', 'fp', 'gaw', 'ga4', 'gtm', 'im',],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-96565469-1',
                        'optimise-id' => null
                    ],
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-RD2SJQH0N7'
                    ],
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-5CQBWGQ'
                    ],
                'google-adwords' =>
                    [
                        'google-conversion-id' => '1071462884',
                        'google-conversion-language' => 'en',
                        'google-conversion-format' => '3',
                        'google-conversion-color' => 'ffffff',
                        'google-conversion-label' => 'Uf7cCNeQgHAQ5PP0_gM',
                    ],
                'facebook-pixel' =>
                    [
                        'pixel-id' => '1303177136444246'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3032697-2ca8-4ba5-9bad-ee08c4a7d1ca1',
                        'sid' => 'IRzxwmnLNaMN3032697tSVoYihcdj3Qop1',
                        'auth-token' => 'Dnetdodz2rgZeU.ECRcMmu9heSt_rhwk',
                        'campaign-id' => '14652',
                        'tag-action-tracker-id' => '27554',
                        'api-action-tracker-id' => '27555',
                        'sign-up-action-tracker-id' => ''
                    ]
            ]
        ],
        'web-staging-one' => [
            'active-tracking-providers' => ['ga', 'fp', 'gaw', 'ga4', 'gtm', 'im',],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-96565469-1',
                        'optimise-id' => null
                    ],
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-RD2SJQH0N7'
                    ],
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-5CQBWGQ'
                    ],
                'google-adwords' =>
                    [
                        'google-conversion-id' => '1071462884',
                        'google-conversion-language' => 'en',
                        'google-conversion-format' => '3',
                        'google-conversion-color' => 'ffffff',
                        'google-conversion-label' => 'Uf7cCNeQgHAQ5PP0_gM',
                    ],
                'facebook-pixel' =>
                    [
                        'pixel-id' => '1303177136444246'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3032697-2ca8-4ba5-9bad-ee08c4a7d1ca1',
                        'sid' => 'IRzxwmnLNaMN3032697tSVoYihcdj3Qop1',
                        'auth-token' => 'Dnetdodz2rgZeU.ECRcMmu9heSt_rhwk',
                        'campaign-id' => '14652',
                        'tag-action-tracker-id' => '27554',
                        'api-action-tracker-id' => '27555',
                        'sign-up-action-tracker-id' => ''
                    ]
            ]
        ],
        'production' => [
            'active-tracking-providers' => ['ga', 'gtm', 'gaw', 'fp', 'ga4', 'im', 'ef'],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-304523-134',
                        'optimise-id' => null,
                    ],
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-Y3L45RQH8R'
                    ],
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-K8757GR'
                    ],
                'google-adwords' =>
                    [
                        'google-conversion-id' => '1071462884',
                        'google-conversion-language' => 'en',
                        'google-conversion-format' => '3',
                        'google-conversion-color' => 'ffffff',
                        'google-conversion-label' => 'NWZ6CLGKiHAQ5PP0_gM',
                    ],
                'facebook-pixel' =>
                    [
                        'pixel-id' => '713455882045507'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3032697-2ca8-4ba5-9bad-ee08c4a7d1ca1',
                        'sid' => 'IRzxwmnLNaMN3032697tSVoYihcdj3Qop1',
                        'auth-token' => 'Dnetdodz2rgZeU.ECRcMmu9heSt_rhwk',
                        'campaign-id' => '14652',
                        'tag-action-tracker-id' => '27554',
                        'api-action-tracker-id' => '27555',
                        'sign-up-action-tracker-id' => '28350'
                    ],
                'everflow' =>
                    [
                        'base_link' => 'https://www.mcqn3fgtrk.com',
                        'nid' => '2809',
                        'verification_token' => 'Wd6qt9rAYSpV9Fm3QYUtBdnra9p4D0',
                        'conversion_event_id' => 1, // This comes from Brands/X/Events
                        'brand_id' => 1,
                        'sign-up-action-tracker-id' => 2
                    ]
            ]
        ]
    ],

    'pianote' => [
        'local' => [
            'active-tracking-providers' => ['ga', 'gtm', 'gaw', 'fp', 'ga4', 'im'],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-96565469-1'
                    ],
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-RD2SJQH0N7'
                    ],
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-5CQBWGQ'
                    ],
                'google-adwords' =>
                    [
                        'google-conversion-id' => '845037222',
                        'google-conversion-language' => 'en',
                        'google-conversion-format' => '3',
                        'google-conversion-color' => 'ffffff',
                        'google-conversion-label' => 'ErWUCNLA3IgYEKb9-JID',
                    ],
                'facebook-pixel' =>
                    [
                        'pixel-id' => '1303177136444246'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3032711-54a2-463a-8dd0-dea886d450581',
                        'sid' => 'IRrBi9uekoT63032711PiY8YYE6HVQztw1',
                        'auth-token' => 'tFaYd3H_pvLUhkzmyuyVRzRrJ7ujv.sX',
                        'campaign-id' => '14651',
                        'tag-action-tracker-id' => '27558',
                        'api-action-tracker-id' => '27559',
                        'sign-up-action-tracker-id' => '',
                    ]
            ]
        ],
        'beta-testing' => [
            'active-tracking-providers' => ['ga', 'gtm', 'gaw', 'fp', 'ga4', 'im'],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-96565469-1'
                    ],
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-RD2SJQH0N7'
                    ],
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-5CQBWGQ'
                    ],
                'google-adwords' =>
                    [
                        'google-conversion-id' => '1071462884',
                        'google-conversion-language' => 'en',
                        'google-conversion-format' => '3',
                        'google-conversion-color' => 'ffffff',
                        'google-conversion-label' => 'Uf7cCNeQgHAQ5PP0_gM',
                    ],
                'facebook-pixel' =>
                    [
                        'pixel-id' => '1303177136444246'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3032711-54a2-463a-8dd0-dea886d450581',
                        'sid' => 'IRrBi9uekoT63032711PiY8YYE6HVQztw1',
                        'auth-token' => 'tFaYd3H_pvLUhkzmyuyVRzRrJ7ujv.sX',
                        'campaign-id' => '14651',
                        'tag-action-tracker-id' => '27558',
                        'api-action-tracker-id' => '27559',
                        'sign-up-action-tracker-id' => '',
                    ]
            ]
        ],
        'production' => [
            'active-tracking-providers' => ['ga', 'gtm', 'gaw', 'fp', 'ga4', 'im', 'ef'],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-87486706-2',
                        'optimise-id' => null,
                    ],
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-H015F84TK0'
                    ],
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-N2NTV9H'
                    ],
                'google-adwords' =>
                    [
                        'google-conversion-id' => '845037222',
                        'google-conversion-language' => 'en',
                        'google-conversion-format' => '3',
                        'google-conversion-color' => 'ffffff',
                        'google-conversion-label' => 'ErWUCNLA3IgYEKb9-JID',
                    ],
                'facebook-pixel' =>
                    [
                        'pixel-id' => '246265805779426'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3032711-54a2-463a-8dd0-dea886d450581',
                        'sid' => 'IRrBi9uekoT63032711PiY8YYE6HVQztw1',
                        'auth-token' => 'tFaYd3H_pvLUhkzmyuyVRzRrJ7ujv.sX',
                        'campaign-id' => '14651',
                        'tag-action-tracker-id' => '27558',
                        'api-action-tracker-id' => '27559',
                        'sign-up-action-tracker-id' => '28349',
                    ],
                'everflow' =>
                    [
                        'base_link' => 'https://www.mcqn3fgtrk.com',
                        'nid' => '2809',
                        'verification_token' => 'ESebdMzhYRuj9e81RThwqbp6SQ8s1W',
                        'conversion_event_id' => 1, // This comes from Brands/X/Events
                        'brand_id' => 2,
                        'sign-up-action-tracker-id' => '2'
                    ]
            ]
        ]
    ],

    'guitareo' => [
        'local' => [
            'active-tracking-providers' => ['ga', 'gtm', 'gaw', 'fp', 'ga4', 'im'],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-46498312-13'
                    ],
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-MS8HQMZ'
                    ],
                'google-adwords' =>
                    [
                        'google-conversion-id' => '992846266',
                        'google-conversion-language' => 'en',
                        'google-conversion-format' => '3',
                        'google-conversion-color' => 'aaaaaa',
                        'google-conversion-label' => 'oV6tCLWy6XYQusO22QM',
                    ],
                'facebook-pixel' =>
                    [
                        'pixel-id' => '781339702238540'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3032716-5429-4214-9065-1670fda851251',
                        'sid' => 'IRrSkmAAdCgz3032716uDi2myMRzPJo2C1',
                        'auth-token' => 'vwGshMUQ-pSZjyGoWCjt4K-uo9syLmQM',
                        'campaign-id' => '14650',
                        'tag-action-tracker-id' => '27560',
                        'api-action-tracker-id' => '27561',
                        'sign-up-action-tracker-id' => ''
                    ]
            ]
        ],
        'beta-testing' => [
            'active-tracking-providers' => ['ga', 'gtm', 'gaw', 'fp', 'ga4', 'im'],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-46498312-13'
                    ],
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-MS8HQMZ'
                    ],
                'google-adwords' =>
                    [
                        'google-conversion-id' => '992846266',
                        'google-conversion-language' => 'en',
                        'google-conversion-format' => '3',
                        'google-conversion-color' => 'aaaaaa',
                        'google-conversion-label' => 'oV6tCLWy6XYQusO22QM',
                    ],
                'facebook-pixel' =>
                    [
                        'pixel-id' => '781339702238540'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3032716-5429-4214-9065-1670fda851251',
                        'sid' => 'IRrSkmAAdCgz3032716uDi2myMRzPJo2C1',
                        'auth-token' => 'vwGshMUQ-pSZjyGoWCjt4K-uo9syLmQM',
                        'campaign-id' => '14650',
                        'tag-action-tracker-id' => '27560',
                        'api-action-tracker-id' => '27561',
                        'sign-up-action-tracker-id' => ''
                    ]
            ]
        ],
        'production' => [
            'active-tracking-providers' => ['ga', 'gtm', 'gaw', 'fp', 'ga4', 'im', 'ef'],

            'providers' => [
                'google-analytics' =>
                    [
                        'tracking-id' => 'UA-46498312-12'
                    ],
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-RJTZJGP1TS'
                    ],
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-5VVQJWC'
                    ],
                'google-adwords' =>
                    [
                        'google-conversion-id' => '992846266',
                        'google-conversion-language' => 'en',
                        'google-conversion-format' => '3',
                        'google-conversion-color' => 'ffffff',
                        'google-conversion-label' => 'aDXXCImz6XYQusO22QM',
                    ],
                'facebook-pixel' =>
                    [
                        'pixel-id' => '781339702238540'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3032716-5429-4214-9065-1670fda851251',
                        'sid' => 'IRrSkmAAdCgz3032716uDi2myMRzPJo2C1',
                        'auth-token' => 'vwGshMUQ-pSZjyGoWCjt4K-uo9syLmQM',
                        'campaign-id' => '14650',
                        'tag-action-tracker-id' => '27560',
                        'api-action-tracker-id' => '27561',
                        'sign-up-action-tracker-id' => '28352'
                    ],
                'everflow' =>
                    [
                        'base_link' => 'https://www.mcqn3fgtrk.com',
                        'nid' => '2809',
                        'verification_token' => 'teNV6vx5a0OfPlf9MuXheR5PJMNURf',
                        'conversion_event_id' => 1, // This comes from Brands/X/Events
                        'brand_id' => 3,
                        'sign-up-action-tracker-id' => 2
                    ]
            ]
        ]
    ],

    'singeo' => [
        'local' => [
            'active-tracking-providers' => ['ga4', 'im'],

            'providers' => [
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-RD2SJQH0N7'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3071331-b8b1-4eb9-becc-451a063412601',
                        'sid' => 'IRZwRzhBXQGF3071331Dnt3Rcc4PK9cMt1',
                        'auth-token' => 'KmosMrz4TeSW7.MXqqXhQKUFNUoN_LMv',
                        'campaign-id' => '14834',
                        'tag-action-tracker-id' => '27792',
                        'api-action-tracker-id' => '27793',
                        'sign-up-action-tracker-id' => ''
                    ]
            ]
        ],
        'beta-testing' => [
            'active-tracking-providers' => ['ga4', 'im'],

            'providers' => [
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-RD2SJQH0N7'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3071331-b8b1-4eb9-becc-451a063412601',
                        'sid' => 'IRZwRzhBXQGF3071331Dnt3Rcc4PK9cMt1',
                        'auth-token' => 'KmosMrz4TeSW7.MXqqXhQKUFNUoN_LMv',
                        'campaign-id' => '14834',
                        'tag-action-tracker-id' => '27792',
                        'api-action-tracker-id' => '27793',
                        'sign-up-action-tracker-id' => ''
                    ]
            ]
        ],
        'production' => [
            'active-tracking-providers' => ['gtm', 'ga4', 'im', 'ef'],

            'providers' => [
                'google-tag-manager' =>
                    [
                        'tracking-id' => 'GTM-N2HMTTQ'
                    ],
                'google-analytics-v4' =>
                    [
                        'tracking-id' => 'G-SF577RN7HF'
                    ],
                'impact' =>
                    [
                        'utt-link' => 'A3071331-b8b1-4eb9-becc-451a063412601',
                        'sid' => 'IRZwRzhBXQGF3071331Dnt3Rcc4PK9cMt1',
                        'auth-token' => 'KmosMrz4TeSW7.MXqqXhQKUFNUoN_LMv',
                        'campaign-id' => '14834',
                        'tag-action-tracker-id' => '27792',
                        'api-action-tracker-id' => '27793',
                        'sign-up-action-tracker-id' => '28353'
                    ],
                'everflow' =>
                    [
                        'base_link' => 'https://www.mcqn3fgtrk.com',
                        'nid' => '2809',
                        'verification_token' => 'LvxhwYIlQ32s7j1r2vMZTtJ0afohJz',
                        'conversion_event_id' => 1, // This comes from Brands/X/Events
                        'brand_id' => 4,
                        'sign-up-action-tracker-id' => 2
                    ]
            ]
        ]
    ],
];
