<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateUserPlaylist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migrateUserPlaylists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate user playlists to the new structure';

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
        $chunkSize = 500;

        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        $start = microtime(true);

        $this->info(
            'Migrate user playlists command starting :::: ' .
            Carbon::now()
                ->toDateTimeString()
        );

        // this allows the command to run after if fails once
        $this->info('Setting old ID column on user_playlists table.');
        if (Schema::connection(config('railcontent.database_connection_name'))
            ->hasColumn(config('railcontent.table_prefix') . 'user_playlists', 'old_id')) {
            $dbConnection->table(config('railcontent.table_prefix') . 'user_playlists')
                ->update(['old_id' => null]);
        } else {
            Schema::connection(config('railcontent.database_connection_name'))
                ->table(config('railcontent.table_prefix') . 'user_playlists', function (Blueprint $table) {
                    $table->integer('old_id')
                        ->nullable(true);
                });
        }

        // fix up invalid date time error
        $this->info('Cleaning up invalid date data on RC tables...');
        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->where('created_on', '<', '2000-01-01')
            ->update(['created_on' => '2011-01-01 00:00:00']);

        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->where('published_on', '<', '2000-01-01')
            ->update(['published_on' => '2011-01-01 00:00:00']);

        $dbConnection->table(config('railcontent.table_prefix') . 'content_hierarchy')
            ->where('created_on', '<', '2000-01-01')
            ->update(['created_on' => '2011-01-01 00:00:00']);

        $sql = <<<'EOT'
INSERT INTO %s (
    `brand`,
    `type`,
    `user_id`,
     `old_id`,
    `created_at`
)
SELECT
    c.`brand` AS `brand`,
    c.`slug` AS `type`,
    c.`user_id` AS `user_id`,
    c.`id` AS `old_id`,
    c.`created_on` AS `created_at`
FROM `%s` c
WHERE
    c.`type` IN ('%s')
EOT;

        $this->info('Inserting content rows in to user_playlists table...');

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'user_playlists',
            config('railcontent.table_prefix') . 'content',
            'user-playlist'
        );

        $dbConnection->statement($statement);

        $sql2 = <<<'EOT'
INSERT INTO %s (
    `content_id`,
    `user_playlist_id`,
    `created_at`
)
SELECT
    c.`child_id` AS `content_id`,
    p.`id` AS `user_playlist_id`,
    c.`created_on` AS `created_at`
FROM `%s` c
JOIN `%s` p
    ON c.`parent_id` = p.`old_id`
EOT;

        $this->info('Inserting link rows in to user_playlist_content table...');
        $statement2 = sprintf(
            $sql2,
            config('railcontent.table_prefix') . 'user_playlist_content',
            config('railcontent.table_prefix') . 'content_hierarchy',
            config('railcontent.table_prefix') . 'user_playlists'
        );

        $dbConnection->statement($statement2);

        $finish = microtime(true) - $start;
        $format = "Finished user playlist data migration  in total %s seconds\n ";
        $this->info(sprintf($format, $finish));

        $this->info('Dropping temp column from user_playlists...');

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'user_playlists', function (Blueprint $table) {
                $table->dropColumn('old_id');
            });
    }
}
