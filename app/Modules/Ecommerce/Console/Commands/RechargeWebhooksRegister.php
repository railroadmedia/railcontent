<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;

class RechargeWebhooksRegister extends Command
{
    public const WEBHOOKS = [
        'subscription/cancelled' => 'recharge.webhook.subscription.cancel',
    ];

    public array $webHookFields = [];

    protected $signature = 'ecommerce:registerRechargeWebhook {customBaseURL?}';

    public function handle(RechargeGateway $rechargeGateway): void
    {
        $this->withExecutionTime(function () use ($rechargeGateway) {
            $customBaseURL = $this->argument('customBaseURL');
            if (app()->isLocal() && !$customBaseURL) {
                throw new \Exception("Please provide a public url using ngrok or similar service");
            }

            foreach (self::WEBHOOKS as $topic => $route) {
                $this->registerWebHook($rechargeGateway, $customBaseURL, $topic, $route);
            }
        });
    }

    public function registerWebHook(RechargeGateway $rechargeGateway, ?string $customBaseURL, $topic, $route): void
    {
        $url = route($route, absolute: !$customBaseURL);
        if ($customBaseURL) {
            $url = $customBaseURL . $url;
        }

        try {
            $data = [
                'topic' => $topic,
                'address' => $url,
            ];
            if ($this->webHookFields[$topic] ?? false) {
                $data['fields'] = $this->webHookFields[$topic];
            }

            $webhookData = $rechargeGateway->createWebhook($data);
            $this->info("Webhooks registered: $url $topic");
            $this->warn("Please write down the webhook's id for future reference:");
            $this->info(print_r($webhookData, true));
        } catch (\Exception $e) {
            $this->info("Error registering webhook: $url $topic");
            $this->info($e->getMessage());
        }
    }
}
