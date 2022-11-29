<?php

namespace App\Modules\Ecommerce\Jobs;

use App\Console\Commands\Infrastructure\BatchQueryJob;
use App\Modules\Ecommerce\Enums\SubscriptionIntervalType;
use App\Modules\Ecommerce\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class UnifySubscriptionsJob extends BatchQueryJob
{
    private int $skip;
    private int $take;

    public function __construct(int $skip, int $take)
    {
        $this->skip = $skip;
        $this->take = $take;
    }

    function getSkip(): int
    {
        return $this->skip;
    }

    function getTake(): int
    {
        return $this->take;
    }

    function getQuery(): Builder
    {
        return User::query()->with('subscriptions.product');
    }

    function handleItem($item): void
    {
        /** @var User $user */
        $user = $item;
        $activeSubscriptions = $this->getActiveSubscriptions($user);
        $activeSubscription = $this->chooseActiveSubscription($user, $activeSubscriptions);
        if ($activeSubscription != null && count($activeSubscriptions) > 1) {
            $this->fixPricing($activeSubscription, $user);
        }
        $this->cancelOtherSubscriptions($activeSubscriptions, $activeSubscription, $user);
        $this->logOldSubscriptions($user);
    }

    public function getActiveSubscriptions(User $user): Collection
    {
        $activeSubscriptions = $user->subscriptions->where(function (Subscription $subscription) {
            return $subscription->is_active
                && ($subscription->product?->isMembershipProduct() ?? false)
                && $subscription->paid_until > Carbon::now()->addDays(-14);
        })->collect();
        return $activeSubscriptions;
    }

    private function chooseActiveSubscription(User $user, Collection $activeSubscriptions)
    {
        if ($user->is_lifetime_member) {
            return null;
        }
        $count = $activeSubscriptions->count();
        if ($count == 0) {
            return null;
        } elseif ($count == 1) {
            return $activeSubscriptions->first();
        } else {
            $candidate = null;
            foreach ($activeSubscriptions as $current) {
                if ($candidate == null) {
                    $candidate = $current;
                    continue;
                }
                $candidate = $this->compareSubscriptions($user, $current, $candidate);
            }
            return $candidate;
        }
    }

    private function compareSubscriptions(User $user, Subscription $current, Subscription $candidate): Subscription
    {
        //if intervals are not the same use Year
        if ($current->interval_type != $candidate->interval_type) {
            if ($current->getIntervalType() == SubscriptionIntervalType::Year) {
                return $current;
            }
            if ($candidate->getIntervalType() == SubscriptionIntervalType::Year) {
                return $candidate;
            }
            Log::info("$user->id Issue");
            throw new \Exception("Unknown interval_type case");
        }

        //if one is a trial use the other
        if (str_contains($current->product->sku, 'trial') || str_contains($candidate->product->sku, 'trial')) {
            if (str_contains($current->product->sku, 'trial') && str_contains($candidate->product->sku, 'trial')) {
                //continue if both are trials
            }
            if (str_contains($current->product->sku, 'trial')) {
                return $candidate;
            } elseif (str_contains($candidate->product->sku, 'trial')) {
                return $current;
            }
        }

        //prioritize web over mobile
        if ($current->isMobile() != $candidate->isMobile()) {
            if ($current->isMobile()) {
                return $candidate;
            }
            if ($candidate->isMobile()) {
                return $current;
            }
            throw new \Exception();
        }

        //Keep first active one they purchased
        if ($current->created_at <= $candidate->created_at) {
            return $current;
        } else {
            return $candidate;
        }
    }

    public function fixPricing(?Subscription $activeSubscription, User $user): void
    {
        switch ($activeSubscription->getIntervalType()) {
            case SubscriptionIntervalType::Month:
                $monthlyPrice = 14.49;
                if ($activeSubscription->total_price < $monthlyPrice) {
                    $diff = $monthlyPrice - $activeSubscription->total_price;
                    $activeSubscription->total_price = $monthlyPrice;
                    $activeSubscription->save();
                    DB::table('ecommerce_unify_subscriptions_archive')->insert([
                        'user_id' => $user->id,
                        'subscription_id' => $activeSubscription->id,
                        'action' => 'price adjusted',
                        'price_adjustment_amount' => $diff
                    ]);
                }
                break;
            case SubscriptionIntervalType::Year:
                $yearlyPrice = 147;
                if ($activeSubscription->total_price < $yearlyPrice) {
                    $diff = $yearlyPrice - $activeSubscription->total_price;
                    $activeSubscription->total_price = $yearlyPrice;
                    $activeSubscription->save();
                    DB::table('ecommerce_unify_subscriptions_archive')->insert([
                        'user_id' => $user->id,
                        'subscription_id' => $activeSubscription->id,
                        'action' => 'price adjusted',
                        'price_adjustment_amount' => $diff
                    ]);
                }
                break;
        }
    }

    public function cancelOtherSubscriptions(
        Collection $activeSubscriptions,
        ?Subscription $activeSubscription,
        User $user
    ): void {
        foreach ($activeSubscriptions as $subscription) {
            if ($activeSubscription != $subscription) {
                if ($subscription->isMobile()) {
                    DB::table('ecommerce_unify_subscriptions_archive')->insert([
                        'user_id' => $user->id,
                        'subscription_id' => $subscription->id,
                        'action' => 'mobile subscription requires manual intervention',
                        'price_adjustment_amount' => 0
                    ]);
                } else {
                    $subscription->cancel("Subscriptions Unified");
                    $subscription->save();
                    DB::table('ecommerce_unify_subscriptions_archive')->insert([
                        'user_id' => $user->id,
                        'subscription_id' => $subscription->id,
                        'action' => 'cancelled',
                        'price_adjustment_amount' => 0
                    ]);
                }
            }
        }
    }

    public function logOldSubscriptions(User $user): void
    {
        $oldActiveSubscriptions = $user->subscriptions->where(function (Subscription $subscription) {
            return $subscription->is_active
                && $subscription->type == Subscription::TYPE_SUBSCRIPTION
                && ($subscription->product?->isMembershipProduct() ?? false)
                && $subscription->paid_until <= Carbon::now()->addDays(-14);
        })->collect();

        $oldActiveSubscriptions->each(function (Subscription $subscription) use ($user) {
            DB::table('ecommerce_unify_subscriptions_archive')->insert([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'action' => 'paid until date in past',
                'price_adjustment_amount' => 0
            ]);
        });
    }

}
