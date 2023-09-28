<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;

use App\Modules\Ecommerce\ApiGateways\RevenueCatApiGateway;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Modules\Ecommerce\Models\SubscriptionPayment;
use Railroad\Ecommerce\Gateways\RevenueCatGateway;
use Modules\UserManagementSystem\Models\User;

class MigrateIntoRevenuecat extends Command
{
    protected $signature = 'ecommerce:migrateIntoRevenuecat';

    protected $description = 'Check subscriptions migrated into Revenuecat';

    public function handle(
        RevenueCatGateway $revenueCatGateway,
        SubscriptionService $subscriptionService,
        UserProductService $userProductService
    ) {
        $user = User::query()->where('id', 575750)->first();

        $res = $revenueCatGateway->sendRequest(
            'gngiooonafdchndohbmpddga.AO-J1OwW6PZ7fyIfXa7h4BR42KfzpC38pMWMi91XwQR-VseMopkZ8iZnuXxcWr-5xmRDufufjrEoSBhdb9h182RbB4O4CTxwIw',
            $user,
            'drumeo_app_1_month_2021',
            'android',
            '29.99',
            'USD',
            'Drumeo'
        );
        dd($res);


        $this->info('Done.');
    }
}
