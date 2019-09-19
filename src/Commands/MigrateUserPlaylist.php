<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
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

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'user_playlists',
                function (Blueprint $table) {
                    $table->integer('old_id')
                        ->nullable(true);
                }
            );

        $dbConnection->table(config('railcontent.table_prefix') . 'content_hierarchy')
            ->where('created_on', '0000-00-00 00:00:00')
            ->update(
                [
                    'created_on' => Carbon::now()
                        ->toDateTimeString(),
                ]
            );

        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->select('id as old_id', 'brand', 'slug as type', 'user_id', 'created_on as created_at')
            ->where('type', 'user-playlist')
            ->orderBy('id', 'asc')
            ->chunk(
                $chunkSize,
                function (Collection $rows) use ($dbConnection) {
                    $playlistsIds =
                        $rows->pluck('old_id')
                            ->toArray();

                    $data = json_decode(json_encode($rows), true);

                    $dbConnection->table(config('railcontent.table_prefix') . 'user_playlists')
                        ->insert($data);

                    $userPlaylistsContent =
                        $dbConnection->table(config('railcontent.table_prefix') . 'content_hierarchy')
                            ->select(
                                [
                                    'child_id as content_id',
                                    'up.id as user_playlist_id',
                                    'railcontent_content_hierarchy.created_on as created_at',
                                ]
                            )
                            ->join(
                                config('railcontent.table_prefix') . 'user_playlists as up',
                                'parent_id',
                                '=',
                                'up.old_id'
                            )
                            ->join(
                                config('railcontent.table_prefix') . 'content as content',
                                'child_id',
                                '=',
                                'content.id'
                            )
                            ->whereIn('parent_id', $playlistsIds)
                            ->where('child_id', '!=', 0)
                            ->get();

                    $userPlaylistsContentData = json_decode(json_encode($userPlaylistsContent), true);

                    $dbConnection->table(config('railcontent.table_prefix') . 'user_playlist_content')
                        ->insert($userPlaylistsContentData);
                }
            );

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(
                config('railcontent.table_prefix') . 'user_playlists',
                function (Blueprint $table) {
                    $table->dropColumn('old_id');
                }
            );

        $finish = microtime(true) - $start;
        $format = "Finished user playlist data migration  in total %s seconds\n";
        $this->info(sprintf($format, $finish));
    }
}
