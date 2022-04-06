<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class MigrateContentVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migrateVideos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate content video to the new structure';

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * MigrateContentFields constructor.
     *
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

        $this->info('Migrate videos command starting.');

        $this->migrateVideo();

        $this->info('Ending content video migration. ' );
    }
    

    /**
     * @return string|void
     */
    private function migrateVideo()
    {
        $start = microtime(true);
        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'content_fields',
                function (Blueprint $table) {
                    $table->integer('video_content_id')
                        ->nullable(true);
                }
            );

        $sqlFields = <<<'EOT'
UPDATE `%s` cs
JOIN `%s` c ON cs.`value` = c.`id`
SET cs.`video_content_id` = c.`id`
WHERE
     cs.`key` = '%s'
EOT;

        $statementF = sprintf(
            $sqlFields,
            config('railcontent.table_prefix') . 'content_fields',
            config('railcontent.table_prefix') . 'content',
            'video'
        );

        $this->databaseManager
            ->connection(config('railcontent.database_connection_name'))
            ->statement($statementF);
        $finish = microtime(true) - $start;
        $format = "Finished fields updates in %s seconds\n ";
        $this->info(sprintf($format, $finish));

        $sql = <<<'EOT'
UPDATE `%s` cs
INNER JOIN `%s` s 
ON (cs.`id` = s.`content_id` AND s.`key` = '%s' AND s.`video_content_id` IS NOT NULL)
SET cs.`video` = s.`value`
WHERE
    s.`video_content_id` IS NOT NULL
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content',
            config('railcontent.table_prefix') . 'content_fields',
            'video'
        );

        $this->databaseManager
            ->connection(config('railcontent.database_connection_name'))
            ->statement($statement);
        $finish2 = microtime(true) - $finish;
        $format = "Finished content video updates in %s seconds\n ";
        $this->info(sprintf($format, $finish2));

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'content_fields',
                function (Blueprint $table) {
                    $table->dropColumn('video_content_id');
                }
            );

        return $statement;
    }
}
