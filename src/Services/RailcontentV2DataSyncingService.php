<?php

namespace Railroad\Railcontent\Services;

use DateTime;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Providers\RailcontentURLProviderInterface;
use Throwable;

class RailcontentV2DataSyncingService
{
    private DatabaseManager $databaseManager;
    private RailcontentURLProviderInterface $railcontentURLProvider;
    private ContentService $contentService;

    public function __construct(
        DatabaseManager $databaseManager,
        RailcontentURLProviderInterface $railcontentURLProvider,
        ContentService $contentService
    ) {
        $this->databaseManager = $databaseManager;
        $this->railcontentURLProvider = $railcontentURLProvider;
        $this->contentService = $contentService;
    }

    /**
     * For now the fields are always the source of truth.
     *
     * @throws Throwable
     */
    public function syncContentId($contentId, $forUserId = null)
    {
        $databaseConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));

        $contentRow = $databaseConnection->table(config('railcontent.table_prefix') . 'content')
            ->where('id', $contentId)
            ->first();

        // update content hierarchy rows
        if (!empty($forUserId)) {
            // --- content hierarchy rows to sync:
            // current_child_content_id
            // current_child_content_index
            // current_child_content_url
            // next_child_content_id
            // next_child_content_index
            // next_child_content_url
        }

        // update content row
        $contentFieldRows = $databaseConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->where('content_id', $contentId)
            ->whereNotNull('value')
            ->whereNotIn('value', ['Invalid date'])
            ->get();

        // fields first
        $fieldNameToContentColumnNameMap = [
            'album' => 'album',
            'artist' => 'artist',
            'associated_user_id' => 'associated_user_id',
            'avatar_url' => 'avatar_url',
            'bands' => 'bands',
            'cd-tracks' => 'cd_tracks', // dashes
            'chord_or_scale' => 'chord_or_scale',
            'difficulty' => 'difficulty',
            'difficulty_range' => 'difficulty_range',
            'endorsements' => 'endorsements',
            'episode_number' => 'episode_number',
            'exercise-book-pages' => 'exercise_book_pages', // dashes
            'fast_bpm' => 'fast_bpm',
            'forum_thread_id' => 'forum_thread_id',
            'high_soundslice_slug' => 'high_soundslice_slug',
            'high_video' => 'high_video',
            'home_staff_pick_rating' => 'home_staff_pick_rating',
            'includes_song' => 'includes_song',
            'is_active' => 'is_active',
            'is_coach' => 'is_coach',
            'is_coach_of_the_month' => 'is_coach_of_the_month',
            'is_featured' => 'is_featured',
            'is_house_coach' => 'is_house_coach',
            'length_in_seconds' => 'length_in_seconds',
            'live_event_start_time' => 'live_event_start_time',
            'live_event_end_time' => 'live_event_end_time',
            'live_event_youtube_id' => 'live_event_youtube_id',
            'live_stream_feed_type' => 'live_stream_feed_type',
            'low_soundslice_slug' => 'low_soundslice_slug',
            'low_video' => 'low_video',
            'name' => 'name',
            'original_video' => 'original_video',
            'pdf' => 'pdf',
            'pdf_in_g' => 'pdf_in_g',
            'qna_video' => 'qna_video',
            'show_in_new_feed' => 'show_in_new_feed',
            'slow_bpm' => 'slow_bpm',
            'song_name' => 'song_name',
            'soundslice_slug' => 'soundslice_slug',
            'soundslice_xml_file_url' => 'soundslice_xml_file_url',
            'staff_pick_rating' => 'staff_pick_rating',
            'student_id' => 'student_id',
            'title' => 'title',
            'transcriber_name' => 'transcriber_name',
            'video' => 'video',
            'vimeo_video_id' => 'vimeo_video_id',
            'youtube_video_id' => 'youtube_video_id',
            'xp' => 'xp',
            'week' => 'week',
            'released' => 'released',
            'total_xp' => 'total_xp',
        ];

        $contentColumnsToUpdate = [];

        foreach ($fieldNameToContentColumnNameMap as $fieldName => $contentColumnName) {
            $contentColumnsToUpdate[$contentColumnName] = null;

            foreach ($contentFieldRows as $contentFieldRow) {
                // skip misc data errors
                if (($contentFieldRow->key == 'home_staff_pick_rating' && !is_numeric($contentFieldRow->value)) ||
                    ($contentFieldRow->key == 'xp' && !is_numeric($contentFieldRow->value)) ||
                    (in_array($contentFieldRow->key, ['live_event_start_time', 'live_event_end_time']) &&
                        !$this->validateDate($contentFieldRow->value))) {
                    continue;
                }

                if ($contentFieldRow->key === $fieldName) {
                    $contentColumnsToUpdate[$contentColumnName] = $contentFieldRow->value;
                }
            }
        }


        // other columns
        // 'web_url_path' => 'web_url_path' // implemented on implementation side using interface binding
        // 'mobile_url_path' => 'mobile_url_path' // implemented on implementation side using interface binding
        // 'child_count' => 'child_count'
        // 'hierarchy_position_number' => 'hierarchy_position_number'
        // 'like_count' => 'like_count'
        // 'length_in_seconds' => 'length_in_seconds'

        $contentColumnsToUpdate['web_url_path'] = null;
        $contentColumnsToUpdate['mobile_app_url_path'] = null;

        $contentURLs = $this->railcontentURLProvider->getContentURLs($contentId, $contentRow->slug, $contentRow->type);

        if (!empty($contentURLs)) {
            $contentColumnsToUpdate['web_url_path'] = $contentURLs->getWebURLPath();
            $contentColumnsToUpdate['mobile_app_url_path'] = $contentURLs->getMobileAppURLPath();
        }

        $contentHierarchyRows = $databaseConnection->table(config('railcontent.table_prefix') . 'content_hierarchy')
            ->where('child_id', $contentId)
            ->orWhere('parent_id', $contentId)
            ->get();

        $contentColumnsToUpdate['child_count'] = $contentHierarchyRows->where('parent_id', $contentId)->count();

        $contentColumnsToUpdate['hierarchy_position_number'] =
            $contentHierarchyRows
                ->where('child_id', $contentId)
                ->first()
                ->child_position ?? null;

        $contentColumnsToUpdate['like_count'] =
            $databaseConnection->table(config('railcontent.table_prefix') . 'content_likes')
                ->where('content_id', $contentId)
                ->count();

        // length_in_seconds
        if (!empty($contentRow->video)) {
            $lengthInSecondsFieldValue = $databaseConnection
                    ->table(config('railcontent.table_prefix') . 'content_fields')
                    ->where('content_id', $contentRow->video)
                    ->where('key', 'length_in_seconds')
                    ->first()
                    ->value ?? 0;

            $contentColumnsToUpdate['length_in_seconds'] = (integer) $lengthInSecondsFieldValue;
        }

        $databaseConnection->table(config('railcontent.table_prefix') . 'content')
            ->where('id', $contentId)
            ->update($contentColumnsToUpdate);

        // update field tables
        $fieldNameToTableMap = [
            'topic' => config('railcontent.table_prefix') . 'content_topics',
            'tag' => config('railcontent.table_prefix') . 'content_tags',
            'playlist' => config('railcontent.table_prefix') . 'content_playlists',
            'key' => config('railcontent.table_prefix') . 'content_keys',
            'key_pitch_type' => config('railcontent.table_prefix') . 'content_key_pitch_types',
            'exercise_id' => config('railcontent.table_prefix') . 'content_exercises',
            'style' => config('railcontent.table_prefix') . 'content_styles',
            'focus' => config('railcontent.table_prefix') . 'content_focus',
            'bpm' => config('railcontent.table_prefix') . 'content_bpm',
            'instructor_id' => config('railcontent.table_prefix') . 'content_instructors',
        ];

        foreach ($fieldNameToTableMap as $fieldAndColumnName => $tableName) {
            $rowsToInsert = [];

            foreach ($contentFieldRows as $contentFieldRow) {
                if ($contentFieldRow->key === $fieldAndColumnName ||
                    ($fieldAndColumnName === 'instructor_id' && $contentFieldRow->key === 'instructor')) {
                    $rowsToInsert[] = [
                        'content_id' => $contentId,
                        $fieldAndColumnName => $contentFieldRow->value,
                        'position' => $contentFieldRow->position,
                    ];
                }
            }

            $databaseConnection->beginTransaction();
            $databaseConnection->table($tableName)
                ->where('content_id', $contentId)
                ->delete();
            $databaseConnection->table($tableName)->insert($rowsToInsert);
            $databaseConnection->commit();
        }

        $this->contentService->fillParentContentDataColumnForContentIds([$contentId]);
    }

    /**
     * @param string $date
     * @param string $format
     * @return bool
     */
    public function validateDate(string $date, string $format = 'Y-m-d H:i:s'): bool
    {
        $d = DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) === $date;
    }
}
