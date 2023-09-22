<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use Signifly\Shopify\REST\Resources\WebhookResource;
use Signifly\Shopify\Shopify;

class ShopifyWebhooksGet extends Command
{
    protected $signature = 'ecommerce:GetShopifyWebHooks';

    public function handle(Shopify $shopify)
    {
        $this->withExecutionTime(function () use ($shopify) {
            $webhooks = $shopify->getWebhooks();
            $this->info(strval(count($webhooks)) . ' webhooks found');
            /** @var WebhookResource $webhook */
            foreach ($webhooks as $webhook) {
                $this->info(print_r($webhook->getAttributes(), true));
            }
        });
    }
}
