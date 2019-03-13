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
        $this->info('Migrate fields command starting.');

        $contentColumnNames =
            $this->entityManager->getClassMetadata(Content::class)
                ->getColumnNames();

                $this->databaseManager->connection(config('railcontent.database_connection_name'))
                    ->table(config('railcontent.table_prefix') . 'content_fields')
                    ->select('id', 'content_id', 'key', 'value','position')
                    ->where('key', 'topic')
                    ->orderBy('content_id', 'desc')
                    ->chunk(
                        500,
                        function (Collection $rows) {
                            $data = [];
                            foreach($rows as $row){
                                $data[] = [
                                    'content_id' =>$row->content_id,
                                    'topic' => $row->value,
                                    'position' => $row->position
                                ];
                            }
                            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                                ->table(config('railcontent.table_prefix') . 'content_topic')
                                ->insert($data);
                        });

                $this->databaseManager->connection(config('railcontent.database_connection_name'))
                    ->table(config('railcontent.table_prefix') . 'content_fields')
                    ->select('id', 'content_id', 'key', 'value','position')
                    ->where('key', 'tag')
                    ->orderBy('content_id', 'desc')
                    ->chunk(
                        500,
                        function (Collection $rows) {
                            $data = [];
                            foreach($rows as $row){
                                $data[] = [
                                    'content_id' =>$row->content_id,
                                    'tag' => $row->value,
                                    'position' => $row->position
                                ];
                            }
                            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                                ->table(config('railcontent.table_prefix') . 'content_tag')
                                ->insert($data);
                        });

                $this->databaseManager->connection(config('railcontent.database_connection_name'))
                    ->table(config('railcontent.table_prefix') . 'content_fields')
                    ->select('id', 'content_id', 'key', 'value','position')
                    ->where('key', 'sbt_bpm')
                    ->orderBy('content_id', 'desc')
                    ->chunk(
                        500,
                        function (Collection $rows) {
                            $data = [];
                            foreach($rows as $row){
                                $data[] = [
                                    'content_id' =>$row->content_id,
                                    'sbt_bpm' => $row->value,
                                    'position' => $row->position
                                ];
                            }
                            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                                ->table(config('railcontent.table_prefix') . 'content_sbt_bpm')
                                ->insert($data);
                        });

                $this->databaseManager->connection(config('railcontent.database_connection_name'))
                    ->table(config('railcontent.table_prefix') . 'content_fields')
                    ->select('id', 'content_id', 'key', 'value','position')
                    ->where('key', 'sbt_exercise_number')
                    ->orderBy('content_id', 'desc')
                    ->chunk(
                        500,
                        function (Collection $rows) {
                            $data = [];
                            foreach($rows as $row){
                                $data[] = [
                                    'content_id' =>$row->content_id,
                                    'sbt_exercise_number' => $row->value,
                                    'position' => $row->position
                                ];
                            }
                            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                                ->table(config('railcontent.table_prefix') . 'content_sbt_exercise_number')
                                ->insert($data);
                        });

                $this->databaseManager->connection(config('railcontent.database_connection_name'))
                    ->table(config('railcontent.table_prefix') . 'content_fields')
                    ->select('id', 'content_id', 'key', 'value','position')
                    ->where('key', 'playlist')
                    ->orderBy('content_id', 'desc')
                    ->chunk(
                        500,
                        function (Collection $rows) {
                            $data = [];
                            foreach($rows as $row){
                                $data[] = [
                                    'content_id' =>$row->content_id,
                                    'playlist' => $row->value,
                                    'position' => $row->position
                                ];
                            }
                            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                                ->table(config('railcontent.table_prefix') . 'content_playlist')
                                ->insert($data);
                        });

                $this->databaseManager->connection(config('railcontent.database_connection_name'))
                    ->table(config('railcontent.table_prefix') . 'content_fields')
                    ->select('id', 'content_id', 'key', 'value','position')
                    ->where('key', 'key')
                    ->orderBy('content_id', 'desc')
                    ->chunk(
                        500,
                        function (Collection $rows) {
                            $data = [];
                            foreach($rows as $row){
                                $data[] = [
                                    'content_id' =>$row->content_id,
                                    'key' => $row->value,
                                    'position' => $row->position
                                ];
                            }
                            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                                ->table(config('railcontent.table_prefix') . 'content_key')
                                ->insert($data);
                        });

                $this->databaseManager->connection(config('railcontent.database_connection_name'))
                    ->table(config('railcontent.table_prefix') . 'content_fields')
                    ->select('id', 'content_id', 'key', 'value','position')
                    ->where('key', 'key_pitch_type')
                    ->orderBy('content_id', 'desc')
                    ->chunk(
                        500,
                        function (Collection $rows) {
                            $data = [];
                            foreach($rows as $row){
                                $data[] = [
                                    'content_id' =>$row->content_id,
                                    'key_pitch_type' => $row->value,
                                    'position' => $row->position
                                ];
                            }
                            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                                ->table(config('railcontent.table_prefix') . 'content_key_pitch_type')
                                ->insert($data);
                        });

                $this->databaseManager->connection(config('railcontent.database_connection_name'))
                    ->table(config('railcontent.table_prefix') . 'content_fields')
                    ->select('id', 'content_id', 'key', 'value','position')
                    ->where('key', 'instructor')
                    ->orderBy('content_id', 'desc')
                    ->chunk(
                        500,
                        function (Collection $rows) {
                            $data = [];
                            foreach($rows as $row){
                                $data[] = [
                                    'content_id' =>$row->content_id,
                                    'instructor_id' => $row->value,
                                    'position' => $row->position
                                ];
                            }
                            $this->databaseManager->connection(config('railcontent.database_connection_name'))
                                ->table(config('railcontent.table_prefix') . 'content_instructor')
                                ->insert($data);
                        });

        $this->databaseManager->connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'content_fields')
            ->select('id', 'content_id', 'key', 'value')
            ->whereIn('key', $contentColumnNames)
            ->orderBy('content_id', 'desc')
            ->chunk(
                500,
                function (Collection $rows) {
                    $groupRows = $rows->groupBy('content_id');
                    foreach ($groupRows as $contentId => $row) {
                        $data = [];
                        foreach ($row as $item) {
                            $data[$item->key] = $item->value;
                        }

                        $this->databaseManager->connection(config('railcontent.database_connection_name'))
                            ->table(config('railcontent.table_prefix') . 'content')
                            ->where('id', $contentId)
                            ->update(
                                $data
                            );
                    }
                }

            );

        $this->info('Migration completed.');
    }
}