<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\CreditCard;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\PaymentMethod;
use App\Modules\Ecommerce\Models\PaypalBillingAgreements;
use App\Modules\Ecommerce\Models\StripeCustomer;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserPaymentMethod;
use Railroad\Ecommerce\Gateways\StripePaymentGateway;

class MigratePaypalGatewayToMusora extends Command
{
    protected $signature = 'ecommerce:migratePaypalGatewayToMusora {id?} {toId?}';
    protected int $totalCount = 0;

    protected StripePaymentGateway $stripePaymentGateway;

    public function handle(StripePaymentGateway $stripePaymentGateway)
    {
        $this->stripePaymentGateway = $stripePaymentGateway;
        $this->info("Migrate Paypal billing agreements to musora...");

        $userId = $this->argument('id') ?? 0;
        $toUserId = $this->argument('toId') ?? 9999999;
        $this->withExecutionTime(function () use ($userId, $toUserId) {
            $query = PaypalBillingAgreements::query()
                ->orderBy('id')
                ->where('id', '>=', $userId)
                ->where('id', '<=', $toUserId)
                ->whereIn('payment_gateway_name', ['drumeo', 'pianote', 'guitareo', 'singeo', 'musora']);
            $totalCount = $query->count();
            $this->info("Total agreements: " . $totalCount);
            $query->chunk(1000, function ($items) {
                foreach ($items as $item) {
                    if($item->payment_gateway_name == 'musora'){
                        continue;
                    }
                    $this->totalCount++;
                    $this->info("Processing agreement: $item->id $item->payment_gateway_name -> musora");
                    $item->legacy_payment_gateway_name = $item->payment_gateway_name;
                    $item->payment_gateway_name = 'musora';
                    $item->save();
                }
            });
        });

        $this->info("Summary:");
        $this->info("Total Users: " . $this->totalCount);
    }


}
