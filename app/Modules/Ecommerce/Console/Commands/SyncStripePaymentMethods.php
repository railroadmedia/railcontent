<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\CreditCard;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\PaymentMethod;
use App\Modules\Ecommerce\Models\StripeCustomer;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserPaymentMethod;
use Railroad\Ecommerce\ExternalHelpers\Stripe;
use Railroad\Ecommerce\Gateways\StripePaymentGateway;
use Stripe\Card;

class SyncStripePaymentMethods extends Command
{
    protected $signature = 'ecommerce:SyncStripePaymentMethods {userId?} {toUserId?}';
    protected StripePaymentGateway $stripePaymentGateway;
    private $totalCount;

    public function handle(StripePaymentGateway $stripePaymentGateway)
    {
        $this->stripePaymentGateway = $stripePaymentGateway;
        $this->info("Migrate Stripe Gateway Customers and Credit Cards To Musora...");

        $userId = $this->argument('userId') ?? 0;
        $toUserId = $this->argument('toUserId') ?? 9999999;
        $this->withExecutionTime(function () use ($userId, $toUserId) {
            $query = StripeCustomer::query()
                ->where('user_id', '>=', $userId)
                ->where('user_id', '<=', $toUserId)
                ->where('payment_gateway_name', '=', 'musora')
                ->orderBy('user_id');
            $count = $query->count();
            $this->info("Total Users: " . $count);
            $query->chunk(1000, function ($items) {
                $customerIds = $items->pluck('stripe_customer_id')->toArray();
                $creditCardLookup = CreditCard::query()
                    ->whereIn('external_customer_id', $customerIds)
                    ->get()->keyBy('external_card_id');
                foreach ($items as $item) {
                    $this->totalCount++;
                    $this->migrateStripeCustomer($item, $creditCardLookup);
                }
            });
        });

        $this->info("Summary:");
        $this->info("Total Users: " . $this->totalCount);
    }

    private function migrateStripeCustomer(StripeCustomer $stripeCustomer, $creditCardLookup)
    {
        $this->info("Migrating stripe user to musora: " . $stripeCustomer->user_id);

        $stripeData = $this->stripePaymentGateway->listCreditCards('musora', $stripeCustomer->stripe_customer_id);

        /** @var Card $card */
        foreach ($stripeData as $card) {
            $creditCard = $creditCardLookup[$card['id']] ?? null;
            if (!$creditCard) {
                $this->info("Creating Payment Method for card " . $card['id']);
                $creditCard = new CreditCard();
                $creditCard->fingerprint = $card->fingerprint;
                $creditCard->last_four_digits = $card->last4;
                $creditCard->cardholder_name = $card->name;
                $creditCard->company_name = $card->brand;
                $creditCard->expiration_date = $card->exp_month . '/' . $card->exp_year;
                $creditCard->external_id = $card->id;
                $creditCard->external_customer_id = $stripeCustomer->stripe_customer_id;
                $creditCard->payment_gateway_name = 'musora';
                //$creditCard->save();
            } else {
                $this->info("Card exists");
            }
        }
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
