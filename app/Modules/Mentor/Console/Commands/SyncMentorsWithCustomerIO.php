<?php

namespace App\Modules\Mentor\Console\Commands;


use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Jobs\SyncMentorsWithCustomerIOJob;

class SyncMentorsWithCustomerIO extends Command
{
    protected $signature = 'mentors:sync';
    protected $description = 'Resyncs all assigned mentors on customerIO';

    public function handle()
    {
        $this->info("Unify Subscriptions...");
        $success = $this->runChainQuery(function (int $skip, int $take) {
            return new SyncMentorsWithCustomerIOJob($skip, $take);
        }, chunks: 50);
        return $success;
    }


}
