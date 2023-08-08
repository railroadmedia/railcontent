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

class SyncStripePaymentMethods extends Command
{
    protected $signature = 'ecommerce:SyncStripePaymentMethods {userId?} {toUserId?}';
    protected StripePaymentGateway $stripePaymentGateway;
    private $totalCount;
    private $expiredCount = 0;
    private $alreadySyncedCount = 0;
    private $totalCards = 0;
    private $noCardMatch = 0;
    private $createdPaymentMethods = 0;

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
                $creditCards = CreditCard::query()
                    ->whereIn('external_customer_id', $customerIds)
                    ->get();
                $creditCardLookup = $creditCards->groupBy('external_customer_id');
                $cardIds = $creditCards->pluck('id')->toArray();
                $paymentMethods = PaymentMethod::query()->whereIn('credit_card_id', $cardIds)->get();
                $paymentMethodLookup = $paymentMethods->keyBy(
                    'credit_card_id'
                );
                $paymentMethodIds = $paymentMethods->pluck('id')->toArray();
                $subscriptionLookup = Subscription::query()
                    ->whereIn('payment_method_id', $paymentMethodIds)
                    ->get()->keyBy('payment_method_id');
                foreach ($items as $item) {
                    $this->totalCount++;
                    $this->migrateStripeCustomer($item, $creditCardLookup, $paymentMethodLookup, $subscriptionLookup);
                }
            });
        });

        $this->info("Summary:");
        $this->info("Total Users: " . $this->totalCount);
        $this->info("Total Cards: " . $this->totalCards);
        $this->info("Already Synced cards: " . $this->alreadySyncedCount);
        $this->info("Expired cards: " . $this->expiredCount);
        $this->info("No card match: " . $this->noCardMatch);
        $this->info("Created Payment Methods: " . $this->createdPaymentMethods);
    }

    private function migrateStripeCustomer(
        StripeCustomer $stripeCustomer,
        $creditCardLookup,
        $paymentMethodLookup,
        $subscriptionLookup
    ) {
        $this->info("Migrating stripe user to musora: " . $stripeCustomer->user_id);

        try {
            $stripeData = $this->stripePaymentGateway->listCreditCards('musora', $stripeCustomer->stripe_customer_id);
        } catch (\Exception $exception) {
            $this->error("Error getting stripe data for user: " . $stripeCustomer->user_id);
            $this->error($exception->getMessage());
            return;
        }

        $creditCardLookupByCard = collect(
            $creditCardLookup->get($stripeCustomer->stripe_customer_id) ?? new Collection()
        )->keyBy('external_id');


        /** @var Card $card */
        foreach ($stripeData as $card) {
            try {
                $this->info("Migrating card: " . $card['id']);
                $this->totalCards++;
                $newCreditCard = $creditCardLookupByCard->get($card['id']) ?? null;
                if ($newCreditCard) {
                    $this->info("Card exists");
                    $this->alreadySyncedCount++;
                    continue;
                }

                $expirationDate = Carbon::createFromDate($card->exp_year, $card->exp_month);
                if ($expirationDate->addMonth()->isPast()) {
                    $this->info("Card is expired");
                    $this->expiredCount++;
                    continue;
                }

                $expirationDateCompare = $expirationDate->format('Y-m');

                foreach ($creditCardLookupByCard as $card2) {
                    $card2->expiration_compare = Carbon::createFromDate($card2->expiration_date)->format('Y-m');
                }

                $matchingCard = $creditCardLookupByCard
                    ->where('last_four_digits', $card->last4)
                    ->where('expiration_compare', $expirationDateCompare)
                    ->where('payment_gateway_name', "!=", 'musora')
                    ->sortByDesc('id')->first() ?? null;

                if (!$matchingCard) {
                    $matchingCard = $creditCardLookupByCard
                        ->where('last_four_digits', $card->last4)
                        ->where('payment_gateway_name', "!=", 'musora')
                        ->sortByDesc('id')->first() ?? null;
                }

                if (!$matchingCard) {
                    $this->info("No matching card found");
                    $this->noCardMatch++;
                }
                $matchingPaymentMethod = $paymentMethodLookup->get($matchingCard->id ?? 0) ?? null;

                $newCreditCard = new CreditCard();
                $newCreditCard->fingerprint = $card->fingerprint;
                $newCreditCard->last_four_digits = $card->last4;
                $newCreditCard->cardholder_name = $card->name;
                $newCreditCard->company_name = $card->brand;
                $newCreditCard->expiration_date = Carbon::createFromDate($card->exp_year, $card->exp_month);
                $newCreditCard->external_id = $card->id;
                $newCreditCard->external_customer_id = $stripeCustomer->stripe_customer_id;
                $newCreditCard->payment_gateway_name = 'musora';
                $newCreditCard->save();

                $newPaymentMethod = new PaymentMethod();
                $newPaymentMethod->credit_card_id = $newCreditCard->id;
                $newPaymentMethod->currency = 'USD';
                $newPaymentMethod->billing_address_id = $matchingPaymentMethod->billing_address_id ?? null;
                $newPaymentMethod->save();

                $newUserPaymentMethod = new UserPaymentMethod();
                $newUserPaymentMethod->user_id = $stripeCustomer->user_id;
                $newUserPaymentMethod->payment_method_id = $newPaymentMethod->id;
                $newUserPaymentMethod->save();

                $subscription = $subscriptionLookup->get($matchingPaymentMethod->id ?? 0) ?? null;
                if ($subscription) {
                    $subscription->legacy_payment_method_id = $matchingPaymentMethod->id ?? null;
                    $subscription->payment_method_id = $newPaymentMethod->id;
                    $subscription->save();
                    $this->info(
                        "Subscription $subscription->id updated from $subscription->legacy_payment_method_id to $subscription->payment_method_id"
                    );
                }
                $this->info("Created Payment Method for card");
                $this->createdPaymentMethods++;
            } catch (Exception $e) {
                $this->error("Error processing card:");
                $this->error($e->getMessage());
            }
        }
    }
}
