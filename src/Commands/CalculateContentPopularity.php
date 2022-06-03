<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ContentService;

class CalculateContentPopularity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CalculateContentPopularity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CalculateContentPopularity';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DatabaseManager $databaseManager)
    {
        $this->info('CalculateContentPopularity start.');
        $dbConnection = $databaseManager->connection(config('railcontent.database_connection_name'));
        $dbConnection->disableQueryLog();
        $pdo = $dbConnection->getPdo();
        $pdo->exec('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');

        $memoryStart = memory_get_usage();
        $startTime = microtime(true);

        $startDate = Carbon::now()->subDays(30)->toDateTimeString();

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
SET cs.`popularity` = (((IFNULL(c.nr, 0) * 5) + IFNULL(s.nr, 0)) / (GREATEST(datediff(CURDATE(), DATE(cs.published_on)) / 60, 0.75)))
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

        $this->info('Total time::  '.(microtime(true) - $startTime));
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
}
