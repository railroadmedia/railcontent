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
        $index = $client->getIndex('content');

        if (!$index->exists()) {
            $index->create(['settings' => ['index' => ['number_of_shards' => 1, 'number_of_replicas' => 1]]]);
        }

        $this->elasticService->setMapping($index);


        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->select('*')
            ->orderBy('id', 'asc')
            ->chunk(
                50,
                function (Collection $rows) use ($dbConnection, $index) {
                    $elasticBulk = [];
                    foreach ($rows as $row) {
                        //delete document if exists
                        $matchPhraseQuery = new MatchPhrase("id", $row->id);
                        $index->deleteByQuery($matchPhraseQuery);

                        $topics =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_topic')
                                ->select('topic')
                                ->where('content_id', $row->id)
                                ->orderBy('id', 'asc')
                                ->get();
                        $data =
                            $dbConnection->table(config('railcontent.table_prefix') . 'content_data')
                                ->select('*')
                                ->where('content_id', $row->id)
                                ->orderBy('id', 'asc')
                                ->get();
                        $datum = [];
                        foreach ($data as $d) {
                            $datum[] = ['key' => $d->key, 'value' => $d->value];
                        }

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

                        $document = new Document(
                            '', [
                                'id' => $row->id,
                                'title' => $row->title,
                                'name' => $row->name,
                                'slug' => $row->slug,
                                'difficulty' =>  $row->difficulty,
                                'status' => $row->status,
                                'brand' => $row->brand,
                                'style' => $row->style,
                                'content_type' => $row->type,
                                'published_on' => Carbon::parse($row->published_on),
                                'topics' => $topics->pluck('topic')
                                    ->toArray(),
                                'all_progress_count' => $allProgressCount,
                                'last_week_progress_count' => $lastWeekProgressCount,
                                'datum' => $datum,
                            ]
                        );

                        $elasticBulk[] = $document;
                    }
                    //Add documents
                    $index->addDocuments($elasticBulk);

                    //Refresh Index
                    $index->refresh();
                }

            );



        $this->info('Finished MigrateContentToElasticsearch.');
    }
}
