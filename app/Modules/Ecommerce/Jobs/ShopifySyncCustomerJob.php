<?php

namespace App\Modules\Ecommerce\Jobs;

use App\Jobs\WebhookChildJob;
use App\Modules\Ecommerce\Services\ShopifySyncService;

class ShopifySyncCustomerJob extends WebhookChildJob
{
    private ?int $customerId;
    private string $email;

    public function __construct(
        ?int $customerId,
        string $email
    ) {
        $this->customerId = $customerId;
        $this->email = $email;
    }

    public function handle(ShopifySyncService $shopifySyncService): void
    {
        $shopifySyncService->syncCustomer($this->customerId, $this->email);
    }
}
