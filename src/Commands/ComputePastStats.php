<?php

namespace Railroad\Railcontent\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Railroad\Railcontent\Services\ContentStatisticsService;

class ComputePastStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ComputePastStats {startDate?} {endDate?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compute content statistics for a past interval';

    /**
     * @var ContentStatisticsService
     */
    protected $contentStatisticsService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ContentStatisticsService $contentStatisticsService)
    {
        parent::__construct();

        $this->contentStatisticsService = $contentStatisticsService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $startDateString = $this->argument('startDate') ?: '2011-01-01';
        $startDate = Carbon::parse($startDateString);

        $endDate = $this->argument('endDate') ?
                        Carbon::parse($this->argument('endDate')) : Carbon::now();


        $format = "Started computing content stats for interval [%s -> %s].\n";

        $this->info(sprintf($format, $startDate->toDateTimeString(), $endDate->toDateTimeString()));

        $start = microtime(true);

        $this->contentStatisticsService->computeContentStatistics($startDate, $endDate, $this);

        $finish = microtime(true) - $start;

        $format = "Finished computing content stats in total %s seconds\n";

        $this->info(sprintf($format, $finish));
    }
}
