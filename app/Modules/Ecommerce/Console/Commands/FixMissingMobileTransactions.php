<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\FixMissingMobileTransactionsJob;
use Carbon\Carbon;

class FixMissingMobileTransactions extends Command
{
    protected $signature = 'ecommerce:fixMissingMobileTransactions
                            {startDate : The ISO 8601 date time for all Shopify orders to get where the created_at at or after. e.g. 2023-10-13T17:00:25+00:00}
                            {endDate : The ISO 8601 date time for all Shopify orders to get where the created_at at or before. e.g. 2023-10-13T17:30:14+00:00}';

    public function handle()
    {
        $startDate = Carbon::parse($this->argument('startDate'));
        $endDate = Carbon::parse($this->argument('endDate'));
        dispatch(new FixMissingMobileTransactionsJob($startDate, $endDate));
    }
}
