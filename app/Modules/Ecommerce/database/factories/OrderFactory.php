<?php

namespace App\Modules\Ecommerce\database\factories;

use App\Modules\Ecommerce\Models\Address;
use App\Modules\Ecommerce\Models\Customer;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\OrderItem;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\UserManagementSystem\Models\User;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    protected float $taxRate = 0.12;

    protected ?Address $shippingAddress;

    public function definition(): array
    {
        $productDue = round(fake()->randomFloat(2, 0, 10000), 2);
        $shippingDue = 0.00;
        $taxesDue = round(($productDue + $shippingDue) * $this->taxRate, 2);

        var_dump($productDue + $shippingDue + $taxesDue);
        return [
            'total_due' => $productDue + $shippingDue + $taxesDue,
            'product_due' => $productDue,
            'taxes_due' => $taxesDue,
            'shipping_due' => $shippingDue,
            'total_paid' => $productDue + $shippingDue + $taxesDue,
            'brand' => config('ecommerce.brand'),
            'shipping_address_id' => $this->shippingAddress?->id ?? null,
            'billing_address_id' => Address::factory(),
            'note' => fake()->text,
        ];
    }

    public function forUser(User $user, ?Address $billingAddress = null, ?Address $shippingAddress = null): Factory
    {
        $changes = [
            'user_id' => $user->id,
        ];
        if ($billingAddress) {
            $changes['billing_address_id'] = $billingAddress->id;
        }
        if ($shippingAddress) {
            $changes['shipping_address_id'] = $shippingAddress->id;
        }
        return $this->state(function (array $attributes) use ($changes) {
            return $changes;
        });
    }

    public function forCustomer(Customer $customer, ?Address $billingAddress = null, ?Address $shippingAddress = null)
    {
        $changes = [
            'customer_id' => $customer->id,
        ];
        if ($billingAddress) {
            $changes['billing_address_id'] = $billingAddress->id;
        }
        if ($shippingAddress) {
            $changes['shipping_address_id'] = $shippingAddress->id;
        }
        return $this->state(function (array $attributes) use ($changes) {
            return $changes;
        });
    }

    public function hasOrderItemForProduct(Product $product): Factory
    {
        return $this->has(
            OrderItem::factory(['product_id' => $product->id]),
            "orderItems"
        );
    }

    public function createdAtInDateRange(Carbon $startDate, Carbon $endDate, bool $updatedAtMatch = true): Factory
    {
        $date = $this->faker->dateTimeBetween($startDate, $endDate);
        $changes = [
            'created_at' => $date,
        ];
        if ($updatedAtMatch) {
            $changes['updated_at'] = $date;
        }
        return $this->state(function (array $attributes) use ($changes) {
            return $changes;
        });
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Order $order) {
            // update the product-related values
            $productDue = $order->orderItems->pluck('product')->sum('price');
            $taxesDue = ($productDue + $order->shipping_due) * $this->taxRate;

            $order->product_due = $productDue;
            $order->taxes_due = $taxesDue;
            $order->total_due = $productDue + $order->shipping_due + $taxesDue;
            $order->total_paid = $productDue + $order->shipping_due + $taxesDue;
            $order->save();
        });
    }
}
