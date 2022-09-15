<?php

namespace App\Modules\Mentor\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Services\HelpScoutMentorService;

class RegisterHelpScoutWebHook extends Command
{
    protected $signature = 'mentors:registerHelpScoutWebHook';
    protected $description = 'Run to register help scout web hook';

    public function handle(HelpScoutMentorService $helpScoutMentorService): bool
    {
        $this->info("\nRegistering Web Hook");
        $helpScoutMentorService->registerHelpScoutWebHook();
        return true;
    }

}
