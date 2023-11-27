<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;

class RechargeWebhookDelete extends Command
{
    protected $signature = 'ecommerce:deleteRechargeWebhooks {webhookId}';

    public function handle(RechargeGateway $recharge): void
    {
        $this->withExecutionTime(function () use ($recharge) {
            $webhookId = $this->argument('webhookId');
            $webhooks = $recharge->getWebhooks();
            foreach ($webhooks as $webhook) {
                if ($webhook->id == $webhookId) {
                    $recharge->deleteWebhook($webhook->id);
                    $this->info("$webhook->topic webhook $webhook->id deleted ($webhook->address)");
                }
            }
        });
    }
}
