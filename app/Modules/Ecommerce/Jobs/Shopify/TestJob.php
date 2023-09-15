<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable, LogsShopify;

    public function __construct(protected int $loop)
    {
    }

    public function handle(): void
    {
       $this->logInfo($this->loop);
       sleep(1);
    }


    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncBulkCustomersToShopify";
    }
}
