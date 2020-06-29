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
    protected $description = 'Migrate contents to Elasticsearch';

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
        $contentIndex = $client->getIndex('content');

//        if (!$contentIndex->exists()) {
//            $contentIndex->create(['settings' => ['index' => ['number_of_shards' => 1, 'number_of_replicas' => 1]]]);
//
//            $this->elasticService->setMapping($contentIndex);
//        }
//
//
//        $dbConnection->table(config('railcontent.table_prefix') . 'content')
//            ->select('*')
//            ->orderBy('id', 'asc')
//            ->chunk(
//                50,
//                function (Collection $rows) use ($dbConnection, $contentIndex) {
//                    $elasticBulk = [];
//                    foreach ($rows as $row) {
//                        //delete document if exists
//                        $matchPhraseQuery = new MatchPhrase("id", $row->id);
//                        $contentIndex->deleteByQuery($matchPhraseQuery);
//
//                        $topics =
//                            $dbConnection->table(config('railcontent.table_prefix') . 'content_topic')
//                                ->select('topic')
//                                ->where('content_id', $row->id)
//                                ->orderBy('id', 'asc')
//                                ->get();
//                        $data =
//                            $dbConnection->table(config('railcontent.table_prefix') . 'content_data')
//                                ->select('*')
//                                ->where('content_id', $row->id)
//                                ->orderBy('id', 'asc')
//                                ->get();
//                        $datum = [];
//                        foreach ($data as $d) {
//                            $datum[] = ['key' => $d->key, 'value' => $d->value];
//                        }
//
//                        $allProgressCount =
//                            $dbConnection->table(config('railcontent.table_prefix') . 'user_content_progress')
//                                ->where('content_id', $row->id)
//                                ->count();
//
//                        $lastWeekProgressCount =
//                            $dbConnection->table(config('railcontent.table_prefix') . 'user_content_progress')
//                                ->where('content_id', $row->id)
//                                ->where(
//                                    'updated_on',
//                                    '>=',
//                                    Carbon::now()
//                                        ->subWeek(1)
//                                )
//                                ->count();
//
//                        $parent =  $dbConnection->table(config('railcontent.table_prefix') . 'content_hierarchy')
//                            ->where('child_id', $row->id)
//                            ->select('parent_id')
//                            ->first();
//
//                        $userPlaylists =  $dbConnection->table(config('railcontent.table_prefix') . 'user_playlist_content')
//                            ->where('content_id', $row->id)
//                            ->select('user_playlist_id')
//                            ->get();

        //$instructors =
            //                            $dbConnection->table(config('railcontent.table_prefix') . 'content_instructor')
            //                                ->select('instructor_id')
            //                                ->where('content_id', $row->id)
            //                                ->orderBy('id', 'asc')
            //                                ->get();
//
//                        $document = new Document(
//                            '', [
//                                'id' => $row->id,
//                                'title' => $row->title,
//                                'name' => $row->name,
//                                'slug' => $row->slug,
//                                'difficulty' =>  $row->difficulty,
//                                'status' => $row->status,
//                                'brand' => $row->brand,
//                                'style' => $row->style,
//                                'artist => $row->artist,
//                                'content_type' => $row->type,
//                                'published_on' => Carbon::parse($row->published_on),
//                                'topics' => $topics->pluck('topic')
//                                    ->toArray(),
//        'instructors' => $instructors->pluck('instructor_id')
//                                    ->toArray(),
//                                'all_progress_count' => $allProgressCount,
//                                'last_week_progress_count' => $lastWeekProgressCount,
//                                'datum' => $datum,
//                                'parent_id' => ($parent)?$parent->parent_id:null,
//                                'playlist_ids' => $userPlaylists->pluck('user_playlist_id')->toArray()
//                            ]
//                        );
//
//                        $elasticBulk[] = $document;
//                    }
//                    //Add documents
//                    $contentIndex->addDocuments($elasticBulk);
//
//                    //Refresh Index
//                    $contentIndex->refresh();
//                }
//            );

        //TODO: Optimize user progress migration to elasticsearch
        $userProgressIndex = $client->getIndex('progress');

        if (!$userProgressIndex->exists()) {
            $userProgressIndex->create(['settings' => ['index' => ['number_of_shards' => 1, 'number_of_replicas' => 1]]]);

          //  $this->elasticService->setMapping($contentIndex);
        }



        $dbConnection->table(config('railcontent.table_prefix') . 'user_content_progress')
            ->select('*')
           // ->limit(1000)
            ->orderBy('id', 'asc')
            ->chunk(
                500,
                function (Collection $rows) use ($dbConnection, $userProgressIndex) {
                    $elasticBulk = [];

                    foreach ($rows as $row) {
                        $document = new Document(
                            '', [
                                'id' => $row->id,
                                'user_id' => $row->user_id,
                                'content_id' => $row->content_id,
                                'state' => $row->state,
                            ]
                        );

                        $elasticBulk[] = $document;
                    }

                    //Add documents
                    $userProgressIndex->addDocuments($elasticBulk);

                    //Refresh Index
                    $userProgressIndex->refresh();
                });

        $this->info('Finished MigrateContentToElasticsearch.');
    }
}
