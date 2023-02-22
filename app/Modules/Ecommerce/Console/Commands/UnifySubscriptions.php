<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\UnifySubscriptionsJob;
use Modules\UserManagementSystem\Models\User;

class UnifySubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ecommerce:unifySubscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Takes subscriptions from old brand model to new unified model';

    /**
     * Execute the console command.
     *
     * @throws Throwable
     */
    public function handle()
    {
        $this->info("Unify Subscriptions...");
        $success = $this->runBatchQuery(function (int $skip, int $take) {
            return new UnifySubscriptionsJob($skip, $take);
        }, chunks: 1000);
        return $success;
    }

    public function callback(User $user)
    {
        $test = $user->id;
    }
}
