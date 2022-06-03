<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Railroad\Railcontent\Services\ContentStatisticsService;

class ComputeWeeklyStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ComputeWeeklyStats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compute content statistics for the latest week';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(ContentStatisticsService $contentStatisticsService)
    {
        // last Sunday -> Saturday interval, of any current day
        $intervalStart = Carbon::now()->subDays(Carbon::now()->dayOfWeek + 7)->startOfDay(); // preceding last Sunday
        $intervalEnd = $intervalStart->copy()->addDays(6)->endOfDay(); // last Saturday

        $contentStatisticsService->computeContentStatistics($intervalStart, $intervalEnd);
    }
}
