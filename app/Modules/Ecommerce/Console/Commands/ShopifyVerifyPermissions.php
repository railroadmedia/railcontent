<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Jobs\ShopifyVerifyPermissionsJob;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Shopify;

class ShopifyVerifyPermissions extends Command
{
    protected $signature = 'ecommerce:ShopifyVerifyPermissions {chunkSize=1000}';

    public function handle()
    {
        $chunkSize = $this->argument('chunkSize');
        $this->runBatchQuery(function (int $skip, int $take) {
            return new ShopifyVerifyPermissionsJob($skip, $take);
        }, chunks: $chunkSize, queue: 'command');
    }
}
