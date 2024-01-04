<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Jobs\Shopify\SyncSubscriptionPaymentsToShopifyOrders;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use App\Modules\Ecommerce\Services\ShopifyCancelService;
use Carbon\Carbon;
use Railroad\Ecommerce\Repositories\SubscriptionPaymentRepository;
use Signifly\Shopify\Shopify;

class FixWrongAccessIssues extends Command
{
    protected $signature = 'ecommerce:FixWrongAccessIssues {--limit=10000} {--userId=}';

    public function handle(Shopify $shopify, ShopifyCancelService $shopifyCancelService): void
    {
        $this->withExecutionTime(function () use ($shopify, $shopifyCancelService) {
            $limit = $this->option('limit');
            $userId = $this->option('userId');
            $query = SubscriptionPayment::query()->select('ecommerce_subscription_payments.*')
                ->join(
                    'ecommerce_subscriptions',
                    'ecommerce_subscriptions.id',
                    '=',
                    'ecommerce_subscription_payments.subscription_id'
                )
                ->where('ecommerce_products.digital_access_time_interval_type', 'month')
                ->where('ecommerce_products.digital_access_time_interval_length', '6')
                ->where('ecommerce_subscriptions.interval_type', 'month')
                ->where('ecommerce_subscriptions.interval_count', 1)
                ->where('ecommerce_subscriptions.type', '<>', 'payment plan')
                //->where('ecommerce_subscription_payments.payment_id', 334338)
                ->join('ecommerce_products', 'ecommerce_products.id', '=', 'ecommerce_subscriptions.product_id');
            if ($userId) {
                $query->where('ecommerce_subscriptions.user_id', $userId);
            }
            $items = $query->limit($limit)->get();
            $count = count($items);
            $this->info("Found $count items to fix");

            foreach ($items as $item) {
                $this->info("Fixing item $item->id");
                try {
                    $subscription = Subscription::find($item->subscription_id);

                    $payment = Payment::find($item->payment_id);
                    if ($subscription->user_id == 385381) {
                        $this->info("Skipping user 385381");
                        continue;
                    }
                    $requiresUpdate = false;

                    switch ($subscription->type) {
                        case 'subscription':
                            if ($subscription->total_price < 30) {
                                $requiresUpdate = true;
                            }
                            break;
                        case 'apple_subscription':
                            $requiresUpdate = true;
                            break;
                        default:
                            throw new \Exception('case not handled');
                    }
                    $subscription->product_id = $this->getMonthlyProductId($subscription);

                    if ($requiresUpdate) {
                        $this->info("Removing order $item->shopify_id");
                        $shopifyCancelService->cancelSubscriptionPaymentOrder($item);
                        $item->shopify_id = null;
                        $item->save();

                        switch ($subscription->type) {
                            case 'subscription':
                                if ($subscription->total_price < 30) {
                                    $subscription->product_id = $this->getMonthlyProductId($subscription);
                                    $subscription->save();
                                    $requiresUpdate = true;
                                }
                                break;
                            case 'apple_subscription':
                                if ($payment->total_paid > 35) {
                                    $payment->total_paid = 29.99;
                                    if ($payment->total_refunded > $payment->total_paid) {
                                        $payment->total_refunded = 29.99;
                                    }
                                    $payment->save();
                                }
                                $subscription->product_id = $this->getMonthlyProductId($subscription);
                                $subscription->total_price = 29.99;
                                $subscription->save();
                                $requiresUpdate = true;

                                break;
                            default:
                                throw new \Exception('case not handled');
                        }

                        dispatch_sync(
                            new SyncSubscriptionPaymentsToShopifyOrders(
                                $item->id,
                                $item->id,
                                Carbon::minValue(),
                                false,
                                false
                            )
                        );
                    }
                } catch (\Throwable $exception) {
                    \Log::error($exception->getMessage());
                }
            }
        });
    }

    private function getMonthlyProductId(Subscription $subscription): int
    {
        switch ($subscription->product_id) {
            case 124:
            case 125:
                return 124;
            case 6:
            case 5:
            case 53:
                return 5;
            default:
                throw  new \Exception('case not handled');
        }
    }
}
