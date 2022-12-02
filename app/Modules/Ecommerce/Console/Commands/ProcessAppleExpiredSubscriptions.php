<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\ProcessAppleExpiredSubscriptionsJob;

class ProcessAppleExpiredSubscriptions extends Command
{
    protected $signature = 'ecommerce:ProcessAppleExpiredSubscriptionsBatched';

    protected $description = 'Queries Apple to get the state of subscriptions due to expire';

    public function handle() {
        $this->runBatchQuery(function (int $skip, int $take) {
            return new ProcessAppleExpiredSubscriptionsJob($skip, $take);
        }, chunks: 100);
    }
}
