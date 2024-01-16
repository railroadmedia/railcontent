<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Jobs\Shopify\SyncSubscriptionPaymentsToShopifyOrders;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\Services\ShopifyCancelService;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Carbon\Carbon;
use Railroad\Ecommerce\Repositories\SubscriptionPaymentRepository;
use Signifly\Shopify\Shopify;

class FixWrongAccessIssues extends Command
{
    protected $signature = 'ecommerce:FixWrongAccessIssues {--limit=10000} {--userId=}';

    public function handle(ShopifySyncService $shopifySyncService): void
    {
        $this->withExecutionTime(function () use ($shopifySyncService) {
            $query = SubscriptionPayment::query()->distinct()->select(['usora_users.id', 'usora_users.shopify_id'])
                ->join(
                    'ecommerce_subscriptions',
                    'ecommerce_subscriptions.id',
                    '=',
                    'ecommerce_subscription_payments.subscription_id'
                )
                ->join('usora_users', 'usora_users.id', '=', 'ecommerce_subscriptions.user_id')
                ->where('ecommerce_subscription_payments.updated_at', '>', Carbon::parse('2024-01-03'));
            $userId = $this->option('userId');
            if ($userId) {
                $query = $query->where('ecommerce_subscriptions.user_id', $userId);
            }
            $users = $query->get();

            foreach ($users as $user) {
                $this->info('ecommerce:FixWrongAccessIssues:Syncing user: ' . $user->id);
                $shopifySyncService->syncCustomer($user->shopify_id, removeDeletedOrderPermissions: true);
            }
        });
    }
}
