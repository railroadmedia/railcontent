<?php

return [
    'drumeo' => [
        'get_stream_credentials' => [
            'key' => env('DRUMEO_STREAM_API_KEY'),
            'secret' => env('DRUMEO_STREAM_APP_SECRET'),
        ],

        'chat_channel_name' => 'drumeo_messages',
        'questions_channel_name' => 'drumeo_questions',

        'channel_founder' => [
            'id' => '150259',
            'displayName' => 'bogdan.d',
            'avatarUrl' => 'https://d2vyvo0tyx8ig5.cloudfront.net/avatars/150259_1557736362228.jpg',
            'profileUrl' => 'https://dev.drumeo.com/laravel/public/members/profile/150259',
            'role' => 'admin',
        ],

        'embed_url' => 'https://www.musora.com/drumeo/live-chat',

        // https://getstream.io/chat/docs/query_channels/?language=php
        'channels_list' => [
            'filter' => new \stdClass(),
            // if no filter is specified, API requires an empty JSON object, empty array is not supported
            'sort' => [],
            'options' => [
                'state' => false,
                'message_limit' => 0,
                'member_limit' => 0,
            ],
        ],

        'route_prefix' => 'chat',
        'route_middleware_logged_in_groups' => ['web_authenticated'],

        'app_route_prefix' => 'api/chat',
        'app_route_middleware_logged_in_groups' => ['api_authenticated'],

        // permissions
        'role_abilities' => [
            'administrator' => [
                'chat.ban_user',
                'chat.unban_user',
                'chat.delete_user_messages',
            ],
            'live_chat_moderator' => [
                'chat.ban_user',
                'chat.unban_user',
                'chat.delete_user_messages',
            ],
        ],
    ],
    'pianote' => [
        'get_stream_credentials' => [
            'key' => env('PIANOTE_STREAM_API_KEY'),
            'secret' => env('PIANOTE_STREAM_APP_SECRET'),
        ],

        'chat_channel_name' => 'pianote_messages',
        'questions_channel_name' => 'pianote_questions',

        'channel_founder' => [
            'id' => '150259',
            'displayName' => 'bogdan.d',
            'avatarUrl' => 'https://d2vyvo0tyx8ig5.cloudfront.net/avatars/150259_1557736362228.jpg',
            'profileUrl' => 'https://dev.drumeo.com/laravel/public/members/profile/150259',
            'role' => 'admin',
        ],

        'embed_url' => 'https://www.musora.com/pianote/live-chat',

        // https://getstream.io/chat/docs/query_channels/?language=php
        'channels_list' => [
            'filter' => new \stdClass(),
            // if no filter is specified, API requires an empty JSON object, empty array is not supported
            'sort' => [],
            'options' => [
                'state' => false,
                'message_limit' => 0,
                'member_limit' => 0,
            ],
        ],

        'route_prefix' => 'chat',
        'route_middleware_logged_in_groups' => ['web_authenticated'],

        'app_route_prefix' => 'api/chat',
        'app_route_middleware_logged_in_groups' => ['api_authenticated'],

        // permissions
        'role_abilities' => [
            'administrator' => [
                'chat.ban_user',
                'chat.unban_user',
                'chat.delete_user_messages',
            ],
            'live_chat_moderator' => [
                'chat.ban_user',
                'chat.unban_user',
                'chat.delete_user_messages',
            ],
        ],
    ],
    'guitareo' => [
        'get_stream_credentials' => [
            'key' => env('GUITAREO_STREAM_API_KEY'),
            'secret' => env('GUITAREO_STREAM_APP_SECRET'),
        ],

        'chat_channel_name' => 'guitareo_messages',
        'questions_channel_name' => 'guitareo_questions',

        'channel_founder' => [
            'id' => '150259',
            'displayName' => 'bogdan.d',
            'avatarUrl' => 'https://d2vyvo0tyx8ig5.cloudfront.net/avatars/150259_1557736362228.jpg',
            'profileUrl' => 'https://dev.drumeo.com/laravel/public/members/profile/150259',
            'role' => 'admin',
        ],

        'embed_url' => 'https://www.musora.com/guitareo/live-chat',

        // https://getstream.io/chat/docs/query_channels/?language=php
        'channels_list' => [
            'filter' => new \stdClass(),
            // if no filter is specified, API requires an empty JSON object, empty array is not supported
            'sort' => [],
            'options' => [
                'state' => false,
                'message_limit' => 0,
                'member_limit' => 0,
            ],
        ],

        'route_prefix' => 'chat',
        'route_middleware_logged_in_groups' => ['web_authenticated'],

        'app_route_prefix' => 'api/chat',
        'app_route_middleware_logged_in_groups' => ['api_authenticated'],

        // permissions
        'role_abilities' => [
            'administrator' => [
                'chat.ban_user',
                'chat.unban_user',
                'chat.delete_user_messages',
            ],
            'live_chat_moderator' => [
                'chat.ban_user',
                'chat.unban_user',
                'chat.delete_user_messages',
            ],
        ],
    ],
    'singeo' => [
        'get_stream_credentials' => [
            'key' => env('SINGEO_STREAM_API_KEY'),
            'secret' => env('SINGEO_STREAM_APP_SECRET'),
        ],

        'chat_channel_name' => 'singeo_messages',
        'questions_channel_name' => 'singeo_questions',

        'channel_founder' => [
            'id' => '150259',
            'displayName' => 'bogdan.d',
            'avatarUrl' => 'https://d2vyvo0tyx8ig5.cloudfront.net/avatars/150259_1557736362228.jpg',
            'profileUrl' => 'https://dev.drumeo.com/laravel/public/members/profile/150259',
            'role' => 'admin',
        ],

        'embed_url' => 'https://www.musora.com/singeo/live-chat',

        // https://getstream.io/chat/docs/query_channels/?language=php
        'channels_list' => [
            'filter' => new \stdClass(),
            // if no filter is specified, API requires an empty JSON object, empty array is not supported
            'sort' => [],
            'options' => [
                'state' => false,
                'message_limit' => 0,
                'member_limit' => 0,
            ],
        ],

        'route_prefix' => 'chat',
        'route_middleware_logged_in_groups' => ['web_authenticated'],

        'app_route_prefix' => 'api/chat',
        'app_route_middleware_logged_in_groups' => ['api_authenticated'],

        // permissions
        'role_abilities' => [
            'administrator' => [
                'chat.ban_user',
                'chat.unban_user',
                'chat.delete_user_messages',
            ],
            'live_chat_moderator' => [
                'chat.ban_user',
                'chat.unban_user',
                'chat.delete_user_messages',
            ],
        ],
    ]
];
