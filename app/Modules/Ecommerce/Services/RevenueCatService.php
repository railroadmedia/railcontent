<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\ApiGateways\RevenueCatApiGateway;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;
use App\Modules\Ecommerce\Services\PaymentService;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Models\User;
use Illuminate\Support\Facades\Log;

class RevenueCatService
{
    public RevenueCatApiGateway $revenueCatApiGateway;
    public SubscriptionService $subscriptionService;
    public UserProductService $userProductService;
    public PaymentService $paymentService;

    /**
     * @param RevenueCatApiGateway $revenueCatApiGateway
     * @param \App\Modules\Ecommerce\Services\SubscriptionService $subscriptionService
     */
    public function __construct(
        RevenueCatApiGateway $revenueCatApiGateway,
        SubscriptionService $subscriptionService,
        UserProductService $userProductService,
        PaymentService $paymentService
    ) {
        $this->revenueCatApiGateway = $revenueCatApiGateway;
        $this->subscriptionService = $subscriptionService;
        $this->userProductService = $userProductService;
        $this->paymentService = $paymentService;
    }

    /**
     * @param $appUserId
     * @return mixed
     * @throws \Exception
     */
    public function getSubscriber($appUserId)
    {
        return $this->revenueCatApiGateway->getSubscriber($appUserId);
    }

    /**
     * @param $revenueCatOriginalAppUserId
     * @param null $email
     * @param false $forceCreateNewUser
     * @return User|null
     * @throws \Exception
     */
    public function syncSubscriber($revenueCatOriginalAppUserId, $email = null, $forceCreateNewUser = false)
    {
        $user = $this->getUser(
            $email,
            $revenueCatOriginalAppUserId,
            $forceCreateNewUser
        );

        $subscriber = $this->getSubscriber($revenueCatOriginalAppUserId);
        $entitlements = $subscriber->entitlements;
        $subscriptions = $subscriber->subscriptions;

        $active = false;
        if (!empty($entitlements)) {
            foreach ($entitlements as $entitlement) {
                $productIdentifier = $entitlement->product_identifier;
                $subscriptionData = $subscriptions->$productIdentifier;
                if (Carbon::parse($subscriptionData->expires_date) >= now()->subDays(
                        config(
                            'ecommerce.days_before_access_revoked_after_expiry_in_app_purchases_only',
                            7
                        )
                    )) {
                    $active = true;
                }
                $type = (strtolower($subscriptionData->store) == 'app_store') ? 'apple' : 'google';
                $store = $type . '_store';
                if ($subscriptionData->period_type == 'trial') {
                    $productsMap = [config('ecommerce.' . $store . '_products_map_trial')[$productIdentifier]];
                } else {
                    $productsMap = array_merge(
                        [config('ecommerce.' . $store . '_products_map')[$productIdentifier]],
                        [config('ecommerce.' . $store . '_products_map_trial')[$productIdentifier]]
                    );
                }

                $musoraProduct =
                    Product::whereIn('sku', $productsMap)
                        ->get();

                if ($user) {
                    $userId = $user->id;
                    $musoraSubscription =
                        Subscription::query()
                            ->where('user_id', '=', $userId)
                            ->where('type', '=', $type . '_subscription')
                            ->whereIn(
                                'product_id',
                                $musoraProduct->pluck('id')
                                    ->toArray()
                            )
                            ->first();

                    if (!$musoraSubscription) {
                        $musoraSubscription = $this->subscriptionService->createSubscription(
                            $userId,
                            Carbon::parse($subscriptionData->expires_date)
                                ->getTimestampMs(),
                            $musoraProduct->first(),
                            $type,
                            Carbon::parse($subscriptionData->purchase_date)
                                ->getTimestampMs(),
                            Carbon::parse($subscriptionData->unsubscribe_detected_at)
                                ->getTimestampMs()
                        );
                    } else {
                        //update subscription
                        $this->subscriptionService->updateSubscription(
                            $musoraSubscription,
                            Carbon::parse($subscriptionData->expires_date)
                                ->getTimestampMs(),
                            Carbon::parse($subscriptionData->unsubscribe_detected_at)
                                ->getTimestampMs()
                        );
                    }

                    //Assign user product
                    $this->userProductService->assignUserProduct(
                        $userId,
                        $musoraSubscription->product_id,
                        $musoraSubscription->paid_until
                    );
                    if (strtoupper($subscriptionData->period_type) != 'TRIAL') {
                        $this->paymentService->create(
                            $musoraSubscription,
                            $type,
                            Carbon::parse($subscriptionData->purchase_date)
                                ->getTimestampMs(),
                            $subscriptionData->store_transaction_id
                        );
                    }
                }
            }
        }

        return $user;
    }

    /**
     * @param null $value
     * @param $appUserId
     * @param false $createIfNotExists
     * @param array $aliases
     * @return User|null
     */
    public function getUser($value = null, $appUserId, $createIfNotExists = false, $aliases = []): ?User
    {
        if (empty($aliases)) {
            $aliases = [$appUserId];
        }
        $user =
            User::on('musora_laravel_mysql::write')
                ->where('email', $value)
                ->orWhereIn('revenuecat_origin_app_user_id', $aliases)
                ->first();
        if (!$user && $createIfNotExists && $value) {
            $parts = explode('@', $value);
            $user = new User;
            $user->email = $value;
            $user->setPassword($value);
            $user->display_name = $parts[0] . rand(10000, 99999);
            $user->revenuecat_origin_app_user_id = $appUserId;
            $user->save();
            event(new UserCreated($user));
        } elseif ($user) {
            $user->revenuecat_origin_app_user_id = $appUserId;
            $user->save();
        }

        return $user;
    }


    /**
     * @param $userId
     * @param $productIdentifier
     * @param $platform
     * @param string $app
     * @return string
     */
    public function revoke(
        $userId,
        $productIdentifier,
        $platform,
        $app = 'Musora'
    ) {
        Log::debug(
            'Call revoke API ' .
            $productIdentifier .
            ' for ' .
            $userId .
            ' on Revenuecat(user access revoked from Google Play Console)'
        );

        $results = $this->revenueCatApiGateway->revoke($userId, $productIdentifier, $platform, $app);
        Log::debug(print_r($results, true));

        return $results;
    }
}
