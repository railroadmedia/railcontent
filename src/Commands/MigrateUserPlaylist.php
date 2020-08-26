<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Contracts\UserProviderInterface;

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
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * MigrateUserPlaylist constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param UserProviderInterface $userProvider
     */
    public function __construct(
        DatabaseManager $databaseManager,
        UserProviderInterface $userProvider
    ) {
        parent::__construct();

        $this->databaseManager = $databaseManager;
        $this->userProvider = $userProvider;
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

        $invalidUserIds = 0;
        $migrated = 0;

        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->select('id', 'brand', 'slug as type', 'user_id', 'created_on as created_at')
            ->where('type', 'user-playlist')
            ->orderBy('id', 'asc')
            ->chunk(
                $chunkSize,
                function (Collection $rows) use ($dbConnection, &$invalidUserIds, &$migrated) {

                    $playlistsIds = [];
                    $rowData = json_decode(json_encode($rows), true);

                    foreach ($rowData as $index => $row) {

                        $user = $this->userProvider->getUserById(
                            $row['user_id']
                        );

                        if (!$user) {
                            unset($rowData[$index]);
                            $this->info(
                                'Not exists user with user id::' . $row['user_id'] . ' brand:' . ucfirst($row['brand'])
                            );
                            $invalidUserIds++;
                        } else {
                            $rowData[$index]['user_id'] = $user->getId();
                            $migrated++;
                            $mapping[$row['id']] = $migrated;
                            $playlistsIds[] = $row['id'];
                        }

                        unset($rowData[$index]['id']);
                    }

                    $dbConnection->table(config('railcontent.table_prefix') . 'user_playlists')
                        ->insert($rowData);

                    $userPlaylistsContent =
                        $dbConnection->table(config('railcontent.table_prefix') . 'content_hierarchy')
                            ->select(
                                [
                                    'child_id as content_id',
                                    'parent_id as old_playlist_id',
                                    'railcontent_content_hierarchy.created_on as created_at',
                                ]
                            )
                            ->whereIn('parent_id', $playlistsIds)
                            ->where('child_id', '!=', 0)
                            ->get();

                    $playlistContents = [];
                    $userPlaylistsContentData = json_decode(json_encode($userPlaylistsContent), true);

                    foreach ($userPlaylistsContentData as $index => $playlistContent) {

                        $newUserPlaylistId = ['user_playlist_id' => $mapping[$playlistContent['old_playlist_id']]];

                        unset($playlistContent['old_playlist_id']);

                        $playlistContents[$index] = array_merge($playlistContent, $newUserPlaylistId);
                    }

                    $dbConnection->table(config('railcontent.table_prefix') . 'user_playlist_content')
                        ->insert($playlistContents);

                    $this->info('Migrated user playlists: ' . $migrated);
                }
            );

        $finish = microtime(true) - $start;
        $format =
            "Finished user playlist data migration  in total %s seconds\n Not found " . $invalidUserIds . ' users';
        $this->info(sprintf($format, $finish));
    }
}
