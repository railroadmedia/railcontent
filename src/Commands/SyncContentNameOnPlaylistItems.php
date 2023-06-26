<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class SyncContentNameOnPlaylistItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SyncContentNameOnPlaylistItems {startingUserId=0} {endingUserId=9999999} {playlistId=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync playlist items content name';

    private DatabaseManager $databaseManager;

    /**
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
            'Migrate command starting :::: '.
            Carbon::now()
                ->toDateTimeString()
        );



        $sqlFields = <<<'EOT'
UPDATE `%s` cs
JOIN `%s` c ON cs.`content_id` = c.`id`
SET cs.`content_name` = c.`title`

EOT;

        $statementF = sprintf(
            $sqlFields,
            config('railcontent.table_prefix').'user_playlist_content',
            config('railcontent.table_prefix').'content'
        );

        $dbConnection
            ->statement($statementF);



        $finish = microtime(true) - $start;
        $format = "Finished user playlist name migration in total %s seconds\n ";
        $this->info(sprintf($format,  $finish));
    }

}
