<?php

namespace Railroad\Railcontent\Commands;

use App\Entities\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Entities\Content;
use Railroad\Railcontent\Entities\UserPlaylist;
use Railroad\Railcontent\Entities\UserPlaylistContent;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistService;
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
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var ContentService
     */
    private $contentService;

    private $contentRepository;

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
        UserPlaylistService $userPlaylistService,
        UserProviderInterface $userProvider,
        ContentService $contentService
    ) {
        parent::__construct();

        $this->databaseManager = $databaseManager;

        $this->entityManager = $entityManager;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->userPlaylistService = $userPlaylistService;
        $this->userProvider = $userProvider;
        $this->contentService = $contentService;

        $this->contentRepository = $this->entityManager->getRepository(Content::class);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ContentRepository::$bypassPermissions = true;
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

        $migratedPlaylists = 0;

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

        $prepareDB = microtime(true) - $start;
        $format = "Finish DB  in total %s seconds\n";
        $this->info(sprintf($format, $prepareDB));

        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->select('id as old_id', 'brand', 'slug as type', 'user_id', 'created_on as created_at')
            ->where('type', 'user-playlist')
            ->orderBy('id', 'asc')
            ->chunk(
               100,
                function (Collection $rows) use (&$migratedPlaylists, $dbConnection) {
                    $playlistsIds =
                        $rows->pluck('old_id')
                            ->toArray();

                    $data =  json_decode(json_encode($rows), True);

                    $dbConnection->table(config('railcontent.table_prefix') . 'user_playlists')
                        ->insert($data);

                    $userPlaylistsContent =
                        $dbConnection->table(config('railcontent.table_prefix') . 'content_hierarchy')
                            ->select(['child_id as content_id', 'up.id as user_playlist_id', 'created_on as created_at'])
                            ->join(config('railcontent.table_prefix') . 'user_playlists as up', 'parent_id', '=', 'up.old_id')
                            ->whereIn('parent_id', $playlistsIds)
                            ->where('child_id', '!=', 0)
                            ->get();

                    $userPlaylistsContentData = json_decode(json_encode($userPlaylistsContent), True);

                    $dbConnection->table(config('railcontent.table_prefix') . 'user_playlist_content')
                        ->insert($userPlaylistsContentData);


//                    foreach ($rows as $row) {
//                        $playlistData = get_object_vars($row);
//                        $data[] = $playlistData;
//
//                    }

                    //                    $dbConnection->table(config('railcontent.table_prefix') . 'user_playlists')
                    //                                                            ->insert($data);

                    //dd($playlistContentdata);
                    /*
                                            $user = $this->userProvider->getUserById($playlistData['user_id']);

                                            if (!$user) {
                                                // $this->info('Not exists user with id::: '.$playlistData['user_id']);

                                            } else {
                                                //dd($this->contentService->getById(198385));
                                                //$this->info('Exists user with id::: '.$playlistData['user_id']);
                                                $playlist = new UserPlaylist();
                                                $playlist->setBrand($playlistData['brand']);
                                                $playlist->setType($playlistData['slug']);
                                                $playlist->setCreatedAt(Carbon::parse($playlistData['created_on']));

                                                $playlist->setUser($user);
                                                if (array_key_exists($row->id, $userPlaylistsContent)) {
                                                    foreach ($userPlaylistsContent[$row->id] as $userContent) {
                                                        $userContentData = get_object_vars($userContent);
                                                        $content = $this->contentRepository->find($userContentData['child_id']);

                                                        if(!is_null($content)) {
                                                            $playlistContent = new UserPlaylistContent();
                                                            $playlistContent->setContent($content);
                                                            $playlistContent->setCreatedAt(Carbon::parse($userContentData['created_on']));

                                                            $playlist->addPlaylistContent($playlistContent);
                                                        } else {
                                                            $this->info('Not found content with id::'.$userContentData['child_id']);
                                                        }
                                                    }
                                                }

                    $this->entityManager->persist($playlist);
                                                $this->info('afetr persist');


                                                //                        $data = [
                                                //                            'brand' => $row->brand,
                                                //                            'type' => $row->slug,
                                                //                            'user_id' => $row->user_id,
                                                //                            'created_at' => $row->created_on,
                                                //                        ];
                                                //                        $userPlaylistsContentArray = $userPlaylistsContent->toArray();
                                                //
                                                //                        $playlistContents = [];
                                                //                        if (array_key_exists($row->id, $userPlaylistsContentArray)) {
                                                //                            $playlistContents = $userPlaylistsContentArray[$row->id];
                                                //                        }
                                                //
                                                //                        $playlistId =
                                                //                            $dbConnection->table(config('railcontent.table_prefix') . 'user_playlists')
                                                //                                ->insertGetId($data);

                                                //                        foreach ($playlistContents as $playlistContent) {
                                                //                            $userPlaylistContentData[] = [
                                                //                                'user_playlist_id' => $playlistId,
                                                //                                'content_id' => $playlistContent->child_id,
                                                //                                'created_at' => $row->created_on,
                                                //                            ];
                                                //                        }
                                                $migratedPlaylists++;
                                            }
                                        }
                    $this->info('before flush');
                                        $this->entityManager->flush();
                                        $this->entityManager->clear();
                                        $this->info('after flush');
                    */
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
