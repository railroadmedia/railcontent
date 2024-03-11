<?php

return [
    'v5' => [
        'events' => [
            'filter-applied',
            'filter-group-applied',
            'sorting-applied',
            'homepage-content-clicked',
            'homepage-section-see-all-clicked',
        ],
        'schema' => [
            'filter-applied' => [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'filters' => ['required', 'array'],
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
            'homepage-content-clicked' => [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'contentId' => ['required', 'int']
            ],
            'homepage-section-see-all-clicked' => [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
            ],
        ]
    ],
];
