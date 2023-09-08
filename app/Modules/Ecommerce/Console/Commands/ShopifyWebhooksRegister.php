<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use Illuminate\Support\Facades\URL;
use Signifly\Shopify\Shopify;
use Signifly\Shopify\Webhooks\Webhook;

class ShopifyWebhooksRegister extends Command
{
    protected $signature = 'ecommerce:registerShopifyWebhook {customBaseURL?}';

    public function handle(Shopify $shopify)
    {
        $this->withExecutionTime(function () use ($shopify) {
            $customBaseURL = $this->argument('customBaseURL');
            if (app()->isLocal() && !$customBaseURL) {
                throw new \Exception("Please provide a public url using ngrok or similar service");
            }
            $this->registerOrderCreateURL($shopify, $customBaseURL);
        });
    }

    function registerOrderCreateURL(Shopify $shopify, ?string $customBaseURL)
    {
        $topic = 'orders/create';

        $url = route('shopify.webhook.order.create', absolute: !$customBaseURL);
        if ($customBaseURL) {
            $url = "$customBaseURL/$url";
        }

        $shopify->createWebhook([
            'topic' => $topic,
            'address' => $url,
            'format' => 'json',
        ]);
        $this->info("Webhooks registered: $url $topic");
    }
}
