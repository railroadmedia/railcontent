<?php

namespace App\Modules\Ecommerce\tests\Feature;

use App\Enums\Interval;
use App\Modules\Ecommerce\Enums\RechargeSubscriptionStatusEnum;
use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Models\Recharge\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;

class RechargeSubscriptionHelper
{
    public static function getSubscriptionData(
        User $user,
        Product $product,
        Carbon $nextChargeDate,
        int $frequency,
        Interval $interval,
    ): Collection {
        $data = new class {
        };
        $data->id = fake()->randomNumber(6, true);
        $data->customer_id = $user->shopify_id;
        $data->email = $user->email;
        $data->status = RechargeSubscriptionStatusEnum::Active->value;
        $data->next_charge_scheduled_at = $nextChargeDate->toDateTimeString();
        $data->shopify_variant_id = $product->shopify_id;
        $data->sku = $product->sku;
        $data->created_at = Carbon::now()->addMonths(-5)->toDateTimeString();
        $data->updated_at = Carbon::now()->addMonths(-1)->toDateTimeString();
        $data->order_interval_frequency = $frequency;
        $data->order_interval_unit = $interval->value;

        $data->cancelled_at = '';
        $data->cancellation_reason = '';
        return collect([new Subscription($data)]);
    }


}
