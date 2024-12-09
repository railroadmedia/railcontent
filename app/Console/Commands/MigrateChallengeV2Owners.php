<?php

namespace App\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Console\Commands\Infrastructure\Timer;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Models\ChallengeUserProgress;
use App\Modules\Content\Models\ContentUserProgress;
use App\Modules\Content\Services\ChallengesService;
use App\Modules\Ecommerce\Enums\UserAccessPermissionsSourceEnum;
use App\Modules\Ecommerce\Models\UserAccessPermission;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;

use function Amp\delay;

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
            $this->migrate($sanityGateway);
        });
    }

    public function migrate(SanityGateway $sanityGateway): void
    {
        $challenges = $sanityGateway->getAllByType('challenge', 1000);
        $productIds = collect($challenges)->whereNotNull('product_id')->pluck('product_id')->toArray();
        UserAccessPermission::query()
            ->select('user_id')
            ->distinct()
            ->where('source', '!=', UserAccessPermissionsSourceEnum::Challenges->value)
            ->whereIn('product_id', $productIds)
            ->orderBy('user_id')
            ->chunk(1000, function ($items) {
                $userIds = $items->pluck('user_id')->toArray();
                User::query()->whereIn('id', $userIds)->update(['is_challenge_owner' => true]);
                sleep(1);
            });
    }
}
