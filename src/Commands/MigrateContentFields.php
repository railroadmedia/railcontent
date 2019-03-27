<?php

namespace Railroad\Railcontent\Commands;

use Doctrine\ORM\EntityManager;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Entities\Content;

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
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DatabaseManager $databaseManager, EntityManager $entityManager)
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

        $contentColumnNames =
            $this->entityManager->getClassMetadata(Content::class)
                ->getColumnNames();

        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->where('key', 'topic')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection) {
                    $data = [];
                    foreach ($rows as $row) {
                        if($row->value) {
                            $data[] = [
                                'content_id' => $row->content_id,
                                'topic' => $row->value,
                                'position' => $row->position,
                            ];
                            $migratedFields++;
                        }
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_topic')
                        ->insert($data);
                }
            );

        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->where('key', 'tag')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection) {
                    $data = [];
                    foreach ($rows as $row) {
                        if($row->value) {
                            $data[] = [
                                'content_id' => $row->content_id,
                                'tag' => $row->value,
                                'position' => $row->position,
                            ];
                            $migratedFields++;
                        }
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_tag')
                        ->insert($data);
                }
            );

        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->whereIn('key', ['sbt_bpm','sbt_exercise_number'])
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection) {
                    $data = [];
                    foreach ($rows as $row) {
                        if($row->value) {
                            $data[] = [
                                'content_id' => $row->content_id,
                                'key' => $row->key,
                                'value' => $row->value,
                                'position' => $row->position,
                            ];
                            $migratedFields++;
                        }
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_data')
                        ->insert($data);
                }
            );

        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->where('key', 'playlist')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection) {
                    $data = [];
                    foreach ($rows as $row) {
                        if($row->value) {
                            $data[] = [
                                'content_id' => $row->content_id,
                                'playlist' => $row->value,
                                'position' => $row->position,
                            ];

                            $migratedFields++;
                        }
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_playlist')
                        ->insert($data);
                }
            );

        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->where('key', 'key')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection) {
                    $data = [];
                    foreach ($rows as $row) {
                        if($row->value) {
                            $data[] = [
                                'content_id' => $row->content_id,
                                'key' => $row->value,
                                'position' => $row->position,
                            ];
                            $migratedFields++;
                        }
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_key')
                        ->insert($data);
                }
            );

        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->where('key', 'key_pitch_type')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection) {
                    $data = [];
                    foreach ($rows as $row) {
                        if($row->value) {
                            $data[] = [
                                'content_id' => $row->content_id,
                                'key_pitch_type' => $row->value,
                                'position' => $row->position,
                            ];
                            $migratedFields++;
                        }
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_key_pitch_type')
                        ->insert($data);
                }
            );

        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->where('key', 'instructor')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection) {
                    $data = [];
                    foreach ($rows as $row) {
                        if(($row->value)&&(is_numeric($row->value))) {
                            $data[] = [
                                'content_id' => $row->content_id,
                                'instructor_id' => $row->value,
                                'position' => $row->position,
                            ];
                            $migratedFields++;
                        }
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_instructor')
                        ->insert($data);
                }
            );


        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value', 'position')
            ->where('key', 'exercise_id')
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, $dbConnection) {
                    $data = [];
                    foreach ($rows as $row) {
                        if(($row->value)&&(is_numeric($row->value))) {
                            $data[] = [
                                'content_id' => $row->content_id,
                                'exercise_id' => $row->value,
                                'position' => $row->position,
                            ];
                            $migratedFields++;
                        }
                    }
                    $dbConnection->table(config('railcontent.table_prefix') . 'content_exercise')
                        ->insert($data);
                }
            );

        $contentColumns = [];
        $dbConnection->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value')
            ->whereIn('key', $contentColumnNames)
            ->where('content_id','!= ',0)
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedFields, &$contentColumns) {
                    $groupRows = $rows->groupBy('content_id');
                    foreach ($groupRows as $contentId => $row) {
                        $data = [];
                        foreach ($row as $item) {
                            $data[$item->key] = $item->value;
                            $migratedFields++;
                        }
                        $contentColumns[$contentId] = $data;
                    }
                }
            );

        $contentIdsToUpdate = array_keys($contentColumns);

        foreach ($contentColumnNames as $column) {
            $query1 = ' CASE';
            $exist = false;
            foreach ($contentIdsToUpdate as $index2 => $contentId) {
                if (array_key_exists($column, $contentColumns[$contentId])) {
                    $value = $contentColumns[$contentId][$column];
                    if($value != '') {
                        $query1 .= "  WHEN id = " . $contentId . " THEN " . $pdo->quote($value);
                        $exist = true;
                    }
                }
            }
            if ($exist) {
                $query1 .= " ELSE " . $column . " = " . $column . " END";

                $cq = " SET " . $column . " = " . $query1;

                $statement = "UPDATE " . config('railcontent.table_prefix') . 'content' . $cq;
                $statement .= " WHERE id IN (" . implode(",", $contentIdsToUpdate) . ")";

                $dbConnection->statement($statement);
            }
        }

        $this->info('Migration completed. ' . $migratedFields . ' fields migrated.');
    }
}
