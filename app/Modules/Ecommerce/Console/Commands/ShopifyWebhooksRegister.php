<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use Illuminate\Support\Facades\URL;
use Signifly\Shopify\Shopify;
use Signifly\Shopify\Webhooks\Webhook;

class ShopifyWebhooksRegister extends Command
{
    public const WEBHOOKS = [
        'orders/updated' => 'shopify.webhook.order.update',
        'orders/create' => 'shopify.webhook.order.create'
    ];

    protected $signature = 'ecommerce:registerShopifyWebhook {customBaseURL?}';

    public function handle(Shopify $shopify)
    {
        $this->withExecutionTime(function () use ($shopify) {
            $customBaseURL = $this->argument('customBaseURL');
            if (app()->isLocal() && !$customBaseURL) {
                throw new \Exception("Please provide a public url using ngrok or similar service");
            }

            foreach (self::WEBHOOKS as $topic => $route) {
                $this->registerWebHook($shopify, $customBaseURL, $topic, $route);
            }
        });
    }

    function registerWebHook(Shopify $shopify, ?string $customBaseURL, $topic, $route)
    {
        $url = route($route, absolute: !$customBaseURL);
        if ($customBaseURL) {
            $url = $customBaseURL . $url;
        }

        try {
            $result = $shopify->createWebhook([
                'topic' => $topic,
                'address' => $url,
                'format' => 'json',
            ]);
            $this->info("Webhooks registered: $url $topic");
        } catch (\Exception $e) {
            $this->info("Error registering webhook: $url $topic");
            $this->info($e->getMessage());
        }
    }


}
