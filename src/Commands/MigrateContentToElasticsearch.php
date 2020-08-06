<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Elastica\Document;
use Elastica\Query\MatchPhrase;
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

        $this->info('Migrate contents.');

        $client = $this->elasticService->getClient();
        $contentIndex = $client->getIndex('content');
        $contentIndex->create(['settings' => ['index' => ['number_of_shards' => 1, 'number_of_replicas' => 0]]], true);

        $this->elasticService->setMapping($contentIndex);

        $nr = 0;
        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->select('*')
            ->whereNotIn('type', ['assignment', 'exercise', 'vimeo-video', 'youtube-video'])
            ->orderBy('id', 'asc')
            ->chunk(
                500,
                function (Collection $rows) use ($dbConnection, $contentIndex, &$nr) {
                    $elasticBulk = [];
                    foreach ($rows as $row) {
                        $nr++;

                        //delete document if exists
                        $matchPhraseQuery = new MatchPhrase("id", $row->id);
                        $contentIndex->deleteByQuery($matchPhraseQuery);

                        $topics =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_topic')
                                ->select('topic')
                                ->where('content_id', $row->id)
                                ->orderBy('id', 'asc')
                                ->get();

                        $tags =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_tag')
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
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_instructor')
                                ->join(
                                    config('railcontent.table_prefix') . 'content',
                                    config('railcontent.table_prefix') . 'content_instructor.instructor_id',
                                    '=',
                                    config('railcontent.table_prefix') . 'content.id'
                                )
                                ->select('instructor_id','name')
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
                                ->where('key','description')
                                ->orderBy('id', 'asc')
                                ->first();

                        $document = new Document(
                            '', [
                                'id' => $row->id,
                                'title' => $row->title,
                                //  'name' => $row->name,
                                'slug' => $row->slug,
                                'difficulty' => $row->difficulty,
                                'status' => $row->status,
                                'brand' => $row->brand,
                                'style' => $row->style,
                                'artist' => $row->artist,
                                'content_type' => $row->type,
                                'staff_pick_rating' => $row->staff_pick_rating,
                                'bpm' => $row->bpm,
                                'show_in_new_feed' => $row->show_in_new_feed,
                                'published_on' => Carbon::parse($row->published_on),
                                'topic' => (!$topics->isEmpty()) ?
                                    array_map('strtolower', $topics->pluck('topic')
                                        ->toArray()) : [],
                                'tag' => (!$tags->isEmpty()) ?
                                    array_map('strtolower',  $tags->pluck('tag')
                                        ->toArray())
                                    : [],
                                'instructor' => $instructors->pluck('instructor_id')
                                    ->toArray(),
                                'instructors_name' => array_map('strtolower', $instructors->pluck('name')
                                    ->toArray())                                    ,
                                'all_progress_count' => $allProgressCount,
                                'last_week_progress_count' => $lastWeekProgressCount,
                                'description' => $description->value ?? '',
                                'parent_id' => ($parent) ? $parent->parent_id : null,
                                'parent_slug' => $parentSlug,
                                'playlist_ids' => $userPlaylists->pluck('user_playlist_id')
                                    ->toArray(),
                                'permission_ids' => $permissions->pluck('permission_id')
                                    ->toArray(),
                            ]
                        );

                        $elasticBulk[] = $document;
                    }
                    //Add documents
                    $contentIndex->addDocuments($elasticBulk);

                    //Refresh Index
                    $contentIndex->refresh();

                    $this->info('Migrated ' . $nr . ' contents');
                }
            );

//        $this->info('Migrate user progress.');
//        $userProgressIndex = $client->getIndex('progress');
//
//        if (!$userProgressIndex->exists()) {
//            $userProgressIndex->create(
//                ['settings' => ['index' => ['number_of_shards' => 1, 'number_of_replicas' => 0]]], true);
//
//        }
//        $nrProgress = 0;
//        $dbConnection->table(config('railcontent.table_prefix') . 'user_content_progress')
//            ->select(config('railcontent.table_prefix') . 'user_content_progress.*')
//            ->join(
//                config('railcontent.table_prefix') . 'content',
//                'content_id',
//                '=',
//                config('railcontent.table_prefix') . 'content.id'
//            )
//            ->whereNotIn('type', ['assignment', 'instructor', 'exercise', 'vimeo-video', 'youtube-video'])
//            ->orderBy(config('railcontent.table_prefix') . 'user_content_progress.id', 'asc')
//            ->chunk(
//                5000,
//                function (Collection $rows) use ($dbConnection, $userProgressIndex, &$nrProgress) {
//                    $elasticBulk = [];
//
//                    foreach ($rows as $row) {
//                        $nrProgress++;
//                        $document = new Document(
//                            '', [
//                                'id' => $row->id,
//                                'user_id' => $row->user_id,
//                                'content_id' => $row->content_id,
//                                'state' => $row->state,
//                            ]
//                        );
//
//                        $elasticBulk[] = $document;
//                    }
//
//                    //Add documents
//                    $userProgressIndex->addDocuments($elasticBulk);
//
//                    //Refresh Index
//                    $userProgressIndex->refresh();
//
//                    $this->info('Migrated ' . $nrProgress . ' progresses records');
//
//                }
//            );

        $this->info('Finished MigrateContentToElasticsearch.');
    }
}
