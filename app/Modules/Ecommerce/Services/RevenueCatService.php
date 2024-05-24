<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\ApiGateways\RevenueCatApiGateway;
use App\Modules\Ecommerce\Enums\ShopifyPaymentSourceEnum;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\EventTracking\Services\CustomerIoService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Events\User\UserCreated;
use Modules\UserManagementSystem\Models\User;

class RevenueCatService
{
    public RevenueCatApiGateway $revenueCatApiGateway;
    private ShopifySyncService $shopifySyncService;
    private CustomerIoService $customerIoService;

    /**
     * @param RevenueCatApiGateway $revenueCatApiGateway
     * @param ShopifySyncService $shopifySyncService
     * @param CustomerIoService $customerIoService
     */
    public function __construct(
        RevenueCatApiGateway $revenueCatApiGateway,
        ShopifySyncService $shopifySyncService,
        CustomerIoService $customerIoService
    ) {
        $this->revenueCatApiGateway = $revenueCatApiGateway;
        $this->shopifySyncService = $shopifySyncService;
        $this->customerIoService = $customerIoService;
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

        if (!empty($entitlements)) {
            foreach ($entitlements as $entitlement) {
                $productIdentifier = $entitlement->product_identifier;
                $productPlanIdentifier = $entitlement->product_plan_identifier;
                $subscriptionData = $subscriptions->$productIdentifier;

                $type = (strtolower($subscriptionData->store) == 'app_store') ? 'apple' : 'google';
                $store = $type.'_store';
                $entitlementProduct = ($productIdentifier == 'musora_subscription') ? $productIdentifier.':'.$productPlanIdentifier : $productIdentifier;
                if ($subscriptionData->period_type == 'trial') {
                    $productsMap = [config('ecommerce.'.$store.'_products_map_trial')[$entitlementProduct]];
                } else {
                    $productsMap = array_merge(
                        [config('ecommerce.'.$store.'_products_map')[$entitlementProduct]],
                        [config('ecommerce.'.$store.'_products_map_trial')[$entitlementProduct]]
                    );
                }
                $musoraProduct =
                    Product::whereIn('sku', $productsMap)
                        ->get()
                        ->first();

                $processedAt = Carbon::parse($subscriptionData->purchase_date);
                $expiredAt = Carbon::parse($subscriptionData->expires_date);
                if ($user && (!$this->shopifySyncService->doesOrderExist($user->shopify_id, $processedAt))) {
                    if (!$musoraProduct) {
                        break;
                    }
                    $price = $musoraProduct->price;

                    if ($subscriptionData->is_sandbox) {
                        UserAccessPermissionsService::$timeMinutes = round(
                            $expiredAt->diffInSeconds($processedAt) / 60
                        );
                    }

                    $this->shopifySyncService->syncOrder(
                        $user,
                        [$musoraProduct->id],
                        $musoraProduct->brand,
                        $processedAt,
                        $price,
                        0,
                        $type == 'apple' ? ShopifyPaymentSourceEnum::Apple : ShopifyPaymentSourceEnum::Google,
                        null //defaults to USD
                    );

                    match ($type) {
                        'apple' => $user->has_apple_subscription = true,
                        'google' => $user->has_google_subscription = true
                    };
                    $user->save();
                    $event['expiration_at_ms'] = $expiredAt->timestamp;
                    $event['event_timestamp_ms'] = Carbon::parse(Carbon::now())->timestamp;
                    $event['purchased_at_ms'] = $processedAt->timestamp;

                    $this->customerIoService->updateCustomerIoAttributesFromRevenueCat($user, $event, $musoraProduct);
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
            User::onWriteConnection()
                ->where('email', $value)
                ->orWhereIn('revenuecat_origin_app_user_id', $aliases)
                ->first();
        if (!$user && $createIfNotExists && $value) {
            $parts = explode('@', $value);
            User::upsert(
                [
                                     'email' => $value,
                                     'password' => Hash::make($value),
                                     'display_name' => $parts[0].rand(10000, 99999),
                                     'revenuecat_origin_app_user_id' => $appUserId,
                                 ],
                'email',
                ['password','display_name','revenuecat_origin_app_user_id']
            );

            $user =
                User::onWriteConnection()
                    ->where('email', $value)
                    ->first();
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
            'Call revoke API '.
            $productIdentifier.
            ' for '.
            $userId.
            ' on Revenuecat(user access revoked from Google Play Console)'
        );

        $results = $this->revenueCatApiGateway->revoke($userId, $productIdentifier, $platform, $app);
        Log::debug(print_r($results, true));

        return $results;
    }
}
