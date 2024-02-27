<?php

namespace Railroad\Railcontent\Services;

use DateTime;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Entities\ContentEntity;
use Railroad\Railcontent\Models\Content;
use Railroad\Railcontent\Providers\RailcontentURLProviderInterface;
use Throwable;

class RailcontentV2DataSyncingService
{
    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var RailcontentURLProviderInterface
     */
    private $railcontentURLProvider;

    /**
     * @var ContentService
     */
    private $contentService;

    private $fieldNameToContentColumnNameMap = [];
    private $fieldNameToTableMap = [];

    public function __construct(
        DatabaseManager $databaseManager,
        RailcontentURLProviderInterface $railcontentURLProvider,
        ContentService $contentService
    ) {
        $this->databaseManager = $databaseManager;
        $this->railcontentURLProvider = $railcontentURLProvider;
        $this->contentService = $contentService;

        $this->fieldNameToContentColumnNameMap = [
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
            'enrollment_start_time' => 'enrollment_start_time',
            'enrollment_end_time' => 'enrollment_end_time',
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
        ];

        $this->fieldNameToTableMap = [
            'topic' => config('railcontent.table_prefix').'content_topics',
            'tag' => config('railcontent.table_prefix').'content_tags',
            'playlist' => config('railcontent.table_prefix').'content_playlists',
            'key' => config('railcontent.table_prefix').'content_keys',
            'key_pitch_type' => config('railcontent.table_prefix').'content_key_pitch_types',
            'exercise_id' => config('railcontent.table_prefix').'content_exercises',
            'style' => config('railcontent.table_prefix').'content_styles',
            'focus' => config('railcontent.table_prefix').'content_focus',
            'bpm' => config('railcontent.table_prefix').'content_bpm',
            'instructor_id' => config('railcontent.table_prefix').'content_instructors',
            'essentials' => config('railcontent.table_prefix').'content_essentials',
            'creativity' => config('railcontent.table_prefix').'content_creativity',
            'theory' => config('railcontent.table_prefix').'content_theory',
            'lifestyle' => config('railcontent.table_prefix').'content_lifestyle',
            'gear' => config('railcontent.table_prefix').'content_gears',
        ];
    }

    /**
     * For now the fields are always the source of truth.
     *
     * @throws Throwable
     */
    public function syncContentId($contentId, $forUserId = null)
    {
        $this->syncContentIds([$contentId], $forUserId);
    }

    /**
     * For now the fields are always the source of truth.
     *
     * @throws Throwable
     */
    public function syncContentIds(array $contentIds, $forUserId = null)
    {
        $databaseConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));

        $contentRows = $databaseConnection->table(config('railcontent.table_prefix').'content')
            ->whereIn('id', $contentIds)
            ->get();

        $contentsFieldRows = $databaseConnection->table(config('railcontent.table_prefix').'content_fields')
            ->whereIn('content_id', $contentIds)
            ->whereNotNull('value')
            ->whereNotIn('value', ['Invalid date'])
            ->get()
            ->groupBy('content_id');

        $contentsHierarchyRows = $databaseConnection->table(config('railcontent.table_prefix').'content_hierarchy')
            ->whereIn('child_id', $contentIds)
            ->orWhereIn('parent_id', $contentIds)
            ->get();

        $contentsLikeCounts = $databaseConnection->table(config('railcontent.table_prefix').'content_likes')
            ->whereIn('content_id', $contentIds)
            ->selectRaw('COUNT(*) as count, content_id')
            ->groupBy(['content_id'])
            ->get()
            ->keyBy('content_id');

        $contentsLengthInSecondsFields = $databaseConnection
            ->table(config('railcontent.table_prefix').'content_fields')
            ->whereIn('content_id', $contentRows->pluck('video')->toArray())
            ->where('key', 'length_in_seconds')
            ->get()
            ->keyBy('content_id');

        // delete current field tables for content ids
        foreach ($this->fieldNameToTableMap as $fieldAndColumnName => $tableName) {
            $databaseConnection->table($tableName)
                ->where('content_id', $contentIds)
                ->delete();
        }

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

        $tableRowsToInsert = [];
        $contentsColumnsToUpdate = [];

        foreach ($contentRows as $contentRow) {
            $contentFieldRows = $contentsFieldRows[$contentRow->id] ?? [];
            $contentLengthInSecondsField = $contentsLengthInSecondsFields[$contentRow->id] ?? null;

            // fields first
            foreach ($this->fieldNameToContentColumnNameMap as $fieldName => $contentColumnName) {
                // update content columns from fields using map
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

            // urls
            $contentColumnsToUpdate['web_url_path'] = null;
            $contentColumnsToUpdate['mobile_app_url_path'] = null;

            $contentURLs =
                $this->railcontentURLProvider->getContentURLs(
                    $contentRow->id,
                    $contentRow->slug,
                    $contentRow->type,
                    new ContentEntity((array)$contentRow)
                );

            if (!empty($contentURLs)) {
                $contentColumnsToUpdate['web_url_path'] = $contentURLs->getWebURLPath();
                $contentColumnsToUpdate['mobile_app_url_path'] = $contentURLs->getMobileAppURLPath();
            }

            // child count
            $contentColumnsToUpdate['child_count'] = $contentsHierarchyRows->where('parent_id', $contentRow->id)
                ->count();

            // hierarchy position number
            $contentColumnsToUpdate['hierarchy_position_number'] =
                $contentsHierarchyRows
                    ->where('child_id', $contentRow->id)
                    ->first()
                    ->child_position ?? null;

            // like count
            $contentColumnsToUpdate['like_count'] = $contentsLikeCounts[$contentRow->id]->count ?? 0;

            // length in seconds
            if($contentRow->type !== 'assignment') {
                $contentColumnsToUpdate['length_in_seconds'] = (integer)($contentLengthInSecondsField->value ?? $contentRow->length_in_seconds ?? 0);
            }else{
                $contentColumnsToUpdate['length_in_seconds'] = $contentRow->length_in_seconds;
            }

            // update content row
            $contentColumnsToUpdate['id'] = $contentRow->id;

            $contentsColumnsToUpdate[] = $contentColumnsToUpdate;

            // update field tables
            foreach ($this->fieldNameToTableMap as $fieldAndColumnName => $tableName) {

                foreach ($contentFieldRows as $contentFieldRow) {
                    if ($contentFieldRow->key === $fieldAndColumnName ||
                        ($fieldAndColumnName === 'instructor_id' &&
                            $contentFieldRow->key === 'instructor' &&
                            is_numeric($contentFieldRow->value))) {
                        $tableRowsToInsert[$tableName][] = [
                            'content_id' => $contentRow->id,
                            $fieldAndColumnName => $contentFieldRow->value,
                            'position' => $contentFieldRow->position ?? 1,
                        ];
                    }
                }
            }
        }

        foreach ($contentsColumnsToUpdate as $contentColumnsToUpdate) {
            $databaseConnection->table('railcontent_content')
                ->where('id', $contentColumnsToUpdate['id'])
                ->update($contentColumnsToUpdate);
        }

        foreach ($tableRowsToInsert as $tableName => $rowsToInsert) {
            $databaseConnection->table($tableName)->insert($rowsToInsert);
        }

        $this->contentService->fillParentContentDataColumnForContentIds($contentIds);
    }

    /**
     * @param  string  $date
     * @param  string  $format
     * @return bool
     */
    public function validateDate(string $date, string $format = 'Y-m-d H:i:s'): bool
    {
        $d = DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) === $date;
    }
}
