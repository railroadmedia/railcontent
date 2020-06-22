<?php

namespace Railroad\Railcontent\Commands;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Search\SearchManager;
use Elastica\Client;
use Elastica\Document;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Railroad\Railcontent\Managers\RailcontentEntityManager;
use Railroad\Railcontent\Managers\SearchEntityManager;

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
     * @var RailcontentEntityManager
     */
    private $entityManager;

    /**
     * MigrateContentToElasticsearch constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param RailcontentEntityManager $entityManager
     */
    public function __construct(DatabaseManager $databaseManager, RailcontentEntityManager $entityManager)
    {
        parent::__construct();

        $this->databaseManager = $databaseManager;

        $this->entityManager = $entityManager;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle()
    {
        $this->info('Starting MigrateContentToElasticsearch.');

        $dbConnection = $this->databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        $sm = SearchEntityManager::get();
        $client = $sm->getClient();

        if (!$client->getIndex('content')
            ->exists()) {
            $client->createIndex('content');
        }
        $index = $client->getIndex('content');

        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->select('*')
            ->orderBy('id', 'asc')
            ->chunk(
                5,
                function (Collection $rows) use ($dbConnection, $index) {

                    foreach ($rows as $row) {

                        $document = new Document(
                            '', [
                                'id' => $row->id,
                                'title' => $row->title,
                                'name' => $row->name,
                                'slug' => $row->slug,
                                'difficulty' => $row->difficulty,
                                'status' => $row->status,
                                'brand' => $row->brand,
                                'style' => $row->style,
                                'content_type' => $row->type,
                                'published_on' => $row->published_on,
                            ]
                        );

                        // Add tweet to type
                        $index->addDocument($document);

                        // Refresh Index
                        $index->refresh();
                    }

                }
            );

        $this->info('Finished MigrateContentToElasticsearch.');
    }
}