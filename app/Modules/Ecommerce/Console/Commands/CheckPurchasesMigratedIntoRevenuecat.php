<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Services\RevenueCatService;
use App\Modules\Ecommerce\Services\SubscriptionService;
use App\Modules\Ecommerce\Services\UserProductService;
use Carbon\Carbon;
use Modules\Ecommerce\Models\SubscriptionPayment;

class CheckPurchasesMigratedIntoRevenuecat extends Command
{
    protected $signature = 'ecommerce:CheckPurchasesMigratedIntoRevenuecat {brand?} {type?}';

    protected $description = 'Check subscriptions migrated into Revenuecat';

    public function handle(
        RevenueCatService $revenueCatService,
        SubscriptionService $subscriptionService,
        UserProductService $userProductService
    ) {
        $brand = $this->argument('brand');
        $type = $this->argument('type') ?? 'apple_subscription';
        $users = [];
        $subscriptions =   Subscription::query()
            ->where('brand','=', $brand)
            ->where('type','=', $type)
            ->whereNotNull('user_id')
           // ->where('user_id','=', 601352)
            ->orderBy('created_at')
            ->chunk(1000, function ($items) use($revenueCatService, $subscriptionService, $userProductService, &$users) {
                foreach($items as $item){
                   // dd($item);
                    try {
                        $subscriber = $revenueCatService->getSubscriber($item->user_id);
                       // dd($subscriber);
                        $entitlements = $subscriber->entitlements;
                        $subscriptions = $subscriber->subscriptions;
                        if (!empty($entitlements)) {
                            foreach ($entitlements as $entitlement) {
                                $productIdentifier = $entitlement->product_identifier;
                                $subscriptionData = $subscriptions->$productIdentifier;
                                $expireDate = $entitlement->expires_date;

                                $sameExpireDate = Carbon::parse($subscriptionData->expires_date) == $item->paid_until;
                                $isActiveRevenueCat = ((Carbon::parse($subscriptionData->expires_date) >= now()->subDays(5)
                                && !$subscriptionData->unsubscribe_detected_at )|| $subscriptionData->auto_resume_date);
                                $isActive = $isActiveRevenueCat == $item->is_active;
                                if(!$isActive) {
                                   // dd($subscriber);
                                   // $this->info('User status :: '.$item->user_id);
                                    $users[$item->user_id] = $item->user_id;
                                    //                                    $this->info(Carbon::parse($subscriptionData->expires_date).'                          '.$item->paid_until);
                                    //                                    $this->info(print_r($subscriber));
                                }
                                if(!$sameExpireDate) {
                                    //$this->info('User with different expiration date :: '.$item->user_id);
//                                    $this->info(Carbon::parse($subscriptionData->expires_date).'                          '.$item->paid_until);
//                                    $this->info(print_r($subscriber));
                                }

//                                $pay = SubscriptionPayment::query()->where('subscription_id', $item->id)->first();
//                                $payment = Payment::query()->where('id',$pay->payment_id ?? null)->orderBy('id','desc')->first();
//                                if($payment) {
//                                    $sameExternalId = $payment->external_id == $subscriptionData->store_transaction_id;
//
//                                    if (!$sameExternalId) {
//                                        $this->info(
//                                            'User with different external app store id  : '.
//                                            $item->user_id.
//                                            '    musora:: '.
//                                            $payment->external_id.
//                                            '    revenue::'.
//                                            $subscriptionData->store_transaction_id
//                                        );
//                                    }
//                                }

                            }
                        }
                    } catch (\Exception $e) {
                        $this->info(print_r($e->getMessage(), true));
                        $this->error('User not found : '.$item->user_id);
                        continue;
                    }

                }
                $this->info('1000 ready');
               // dd($expireDate);
        });

        $this->info(print_r($users, true));
        $this->info(count($users));
        $this->info('Done.');
    }
}
