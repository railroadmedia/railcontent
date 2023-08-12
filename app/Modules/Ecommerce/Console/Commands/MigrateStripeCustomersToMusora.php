<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\CreditCard;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\PaymentMethod;
use App\Modules\Ecommerce\Models\StripeCustomer;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserPaymentMethod;
use Railroad\Ecommerce\Gateways\StripePaymentGateway;
use Stripe\Stripe;

class MigrateStripeCustomersToMusora extends Command
{
    protected $signature = 'ecommerce:MigrateStripeCustomersToMusora {userId?} {toUserId?}';
    protected int $totalCount = 0;

    protected int $alreadyMigratedCount = 0;
    protected int $subscriptionCount = 0;
    protected int $onlyOneStripeCustomerFoundCount = 0;
    protected int $recentPaymentFoundCount = 0;
    protected int $recentCreditCardFoundCount = 0;
    protected int $skippedMigratedCount = 0;

    protected int $lastResortCount = 0;

    protected StripePaymentGateway $stripePaymentGateway;

    public function handle(StripePaymentGateway $stripePaymentGateway)
    {
        $this->stripePaymentGateway = $stripePaymentGateway;
        $this->info("Migrate Stripe Gateway Customers and Credit Cards To Musora...");

        $userId = $this->argument('userId') ?? 0;
        $toUserId = $this->argument('toUserId') ?? 9999999;
        $this->withExecutionTime(function () use ($userId, $toUserId) {
            $userIds = [
                163346,
                161770,
                298730,
                255176,
                280705,
                288102,
                301955,
                286155,
                302326,
                302640,
                303047,
                304689,
                306309,
                307725,
                150177,
                312269,
                313417,
                278885,
                315597,
                315746,
                316515,
                308626,
                316663,
                316758,
                316992,
                317242,
                317740,
                317926,
                232910,
                319051,
                319652,
                319830,
                321597,
                271271,
                320657,
                323541,
                323678,
                323880,
                324747,
                325938,
                326072,
                326747,
                328264,
                329125,
                329550,
                329962,
                330101,
                330126,
                318133,
                330395,
                330403,
                330527,
                330539,
                330745,
                330854,
                330894,
                331448,
                331808,
                333035,
                333249,
                333262,
                333844,
                334033,
                334172,
                334272,
                334756,
                334673,
                173519,
                335281,
                335342,
                335710,
                335742,
                320817,
                188078,
                336732,
                336837,
                336689,
                337114,
                337675,
                337833,
                338432,
                338553,
                338565,
                339680,
                339685,
                340004,
                340062,
                321495,
                341193,
                341309,
                341388,
                341457,
                341492,
                341546,
                315451,
                341700,
                341782,
                341974,
                341995,
                341998,
                342194,
                342222,
                342342,
                353906,
                389453,
                389823,
                394127,
                428080,
                352690,
                472557,
                326883,
                341182,
                475859,
                444935,
                485762,
                511675,
                324331,
                350189,
                519772,
                365014,
                532419,
                317322,
                540905,
                464176,
                546694,
                546720,
                503435,
                530445,
                298399,
                411738,
                417415,
                561648,
                591653,
                440365,
                419994,
                604120,
                606311,
                346129,
                589166,
                607848,
                341782,
                341974,
                341995,
                341998,
                342194,
                342222,
                342342,
                300649,
                310647,
                314711,
                252133,
                353906,
                332252,
                389453,
                389823,
                322447,
                394127,
                283924,
                158648,
                428080,
                297635,
                352690,
                271312,
                472557,
                315124,
                326883,
                341182,
                475859,
                444935,
                485762,
                484950,
                482186,
                302592,
                511675,
                324331,
                297653,
                350189,
                363232,
                519772,
                307379,
                365014,
                522220,
                532419,
                317322,
                540905,
                464176,
                303362,
                278007,
                546694,
                546720,
                503435,
                548296,
                530445,
                298399,
                411738,
                560060,
                526365,
                417415,
                291936,
                561648,
                433219,
                413173,
                150001,
                591468,
                591653,
                430834,
                344122,
                416330,
                294835,
                299333,
                599103,
                174412,
                440365,
                419994,
                323227,
                604120,
                606311,
                346129,
                396954,
                589166,
                607848,
                396223,
                523081,
            ];
            StripeCustomer::query()->select('user_id')
                ->distinct()
                ->orderBy('user_id')
                ->whereIn('user_id', $userIds)
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
        $this->info("Skipped migrated: " . $this->skippedMigratedCount);
    }

    private function migrateStripeCustomer(int $userId)
    {
        $this->info("Migrating stripe user to musora: " . $userId);
        $stripeCustomer = $this->getStripeCustomerToMigrate($userId);

        if ($stripeCustomer) {
            $musoraStripeCustomer = StripeCustomer::query()
                ->where('user_id', $userId)
                ->where('payment_gateway_name', '=', 'musora')
                ->first();
            if ($musoraStripeCustomer && $musoraStripeCustomer->stripe_customer_id != $stripeCustomer->stripe_customer_id) {
                $stripeCustomerId = $musoraStripeCustomer->stripe_customer_id;

                $creditCards = CreditCard::query()
                    ->where('external_customer_id', $stripeCustomerId)
                    ->where('payment_gateway_name', '=', 'musora')->get();

                $creditCardIds = $creditCards->pluck('id')->toArray();

                $paymentMethods = PaymentMethod::query()->whereIn('credit_card_id', $creditCardIds)->get();
                $paymentMethodIds = $paymentMethods->pluck('id')->toArray();

                $userPaymentMethods = UserPaymentMethod::query()->whereIn('payment_method_id', $paymentMethodIds)->get(
                );
                foreach ($userPaymentMethods as $userPaymentMethod) {
                    if ($userPaymentMethod->user_id != $userId) {
                        $this->info(
                            "Cannot fix case: User Payment Method $userPaymentMethod->id has different user id: $userPaymentMethod->user_id"
                        );
                        return null;
                    }
                }
                foreach ($userPaymentMethods as $userPaymentMethod) {
                    $userPaymentMethod->delete();
                }
                foreach ($paymentMethods as $paymentMethod) {
                    $paymentMethod->delete();
                }
                foreach ($creditCards as $creditCard) {
                    $creditCard->delete();
                }
                $musoraStripeCustomer->delete();
            } else {
                return;
            }


            $this->info("Stripe Customer: $stripeCustomer->stripe_customer_id");
            $newStripeCustomer = new StripeCustomer();
            $newStripeCustomer->user_id = $stripeCustomer->user_id;
            $newStripeCustomer->stripe_customer_id = $stripeCustomer->stripe_customer_id;
            $newStripeCustomer->payment_gateway_name = 'musora';
            $newStripeCustomer->save();


//            $customerData = $this->stripePaymentGateway->getCustomer('musora', $newStripeCustomer->stripe_customer_id);
//
//
//
//
//
//
//            $creditCards = CreditCard::query()
//                ->where('external_customer_id', $stripeCustomer->stripe_customer_id)
//                ->get();
//
//            foreach ($creditCards as $creditCard) {
//                $newCreditCard = new CreditCard();
//                $newCreditCard->fingerprint = $creditCard->fingerprint;
//                $newCreditCard->last_four_digits = $creditCard->last_four_digits;
//                $newCreditCard->cardholder_name = $creditCard->cardholder_name;
//                $newCreditCard->company_name = $creditCard->company_name;
//                $newCreditCard->expiration_date = $creditCard->expiration_date;
//                $newCreditCard->external_id = $creditCard->external_id;
//                $newCreditCard->payment_gateway_name = 'musora';
//                $newCreditCard->external_customer_id = $creditCard->external_customer_id;
//                $newCreditCard->save();
//
//                $paymentMethod = PaymentMethod::query()->where('credit_card_id', $creditCard->id)->first();
//                if ($paymentMethod) {
//                    $newPaymentMethod = new PaymentMethod();
//                    $newPaymentMethod->method_id = $paymentMethod->method_id;
//                    $newPaymentMethod->method_type = $paymentMethod->method_type;
//                    $newPaymentMethod->credit_card_id = $newCreditCard->id;
//                    $newPaymentMethod->currency = $paymentMethod->currency;
//                    $newPaymentMethod->billing_address_id = $paymentMethod->billing_address_id;
//                    $newPaymentMethod->note = $paymentMethod->note;
//                    $newPaymentMethod->save();
//
//                    $userPaymentMethod = UserPaymentMethod::query()
//                        ->where('payment_method_id', $paymentMethod->id)
//                        ->first();
//                    if ($userPaymentMethod) {
//                        $newUserPaymentMethod = new UserPaymentMethod();
//                        $newUserPaymentMethod->user_id = $userPaymentMethod->user_id;
//                        $newUserPaymentMethod->payment_method_id = $newPaymentMethod->id;
//                        $newUserPaymentMethod->save();
//                    }
//
//
//                    $subscriptions = Subscription::query()
//                        ->where('payment_method_id', $paymentMethod->id)->get();
//                    foreach ($subscriptions as $subscription) {
//                        $this->info(
//                            "Updating Subscription $subscription->id to use new payment method: $subscription->payment_method_id -> $newPaymentMethod->id"
//                        );
//                        $subscription->payment_method_id = $newPaymentMethod->id;
//                        $subscription->save();
//                    }
//                }
//            }
        }
    }

    public function getStripeCustomerToMigrate(int $userId): mixed
    {
        $musoraStripeCustomer = null;
        $stripeCustomers = StripeCustomer::query()->where('user_id', $userId)->get();
        foreach ($stripeCustomers as $stripeCustomer) {
            if ($stripeCustomer->payment_gateway_name == 'musora') {
                $musoraStripeCustomer = $stripeCustomer;
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
                    if ($creditCard) {
                        if (!$creditCard->external_customer_id) {
                            $stripeCustomer = StripeCustomer::query()
                                ->where('user_id', $userId)
                                ->where('payment_gateway_name', $creditCard->payment_gateway_name)
                                ->first();
                            if ($stripeCustomer) {
                                $this->info("Active subscriptionfound");
                                $this->subscriptionCount++;

                                return $stripeCustomer;
                            }
                        } else {
                            $stripeCustomer = StripeCustomer::query()
                                ->where('user_id', $userId)
                                ->where('stripe_customer_id', $creditCard->external_customer_id)
                                ->first();
                            $this->info("Active subscriptionfound");
                            $this->subscriptionCount++;

                            return $stripeCustomer;
                        }
                    }
                }
            }
        }

        return null;
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
