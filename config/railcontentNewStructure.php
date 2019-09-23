<?php

return [

    // content columns 
    'content_columns' => [
        'title',
        'difficulty',
        'album',
        'xp',
        'fast_bpm',
        'slow_bpm',
        'home_staff_pick_rating',
        'legacy_id',
        'legacy_wordpress_post_id',
        'qna_video',
        'style',
        'artist',
        'bpm',
        'cd_tracks',
        'chord_or_scale',
        'difficulty_range',
        'episode_number',
        'exercise_book_pages',
        'includes_song',
        'instructors',
        'live_event_start_time',
        'live_event_end_time',
        'live_event_youtube_id',
        'live_stream_feed_type',
        'name',
        'released',
        'total_xp',
        'transcriber_name',
        'week',
        'avatar_url',
        'soundslice_slug',
        'staff_pick_rating',
        'student_id',
        'vimeo_video_id',
        'youtube_video_id',
        'length_in_seconds',
    ],
    'content_associations' => [
        'topic' => [
            'table' => 'railcontent_content_topic',
            'column' => 'topic',
        ],
        'tag' => [
            'table' => 'railcontent_content_tag',
            'column' => 'tag',
        ],
        'key' => [
            'table' => 'railcontent_content_key',
            'column' => 'key',
        ],
        'key_pitch_type' => [
            'table' => 'railcontent_content_key_pitch_type',
            'column' => 'key_pitch_type',
        ],
        'playlist' => [
            'table' => 'railcontent_content_playlist',
            'column' => 'playlist',
        ],
        'instructor' => [
            'table' => 'railcontent_content_instructor',
            'column' => 'instructor_id',
        ],
    ],

];

  