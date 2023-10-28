<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Self_;
use Signifly\Shopify\Shopify;
use Signifly\Shopify\Webhooks\Webhook;

class ShopifyWebhooksRegister extends Command
{
    public const WEBHOOKS = [
        'orders/updated' => 'shopify.webhook.order.update',
        'orders/create' => 'shopify.webhook.order.create'
    ];

    public array $webHookFields = [

    ]

    protected $signature = 'ecommerce:registerShopifyWebhook {customBaseURL?}';

    public function __construct()
    {
        $this->webHookFields['orders/create'] = [
            'id',
            'customer',
            'line_items',
            'checkout_token',
            'processed_at',
            'subtotal_price',
            'total_price',
            'currency',
            'total_tax',
            'total_discounts',
            'total_shipping_price_set',
            'discount_codes',
            ShopifyMetafieldNamespace::Musora->value . '.' . ShopifyMetafieldKey::Brand->value,
        ];
    }

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
            $data = [
                'topic' => $topic,
                'address' => $url,
                'format' => 'json',
            ];
            if ($this->webHookFields[$topic] ?? false) {
                $data['fields'] = $this->webHookFields[$topic];
                $data['metafield_namespaces'] = [ShopifyMetafieldNamespace::Musora->value];
            }
            $result = $shopify->createWebhook($data);
            $this->info("Webhooks registered: $url $topic");
        } catch (\Exception $e) {
            $this->info("Error registering webhook: $url $topic");
            $this->info($e->getMessage());
        }
    }


}
