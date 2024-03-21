<?php

use Illuminate\Validation\Rule;

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
                'filters' => ['nullable', 'array'],
                'filters.*' => ['required', 'string', 'regex:/([A-Z]|[a-z])\w+,([a-z]|[A-Z])\w+/'],
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
                'sort' => [
                    'required',
                    'string',
                    Rule::in(['-popularity', 'popularity', 'slug', '-slug', 'published_on', '-published_on'])
                ],
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
