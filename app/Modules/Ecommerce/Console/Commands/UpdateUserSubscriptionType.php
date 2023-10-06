<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class UpdateUserSubscriptionType extends Command
{
    protected $signature = 'ecommerce:UpdateUserSubscriptionType {subscriptionType=subscription}';

    /**
     * @throws Throwable
     */
    public function handle()
    {
        $this->withExecutionTime(function () {
            $type = $this->argument('subscriptionType');
            $this->info("Updating users for subscription type: $type");
            Subscription::query()
                ->where('is_active', 1)
                ->where('paid_until', '>', Carbon::now())
                ->where('type', $type)
                ->chunk(1000, function (Collection $subscriptions) {
                    $this->info('processing chunk');
                    foreach ($subscriptions as $subscription) {
                        /** @var User $user */
                        /** @var Subscription $subscription */
                        $user = $subscription->user;
                        if ($user) {
                            match ($subscription->type) {
                                'subscription' => $user->has_recharge_subscription = true,
                                'apple_subscription' => $user->has_apple_subscription = true,
                                'google_subscription' => $user->has_google_subscription = true
                            };
                            $user->save();
                        }
                    }
                });
        });
    }
}
