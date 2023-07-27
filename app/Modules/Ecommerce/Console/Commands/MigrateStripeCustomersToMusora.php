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

class MigrateStripeCustomersToMusora extends Command
{
    protected $signature = 'ecommerce:MigrateStripeCustomersToMusora {--userId=}';
    protected int $totalCount = 0;

    protected int $alreadyMigratedCount = 0;
    protected int $subscriptionCount = 0;
    protected int $onlyOneStripeCustomerFoundCount = 0;
    protected int $recentPaymentFoundCount = 0;
    protected int $recentCreditCardFoundCount = 0;

    protected int $lastResortCount = 0;


    public function handle()
    {
        $this->info("Migrate Stripe Gateway Customers and Credit Cards To Musora...");

        $userId = $this->option('userId') ?? 0;
        $this->withExecutionTime(function () use ($userId) {
            StripeCustomer::query()->select('user_id')
                ->distinct()
                ->orderBy('user_id')
                ->where('user_id', '>', $userId)
                ->chunk(1000, function ($items) {
                    foreach ($items as $item) {
                        $this->totalCount++;
                        $this->migrateStripeCustomer($item->user_id);
                    }
                });
        });

        $this->info("Summary:");
        $this->info("Total Users: " . $this->totalCount);
        $this->info("Already migrated: " . $this->alreadyMigratedCount);
        $this->info("Only one stripe customer found: " . $this->onlyOneStripeCustomerFoundCount);
        $this->info("Subscription count: " . $this->subscriptionCount);
        $this->info("Recent payment found: " . $this->recentPaymentFoundCount);
        $this->info("Recent credit card found: " . $this->recentCreditCardFoundCount);
        $this->info("Last resort: " . $this->lastResortCount);
    }

    private function migrateStripeCustomer(int $userId)
    {
        $this->info("Migrating stripe user to musora: " . $userId);
        $stripeCustomer = $this->getStripeCustomerToMigrate($userId);

        if ($stripeCustomer) {
            $this->info("Stripe Customer: $stripeCustomer->stripe_customer_id");
            $newStripeCustomer = new StripeCustomer();
            $newStripeCustomer->user_id = $stripeCustomer->user_id;
            $newStripeCustomer->stripe_customer_id = $stripeCustomer->stripe_customer_id;
            $newStripeCustomer->payment_gateway_name = 'musora';
            $newStripeCustomer->save();

            $creditCards = CreditCard::query()
                ->where('external_customer_id', $stripeCustomer->stripe_customer_id)
                ->get();

            foreach ($creditCards as $creditCard) {
                $newCreditCard = new CreditCard();
                $newCreditCard->fingerprint = $creditCard->fingerprint;
                $newCreditCard->last_four_digits = $creditCard->last_four_digits;
                $newCreditCard->cardholder_name = $creditCard->cardholder_name;
                $newCreditCard->company_name = $creditCard->company_name;
                $newCreditCard->expiration_date = $creditCard->expiration_date;
                $newCreditCard->external_id = $creditCard->external_id;
                $newCreditCard->payment_gateway_name = 'musora';
                $newCreditCard->external_customer_id = $creditCard->external_customer_id;
                $newCreditCard->save();

                $paymentMethod = PaymentMethod::query()->where('credit_card_id', $creditCard->id)->first();
                if ($paymentMethod) {
                    $newPaymentMethod = new PaymentMethod();
                    $newPaymentMethod->method_id = $paymentMethod->method_id;
                    $newPaymentMethod->method_type = $paymentMethod->method_type;
                    $newPaymentMethod->credit_card_id = $newCreditCard->id;
                    $newPaymentMethod->currency = $paymentMethod->currency;
                    $newPaymentMethod->billing_address_id = $paymentMethod->billing_address_id;
                    $newPaymentMethod->note = $paymentMethod->note;
                    $newPaymentMethod->save();

                    $userPaymentMethod = UserPaymentMethod::query()
                        ->where('payment_method_id', $paymentMethod->id)
                        ->first();
                    if ($userPaymentMethod) {
                        $newUserPaymentMethod = new UserPaymentMethod();
                        $newUserPaymentMethod->user_id = $userPaymentMethod->user_id;
                        $newUserPaymentMethod->payment_method_id = $newPaymentMethod->id;
                        $newUserPaymentMethod->save();
                    }
                }

//                $paymentMethodsToDelete = PaymentMethod::query()
//                    ->join(
//                        'ecommerce_user_payment_methods',
//                        'ecommerce_user_payment_methods.payment_method_id',
//                        '=',
//                        'ecommerce_payment_methods.id'
//                    )
//                    ->join(
//                        'ecommerce_credit_cards',
//                        'ecommerce_credit_cards.id',
//                        '=',
//                        'ecommerce_payment_methods.credit_card_id'
//                    )
//                    ->where('ecommerce_user_payment_methods.user_id', $userId)
//                    ->where('ecommerce_credit_cards.payment_gateway_name', '!=', 'musora')
//                    ->get();
//                foreach ($paymentMethodsToDelete as $paymentMethodToDelete) {
//                    $paymentMethodToDelete->deleted_at = Carbon::now();
//                    $paymentMethodToDelete->save();
//                }
            }
        }
    }

    public function getStripeCustomerToMigrate(int $userId): mixed
    {
        $stripeCustomers = StripeCustomer::query()->where('user_id', $userId)->get();
        foreach ($stripeCustomers as $stripeCustomer) {
            if ($stripeCustomer->payment_gateway_name == 'musora') {
                $this->info("Already migrated");
                $this->alreadyMigratedCount++;
                return null; //is already migrated
            }
        }

        if (count($stripeCustomers) == 1) {
            $this->info("Only one stripe customer found");
            $this->onlyOneStripeCustomerFoundCount++;
            return $stripeCustomers->first();
        }

        $stripeCustomer = null;

        $activeSubscription = Subscription::query()
            ->where('is_active', true)
            ->where('user_id', $userId)
            ->orderByDesc('paid_until')
            ->first();

        if ($activeSubscription) {
            $paymentMethod = PaymentMethod::query()->where('id', $activeSubscription->payment_method_id)->first();
            if ($paymentMethod) {
                $creditCard = CreditCard::query()->where('id', $paymentMethod->credit_card_id)->first();
                if ($creditCard) {
                    $stripeCustomer = StripeCustomer::query()
                        ->where('user_id', $userId)
                        ->where('stripe_customer_id', $creditCard->external_customer_id)
                        ->first();
                    if ($stripeCustomer) {
                        $this->info("Active subscriptionfound");
                        $this->subscriptionCount++;
                        return $stripeCustomer;
                    }
                }
            }
        }


        $customerIds = $stripeCustomers->pluck('stripe_customer_id')->toArray();


        $customerId = Payment::query()
            ->select('ecommerce_credit_cards.external_customer_id')
            ->join(
                'ecommerce_payment_methods',
                'ecommerce_payments.payment_method_id',
                '=',
                'ecommerce_payment_methods.id'
            )
            ->join(
                'ecommerce_credit_cards',
                'ecommerce_payment_methods.credit_card_id',
                '=',
                'ecommerce_credit_cards.id'
            )
            ->where('status', 'paid')
            ->where('external_provider', 'stripe')
            ->whereIn('ecommerce_credit_cards.external_customer_id', $customerIds)
            ->orderBy('ecommerce_payments.created_at', 'desc')
            ->first();
        if ($customerId) {
            $stripeCustomer = $stripeCustomers->where('stripe_customer_id', $customerId->external_customer_id)->first();
        }

        if ($stripeCustomer) {
            $this->info("Recent Payment found");
            $this->recentPaymentFoundCount++;
            return $stripeCustomer;
        }

        $creditCard = CreditCard::query()->whereIn('external_customer_id', $customerIds)
            ->orderBy('created_at', 'desc')->first();


        if ($creditCard) {
            $stripeCustomer = $stripeCustomers->where('stripe_customer_id', $creditCard->external_customer_id)->first();
        }

        if ($stripeCustomer) {
            $this->info("Recent Credit Card found");
            $this->recentCreditCardFoundCount++;
            return $stripeCustomer;
        }

        $stripeCustomer = $stripeCustomers->sortByDesc('created_at')->first();
        $this->lastResortCount++;
        $this->info("Use most recent customer as last resort");
        return $stripeCustomer;
    }


}
