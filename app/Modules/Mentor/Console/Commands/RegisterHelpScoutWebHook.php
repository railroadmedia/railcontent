<?php

namespace App\Modules\Mentor\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\HelpScout\Services\HelpScoutUserService;
use App\Modules\Mentor\Models\Mentor;
use App\Modules\Mentor\Services\EnsureMentorResult;
use App\Modules\Mentor\Services\HelpScoutMentorService;
use App\Modules\Mentor\Services\MentorService;
use App\Services\DatabaseService;
use App\Services\DatabaseServiceProvider;
use Illuminate\Database\DatabaseManager;
use Modules\UserManagementSystem\Models\User;

class RegisterHelpScoutWebHook extends Command
{
    protected $signature = 'mentors:registerHelpScoutWebHook';
    protected $description = 'Run to register help scout web hook';

    private HelpScoutMentorService $helpScoutMentorService;

    public function __construct(
        HelpScoutMentorService $helpScoutMentorService,
    ) {
        parent::__construct();
        $this->helpScoutMentorService = $helpScoutMentorService;
    }

    public function handle(): bool
    {
        $this->info("\nRegistering Web Hook");
        $this->helpScoutMentorService->registerHelpScoutWebHook();
        return true;
    }

}
