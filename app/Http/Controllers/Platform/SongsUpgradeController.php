<?php

namespace App\Http\Controllers\Platform;

use Illuminate\View\View;
use App\Http\Controllers\BaseController;
use Railroad\Ecommerce\Services\MembershipTier;
use Railroad\Ecommerce\Services\UpgradeService;
use Request;

class SongsUpgradeController extends BaseController
{
    private UpgradeService $upgradeService;

    public function __construct(UpgradeService $upgradeService)
    {
        $this->upgradeService = $upgradeService;
    }

    public function index(Request $request, $domain, $brand): View
    {
        $isLifetime = user()->isALifetimeMember();
        $currentTier = $this->upgradeService->getSubscriptionMembershipTier($isLifetime);

        $proratedUpgradeCost = $this->upgradeService->getProratedUpgradeCost();
        $showManageSongsButton = $isLifetime || $this->upgradeService->getCurrentSubscription() != null;

        return view(
            'home.songs-upgrade',
            [
                'isLifetime' => $isLifetime,
                'currentTier' => $currentTier->value,
                'upgradeCost' => $proratedUpgradeCost,
            ]
        );
    }
}
