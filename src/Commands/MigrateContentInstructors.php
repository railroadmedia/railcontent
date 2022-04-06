<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class MigrateContentInstructors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migrateInstructors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate instructors to the new structure';

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

        $this->info('Migrate instructors command starting.');

        $this->migrateInstructors($dbConnection);

        $this->info('Ending content instructors migration. ');

        $this->info('Migration completed. ');
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
JOIN `%s` ci on c.`value` = ci.`id`
WHERE
    c.`key` IN ('%s')
    AND c.`value`  REGEXP '^-?[0-9]+$'
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix').'content_instructors',
            config('railcontent.table_prefix').'content_fields',
            config('railcontent.table_prefix').'content',
            'instructor'
        );

        $dbConnection->statement($statement);

        return $statement;
    }
}
