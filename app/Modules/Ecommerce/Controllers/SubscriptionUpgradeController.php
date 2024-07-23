<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Enums\Interval;
use App\Modules\Ecommerce\Enums\MembershipLevel;
use App\Modules\Ecommerce\Services\SubscriptionUpgradeService;
use Exception;
use Illuminate\Routing\Controller;

class SubscriptionUpgradeController extends Controller
{
    private SubscriptionUpgradeService $subscriptionUpgradeService;

    public function __construct(
        SubscriptionUpgradeService $subscriptionUpgradeService,
    ) {
        $this->subscriptionUpgradeService = $subscriptionUpgradeService;
    }

    /**
     * @throws Exception
     */
    public function upgrade()
    {
        $purchaseInfo = $this->subscriptionUpgradeService->getUpgradeProductInfo(user());
        $sku = $purchaseInfo['sku'];
        $quantity = $purchaseInfo['quantity'];
        if ($quantity == 0) {
            $this->subscriptionUpgradeService->upgradeSubscription(user());
            return response()->json();
        }
        return response()->json(['url' => "/ecommerce/add-to-cart?products[$sku]=$quantity&locked=true"]);
    }

    /**
     * @throws Exception
     */
    public function info(): array
    {
        $membershipLevel = user()->getMembershipLevelAsEnum();
        $yearUpgradeCost = $this->subscriptionUpgradeService->getProratedUpgradeCost();
        $data = [
            "currentTier" => $membershipLevel->value,
            "yearUpgradeCost" => $yearUpgradeCost
        ];
        return $data;
    }
}
