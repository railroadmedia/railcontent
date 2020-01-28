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
    protected $signature = 'command:ComputePastStats';

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
        // todo - past interval dates may be specified by commands params, ask for details
        $startDate = Carbon::parse('2011-01-01');
        $endDate = Carbon::now();

        $this->contentStatisticsService->computeContentStatistics($startDate, $endDate);
    }
}
