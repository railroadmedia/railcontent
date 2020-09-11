<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;

class DeleteContentAndHierarchiesForUserPlaylists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deleteOldContentForPlaylist';

    /**
     * @var string
     */
    protected $description = 'Delete old contents and hierarchies for user playlists';

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * DeleteContentAndHierarchiesForUserPlaylists constructor.
     *
     * @param DatabaseManager $databaseManager
     */
    public function __construct(
        DatabaseManager $databaseManager
    ) {
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

        $start = microtime(true);

        $this->info(
            'Delete old user playlists command starting :::: ' .
            Carbon::now()
                ->toDateTimeString()
        );

        $sql = <<<'EOT'
DELETE FROM %s 
WHERE id IN (
SELECT
    implicitTemp.`id`  
    FROM (SELECT ch.id FROM `%s` ch 
JOIN `%s` ci on ch.`parent_id` = ci.`id`
WHERE
    ci.`type` IN ('%s')) implicitTemp
    )
EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content_hierarchy',
            config('railcontent.table_prefix') . 'content_hierarchy',
            config('railcontent.table_prefix') . 'content',
            'user-playlist'
        );

        $dbConnection->statement($statement);

        $statement = "DELETE FROM " . config('railcontent.table_prefix') . 'content';
        $statement .= " WHERE type = 'user-playlist'";

        $dbConnection->statement($statement);

        $finish = microtime(true) - $start;
        $format = 'Finished delete user playlists in ' . $finish . ' seconds';
        $this->info(sprintf($format, $finish));
    }
}
