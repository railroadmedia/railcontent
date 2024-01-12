<?php

namespace App\Modules\Ecommerce\Jobs;


use App\Modules\Ecommerce\Services\ShopifySyncService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ShopifySyncCustomerJob
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;


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
