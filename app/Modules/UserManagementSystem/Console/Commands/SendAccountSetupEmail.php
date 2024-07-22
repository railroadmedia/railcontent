<?php

namespace App\Modules\UserManagementSystem\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\UserManagementSystem\Jobs\SendAccountSetupEmailJob;

class SendAccountSetupEmail extends Command
{
    protected $signature = 'user:sendAccountSetupEmail';
    protected $description = 'Send account setup email to users who have not completed their account setup';

    public function handle(): void
    {
        $this->runBatchQuery(
            function (int $skip, int $take) {
                return new SendAccountSetupEmailJob(
                    $skip,
                    $take,
                );
            },
            chunks: 12,
            queue: 'command'
        );
    }
}
