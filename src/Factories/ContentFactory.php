<?php

namespace Railroad\Railcontent\Factories;

use Faker\Generator;
use Railroad\Railcontent\Helpers\ContentHelper;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ElasticService;

class ContentFactory extends ContentService
{
    /**
     * @var Generator
     */
    protected $faker;

    protected $elasticService;

    /**
     * @param  null  $slug
     * @param  null  $type
     * @param  null  $status
     * @param  null  $language
     * @param  null  $brand
     * @param  null  $userId
     * @param  null  $publishedOn
     * @param  null  $createdOn
     * @return array
     */
    public function create(
        $slug = null,
        $type = null,
        $status = null,
        $language = null,
        $brand = null,
        $userId = null,
        $publishedOn = null,
        $parentId = null,
        $sort = null,
        $slugify = null
    ) {
        $this->faker = app(Generator::class);
        $this->elasticService = app(ElasticService::class);

        $parameters =
            func_get_args() + [
                ContentHelper::slugify($this->faker->words(rand(2, 6), true)),
                $this->faker->word,
                $this->faker->randomElement(
                    [
                        ContentService::STATUS_PUBLISHED,
                        ContentService::STATUS_SCHEDULED,
                    ]
                ),
                'en-US',
                ConfigService::$brand,
                rand(),
                $this->faker->dateTimeThisCentury(),
            ];

        $content = (parent::create(...$parameters));


       // $this->elasticService->syncDocument($content['id']);

        return $content;
    }

    public function createFullQuickTip($title, $brand)
    {
        $contentRow = [
            [
                'slug' => ContentHelper::slugify($title),
                'type' => 'quick-tips',
                'sort' => 0,
                'status' => 'published',
                'brand' => $brand,
                'language' => 'en-US',
                'user_id' => null,
                'album' => null,
                'artist' => null,
                'associated_user_id' => null,
                'avatar_url' => null,
                'bands' => null,
                'cd_tracks' => null,
                'chord_or_scale' => null,
                'difficulty' => 'All',
                'difficulty_range' => null,
                'endorsements' => null,
                'episode_number' => null,
                'exercise_book_pages' => null,
                'fast_bpm' => null,
                'forum_thread_id' => null,
                'high_soundslice_slug' => null,
                'high_video' => null,
                'home_staff_pick_rating' => null,
                'includes_song' => null,
                'is_active' => null,
                'is_coach' => null,
                'is_coach_of_the_month' => null,
                'is_featured' => true,
                'is_house_coach' => null,
                'length_in_seconds' => 1094,
                'live_event_start_time' => null,
                'live_event_end_time' => null,
                'live_event_youtube_id' => null,
                'live_stream_feed_type' => null,
                'low_soundslice_slug' => null,
                'low_video' => null,
                'name' => null,
                'original_video' => null,
                'pdf' => null,
                'pdf_in_g' => null,
                'qna_video' => null,
                'show_in_new_feed' => true,
                'slow_bpm' => null,
                'song_name' => null,
                'soundslice_slug' => null,
                'soundslice_xml_file_url' => null,
                'staff_pick_rating' => null,
                'student_id' => null,
                'title' => $title,
                'transcriber_name' => null,
                'video' => 349447,
                'vimeo_video_id' => null,
                'youtube_video_id' => null,
                'xp' => 150,
                'week' => null,
                'released' => null,
                'total_xp' => null,
                'popularity' => 57,
                'web_url_path' => '/drumeo/quick-tips/12-must-know-dave-grohl-drum-beats/349360',
                'mobile_app_url_path' => '',
                'child_count' => 0,
                'hierarchy_position_number' => null,
                'parent_content_data' => null,
                'compiled_view_data' => null,
                'like_count' => '158',
                'published_on' => '2022-03-12 14:00:00',
                'created_on' => '2022-03-11 19:03:45',
                'archived_on' => null,
                'children_total_xp' => null
            ]
        ];
    }
}