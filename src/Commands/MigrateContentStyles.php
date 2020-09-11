<?php

namespace Railroad\Railcontent\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Connection;
use Illuminate\Database\DatabaseManager;
use Railroad\Railcontent\Managers\RailcontentEntityManager;

class MigrateContentStyles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migrateStyles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate content styles to the new structure';

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

        $this->info('Migrate content styles command starting.');

        $this->migrateStyles($dbConnection);

        $this->info('Ending content styles migration.');

        $this->info('Migration completed. ');
    }

    /**
     * @param Connection $dbConnection
     * @return string|void
     */
    private function migrateStyles(Connection $dbConnection)
    {
        $sql = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `style`,
    `position`
)
SELECT
    c.`content_id` AS `content_id`,
    c.`value` AS `style`,
    c.`position` AS `position`
FROM `%s` c
WHERE
    c.`key` IN ('%s')
    AND  c.`value` is not null
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_styles',
            config('railcontent.table_prefix') . 'content_fields',
            'style'
        );

        $dbConnection->statement($statement);
        return $statement;
    }
}
