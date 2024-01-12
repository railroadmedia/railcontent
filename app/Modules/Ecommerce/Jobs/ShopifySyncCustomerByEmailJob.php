<?php

namespace App\Modules\Ecommerce\Jobs;


use App\Modules\Ecommerce\Services\ShopifySyncService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ShopifySyncCustomerByEmailJob
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private array $emails;

    public function __construct(
        array $emails
    ) {
        $this->emails = $emails;
    }

    public function handle(ShopifySyncService $shopifySyncService): void
    {
        foreach ($this->emails as $email) {
            $shopifySyncService->syncCustomerByEmail($email);
        }
    }
}
