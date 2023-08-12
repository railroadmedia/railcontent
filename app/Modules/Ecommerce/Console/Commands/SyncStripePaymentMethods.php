<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\CreditCard;
use App\Modules\Ecommerce\Models\PaymentMethod;
use App\Modules\Ecommerce\Models\StripeCustomer;
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
        $userId = $this->argument('userId') ?? 0;
        $toUserId = $this->argument('toUserId') ?? 9999999;
        $this->info("Migrate Stripe Credit Cards To Musora... $userId to $toUserId.");

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
            $query = StripeCustomer::query()
                ->whereIn('user_id', $userIds)
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
//                $paymentMethodIds = $paymentMethods->pluck('id')->toArray();
//                $subscriptionLookup = Subscription::query()
//                    ->whereIn('payment_method_id', $paymentMethodIds)
//                    ->get()->keyBy('payment_method_id');
                foreach ($items as $item) {
                    $this->totalCount++;
                    $this->migrateStripeCustomer($item, $creditCardLookup, $paymentMethodLookup);
                }
            });
        });

        $this->info("Finished Migrated Stripe Credit Cards To Musora... $userId to $toUserId.");
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
        $paymentMethodLookup
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
//                if ($expirationDate->addYear()->isPast()) {
//                    $this->info("Card is expired");
//                    $this->expiredCount++;
//                    continue;
//                }

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
                $newCreditCard->expiration_date = Carbon::createFromDate($card->exp_year, $card->exp_month, 1)
                    ->format('Y-m-d');
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

//                $subscription = $subscriptionLookup->get($matchingPaymentMethod->id ?? 0) ?? null;
//                if ($subscription) {
//                    $subscription->legacy_payment_method_id = $matchingPaymentMethod->id ?? null;
//                    $subscription->payment_method_id = $newPaymentMethod->id;
//                    $subscription->save();
//                    $this->info(
//                        "Subscription $subscription->id updated from $subscription->legacy_payment_method_id to $subscription->payment_method_id"
//                    );
//                }
                $this->info("Created Payment Method for card");
                $this->createdPaymentMethods++;
            } catch (Exception $e) {
                $this->error("Error processing card:");
                $this->error($e->getMessage());
            }
        }
    }
}
