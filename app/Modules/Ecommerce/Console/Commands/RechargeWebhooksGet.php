<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;

class RechargeWebhooksGet extends Command
{
    protected $signature = 'ecommerce:getRechargeWebhooks';

    public function handle(RechargeGateway $recharge): void
    {
        $this->withExecutionTime(function () use ($recharge) {
            $webhooks = $recharge->getWebhooks();
            $this->info(strval(count($webhooks)) . ' webhooks found');
            foreach ($webhooks as $webhook) {
                $this->info(print_r($webhook, true));
            }
        });
    }
}
