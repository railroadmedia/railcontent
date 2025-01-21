<?php

return [
    'v5' => [
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
                    'in:' . implode(',', [
                        '-popularity',
                        'popularity',
                        'slug',
                        '-slug',
                        'published_on',
                        '-published_on',
                        'created_at',
                        '-created_at',
                        'pinned',
                        'most_recent',
                        '-progress',
                        '-last_progress'
                    ])
                ],
            ],
            'homepage-content-clicked' => [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
                'contentId' => ['sometimes', 'nullable', 'int']
            ],
            'homepage-section-see-all-clicked' => [
                'brand' => ['required', 'string'],
                'section' => ['required', 'string'],
            ],
            'recommended-content-served' => [
                'brand' => ['required', 'string'],
                'navigation_section' => ['required', 'string'],
                'recommended_content' => ['required', 'array'],
                'recommended_content.*.id' => ['required', 'integer'],
                'recommended_content.*.position' => ['required', 'integer'],
            ],
            'video-started' => [
                'brand' => ['required', 'string'],
                'content_id' => ['required', 'integer'],
                'position_seconds' => ['required', 'integer'],
                'video_player' => ['required', 'string', 'in:soundslice,youtube,vimeo'],
                'video_length_seconds' => ['required', 'integer'],
                'soundslice_slug' => ['required_if:video_player,soundslice', 'string'],
            ],
            'video-resumed' => [
                'brand' => ['required', 'string'],
                'content_id' => ['required', 'integer'],
                'position_seconds' => ['required', 'integer'],
                'video_player' => ['required', 'string', 'in:soundslice,youtube,vimeo'],
                'video_length_seconds' => ['required', 'integer'],
                'soundslice_slug' => ['required_if:video_player,soundslice', 'string'],
            ],
            'video-playing' => [
                'brand' => ['required', 'string'],
                'content_id' => ['required', 'integer'],
                'position_seconds' => ['required', 'integer'],
                'video_player' => ['required', 'string', 'in:soundslice,youtube,vimeo'],
                'video_length_seconds' => ['required', 'integer'],
                'soundslice_slug' => ['required_if:video_player,soundslice', 'string'],
            ],
            'video-paused' => [
                'brand' => ['required', 'string'],
                'content_id' => ['required', 'integer'],
                'position_seconds' => ['required', 'integer'],
                'video_player' => ['required', 'string', 'in:soundslice,youtube,vimeo'],
                'video_length_seconds' => ['required', 'integer'],
                'soundslice_slug' => ['required_if:video_player,soundslice', 'string'],
            ],
            'video-completed' => [
                'brand' => ['required', 'string'],
                'content_id' => ['required', 'integer'],
                'position_seconds' => ['required', 'integer'],
                'video_player' => ['required', 'string', 'in:soundslice,youtube,vimeo'],
                'video_length_seconds' => ['required', 'integer'],
            ],
            'content-liked' => [
                'brand' => ['required', 'string'],
                'content_id' => ['required', 'integer'],
            ],
            'content-unliked' => [
                'brand' => ['required', 'string'],
                'content_id' => ['required', 'integer'],
            ],
        ]
    ],
];
