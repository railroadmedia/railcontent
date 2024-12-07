<?php

namespace App\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Console\Commands\Infrastructure\Timer;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\ChallengesService;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;

class MigrateChallengeV2Owners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateChallengeV2Owners';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';


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
    public function handle(SanityGateway $sanityGateway): void
    {
        $this->withExecutionTime(function () use ($sanityGateway) {
            $this->migrate( $sanityGateway);
        });
    }

    public function migrate(SanityGateway $sanityGateway): void
    {
        $challenges = $sanityGateway->getAllByType('challenge', 1000);
        $productIds = collect($challenges)->whereNotNull('product_id')->pluck('product_id')->toArray();
        UserAccessPermission::query()
            ->select('user_id')
            ->distinct()
            ->where('source', 'web')
            ->whereIn('product_id', $productIds)
            ->orderBy('user_id')
            ->chunk(1000, function ($items) {
                foreach ($items as $item) {
                    $user = User::query()->find($item->user_id);
                    if (!$user) {
                        $user->is_challenge_owner = true;
                        $user->save();
                    }
                }
            });
    }
}
