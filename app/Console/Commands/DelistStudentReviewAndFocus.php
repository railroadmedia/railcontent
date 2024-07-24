<?php

namespace App\Console\Commands;

use App\Jobs\DelistContentJob;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class DelistStudentReviewAndFocus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:DelistStudentReviewAndFocus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DelistStudentReviewAndFocus';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ContentRepository::$bypassPermissions = true;
        ContentRepository::$pullFutureContent = true;
        $count = 0;
        $chunkSize = 500;
        $this->musoraDB()->from('railcontent_content')
            ->whereIn('type', ['student-review', 'student-focus'])
            //->whereNot('status', '=', 'unlisted')
            ->chunkById($chunkSize, function (Collection $contentRows) use (&$count, $chunkSize)  {
                $count += $contentRows->count();
                $ids = $contentRows->pluck('id')->toArray();
                dispatch(new DelistContentJob($ids, ContentService::STATUS_UNLISTED));
                $this->info("Dispatched DeListContentJob Count: $count");
            }, 'id');
        $this->info("Finished dispatching jobs. Nothing to do but wait now.");
        return 0;
    }

    private function musoraDB()
    {
        return DB::connection(config('railcontent.database_connection_name'))->query();
    }
}
