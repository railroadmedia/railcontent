<?php

use Illuminate\Validation\Rule;

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
                    Rule::in(['-popularity', 'popularity', 'name', '-name', 'published_on', '-published_on'])
                ],
            ],
        ]
    ],
];
