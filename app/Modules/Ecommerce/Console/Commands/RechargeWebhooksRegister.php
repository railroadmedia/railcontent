<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;

class RechargeWebhooksRegister extends Command
{
    public const WEBHOOKS = [
        'subscription/cancelled' => ['route' => 'recharge.webhook.subscription.cancel', 'version' => '2021-01'],
        'subscription/paused' => ['route' => 'recharge.webhook.subscription.paused', 'version' => '2021-11'],
        'charge/failed' => ['route' => 'recharge.webhook.charge.failed', 'version' => '2021-01'],
        'customer/payment_method_updated' => ['route' => 'recharge.webhook.customer.payment-method-updated', 'version' => '2021-01'],

    ];

    protected $signature = 'ecommerce:registerRechargeWebhook {customBaseURL?}';

    public function handle(RechargeGateway $rechargeGateway): void
    {
        $this->withExecutionTime(function () use ($rechargeGateway) {
            $customBaseURL = $this->argument('customBaseURL');
            if (app()->isLocal() && !$customBaseURL) {
                throw new \Exception("Please provide a public url using ngrok or similar service");
            }

            foreach (self::WEBHOOKS as $topic => $webhookConfig) {
                $this->registerWebHook($rechargeGateway, $customBaseURL, $topic, $webhookConfig);
            }
        });
    }

    /**
     * @param  array<string, array{route: string, version: string}>  $config
     */
    public function registerWebHook(
        RechargeGateway $rechargeGateway,
        ?string $customBaseURL,
        string $topic,
        array $config
    ): void {
        $url = route($config['route'], absolute: !$customBaseURL);
        if ($customBaseURL) {
            $url = $customBaseURL . $url;
        }

        try {
            $data = [
                'topic' => $topic,
                'address' => $url,
                'version' => $config['version']
            ];

            $webhookData = $rechargeGateway->createWebhook($data);
            $this->info("Webhooks registered: $url $topic");
            $this->warn("Please write down the webhook's id for future reference:");
            $this->info(print_r($webhookData, true));
        } catch (\Exception $e) {
            $this->error("Error registering webhook: $url $topic");
            $this->error($e->getMessage());
        }
    }
}
