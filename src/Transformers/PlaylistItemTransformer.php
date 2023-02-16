<?php

namespace Railroad\Railcontent\Transformers;

use Railroad\Railcontent\Services\ContentService;

class PlaylistItemTransformer
{
    private $params;

    private ContentService $contentService;

    /**
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * @param $data
     * @return array
     */
    public function transform($data)
    {
        if (is_null($data) || empty($data)) {
            return [];
        }

        $fieldsColumns = config('railcontent.contentColumnNamesForFields', []);
        $associations = $this->includeAssociations();

        $results = [];

        if (!is_array($data[array_key_first($data)])) {
            $fields = [];
            foreach ($fieldsColumns as $column) {
                if ($column != 'video' && array_key_exists($column, $data) && $data[$column] != '') {
                    $fields[] = [
                        "content_id" => $data['id'],
                        "key" => $column,
                        "value" => $data[$column],
                        "type" => "string",
                        "position" => 1,
                    ];
                }
            }
            foreach ($associations['fields'] ?? [] as $value) {
                $fields = array_merge($fields, $value[$data['id']] ?? []);
            }

            $content = [
                'id' => $data['id'] ?? null,
                'slug' => $data['slug'] ?? '',
                'status' => $data['status'] ?? '',
                'sort' => $data['sort'] ?? '',
                'type' => $data['type'] ?? '',
                'fields' => $fields,
                'data' => $associations['data'][$data['id']] ?? [],
                'permissions' => $data['permissions'] ?? [],
                'published_on' => $data['published_on'] ?? null,
                'created_on' => $data['created_on'] ?? null,
                'archived_on' => $data['archived_on'] ?? null,
                'brand' => $data['brand'] ?? null,
                'language' => $data['language'] ?? null,
                'popularity' => $data['popularity'] ?? 0,
                'album' => $data['album'],
                'artist' => $data['artist'],
                'associated_user_id' => $data['associated_user_id'],
                'avatar_url' => $data['avatar_url'],
                'bands' => $data['bands'],
                'cd_tracks' => $data['cd_tracks'],
                'chord_or_scale' => $data['chord_or_scale'],
                'difficulty' => $data['difficulty'],
                'difficulty_range' => $data['difficulty_range'],
                'endorsements' => $data['endorsements'],
                'episode_number' => $data['episode_number'],
                'exercise_book_pages' => $data['exercise_book_pages'],
                'fast_bpm' => $data['fast_bpm'],
                'forum_thread_id' => $data['forum_thread_id'],
                'high_soundslice_slug' => $data['high_soundslice_slug'],
                'high_video' => $data['high_video'],
                'home_staff_pick_rating' => $data['home_staff_pick_rating'],
                'includes_song' => $data['includes_song'],
                'is_active' => $data['is_active'],
                'is_coach' => $data['is_coach'],
                'is_coach_of_the_month' => $data['is_coach_of_the_month'],
                'is_featured' => $data['is_featured'],
                'is_house_coach' => $data['is_house_coach'],
                'length_in_seconds' => $data['length_in_seconds'],
                'live_event_start_time' => $data['live_event_start_time'],
                'live_event_end_time' => $data['live_event_end_time'],
                'live_event_youtube_id' => $data['live_event_youtube_id'],
                'live_stream_feed_type' => $data['live_stream_feed_type'],
                'low_soundslice_slug' => $data['low_soundslice_slug'],
                'low_video' => $data['low_video'],
                'name' => $data['name'],
                'original_video' => $data['original_video'],
                'pdf' => $data['pdf'],
                'pdf_in_g' => $data['pdf_in_g'],
                'qna_video' => $data['qna_video'],
                'show_in_new_feed' => $data['show_in_new_feed'],
                'slow_bpm' => $data['slow_bpm'],
                'song_name' => $data['song_name'],
                'soundslice_slug' => $data['soundslice_slug'],
                'soundslice_xml_file_url' => $data['soundslice_xml_file_url'],
                'staff_pick_rating' => $data['staff_pick_rating'],
                'student_id' => $data['student_id'],
                'title' => $data['title'],
                'transcriber_name' => $data['transcriber_name'],
                'video' => $data['video'],
                'vimeo_video_id' => $data['vimeo_video_id'],
                'youtube_video_id' => $data['youtube_video_id'],
                'xp' => $data['xp'],
                'week' => $data['week'],
                'released' => $data['released'],
                'total_xp' => $data['total_xp'],
                'web_url_path' => $data['web_url_path'],
                'mobile_app_url_path' => $data['mobile_app_url_path'],
                'child_count' => $data['child_count'],
                'lesson_count' => $data['child_count'],
                'hierarchy_position_number' => $data['hierarchy_position_number'],
                'parent_content_data' => $data['parent_content_data'],
                'like_count' => $data['like_count'] ?? 0,
            ];

            if (!empty($data['child_id'])) {
                $content['child_ids'][] = $data['child_id'];
            }

            if (!empty($data['parent_id'])) {
                $content['parent_id'] = $data['parent_id'];
                $content['position'] = $data['child_position'] ?? null;
            }

            $results = $content;
        } else {
            foreach ($data as $rowIndex => $row) {
                if (is_array($row) && (isset($row['id']))) {
                    $fields = [];
                    foreach ($fieldsColumns as $column) {
                        if ($column != 'video' && array_key_exists($column, $row) && $row[$column] != '') {
                            $fields[] = [
                                "content_id" => $row['id'],
                                "key" => $column,
                                "value" => $row[$column],
                                "type" => "string",
                                "position" => 1,
                            ];
                        }
                    }

                    foreach ($associations['fields'] ?? [] as $value) {
                        $fields = array_merge($fields, $value[$row['id']] ?? []);
                    }
                    $itemId = $row['user_playlist_item_id'];
                    $content[$itemId] = [
                        'id' => $row['id'] ?? null,
                        'slug' => $row['slug'] ?? '',
                        'status' => $row['status'] ?? '',
                        'sort' => $row['sort'] ?? '',
                        'type' => $row['type'] ?? '',
                        'fields' => $fields,
                        'data' => $associations['data'][$row['id']] ?? [],
                        'permissions' => $row['permissions'] ?? [],
                        'published_on' => $row['published_on'] ?? null,
                        'created_on' => $row['created_on'] ?? null,
                        'archived_on' => $row['archived_on'] ?? null,
                        'brand' => $row['brand'] ?? null,
                        'language' => $row['language'] ?? null,
                        'parent_id' => $row['parent_id'] ?? null,
                        'popularity' => $row['popularity'] ?? 0,
                        'album' => $row['album'],
                        'artist' => $row['artist'],
                        'associated_user_id' => $row['associated_user_id'],
                        'avatar_url' => $row['avatar_url'],
                        'bands' => $row['bands'],
                        'cd_tracks' => $row['cd_tracks'],
                        'chord_or_scale' => $row['chord_or_scale'],
                        'difficulty' => $row['difficulty'],
                        'difficulty_range' => $row['difficulty_range'],
                        'endorsements' => $row['endorsements'],
                        'episode_number' => $row['episode_number'],
                        'exercise_book_pages' => $row['exercise_book_pages'],
                        'fast_bpm' => $row['fast_bpm'],
                        'forum_thread_id' => $row['forum_thread_id'],
                        'high_soundslice_slug' => $row['high_soundslice_slug'],
                        'high_video' => $row['high_video'],
                        'home_staff_pick_rating' => $row['home_staff_pick_rating'],
                        'includes_song' => $row['includes_song'],
                        'is_active' => $row['is_active'],
                        'is_coach' => $row['is_coach'],
                        'is_coach_of_the_month' => $row['is_coach_of_the_month'],
                        'is_featured' => $row['is_featured'],
                        'is_house_coach' => $row['is_house_coach'],
                        'length_in_seconds' => $row['length_in_seconds'],
                        'live_event_start_time' => $row['live_event_start_time'],
                        'live_event_end_time' => $row['live_event_end_time'],
                        'live_event_youtube_id' => $row['live_event_youtube_id'],
                        'live_stream_feed_type' => $row['live_stream_feed_type'],
                        'low_soundslice_slug' => $row['low_soundslice_slug'],
                        'low_video' => $row['low_video'],
                        'name' => $row['name'],
                        'original_video' => $row['original_video'],
                        'pdf' => $row['pdf'],
                        'pdf_in_g' => $row['pdf_in_g'],
                        'qna_video' => $row['qna_video'],
                        'show_in_new_feed' => $row['show_in_new_feed'],
                        'slow_bpm' => $row['slow_bpm'],
                        'song_name' => $row['song_name'],
                        'soundslice_slug' => $row['soundslice_slug'],
                        'soundslice_xml_file_url' => $row['soundslice_xml_file_url'],
                        'staff_pick_rating' => $row['staff_pick_rating'],
                        'student_id' => $row['student_id'],
                        'title' => $row['title'],
                        'transcriber_name' => $row['transcriber_name'],
                        'video' => $row['video'],
                        'vimeo_video_id' => $row['vimeo_video_id'],
                        'youtube_video_id' => $row['youtube_video_id'],
                        'xp' => $row['xp'],
                        'week' => $row['week'],
                        'released' => $row['released'],
                        'total_xp' => $row['total_xp'],
                        'web_url_path' => $row['web_url_path'],
                        'mobile_app_url_path' => $row['mobile_app_url_path'],
                        'child_count' => $row['child_count'],
                        'lesson_count' => $row['child_count'] ?? 0,
                        'hierarchy_position_number' => $row['hierarchy_position_number'],
                        'parent_content_data' => $row['parent_content_data'],
                        'like_count' => $row['like_count'] ?? 0,
                    ];

                    if (!empty($row['child_id'])) {
                        $content[$itemId]['child_ids'][] = $row['child_id'];
                    }

                    if (!empty($row['parent_id'])) {
                        $content[$itemId]['parent_id'] = $row['parent_id'];
                        $content[$itemId]['position'] = $row['child_position'] ?? null;
                    }
                    $content[$itemId]['start_second'] = $row['start_second'] ?? null;
                    $content[$itemId]['end_second'] = $row['end_second'] ?? null;
                    $content[$itemId]['user_playlist_item_id'] = $row['user_playlist_item_id'] ?? null;
                    $content[$itemId]['user_playlist_item_position'] = $row['user_playlist_item_position'] ?? null;
                    $content[$itemId]['user_playlist_item_extra_data'] = $row['user_playlist_item_extra_data'] ?? null;
                    if (!empty($row['user_playlist_item_extra_data'])) {
                        foreach (json_decode($row['user_playlist_item_extra_data'], true) as $key => $value) {
                            $content[$itemId][$key] = $value;
                        }
                    }

                    $route = '';

                    if(!empty($row['parent_content_data'])){
                        $parentContentData = array_reverse(json_decode($row['parent_content_data'], true));
                        $parentIds = \Arr::pluck($parentContentData,'id');
                        $parents = $this->contentService->getByIds($parentIds)->keyBy('id');
                        foreach( $parentContentData as $value){
                            switch ($value['type']) {
                                case 'learning-path':
                                    $route .= 'Method ';
                                    break;
                                case 'learning-path-level':
                                    $route .= 'L'.$value['position'].' - ';
                                    break;
                                default:
                                    $route .= $parents[$value['id']]['title'].' ' ?? '';
                                    break;
                            }
                        }
                    }
                    $content[$itemId]['route'] = $route;
                }
            }
            $results = array_values($content);
        }

        return $results;
    }

    /**
     * @return array[]
     */
    public function includeAssociations()
    {
        $association = [
            'fields' => [],
            'data' => [],
        ];

        if (!empty($this->params)) {
            foreach ($this->params as $key => $value) {
                if ($key != 'data') {
                    $association['fields'] = $association['fields'] + $this->transformField($key, $value);
                } else {
                    $association['data'] = $value;
                }
            }
        }

        return $association;
    }

    public function addParam()
    {
        $args = func_get_args();

        if (is_array($args[0])) {
            $this->params = $args[0];
        } else {
            $this->params[$args[0]] = $args[1];
        }
    }

    /**
     * @param $key
     * @param $value
     * @return array
     */
    public function transformField($key, $value)
    {
        if (empty($value)) {
            return [];
        }

        if ($key == 'data') {
            $data = [];
            foreach ($value as $val) {
                $data[] = $val;
            }

            return $data;
        }

        $field = [];
        $field[$key] = [];

        if (is_array($value)) {
            foreach ($value as $val) {
                if (($key == 'style') || ($key == 'bpm') || ($key == 'topic') || ($key == 'focus')) {
                    if (is_array($val) && !isset($val['id'])) {
                        foreach ($val as $v) {
                            $field[$key][$v['content_id']][] = [
                                'content_id' => $v['content_id'],
                                'key' => $key,
                                'position' => $v['position'] ?? 1,
                                'value' => $v['value'],
                                'type' => 'string',
                            ];
                        }
                    } else {
                        $field[$key][$val['content_id']][] = [
                            'content_id' => $val['content_id'],
                            'key' => $key,
                            'position' => $val['position'] ?? 1,
                            'value' => $val['value'],
                            'type' => 'string',
                        ];
                    }
                } else {
                    if (is_array($val) && !isset($val['id'])) {
                        foreach ($val as $v) {
                            $field[$key][$v['content_id']][] = [
                                'content_id' => $v['content_id'],
                                'key' => $key,
                                'position' => $v['position'] ?? 1,
                                'value' => $v,
                                'type' => 'content',
                            ];
                        }
                    } else {
                        $field[$key][$val['content_id']][] = [
                            'content_id' => $val['content_id'],
                            'key' => $key,
                            'position' => $val['position'] ?? 1,
                            'value' => $val,
                            'type' => 'content',
                        ];
                    }
                }
            }
        } else {
            $field[$key][$value['content_id']][] = [
                'content_id' => $value['content_id'],
                'key' => $key,
                'position' => $value['position'] ?? 1,
                'value' => $value,
                'type' => 'content',
            ];
        }

        return $field;
    }
}
