<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Elastica\Document;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Services\ElasticService;

class MigrateContentToElasticsearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:MigrateContentToElasticsearch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate contents and user progress to Elasticsearch';

    /**
     * @var DatabaseManager
     */
    private $databaseManager;

    /**
     * @var ElasticService
     */
    private $elasticService;

    /**
     * MigrateContentToElasticsearch constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param ElasticService $elasticService
     */
    public function __construct(
        DatabaseManager $databaseManager,
        ElasticService $elasticService
    ) {
        parent::__construct();

        $this->databaseManager = $databaseManager;

        $this->elasticService = $elasticService;
    }

    public function handle()
    {
        $this->info('Starting MigrateContentToElasticsearch.');

        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        $client = $this->elasticService->getClient();

        //Delete index if exists
        if ($client->indices()
            ->exists(['index' => 'content'])) {

            $client->indices()
                ->delete(['index' => 'content']);
        }

        // Create the index
       $this->elasticService->createContentIndex();

        $nr = 0;
        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->select('*')
            ->whereNotIn('type', ['assignment', 'exercise', 'vimeo-video', 'youtube-video'])
            ->orderBy('id', 'asc')
            ->chunk(
                500,
                function (Collection $rows) use ($dbConnection, $client, &$nr) {
                    $elasticBulk = [];
                    foreach ($rows as $row) {
                        $nr++;

                        $topics =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_topics')
                                ->select('topic')
                                ->where('content_id', $row->id)
                                ->orderBy('id', 'asc')
                                ->get();

                        $tags =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_tags')
                                ->select('tag')
                                ->where('content_id', $row->id)
                                ->orderBy('id', 'asc')
                                ->get();

                        $allProgressCount =
                            $dbConnection->table(config('railcontent.table_prefix') . 'user_content_progress')
                                ->where('content_id', $row->id)
                                ->count();

                        $lastWeekProgressCount =
                            $dbConnection->table(config('railcontent.table_prefix') . 'user_content_progress')
                                ->where('content_id', $row->id)
                                ->where(
                                    'updated_on',
                                    '>=',
                                    Carbon::now()
                                        ->subWeek(1)
                                )
                                ->count();

                        $parent =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_hierarchy')
                                ->join(
                                    config('railcontent.table_prefix') . 'content',
                                    config('railcontent.table_prefix') . 'content_hierarchy.parent_id',
                                    '=',
                                    config('railcontent.table_prefix') . 'content.id'
                                )
                                ->where('child_id', $row->id)
                                ->select('parent_id', config('railcontent.table_prefix') . 'content.slug as slug')
                                ->first();
                        $parentSlug = ($parent) ? $parent->slug : null;

                        $userPlaylists =
                            $dbConnection->table(config('railcontent.table_prefix') . 'user_playlist_content')
                                ->where('content_id', $row->id)
                                ->select('user_playlist_id')
                                ->get();

                        $instructors =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_instructors')
                                ->join(
                                    config('railcontent.table_prefix') . 'content',
                                    config('railcontent.table_prefix') . 'content_instructors.instructor_id',
                                    '=',
                                    config('railcontent.table_prefix') . 'content.id'
                                )
                                ->select('instructor_id', 'name')
                                ->where('content_id', $row->id)
                                ->orderBy('content_id', 'asc')
                                ->get();

                        $permissions =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_permissions')
                                ->select('permission_id')
                                ->where('content_id', $row->id)
                                ->orWhere('content_type', $row->type)
                                ->orderBy('id', 'asc')
                                ->get();

                        $description =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_data')
                                ->select('*')
                                ->where('content_id', $row->id)
                                ->where('key', 'description')
                                ->orderBy('id', 'asc')
                                ->first();
                        $styles =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_styles')
                                ->select('style')
                                ->where('content_id', $row->id)
                                ->orderBy('id', 'asc')
                                ->get();

                        $params1['body'][] = [
                            'index' => [
                                '_index' => 'content',
                            ],
                        ];

                        $params1['body'][] = [
                            'content_id' => $row->id,
                            'title' => $row->title,
                            'slug' => $row->slug,
                            'difficulty' => $row->difficulty,
                            'status' => $row->status,
                            'brand' => $row->brand,
                            'style' =>  (!$styles->isEmpty()) ? array_map(
                                'strtolower',
                                $styles->pluck('style')
                                    ->toArray()
                            ) : [],
                            'artist' => $row->artist,
                            'content_type' => $row->type,
                            'staff_pick_rating' => $row->staff_pick_rating,
                            'bpm' => $row->bpm,
                            'show_in_new_feed' => $row->show_in_new_feed,
                            'published_on' => $row->published_on,
                            'created_on' => $row->created_on,
                            'topic' => (!$topics->isEmpty()) ? array_map(
                                'strtolower',
                                $topics->pluck('topic')
                                    ->toArray()
                            ) : [],
                            'tag' => (!$tags->isEmpty()) ? array_map(
                                'strtolower',
                                $tags->pluck('tag')
                                    ->toArray()
                            ) : [],
                            'instructor' => $instructors->pluck('instructor_id')
                                ->toArray(),
                            'instructors_name' => array_map(
                                'strtolower',
                                $instructors->pluck('name')
                                    ->toArray()
                            ),
                            'all_progress_count' => $allProgressCount,
                            'last_week_progress_count' => $lastWeekProgressCount,
                            'description' => $description->value ?? '',
                            'parent_id' => ($parent) ? $parent->parent_id : null,
                            'parent_slug' => $parentSlug,
                            'playlist_ids' => $userPlaylists->pluck('user_playlist_id')
                                ->toArray(),
                            'permission_ids' => $permissions->pluck('permission_id')
                                ->toArray(),
                        ];
                    }

                    //Bulk insert documents
                    $client->bulk($params1);

                    $this->info('Migrated ' . $nr . ' contents');
                }
            );

        $this->info('Finished MigrateContentToElasticsearch.');
    }
}
