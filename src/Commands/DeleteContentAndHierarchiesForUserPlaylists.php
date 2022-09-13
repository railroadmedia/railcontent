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
        $start = microtime(true);
        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();

        // fix invalid data if there is any left
        $this->info('Fixing any invalid content_hierarchy table data...');
        $dbConnection->table(config('railcontent.table_prefix') . 'content_hierarchy')
            ->where('created_on', '<', '2000-01-01')
            ->update(['created_on' => '2011-01-01 00:00:00']);

        $this->info('Creating temp table...');
        $dbConnection->statement("drop table if exists rch_temp;");
        $dbConnection->statement("create table rch_temp as select * from railcontent_content_hierarchy;");

        $this->info('Truncating railcontent_content_hierarchy table...');
        $dbConnection->statement("truncate table railcontent_content_hierarchy;");

        $this->info('Inserting queried data in to railcontent_content_hierarchy table...');
        $dbConnection->statement("insert into railcontent_content_hierarchy select rch_temp.* from rch_temp JOIN railcontent_content ON railcontent_content.id = rch_temp.parent_id AND railcontent_content.type != 'user-playlist';");

        $this->info('Done purging railcontent_content_hierarchy table, deleting user playlists from content table...');

        $statement = "DELETE FROM " . config('railcontent.table_prefix') . 'content';
        $statement .= " WHERE type = 'user-playlist'";

        $dbConnection->statement($statement);

        $finish = microtime(true) - $start;
        $this->info("Finished delete user playlists contents deleted in " . $finish . " seconds");

        return true;
    }
}