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
        'user_content' => 'railcontent_user_content'
    ],
];