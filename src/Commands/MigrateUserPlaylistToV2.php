<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateUserPlaylistToV2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateUserPlaylistToV2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate user playlists to the new v2 structure';

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * MigrateUserPlaylist constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param UserProviderInterface $userProvider
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
        //TODO :    UPDATE PLAYLIST ITEMS
        // SHOULD NOT BE INCLUDED IN CODE REVIEW
//        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
//        $dbConnection->disableQueryLog();
//        $pdo = $dbConnection->getPdo();
//        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
//
//        $start = microtime(true);
//
//        $this->info(
//            'Migrate user playlists command starting :::: '.
//            Carbon::now()
//                ->toDateTimeString()
//        );
//
//        $sql = <<<'EOT'
//UPDATE `%s` cs
//SET cs.`type` = '%s', cs.name = '%s', cs.thumbnail_url = '%s'
//
//EOT;
//
//        $statement = sprintf(
//            $sql,
//            config('railcontent.table_prefix').'user_playlists',
//            'user-playlist',
//            'My List',
//            'https://musora.com/cdn-cgi/imagedelivery/0Hon__GSkIjm-B_W77SWCA/00a9cf48-0bad-4b94-6d6a-d4aa73a63f00/public'
//        );
//        $dbConnection->statement($statement);
//
//        $finish = microtime(true) - $start;
//        $format = "Finished user playlist data migration  in total %s seconds\n ";
//        $this->info(sprintf($format, $finish));
    }
}
