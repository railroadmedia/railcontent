<?php

namespace App\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Console\Commands\Infrastructure\Timer;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\ChallengesService;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;

class MigrateChallengeV2Progress3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateChallengeV2Progress3 {startIndex=0} {limit=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MigrateChallengeV2Progress3';


    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(ChallengesService $challengesService, SanityGateway $sanityGateway): void
    {
        $startIndex = (int)$this->argument('startIndex') ?? 0;
        $limit = (int)$this->argument('limit') ?? 0;
        $this->withExecutionTime(function () use ($sanityGateway, $challengesService, $startIndex, $limit) {
            $this->info("$this->name: Migration started");
            //$this->migrate($challengesService, $sanityGateway, $startIndex, $limit);
        });
    }
}
