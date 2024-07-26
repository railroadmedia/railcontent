<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Ecommerce\Services\SubscriptionUpgradeService;
use Modules\UserManagementSystem\Models\User;
use Request;

class MembershipUpgradeController extends BaseController
{
    private SubscriptionUpgradeService $subscriptionUpgradeService;

    public function __construct(SubscriptionUpgradeService  $subscriptionUpgradeService)
    {
        $this->subscriptionUpgradeService = $subscriptionUpgradeService;
    }

    public function index(Request $request, $domain, $brand)
    {
        /** @var User $user  */
        $user = user();
        $isLifetime = $user->isALifetimeMember();

        $membershipLevel = $user->getMembershipLevelAsEnum();
        $proratedUpgradeCost = $this->subscriptionUpgradeService->getProratedUpgradeCost($user);

        return view(
            'home.songs-upgrade',
            [
                'isLifetime' => $isLifetime,
                'currentTier' => $membershipLevel->value,
                'upgradeCost' => $proratedUpgradeCost,
            ]
        );
    }
}
