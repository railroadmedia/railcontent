<?php

namespace App\Modules\EventTracking\Services;

use App\Modules\CustomerIO\ApiGateways\CustomerIoApiGateway;
use App\Modules\CustomerIO\Models\Customer;
use App\Modules\CustomerIO\Services\CustomerIoService as LegacyCustomerIoService;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\EventDataSynchronizer\Jobs\CustomerIoSyncUserByUserId;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;
use Throwable;

class CustomerIoService
{
    private LegacyCustomerIoService $customerIoService;

    public function __construct()
    {
        $this->customerIoService = new LegacyCustomerIoService(new CustomerIoApiGateway());
    }

    /**
     * @param User $user
     * @param array $customAttributes
     * @return void
     * @throws Throwable
     */
    public function updateUserAttributes(User $user, array $customAttributes = []): void
    {
        $this->getUserProfiles($user)
            ->each(function (Customer $profile) use ($user, $customAttributes) {
                $this->customerIoService->createOrUpdateCustomerByUserId(
                    $user->id,
                    $profile->workspace_name,
                    $user->email,
                    $customAttributes,
                );
            });
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function getUserProfiles(User $user): Collection
    {
        return Customer::query()
            ->orWhere(function ($query) use ($user) {
                $query->where('user_id', '=', $user->id)
                    ->where('email', '=', $user->email);
            })
            ->orderBy('updated_at', 'desc')->get();
    }

    public function updateCustomerIoAttributesFromRevenueCat(User $user, $event, Product $product): void
    {
        $brand = $product->brand;
        $subscriptionStatus = $this->getSubscriptionStatus($event);
        $expirationTimestamp = Carbon::createFromTimestampMs($event['expiration_at_ms'])->timestamp;
        $eventTimestamp = Carbon::createFromTimestampMs($event['event_timestamp_ms'])->timestamp;
        $purchaseTimestamp = Carbon::createFromTimestampMs($event['purchased_at_ms'])->timestamp;

        $attributes[$brand . '_membership_status'] = $subscriptionStatus;
        $attributes[$brand . '_membership_subscription_type'] = $product->subscription_interval_count . "_" . $product->subscription_interval_type;
        $attributes[$brand . '_membership_subscription_renewal-date'] = $expirationTimestamp;
        $attributes[$brand . '_membership_subscription_cancellation-date'] = $subscriptionStatus == 'cancelled' ? $eventTimestamp : "";
        $attributes[$brand . '_membership_subscription_cancellation-reason'] = $subscriptionStatus == 'cancelled' ? $event['cancel_reason'] : "";
        $attributes[$brand . '_membership_subscription_latest-start-date'] = $purchaseTimestamp;
        $attributes[$brand . '_membership_subscription_first-start-date'] = Carbon::parse($user->created_at)->timestamp;
        $attributes[$brand . '_membership_subscription_trial-type'] = $this->getTrialType($product);
        dispatch(
            (new CustomerIoSyncUserByUserId($user, $attributes))->delay(
                Carbon::now()
                    ->addSeconds(30)
            )
        );
    }

    private function getTrialType(Product $product): string
    {
        if (!$product->isTrial()) {
            return "";
        }
        $interval = match ($product->subscription_interval_type) {
            "month" => "monthly",
            "year" => "annual",
            default => "unknown",
        };

        $days = 0;
        if (str_contains(strtolower($product->sku), "7-day")
            || $product->sku == "PIANOTE-MEMBERSHIP-TRIAL") {
            $days = 7;
        }
        if (str_contains(strtolower($product->sku), "30-day")
            || str_contains(strtolower($product->sku), "1-month")) {
            $days = 30;
        }

        if ($days == 0 || $interval == "unknown") {
            Log::error("Unable to parse trial type for product: " . $product->id);
            return "";
        }

        return $interval . "_" . $days . "_days_free";
    }

    public function getSubscriptionStatus($event): string
    {
        if ($event['cancel_reason'] ?? false) {
            return 'cancelled';
        } elseif (Carbon::now()->lessThan(Carbon::createFromTimestampMs($event['expiration_at_ms']))) {
            return 'active';
        }

        return 'expired';
    }
}
