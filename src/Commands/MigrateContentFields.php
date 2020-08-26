<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class MigrateContentFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migrateFields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate content fields to the new structure';

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * MigrateContentFields constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(DatabaseManager $databaseManager, RailcontentEntityManager $entityManager)
    {
        parent::__construct();

        $this->databaseManager = $databaseManager;

        $this->entityManager = $entityManager;
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

        $this->info('Migrate fields command starting.');
        $migratedFields = 0;

        $contentColumnNames = array_merge(
            $this->entityManager->getClassMetadata(Content::class)
                ->getColumnNames(),
            ['cd-tracks', 'exercise-book-pages']
        );

        $this->migrateTopics($dbConnection);

        $this->info('Ending content topics migration. ');

        $this->migrateTags($dbConnection);

        $this->info('Ending content tags migration.');

        $this->migrateSBTFields($dbConnection);

        $this->info('Ending content sbt_bpm and sbt_exercise_number migration. ');

        $playlistFields = 0;
        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->where('key', 'playlist')
            ->whereNotNull('value')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection, &$playlistFields) {
                    $data = [];
                    foreach ($rows as $row) {
                        $data[] = [
                            'content_id' => $row->content_id,
                            'playlist' => $row->value,
                            'position' => $row->position,
                        ];

                        $migratedFields++;
                        $playlistFields++;
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_playlist')
                        ->insert($data);
                }
            );

        $this->info('Ending content playlists migration. Migrated - ' . $playlistFields);

        $keyFields = 0;
        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->where('key', 'key')
            ->whereNotNull('value')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection, &$keyFields) {
                    $data = [];
                    foreach ($rows as $row) {
                        $data[] = [
                            'content_id' => $row->content_id,
                            'key' => $row->value,
                            'position' => $row->position,
                        ];
                        $migratedFields++;
                        $keyFields++;
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_key')
                        ->insert($data);
                }
            );

        $this->info('Ending content keys migration. Migrated - ' . $keyFields);

        $keyPitchTypeFields = 0;
        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->where('key', 'key_pitch_type')
            ->whereNotNull('value')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection, &$keyPitchTypeFields) {
                    $data = [];
                    foreach ($rows as $row) {
                        $data[] = [
                            'content_id' => $row->content_id,
                            'key_pitch_type' => $row->value,
                            'position' => $row->position,
                        ];
                        $migratedFields++;
                        $keyPitchTypeFields++;
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_key_pitch_type')
                        ->insert($data);
                }
            );

        $this->info('Ending content key pitch types migration. Migrated - ' . $keyPitchTypeFields);

        $this->migrateInstructors($dbConnection);

        $this->info('Ending content instructors migration. ');

        $exercise = 0;
        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('content_id', 'key', 'value', 'position')
            ->join(
                config('railcontent.table_prefix') . 'content',
                config('railcontent.table_prefix') . 'content_fields' . '.value',
                config('railcontent.table_prefix') . 'content.id'
            )
            ->where('key', 'exercise_id')
            ->whereNotNull('value')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection, &$exercise) {
                    $data = [];
                    foreach ($rows as $row) {
                        if ((is_numeric($row->value))) {
                            $data[] = [
                                'content_id' => $row->content_id,
                                'exercise_id' => $row->value,
                                'position' => $row->position,
                            ];
                            $migratedFields++;
                            $exercise++;
                        }
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_exercise')
                        ->insert($data);
                }
            );
        $this->info('Ending content exercise migration. Migrated - ' . $exercise);

        $video = 0;
        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('content_id', 'key', 'value', 'position')
            ->join(
                config('railcontent.table_prefix') . 'content',
                config('railcontent.table_prefix') . 'content_fields' . '.value',
                config('railcontent.table_prefix') . 'content.id'
            )
            ->where('key', 'video')
            ->whereNotNull('value')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection, &$video) {
                    foreach ($rows as $row) {
                        $cq = " SET video = " . $row->value;

                        $statement = "UPDATE " . config('railcontent.table_prefix') . 'content' . $cq;
                        $statement .= " WHERE id =" . $row->content_id;

                        $dbConnection->statement($statement);
                        $video++;
                    }
                }
            );
        $this->info('Ending content video migration. Migrated - ' . $video);

        $specialColumns = [
            'id',
            'slug',
            'type',
            'sort',
            'status',
            'brand',
            'language',
            'user_id',
            'published_on',
            'archived_on',
            'created_on',
            'total_xp',
        ];

        $contentColumnNames = array_diff($contentColumnNames, $specialColumns);

        $mappingColumns = [
            'cd-tracks' => 'cd_tracks',
            'exercise-book-pages' => 'exercise_book_pages',
        ];

        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value')
            ->whereIn('key', $contentColumnNames)
            ->whereNotNull('value')
            ->whereNotIn('value', ['Invalid date'])
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, &$contentColumns, $mappingColumns) {
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
                                    'home_staff_pick_rating is not integer::' .
                                    $item->value .
                                    '    content id: ' .
                                    $contentId
                                );

                                continue;
                            }

                            if ($item->key == 'xp' && !is_numeric($item->value)) {
                                $this->info('xp is not integer::' . $item->value . '    content id: ' . $contentId);

                                continue;
                            }

                            $data[$key] = $item->value;

                            $migratedFields++;
                        }
                        $contentColumns[$contentId] = $data;
                    }
                }
            );

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
                    if ($this->entityManager->getClassMetadata(Content::class)
                            ->getTypeOfField($column) == 'integer') {
                        $value = str_replace(',', '', $value);
                    }

                    if ((($column == 'live_event_end_time') || ($column == 'live_event_start_time'))) {
                        $query1 .= "  WHEN id = " .
                            $contentId .
                            " THEN STR_TO_DATE(" .
                            $pdo->quote($value) .
                            ', \'%Y-%m-%d %H:%i:%s\')';
                    } else {
                        $query1 .= "  WHEN id = " . $contentId . " THEN " . $pdo->quote($value);
                    }
                    $exist = true;
                    $total[$column]++;
                }
            }
            if ($exist) {
                $query1 .= " ELSE " . $column . " = " . $column . " END";

                $cq = " SET " . $column . " = " . $query1;

                $statement = "UPDATE " . config('railcontent.table_prefix') . 'content' . $cq;
                $statement .= " WHERE id IN (" . implode(",", $contentIdsToUpdate) . ")";

                $dbConnection->statement($statement);

            }

            $this->info('Migrated content column:' . $column . '. Total:' . $total[$column]);
        }

        $this->info('Migration completed. ' . $migratedFields . ' fields migrated.');
    }

    /**
     * @param \Illuminate\Database\Connection $dbConnection
     * @return string|void
     */
    private function migrateInstructors(\Illuminate\Database\Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `instructor_id`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `instructor_id`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_instructor',
            config('railcontent.table_prefix') . 'content_fields',
            'instructor'
        );

        $dbConnection->statement($statement);
        return $statement;
    }

    /**
     * @param \Illuminate\Database\Connection $dbConnection
     * @return string|void
     */
    private function migrateTopics(\Illuminate\Database\Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `topic`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `topic`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_topic',
            config('railcontent.table_prefix') . 'content_fields',
            'topic'
        );

        $dbConnection->statement($statement);
        return $statement;
    }

    /**
     * @param \Illuminate\Database\Connection $dbConnection
     * @return string|void
     */
    private function migrateTags(\Illuminate\Database\Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `tag`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `tag`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_tag',
            config('railcontent.table_prefix') . 'content_fields',
            'tag'
        );

        $dbConnection->statement($statement);
        return $statement;
    }

    /**
     * @param \Illuminate\Database\Connection $dbConnection
     * @return string|void
     */
    private function migrateSBTFields(\Illuminate\Database\Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `value`,
    `key`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `tag`,
    c.`key` AS `key`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_data',
            config('railcontent.table_prefix') . 'content_fields',
            implode(", ", ['sbt_bpm', 'sbt_exercise_number'])
        );

        $dbConnection->statement($statement);
        return $statement;
    }
}
