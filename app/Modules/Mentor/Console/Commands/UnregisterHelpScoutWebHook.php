<?php

namespace App\Modules\Mentor\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Mentor\Services\HelpScoutMentorService;
use App\Services\DatabaseServiceProvider;

class UnregisterHelpScoutWebHook extends Command
{
    protected $signature = 'mentors:unregisterHelpScoutWebHook';
    protected $description = 'Run to unregister help scout web hook';

    public function handle(HelpScoutMentorService $helpScoutMentorService): bool
    {
        $this->info("\nRegistering Web Hook");
        $helpScoutMentorService->unregisterHelpScoutWebHook();
        return true;
    }

}
