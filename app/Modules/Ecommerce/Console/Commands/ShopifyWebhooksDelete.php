<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use Signifly\Shopify\Shopify;

class ShopifyWebhooksDelete extends Command
{
    protected $signature = 'ecommerce:DeleteShopifyWebHook {webhookId}';

    public function handle(Shopify $shopify)
    {
        $this->withExecutionTime(function () use ($shopify) {
            $webhookId = $this->argument('webhookId');
            $shopify->deleteWebhook($webhookId);
            $this->info("Webhook $webhookId deleted");
        });
    }
}
