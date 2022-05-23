<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;

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
        $chunkSize = 500;

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

        $hierarchiesIds = [];
        $userPlaylistIds = [];

        $dbConnection->table(config('railcontent.table_prefix') . 'content_hierarchy as content_hierarchy')
            ->select('content_hierarchy.id', 'content_hierarchy.child_id', 'content_hierarchy.parent_id')
            ->join(
                config('railcontent.table_prefix') . 'content as content',
                'content_hierarchy.parent_id',
                'content.id'
            )
            ->where('content.type', 'user-playlist')
            ->orderBy('content_hierarchy.id','asc')
            ->chunk(
                $chunkSize,
                function (Collection $rows) use (&$hierarchiesIds, &$userPlaylistIds) {
                    foreach ($rows as $row) {
                        $hierarchiesIds[] = $row->id;
                        $userPlaylistIds[] = $row->parent_id;
                    }
                }
            );


        if (!empty($hierarchiesIds)) {
            $deletedContentHierarchyes = 0;
            foreach (array_chunk($hierarchiesIds, $chunkSize) as $chunk) {
                $statement = "DELETE FROM " . config('railcontent.table_prefix') . 'content_hierarchy';
                $statement .= " WHERE id IN (" . implode(",", $chunk) . ")";

                $dbConnection->statement($statement);
                $deletedContentHierarchyes += $chunkSize;
                $this->info(
                    'Deleted '.$deletedContentHierarchyes.' old user playlists from railcontent_content_hierarchy table:::: ' .
                    Carbon::now()
                        ->toDateTimeString()
                );
            }
        }


        $statement = "DELETE FROM " . config('railcontent.table_prefix') . 'content';
        $statement .= " WHERE type = 'user-playlist'";

        $dbConnection->statement($statement);

        $i = count($hierarchiesIds) + count($userPlaylistIds);

        $finish = microtime(true) - $start;
        $format = "Finished delete user playlists " . $i . ' contents deleted in ' . $finish . ' seconds';
        $this->info(sprintf($format, $i, $finish));
    }
}