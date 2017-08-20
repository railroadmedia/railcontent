<?php

return [
    'cache_duration' => 60 * 60 * 24 * 30,
    'database_connection_name' => 'mysql',

    'tables' => [
        'categories' => 'railcontent_categories',
        'content' => 'railcontent_content',
        'content_categories' => 'railcontent_content_categories',
        'versions' => 'railcontent_versions',
        'fields' => 'railcontent_fields',
        'subject_fields' => 'railcontent_subject_fields',
        'data' => 'railcontent_data',
        'subject_data' => 'railcontent_subject_data',
    ],
];