<?php

namespace Railroad\Railcontent\Commands;

use DateTime;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;

class MigrateContentColumns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migrateContentColumns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate content columns';

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        parent::__construct();

        $this->databaseManager = $databaseManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        $this->info('Migrate columns command starting.');
        $migratedFields = 0;

        $contentColumnNames = [
            'difficulty',
            'home_staff_pick_rating',
            'qna_video',
            'title',
            'video',
            'xp',
            'album',
            'artist',
            'cd-tracks',
            'chord_or_scale',
            'difficulty_range',
            'episode_number',
            'exercise-book-pages',
            'fast_bpm',
            'includes_song',
            'live_event_start_time',
            'live_event_end_time',
            'live_event_youtube_id',
            'live_stream_feed_type',
            'name',
            'released',
            'slow_bpm',
            'transcriber_name',
            'week',
            'avatar_url',
            'length_in_seconds',
            'soundslice_slug',
            'staff_pick_rating',
            'student_id',
            'vimeo_video_id',
            'youtube_video_id',
            'show_in_new_feed',
            'bands',
            'endorsements',
            'forum_thread_id',
            'is_active',
            'is_coach',
            'is_house_coach',
            'is_coach_of_the_month',
            'is_featured',
            'associated_user_id',
            'high_soundslice_slug',
            'low_soundslice_slug',
            'high_video',
            'low_video',
            'original_video',
            'pdf',
            'pdf_in_g',
            'song_name',
            'soundslice_xml_file_url',
        ];

        $mappingColumns = [
            'cd-tracks' => 'cd_tracks',
            'exercise-book-pages' => 'exercise_book_pages',
        ];

        // fix fast_bpm and slow_bpm cases where they are strings which are not needed
        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->where('key', 'fast_bpm')
            ->where('value', 'fast')
            ->delete();
        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->where('key', 'slow_bpm')
            ->where('value', 'slow')
            ->delete();

        // fix misc use case
        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->where('id', '496893')
            ->delete();

        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select(
                'railcontent_content_fields.id',
                'railcontent_content_fields.content_id',
                'railcontent_content_fields.key',
                'railcontent_content_fields.value'
            )
            ->leftJoin('railcontent_content', 'railcontent_content.id', '=', 'railcontent_content_fields.content_id')
            ->whereNot('railcontent_content.type', 'user-playlist')
            ->whereIn('key', $contentColumnNames)
            ->whereNotNull('value')
            ->whereNotIn('value', ['Invalid date'])
            ->orderBy('content_id', 'desc')
            ->chunk(10000, function (Collection $rows) use (&$migratedFields, &$contentColumns, $mappingColumns) {
                $groupRows = $rows->groupBy('content_id');
                foreach ($groupRows as $contentId => $row) {
                    $data = [];
                    foreach ($row as $item) {
                        if (array_key_exists($item->key, $mappingColumns)) {
                            $key = $mappingColumns[$item->key];
                        } else {
                            $key = $item->key;
                        }

                        if ($item->key == 'home_staff_pick_rating' && !is_numeric($item->value)) {
                            $this->info(
                                'home_staff_pick_rating is not integer::' . $item->value . '    content id: ' . $contentId
                            );

                            continue;
                        }

                        if ($item->key == 'xp' && !is_numeric($item->value)) {
                            $this->info('xp is not integer::' . $item->value . '    content id: ' . $contentId);

                            continue;
                        }

                        if (in_array($item->key, ['live_event_start_time', 'live_event_end_time']) &&
                            !$this->validateDate($item->value)) {
                            $this->info('Skipping date: ' . $item->value . ' | value: ' . $item->value);
                            continue;
                        }

                        $data[$key] = $item->value;

                        $migratedFields++;
                    }
                    $contentColumns[$contentId] = $data;
                }
            });

        $contentIdsToUpdate = array_keys($contentColumns);

        $this->info('Updating content row count: ' . count($contentIdsToUpdate));

        $dbConnection->beginTransaction();
        foreach ($contentIdsToUpdate as $contentIdIndex => $contentId) {
            $updateArray = [];

            foreach ($contentColumnNames as $column) {
                if (!is_array($contentColumns[$contentId]) || $contentId == 0 || empty($contentColumns[$contentId])) {
                    unset($contentIdsToUpdate[$contentIdIndex]);
                    continue;
                }

                $updateArray = array_merge($updateArray, $contentColumns[$contentId]);
            }

            $dbConnection->table(config('railcontent.table_prefix') . 'content')
                ->where('id', $contentId)
                ->update($updateArray);
        }
        $dbConnection->commit();

        $this->info('Updated all content columns.');
        $this->info('Migration completed. ');
    }

    /**
     * @param $date
     * @param $format
     * @return bool
     */
    public function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) === $date;
    }

}
