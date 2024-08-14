<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Services\SubscriptionUpgradeService;
use Modules\UserManagementSystem\Models\User;

class OrderCreatedSubscriptionManagerJob extends WebhookChildJob
{
    public function __construct(
        private $contents,
    ) {
    }

    public function handle(SubscriptionUpgradeService $subscriptionUpgradeService): void
    {
        if ($this->hasSubscriptionUpgradeProduct($this->contents)) {
            $shopifyCustomerId = $this->contents['customer']['id'];
            $user = User::query()->where('shopify_id', $shopifyCustomerId)->first();
            $subscriptionUpgradeService->upgradeSubscription($user);
        }
    }

    private function hasSubscriptionUpgradeProduct($contents): bool
    {
        foreach ($contents['line_items'] as $lineItem) {
            if ($lineItem['sku'] == SubscriptionUpgradeService::MonthlySongsAddOnSKU) {
                return true;
            }
        }
        return false;
    }
}
