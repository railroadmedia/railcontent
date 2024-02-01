<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use App\Modules\Content\Models\ContentUserProgress;
use Carbon\Carbon;
use DB;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ElasticService;

class ContentUpdatePopularity extends Command
{

    protected $signature = 'content:updatePopularityMWP';

    protected $description = 'Updates the content popularity column';

    public function handle(DatabaseManager $databaseManager)
    {
        $this->withExecutionTime(function () use ($databaseManager) {
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

            Schema::connection(config('railcontent.database_connection_name'))
                ->table(config('railcontent.table_prefix') . 'content', function (Blueprint $table) {
                    $table->dropColumn('popularity_old');
                });
        });
    }

    public function updatePopularity(string $startDate, DatabaseManager $databaseManager): void
    {
        $max = Content::query()->max('id');
        $chunk = 1000;
        $minId = 1;
        $maxId = $minId + $chunk;
        while ($minId < $max) {
            $weights = DB::table('railcontent_user_content_progress')->selectRaw(
                "IFNULL(SUM(CASE WHEN state = 'completed' THEN 1 ELSE 0 END), 0)*5 +
                     IFNULL(SUM(CASE WHEN state = 'started' THEN 1 ELSE 0 END), 0) as weight,
                    content_id"
            )
                ->where('content_id', '>=', $minId)
                ->where('content_id', '<', $maxId)
                ->where('updated_on', '>', $startDate)
                ->groupBy('content_id')
                ->get();
            foreach ($weights as $weight) {
                $contentId = $weight->content_id;
                $value = $weight->weight;
                DB::statement(
                    "update railcontent_content
                            set popularity = $value / (GREATEST(datediff(CURDATE(), DATE(published_on)) / 60, 0.75))
                            where id = $contentId"
                );
            }

            $minId += $chunk;
            $maxId += $chunk;
            $this->info("content:updatePopularityMWP: Updating Content Progress to $minId/$max");
            usleep(10000);
        }
    }
}
