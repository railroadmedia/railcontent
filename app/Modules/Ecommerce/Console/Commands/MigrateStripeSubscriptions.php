<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\CreditCard;
use App\Modules\Ecommerce\Models\PaymentMethod;
use App\Modules\Ecommerce\Models\StripeCustomer;
use App\Modules\Ecommerce\Models\Subscription;
use App\Modules\Ecommerce\Models\UserPaymentMethod;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Railroad\Ecommerce\Gateways\StripePaymentGateway;
use Stripe\Card;
use Stripe\Customer;

class MigrateStripeSubscriptions extends Command
{
    protected $signature = 'ecommerce:MigrateStripeSubscriptions';
    private $issueCount;

    public function handle(StripePaymentGateway $stripePaymentGateway)
    {
        $this->info("Migrate Stripe Subscriptions To Musora...");
        $query = Subscription::query()->select([
            'ecommerce_subscriptions.id',
            'ecommerce_subscriptions.payment_method_id',
            'ecommerce_subscriptions.user_id',
            'ecommerce_subscriptions.customer_id',
            'ecommerce_credit_cards.payment_gateway_name',
            'ecommerce_credit_cards.external_id',
            'ecommerce_credit_cards.external_customer_id',
            'ecommerce_credit_cards.last_four_digits',
            'ecommerce_credit_cards.expiration_date',
        ])
            ->join(
                'ecommerce_payment_methods',
                'ecommerce_payment_methods.id',
                '=',
                'ecommerce_subscriptions.payment_method_id'
            )
            ->join(
                'ecommerce_credit_cards',
                'ecommerce_credit_cards.id',
                '=',
                'ecommerce_payment_methods.credit_card_id'
            )
            ->where('legacy_payment_method_id', null)
            ->where('is_active', 1)
            ->whereRaw("(total_cycles_due != total_cycles_paid or type != 'payment plan')")
            ->whereIn('type', ['subscription', 'payment plan'])
            //->where('user_id', 352690)
            ->where('ecommerce_credit_cards.payment_gateway_name', '!=', 'musora');

        $count = $query->count();
        $this->info('Total Subscriptions: ' . $count);

        $subscriptions = $query
            //->limit(10000)
            ->get();
        foreach ($subscriptions as $subscription) {
            $this->migrateStripeSubscription($subscription, $stripePaymentGateway);
        }

        $this->info("Total Issues: " . $this->issueCount);
        //                    $subscription->legacy_payment_method_id = $matchingPaymentMethod->id ?? null;

    }

    private function migrateStripeSubscription(Subscription $subscription, StripePaymentGateway $stripePaymentGateway)
    {
        $userId = $subscription->user_id;

        $userPaymentMethods = UserPaymentMethod::query()
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
            ->where('ecommerce_credit_cards.payment_gateway_name', '=', 'musora')
            ->where('ecommerce_user_payment_methods.user_id', $userId)
            ->get();

        $expirationDateCompare = Carbon::createFromDate($subscription->expiration_date)->format('Y-m');

        foreach ($userPaymentMethods as $userPaymentMethod) {
            $userPaymentMethod->expiration_compare = Carbon::createFromDate(
                $userPaymentMethod->expiration_date
            )->format('Y-m');
        }

        $matchingPaymentMethod = $userPaymentMethods
            ->where('last_four_digits', $subscription->last_four_digits)
            ->where('expiration_compare', $expirationDateCompare)
            ->sortByDesc('id')->first() ?? null;

        if (!$matchingPaymentMethod) {
            $matchingPaymentMethod = $userPaymentMethods
                ->where('last_four_digits', $subscription->last_four_digits)
                ->sortByDesc('id')->first() ?? null;
        }

        if ($matchingPaymentMethod) {
            Subscription::query()->where('id', $subscription->id)->update([
                'legacy_payment_method_id' => $subscription->payment_method_id,
                'payment_method_id' => $matchingPaymentMethod->payment_method_id,
            ]);
            return;
        }

        if ($subscription->external_customer_id) {
            try {
                $stripeCardId = $subscription->external_id;
                $customer = $stripePaymentGateway->getCustomer(
                    $subscription->payment_gateway_name,
                    $subscription->external_customer_id
                );
                $card = $stripePaymentGateway->getCard($customer, $stripeCardId, $subscription->payment_gateway_name);


                $matchingPaymentMethod = $userPaymentMethods
                    ->where('last_four_digits', $card->last4)
                    ->sortByDesc('id')->first() ?? null;

                if ($matchingPaymentMethod) {
                    Subscription::query()->where('id', $subscription->id)->update([
                        'legacy_payment_method_id' => $subscription->payment_method_id,
                        'payment_method_id' => $matchingPaymentMethod->payment_method_id,
                    ]);
                    return;
                }
            } catch (Exception $exception) {
                $this->error($exception);
            }
        }

        $this->issueCount++;

        $this->info(
            "No matching payment method found for userId: $userId customerId: $subscription->customer_id subscription:" . $subscription->id
        );
    }
}
