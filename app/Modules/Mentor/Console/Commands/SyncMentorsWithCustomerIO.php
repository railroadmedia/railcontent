<?php

namespace App\Modules\Mentor\Console\Commands;


use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Jobs\SyncMentorsWithCustomerIOJob;

class SyncMentorsWithCustomerIO extends Command
{
    protected $signature = 'mentors:sync {mentorUserId?}';
    protected $description = 'Resyncs all assigned mentors on customerIO';

    public function handle()
    {
        $this->info("Sync mentor students with customerIO");
        $mentorUserId = $this->argument("mentorUserId");
        $this->runChainQuery(function (int $skip, int $take) use ($mentorUserId) {
            return new SyncMentorsWithCustomerIOJob($skip, $take, $mentorUserId);
        }, chunks: 500);
    }


}
