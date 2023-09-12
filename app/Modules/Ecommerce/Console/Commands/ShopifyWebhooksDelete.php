<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use Illuminate\Support\Str;
use Signifly\Shopify\Shopify;

class ShopifyWebhooksDelete extends Command
{
    protected $signature = 'ecommerce:DeleteShopifyWebHooks {appURL}';

    public function handle(Shopify $shopify)
    {
        $this->withExecutionTime(function () use ($shopify) {
            $appURL = $this->argument('appURL');
            $webhooks = $shopify->getWebhooks();
            foreach ($webhooks as $webhook) {
                if (Str::startsWith($webhook->address, $appURL)) {
                    $shopify->deleteWebhook($webhook->id);
                    $this->info("$webhook->topic webhook $webhook->id deleted ($webhook->address)");
                }
            }
        });
    }
}
