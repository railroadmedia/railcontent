<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\UserPlaylistService;

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
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * @var UserPlaylistService
     */
    private $userPlaylistService;

    /**
     * MigrateContentFields constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(
        DatabaseManager $databaseManager,
        RailcontentEntityManager $entityManager,
        ContentHierarchyService $contentHierarchyService,
        UserPlaylistService $userPlaylistService
    ) {
        parent::__construct();

        $this->databaseManager = $databaseManager;

        $this->entityManager = $entityManager;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->userPlaylistService = $userPlaylistService;
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

        $this->info(
            'Migrate user playlists command starting :::: ' .
            Carbon::now()
                ->toDateTimeString()
        );

        $migratedPlaylists = 0;

        $userPlaylistContentData = [];
        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->select('id', 'brand', 'slug', 'user_id', 'created_on')
            ->where('type', 'user-playlist')
            ->orderBy('id', 'asc')
            ->chunk(
                500,
                function (Collection $rows) use (&$migratedPlaylists, $dbConnection, &$userPlaylistContentData) {
                    $playlistsIds = $rows->pluck('id');
                    $userPlaylistsContent =
                        $dbConnection->table(config('railcontent.table_prefix') . 'content_hierarchy')
                            ->whereIn('parent_id', $playlistsIds->toArray())
                            ->get()
                            ->groupBy('parent_id');

                    foreach ($rows as $row) {
                        $data = [
                            'brand' => $row->brand,
                            'type' => $row->slug,
                            'user_id' => $row->user_id,
                            'created_at' => $row->created_on,
                        ];
                        $userPlaylistsContentArray = $userPlaylistsContent->toArray();

                        $playlistContents = [];
                        if (array_key_exists($row->id, $userPlaylistsContentArray)) {
                            $playlistContents = $userPlaylistsContentArray[$row->id];
                        }

                        $playlistId =
                            $dbConnection->table(config('railcontent.table_prefix') . 'user_playlists')
                                ->insertGetId($data);

                        foreach ($playlistContents as $playlistContent) {
                            $userPlaylistContentData[] = [
                                'user_playlist_id' => $playlistId,
                                'content_id' => $playlistContent->child_id,
                                'created_at' => $row->created_on,
                            ];
                        }
                        $migratedPlaylists++;
                    }
                }
            );

        $dbConnection->table(config('railcontent.table_prefix') . 'user_playlists')
            ->insert($userPlaylistContentData);

        $this->info(
            'Ending user playlists migration.  ' .
            Carbon::now()
                ->toDateTimeString()
        );

        $this->info('Migration completed. ' . $migratedPlaylists . ' user playlists migrated.');
    }
}
