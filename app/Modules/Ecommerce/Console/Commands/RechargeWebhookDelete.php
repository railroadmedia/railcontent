<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use Illuminate\Support\Str;

class RechargeWebhookDelete extends Command
{
    protected $signature = 'ecommerce:deleteRechargeWebhooks {appURL}';

    public function handle(RechargeGateway $recharge): void
    {
        $this->withExecutionTime(function () use ($recharge) {
            $appURL = $this->argument('appURL');
            $webhooks = $recharge->getWebhooks();
            foreach ($webhooks as $webhook) {
                if (Str::startsWith($webhook->address, $appURL)) {
                    $recharge->deleteWebhook($webhook->id);
                    $this->info("$webhook->topic webhook $webhook->id deleted ($webhook->address)");
                }
            }
        });
    }
}
