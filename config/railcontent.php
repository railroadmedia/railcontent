<?php

return [
    'cache_duration' => 60 * 60 * 24 * 30,
    'database_connection_name' => 'mysql',

    'tables' => [
        'content' => 'railcontent_content',
        'versions' => 'railcontent_content_versions',
        'fields' => 'railcontent_fields',
        'content_fields' => 'railcontent_content_fields',
        'data' => 'railcontent_data',
        'content_data' => 'railcontent_content_data',
        'permissions' => 'railcontent_permissions',
        'content_permissions' => 'railcontent_content_permissions',
        'user_content' => 'railcontent_user_content',
        'playlists' => 'railcontent_playlists',
        'user_content_playlists' => 'railcontent_user_content_playlists',
        'language' => 'railcontent_language',
        'translations' => 'railcontent_translations',
        'user_language_preference' => 'railcontent_user_language_preference'

    ],
    'available_languages' => ['en','fr'],
    'default_language' => 'en'
];