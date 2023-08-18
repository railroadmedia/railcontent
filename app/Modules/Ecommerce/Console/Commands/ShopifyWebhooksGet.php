<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use Signifly\Shopify\Shopify;

class ShopifyWebhooksGet extends Command
{
    protected $signature = 'ecommerce:GetShopifyWebHooks';

    public function handle(Shopify $shopify)
    {
        $this->withExecutionTime(function () use ($shopify) {
            $data = $shopify->getWebhooks();
            $this->info(strval(count($data)) . ' webhooks found');
            $this->info(json_encode($data));
        });
    }
}
