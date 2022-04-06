<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Entities\Content;

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
            'legacy_id',
            'legacy_wordpress_post_id',
            'qna_video',
            'title',
            'video',
            'xp',
            'album',
            'artist',
            'bpm',
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
            'focus',
            'forum_thread_id',
            'is_active',
            'is_coach',
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
            'sbt_bpm',
            'sbt_exercise_number',
            'song_name',
            'soundslice_xml_file_url',
        ];

        $mappingColumns = [
            'cd-tracks' => 'cd_tracks',
            'exercise-book-pages' => 'exercise_book_pages',
        ];

        $dbConnection->table(config('railcontent.table_prefix').'content_fields')
            ->select('id', 'content_id', 'key', 'value')
            ->whereIn('key', $contentColumnNames)
            ->whereNotNull('value')
            ->whereNotIn('value', ['Invalid date'])
            ->orderBy('content_id', 'desc')
            ->chunk(500, function (Collection $rows) use (&$migratedFields, &$contentColumns, $mappingColumns) {
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
                                'home_staff_pick_rating is not integer::'.$item->value.'    content id: '.$contentId
                            );

                            continue;
                        }

                        if ($item->key == 'xp' && !is_numeric($item->value)) {
                            $this->info('xp is not integer::'.$item->value.'    content id: '.$contentId);

                            continue;
                        }

                        $data[$key] = $item->value;

                        $migratedFields++;
                    }
                    $contentColumns[$contentId] = $data;
                }
            });

        $contentIdsToUpdate = array_keys($contentColumns);

        foreach ($contentColumnNames as $column) {
            $total[$column] = 0;
            $query1 = ' CASE';
            $exist = false;
            foreach ($contentIdsToUpdate as $index2 => $contentId) {
                if (!is_array($contentColumns[$contentId])) {
                    $this->info($contentColumns[$contentId]);
                    continue;
                }
                if (array_key_exists($column, $contentColumns[$contentId])) {
                    $value = $contentColumns[$contentId][$column];
//                    if ($this->entityManager->getClassMetadata(Content::class)
//                            ->getTypeOfField($column) == 'integer') {
//                        $value = str_replace(',', '', $value);
//                    }

                    if ((($column == 'live_event_end_time') || ($column == 'live_event_start_time'))) {
                        $query1 .= "  WHEN id = ".
                            $contentId.
                            " THEN STR_TO_DATE(".
                            $pdo->quote($value).
                            ', \'%Y-%m-%d %H:%i:%s\')';
                    } else {
                        $query1 .= "  WHEN id = ".$contentId." THEN ".$pdo->quote($value);
                    }
                    $exist = true;
                    $total[$column]++;
                }
            }
            if ($exist) {
                $query1 .= " ELSE ".$column." = ".$column." END";

                $cq = " SET ".$column." = ".$query1;

                $statement = "UPDATE ".config('railcontent.table_prefix').'content'.$cq;
                $statement .= " WHERE id IN (".implode(",", $contentIdsToUpdate).")";

                $dbConnection->statement($statement);
            }

            $this->info('Migrated content column:'.$column.'. Total:'.$total[$column]);
        }

        $this->info('Migration completed. ');
    }
}
