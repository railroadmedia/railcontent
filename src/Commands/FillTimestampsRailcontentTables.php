<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class FillTimestampsRailcontentTables extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:FillTimestampsRailcontentTables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill with today date the timestamps from the given tables';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $tablesToUpdate = [
            'content_focus',
            'content_bpm',
            'content_keys',
            'content_key_pitch_types',
            'content_topics',
            'content_styles',
            'content_playlists',
            'content_instructors',
            'content_exercises',
            'content_tags',
            'content_fields',
            'content_data'
        ];

        $this->info(sprintf("####### Start command FillTimestampsRailcontentTables #######"));

        $dbConnection = $databaseManager->connection(config('railcontent.database_connection_name'));

        foreach ($tablesToUpdate as $table) {
            $dbConnection->table(config('railcontent.table_prefix') . $table)
                ->update([
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
        }

        $this->info(sprintf("####### Finished filling railcontent tables with today's datetime. #######"));
    }

}