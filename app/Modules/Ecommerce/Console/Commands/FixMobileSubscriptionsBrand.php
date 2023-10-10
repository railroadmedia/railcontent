<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\CreditCard;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\PaymentMethod;
use App\Modules\Ecommerce\Models\StripeCustomer;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserPaymentMethod;
use Carbon\Carbon;
use Stripe\Stripe;

class FixMobileSubscriptionsBrand extends Command
{
    protected $signature = 'ecommerce:FixMobileSubscriptionsBrand';

    public function handle()
    {
        $this->info("Fix mobile subscriptions brand");

        $this->withExecutionTime(function () {
            $this->fixBrand();
        });
    }

    private function fixBrand()
    {
        $items =
            Subscription::query()
                ->select(
                    'ecommerce_subscriptions.id',
                    'ecommerce_products.brand'
                )
                ->join(
                    'ecommerce_products',
                    'ecommerce_products.id',
                    '=',
                    'ecommerce_subscriptions.product_id'
                )
                ->whereRaw('ecommerce_subscriptions.brand != ecommerce_products.brand')
                ->whereIn('ecommerce_subscriptions.type', ['apple_subscription', 'google_subscription'])
                ->orderBy('ecommerce_subscriptions.id')
                ->get();

        foreach ($items as $item) {
            Subscription::query()
                ->where('id', $item->id)
                ->update([
                             'brand' => $item->brand,
                         ]);

            $this->info("Fix subscription id: : ".$item->id." $item->brand");
        }
    }
}
