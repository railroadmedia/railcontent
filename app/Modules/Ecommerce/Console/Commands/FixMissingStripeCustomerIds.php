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

class FixMissingStripeCustomerIds extends Command
{
    protected $signature = 'ecommerce:MigrateFixMissingStripeCustomerIds {startingId?} ';
    private int $count = 0;
    private int $totalCount = 0;


    public function handle()
    {
        $this->info("Migrate stripe missing customers");

        $this->withExecutionTime(function () {
            $this->migrateStripeCustomers();
        });
    }

    private function migrateStripeCustomers()
    {
        $startingId = $this->argument('startingId') ?? 0;
        UserPaymentMethod::query()->select(
            'ecommerce_user_payment_methods.id',
            'ecommerce_user_payment_methods.user_id',
            'ecommerce_credit_cards.external_customer_id',
            'ecommerce_credit_cards.payment_gateway_name'
        )
            ->join(
                'ecommerce_payment_methods',
                'ecommerce_payment_methods.id',
                '=',
                'ecommerce_user_payment_methods.payment_method_id'
            )
            ->join(
                'ecommerce_credit_cards',
                'ecommerce_credit_cards.id',
                '=',
                'ecommerce_payment_methods.credit_card_id'
            )
            ->where('ecommerce_user_payment_methods.id', '>=', $startingId)
            ->where('ecommerce_credit_cards.external_customer_id', '!=', '')
            ->where('ecommerce_credit_cards.external_customer_id', '!=', null)
            ->chunk(1000, function ($items) {
                $customerIds = $items->pluck('external_customer_id')->toArray();
                $stripeCustomers = StripeCustomer::query()
                    ->whereIn('stripe_customer_id', $customerIds)
                    ->get();

                $lookup = [];
                foreach ($stripeCustomers as $stripeCustomer) {
                    $lookup[$stripeCustomer->stripe_customer_id] = $stripeCustomer;
                }


                $processedIds = [];
                foreach ($items as $item) {
                    $this->totalCount++;
                    if ($processedIds[$item->external_customer_id] ?? false) {
                        continue;
                    }
                    if (isset($lookup[$item->external_customer_id])) {
                        continue;
                    }
                    $this->info("Processing user payment method id: " . $item->id . " $item->external_customer_id");
                    $this->migrateCreditCard($item);
                    $processedIds[$item->external_customer_id] = true;
                }
            });

        $this->info("Total migrated: " . $this->count);
        $this->info("Total processed: " . $this->totalCount);
    }

    private function migrateCreditCard(mixed $item)
    {
        if ($item->payment_gateway_name == 'recordeo') {
            return;
        }

        $stripeCustomer = new StripeCustomer();
        $stripeCustomer->user_id = $item->user_id;
        $stripeCustomer->stripe_customer_id = $item->external_customer_id;
        $stripeCustomer->payment_gateway_name = $item->payment_gateway_name;
        $stripeCustomer->save();
        $this->info("Created stripe customer record: " . $item->external_customer_id);
        $this->count++;
    }


}
