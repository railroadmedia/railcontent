<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\Recharge\CancelledSubscriptionsReport;
use Carbon\Carbon;

class GenerateReportRechargeCancelledSubscriptions extends Command
{
    protected $signature = 'ecommerce:report-cancelled-subscriptions
                            {to* : The email address(es) to send the report to.}
                            {--cc=* : (Optional) The email address(es) to send the report to as a CC}
                            {--created_at_max= : (Optional) The latest date to get orders from. Defaults to today. e.g. 2023-10-13}
                            {--created_at_min= : (Optional) The earliest date to get orders from. Defaults to two weeks before created_at_max. e.g. 2023-10-13}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a report of cancelled Recharge subscriptions and email it to the Mentors team.';

    public function handle(): int
    {
        $to = $this->argument('to');
        $cc = $this->option('cc') ?: null;
        $createdAtMax = $this->option("created_at_max") ? new Carbon($this->option("created_at_max")) : Carbon::today();
        $createdAtMin = $this->option("created_at_min") ? new Carbon(
            $this->option("created_at_min")
        ) : $createdAtMax->copy()->subWeeks(2);

        dispatch(new CancelledSubscriptionsReport($createdAtMin, $createdAtMax, $to, $cc))
            ->onQueue('command');

        return self::SUCCESS;
    }
}
