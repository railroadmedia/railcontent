<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Modules\Ecommerce\Models\Product;
use Auth;
use Carbon\Carbon;
use Modules\UserManagementSystem\Models\User;
use Illuminate\Console\Command;
use Railroad\Ecommerce\Services\SubscriptionUpgradeService;

class TestMembershipChanges extends Command
{

    protected $name = 'TestMembershipChanges';
    protected $signature = 'TestMembershipChanges';

    protected $description = '';

    public function handle(SubscriptionUpgradeService $service)
    {
        User::query()->where('membership_expiration_date', '>', Carbon::today()->addDays(-10))
            ->orderBy('id', 'desc')
            ->chunk(100, function ($items) use ($service) {
                foreach ($items as $user) {
                    Auth::loginUsingId($user->id);
                    try {
                        $this->info("Processing downgrade $user->id");
                        $result = $service->changeSubscription(Product::DIGITAL_ACCESS_TYPE_BASIC_CONTENT_ACCESS, 'year', $user->id);
                        $this->info($result);
                        $this->info("Processing upgrade $user->id");
                        $result = $service->changeSubscription(Product::DIGITAL_ACCESS_TYPE_ALL_CONTENT_ACCESS, 'year', $user->id);
                        $this->info($result);
                    } catch (\Throwable $e) {
                        $this->info($e->getMessage());
                    }
                }
            });
    }
}
