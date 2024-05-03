<?php

namespace App\Modules\Content\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Content\Models\Content;
use Carbon\Carbon;
use DB;
use Illuminate\Database\DatabaseManager;

class ContentUpdatePopularity extends Command
{
    protected $signature = 'content:updatePopularityMWP';

    protected $description = 'Updates the content popularity column';

    public function handle()
    {
        $this->withExecutionTime(function () {
            $this->updatePopularity();
        });
    }

    public function updatePopularity(): void
    {
        $startDate = Carbon::now()->subDays(30)->startOfDay()->toDateTimeString();
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
