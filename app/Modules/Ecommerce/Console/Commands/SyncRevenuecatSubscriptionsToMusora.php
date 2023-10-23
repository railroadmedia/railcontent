<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Services\PaymentService;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;

class SyncRevenuecatSubscriptionsToMusora extends Command
{
    protected $signature = 'ecommerce:SyncRevenuecatSubscriptionsToMusora {userId?}';

    protected $description = 'Sync Revenuecat subscriptions to Musora';

    public function handle(
        RevenueCatService $revenueCatService,
        SubscriptionService $subscriptionService,
        UserProductService $userProductService,
        PaymentService $paymentService
    ) {
        $userId = $this->argument('userId');
        $user = $revenueCatService->getUser(null, $userId);
        $subscriber = $revenueCatService->getSubscriber($userId);

        $revenueCatSubscriptions = (json_decode(json_encode($subscriber->subscriptions), true));

        foreach ($revenueCatSubscriptions as $product => $subscriptionData) {
            $type = (strtolower($subscriptionData['store']) == 'app_store') ? 'apple' : 'google';
            $musoraProduct = $this->getMusoraProduct($type, $subscriptionData['period_type'], $product);

            $musoraSubscription =
                Subscription::query()
                    ->where('user_id', '=', $user->id)
                    ->where('type', '=', $type.'_subscription')
                    ->whereIn(
                        'product_id',
                        $musoraProduct->pluck('id')
                            ->toArray()
                    )
                    ->orderBy('created_at', 'desc')
                    ->first();

            if (!$musoraSubscription) {
                $musoraSubscription = $subscriptionService->createSubscription(
                    $user->id,
                    $subscriptionData['expires_date'],
                    $musoraProduct->first() ,
                    $type,
                    $subscriptionData['purchase_date'],
                    $subscriptionData['unsubscribe_detected_at']
                );

                //Assign user product
                $userProductService->assignUserProduct($user->id,  $musoraSubscription->product_id, $musoraSubscription->paid_until);
            } else {
                //update subscription
                $subscriptionService->updateSubscription(
                    $musoraSubscription,
                    Carbon::create($subscriptionData['expires_date'])->getTimestampMs(),
                    Carbon::create($subscriptionData['unsubscribe_detected_at'])->getTimestampMs(),
                );

                //update user product
                $userProductService->assignUserProduct($user->id,  $musoraSubscription->product_id, $musoraSubscription->paid_until);
            }

            if ($subscriptionData['period_type'] != 'trial') {
                $paymentService->create(
                    $musoraSubscription,
                    $type,
                    Carbon::create($subscriptionData['purchase_date'])
                        ->getTimestampMs(),
                    $subscriptionData['store_transaction_id']
                );
            }
        }

        $this->info('Done.');
    }

    private function getMusoraProduct(string $type, $periodType, mixed $productId)
    {
        $store = $type.'_store';
        if ($periodType == 'TRIAL') {
            $productsMap = [config('ecommerce.'.$store.'_products_map_trial')[$productId]];
        } else {
            $productsMap = array_merge(
                [config('ecommerce.'.$store.'_products_map')[$productId]],
                [config('ecommerce.'.$store.'_products_map_trial')[$productId]]);
        }

        $musoraProduct =
            Product::whereIn('sku', $productsMap)
                ->get();

        return $musoraProduct;
    }
}
