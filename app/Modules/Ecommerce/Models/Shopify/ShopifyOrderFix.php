<?php

namespace App\Modules\Ecommerce\Models\Shopify;

use App\Modules\Ecommerce\Models\Order as EcommerceOrder;
use App\Modules\Ecommerce\Models\OrderItem;
use App\Modules\Ecommerce\Models\Payment;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;

/**
 * Class Order
 *
 * @package App\Modules\Ecommerce\Models
 *
 * @property int $id
 * @property int|null $shopify_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<Payment> $payments
 *
 */
class ShopifyOrderFix extends Model
{
    use SoftDeletes;

    public const ACTION_MATCHED = 'matched';
    public const ACTION_REPLACED = 'replaced';
    public const ACTION_FAILURE = 'failure';
    public const ACTIONS = [self::ACTION_MATCHED, self::ACTION_REPLACED, self::ACTION_FAILURE];
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_CLONED = 'cloned';
    public const STATUS_PAID = 'paid';
    public const STATUS_FULFILLED = 'fulfilled';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_EVALUATED = 'evaluated';
    public const STATUSES = [self::STATUS_EVALUATED, self::STATUS_PROCESSING, self::STATUS_CLONED, self::STATUS_PAID, self::STATUS_FULFILLED, self::STATUS_COMPLETED];

    protected $table = 'shopify_order_fixes';

    protected $guarded = ['id'];

    public function ecommerceModelable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'ecommerce_modelable_type', 'ecommerce_modelable_id');
    }

    public function getUserAttribute(): ?User
    {
        $ecommerceModelable = $this->ecommerceModelable;

        if ($ecommerceModelable instanceof EcommerceOrder) {
            return $ecommerceModelable->user;
        } elseif ($ecommerceModelable instanceof SubscriptionPayment) {
            return $ecommerceModelable->subscription->user;
        }

        return null;
    }

    /**
     * @return Collection<OrderItem>
     */
    public function getOrderItemsAttribute(): Collection
    {
        $ecommerceModelable = $this->ecommerceModelable;

        if ($ecommerceModelable instanceof EcommerceOrder) {
            return $ecommerceModelable->orderItems;
        } elseif ($ecommerceModelable instanceof SubscriptionPayment) {
            return $ecommerceModelable->subscription->order?->orderItems ?? collect();
        }

        return collect();
    }

    public function getOrderTotalAmountAttribute(): float
    {
        // there are some cases where subscriptions don't have an order, so check for that and use the subscription's total_price
        /** @var Collection<OrderItem> $orderItems */
        $orderItems = $this->orderItems;
        if ($orderItems->isEmpty()) {
            $ecommerceModelable = $this->ecommerceModelable;
            if ($ecommerceModelable instanceof EcommerceOrder) {
                return $ecommerceModelable->total_paid;
            } elseif ($ecommerceModelable instanceof SubscriptionPayment) {
                return $ecommerceModelable->subscription->total_price;
            }
        }
        return $this->orderItems->sum('final_price');
    }

    /**
     * Query scope to get ShopifyOrderFixes that need to be synced with Shopify, for the given constraints.
     */
    public function scopeToSyncWithShopify(
        Builder $query,
        ?int $startingId = null,
        ?int $endingId = null,
        ?bool $matchedOnly = null,
        ?bool $replacedOnly = null,
        ?Carbon $startProcessedAt = null,
        ?Carbon $endProcessedAt = null
    ): void {
        $query
            ->whereNot('status', self::STATUS_COMPLETED)
            ->when(
                !is_null($startingId) && !is_null($endingId),
                function (Builder $q) use ($startingId, $endingId) {
                    return $q->whereBetween("id", [$startingId, $endingId]);
                },
                function (Builder $q) use ($startingId) {
                    return $q->when(!is_null($startingId), function (Builder $q) use ($startingId) {
                        return $q->where("id", ">=", $startingId);
                    });
                },
            )
            ->when($matchedOnly, function (Builder $q) {
                return $q->where('action_taken', self::ACTION_MATCHED);
            })
            ->when($replacedOnly, function (Builder $q) {
                return $q->where('action_taken', self::ACTION_REPLACED);
            })
            ->when(
                !is_null($startProcessedAt) && !is_null($endProcessedAt),
                function (Builder $q) use ($startProcessedAt, $endProcessedAt) {
                    return $q->whereBetween(
                        'processed_at',
                        [$startProcessedAt->toDateTimeString(), $endProcessedAt->toDateTimeString()]
                    );
                }
            );
    }
}
