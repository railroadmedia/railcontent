<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ElasticService;

class CalculateContentPopularity extends Command
{

    protected $signature = 'content:updatePopularity';

    protected $description = 'CalculateContentPopularity';

    public function info($string, $verbosity = null)
    {
        Log::info($string); //also write info statements to log
        $this->line($string, 'info', $verbosity);
    }

    public function handle(DatabaseManager $databaseManager, ElasticService $elasticService)
    {
        $this->info("Processing $this->name");
        $dbConnection = $databaseManager->connection(config('railcontent.database_connection_name'));

        $memoryStart = memory_get_usage();
        $timeStart = microtime(true);

        //use startOfDay for consistency when testing
        $startDate = Carbon::now()->subDays(30)->startOfDay()->toDateTimeString();

        if (!Schema::connection(config('railcontent.database_connection_name'))->hasColumn(
            config('railcontent.table_prefix') . 'content',
            'popularity_old'
        )) {
            Schema::connection(config('railcontent.database_connection_name'))
                ->table(config('railcontent.table_prefix') . 'content', function (Blueprint $table) {
                    $table->integer('popularity_old')->nullable(true);
                });
        }

        $this->updatePopularity($startDate, $databaseManager);
        $rowsUpdated = $this->updateElasticSearch($elasticService, $dbConnection);

        Schema::connection(config('railcontent.database_connection_name'))
            ->table(config('railcontent.table_prefix') . 'content', function (Blueprint $table) {
                $table->dropColumn('popularity_old');
            });

        $diff = microtime(true) - $timeStart;
        $sec = intval($diff);
        $this->info("$rowsUpdated rows updated");
        $this->info("Finished $this->name ($sec s)");
        $this->info('Memory usage :: ' . $this->formatmem(memory_get_usage() - $memoryStart));
        return true;
    }

    function formatmem($m)
    {
        if ($m) {
            $unit = ['b', 'kb', 'mb', 'gb', 'tb', 'pb'];
            $m = @round($m / pow(1024, ($i = floor(log($m, 1024)))), 2) . ' ' . $unit[$i];
        }

        return str_pad($m, 15, ' ', STR_PAD_LEFT);
    }

    public function updatePopularity(string $startDate, DatabaseManager $databaseManager): void
    {
        $this->info("Update Content Popularity");
        // we divide by days published ago so weight newer content higher, can update the divide value to adjust how
        // much to weight newer content
        $sql = <<<'EOT'
                UPDATE `%s` cs
                LEFT JOIN (
                    SELECT
                  count(up.id) as nr, up.content_id
                    FROM railcontent_user_content_progress up
                    where up.state = '%s' and up.updated_on > '%s'
                    Group by up.content_id
                )c ON  cs.id = c.content_id 
                LEFT JOIN (
                    SELECT
                  count(up.id) as nr, up.content_id
                    FROM railcontent_user_content_progress up
                    where up.state = '%s' and up.updated_on > '%s'
                    Group by up.content_id
                )s ON  cs.id = s.content_id 
                SET cs.popularity_old = cs.popularity,
                    cs.popularity = (((IFNULL(c.nr, 0) * 5) + IFNULL(s.nr, 0)) / (GREATEST(datediff(CURDATE(), DATE(cs.published_on)) / 60, 0.75)))
                EOT;

        $statement = sprintf(
            $sql,
            config('railcontent.table_prefix') . 'content',
            'completed',
            $startDate,
            'started',
            $startDate

        );

        $databaseManager->connection(config('railcontent.database_connection_name'))
            ->statement($statement);
    }

    public function updateElasticSearch(
        ElasticService $elasticService,
        \Illuminate\Database\Connection $dbConnection
    ): int {
        $this->info("Update Elastic Search Popularity (disabled)");
        $client = $elasticService->getClient();
        if (!$client->indices()
            ->exists(['index' => 'content'])) {
            $elasticService->createContentIndex();
        }

        $rowsUpdated = 0;
        $dbConnection->table(config('railcontent.table_prefix') . 'content')
            ->select(['id', 'popularity', 'popularity_old'])
            ->where('popularity', '!=', 'popularity_old')
            ->orderBy('id', 'asc')
            ->chunk(2000, function (Collection $rows) use (&$rowsUpdated, $client) {
                foreach ($rows as $row) {
                    //For some reason the mysql where check does not work
                    if ($row->popularity == $row->popularity_old) {
                        continue;
                    }
                    $rowsUpdated++;
//                    $contentID = $row->id;
//
//                    $updateRequest = [
//                        'index' => 'content',
//                        'refresh' => true,
//                        'body' => [
//                            'query' => [
//                                'term' => [
//                                    'content_id' => "$contentID",
//                                ],
//                            ],
//                            'script' => [
//                                "lang" => "painless",
//                                'inline' => 'ctx._source.popularity = params.value',
//                                'params' => [
//                                    'value' => $row->popularity,
//                                ],
//                            ],
//                        ],
//                    ];
//
//                    $client->updateByQuery($updateRequest);
                }
            });
        return $rowsUpdated;
    }
}
