<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use Signifly\Shopify\Shopify;
use Signifly\Shopify\Webhooks\Webhook;

class ShopifyWebhookRegister extends Command
{
    protected $signature = 'ecommerce:registerShopifyWebhook {url}';

    public function handle(Shopify $shopify)
    {
        $this->withExecutionTime(function () use ($shopify) {
            if (app()->isProduction()) {
                //TODO: Implement this for the production environment
                $this->error("Not implemented for the production environment");
                return;
            }
            $url = $this->argument('url');
            $topic = 'orders/create';

            $shopify->createWebhook([
                'topic' => $topic,
                'address' => $url,
                'format' => 'json',
            ]);

            $this->info("Webhook registered: $url $topic");
        });
    }
}
