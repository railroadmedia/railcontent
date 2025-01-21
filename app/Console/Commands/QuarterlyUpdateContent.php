<?php

namespace App\Console\Commands;

use App\Jobs\DelistContentJob;
use App\Modules\Content\Models\Content;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class QuarterlyUpdateContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:QuarterlyUpdateContent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'QuarterlyUpdateContent';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ContentService $contentService)
    {
        $prevQuarter = $contentService->getNextAndPreviousQuarterDates()->previousQuarter;
        $this->info("Prev Quarter $prevQuarter");
        $toReturn = Content::where('status', 'draft')
            ->where('quarter_published', $prevQuarter)
            ->count();
        $toRemove = Content::where('status', 'published')
            ->where('quarter_removed', $prevQuarter)
            ->count();
        $this->info("To Return: $toReturn. To Remove: $toRemove");
        Content::where('status', 'draft')
            ->where('quarter_published', $prevQuarter)
            ->update(['status' => 'published']);
        Content::where('status', 'published')
            ->where('quarter_removed', $prevQuarter)
            ->update(['status' => 'draft']);
        $toReturn = Content::where('status', 'draft')
            ->where('quarter_published', $prevQuarter)
            ->count();
        $toRemove = Content::where('status', 'published')
            ->where('quarter_removed', $prevQuarter)
            ->count();
        $this->info("To Return: $toReturn. To Remove: $toRemove");
        return self::SUCCESS;
    }
}
