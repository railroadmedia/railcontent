<?php

namespace App\Modules\Ecommerce\Services;

use App\Enums\Interval;
use App\Exceptions\UserFriendlyException;
use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Enums\DigitalAccessType;
use App\Modules\Ecommerce\Enums\MembershipLevel;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class SubscriptionUpgradeService
{
    public const MusoraProductBrand = 'musora';
    public const LifetimeSongAddOnSKU = 'LTM-songs-upgrade-recurring-membership';
    public const MonthlySongsAddOnSKU = 'musora-upgrade-month';

    private const SubscriptionNotChangedErrorMessage = "You already have plus access, no changes were made.";
    private ProductService $productService;
    private RechargeGateway $rechargeGateway;
    private SubscriptionService $subscriptionService;
    private UserAccessPermissionsService $userAccessPermissionsService;


    public function __construct(
        ProductService $productService,
        RechargeGateway $rechargeGateway,
        SubscriptionService $subscriptionService,
        UserAccessPermissionsService $userAccessPermissionsService
    ) {
        $this->productService = $productService;
        $this->rechargeGateway = $rechargeGateway;
        $this->subscriptionService = $subscriptionService;
        $this->userAccessPermissionsService = $userAccessPermissionsService;
    }

    public function getUpgradeProductInfo(User $user): array
    {
        if ($user->getMembershipLevelAsEnum() != MembershipLevel::Basic) {
            throw new Exception(self::SubscriptionNotChangedErrorMessage);
        }
        if ($user->isALifetimeMember()) {
            return ['sku' => self::LifetimeSongAddOnSKU, 'quantity' => 1];
        } else {
            $monthsUntilRenewal = max(0, min(12, $user->getMembershipExpirationDate()->diffInMonths(Carbon::now())));
            return ['sku' => self::MonthlySongsAddOnSKU, 'quantity' => $monthsUntilRenewal];
        }
    }

    public function upgradeSubscription(User $user): void
    {
        $this->ensurePlusAccess($user);
        Log::debug("Upgrade Subscription to plus", $user->getDebugInfo());
        $subscription = $this->subscriptionService->getActiveSubscription($user);
        $interval = Interval::tryFrom($subscription->orderIntervalUnit);
        $intervalLength = $subscription->orderIntervalFrequency;
        if ($interval == Interval::Month && $intervalLength == 12) {
            $interval = Interval::Year;
            $intervalLength = 1;
        }

        $shopifyVariantId = Product::whereBrand('musora')
            ->where('digital_access_type', '=', DigitalAccessType::Plus->value)
            ->where('digital_access_time_interval_type', $interval->value)
            ->where('digital_access_time_interval_length', $intervalLength)
            ->first()
            ?->shopify_id;

        $this->subscriptionService->updateSubscriptionProduct($subscription, $shopifyVariantId);
    }

    public function getProratedUpgradeCost(User $user): ?float
    {
        $membershipLevel = user()->getMembershipLevelAsEnum();
        if ($membershipLevel != MembershipLevel::Basic) {
            return null;
        }

        $expirationDate = user()->getMembershipExpirationDate();

        if (!$expirationDate) {
            return null;
        }

        $upgradeProduct = $this->productService->getBySku(self::LifetimeSongAddOnSKU);


        $monthsUntilRenewal = $expirationDate->diffInMonths(Carbon::now());
        if ($monthsUntilRenewal < 12) {
            $price = round(max($upgradeProduct->price * $monthsUntilRenewal / 12, 0), 2);
            return $price;
        }
        return $upgradeProduct->price;
    }

    private function ensurePlusAccess(User $user): void
    {
        $userAccessPermissions = $this->userAccessPermissionsService->getUserAccessPermissionsByUser($user);
        $basicExpirationDate = $userAccessPermissions->getBasicMembershipExpirationDate(includeBuffer: false);
        if (!$basicExpirationDate) {
            return;
        }
        $this->userAccessPermissionsService->ensurePermissionAccessUntil(
            $user,
            UserAccessPermissionsCollection::MusoraPlusMembershipPermission,
            $basicExpirationDate
        );
    }
}
