<?php

return [
    'v5' => [
        'events' => [
            'filter-applied',
            'filter-group-applied',
            'sorting-applied',
        ],
        'schema' => [
            'filter-applied' => [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'filters' => ['nullable', 'array'],
                'filters.*' => ['required', 'string'],
                'progress' => ['nullable', 'string']
            ],
            'filter-group-applied' => [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'group' => ['required', 'string'],
            ],
            'sorting-applied' => [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'sort' => ['required', 'string'],
            ],
        ]
    ],
];
