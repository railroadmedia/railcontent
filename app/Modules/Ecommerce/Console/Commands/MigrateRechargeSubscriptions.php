<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Models\Subscription;
use Carbon\CarbonInterval;
use Signifly\Shopify\Shopify;
use Carbon\Carbon;

class MigrateRechargeSubscriptions extends Command
{
    use HandlesMaskedEmailAddress;

    protected $signature = 'ecommerce:MigrateRechargeSubscriptions';

    public function handle(Shopify $shopify, RechargeGateway $rechargeGateway)
    {
        $this->withExecutionTime(function () use ($shopify, $rechargeGateway) {
            $fileName = app_path('rechargeSubscriptions.csv');
            $file = fopen($fileName, 'w');
            $this->info('Loading Subscriptions');
            $subscriptions = Subscription::query()->with('product')
                ->where('is_active', 1)
                ->where('type', 'subscription')
                ->where('paid_until', '>', Carbon::now())
                ->get();

            $columns = [
                'validation_status',
                'validation_details',
                'external_product_id',
                'external_variant_id',
                'external_product_name',
                'external_variant_name',
                'quantity',
                'recurring_price',
                'charge_interval_unit_type',
                'charge_interval_frequency',
                'shipping_interval_unit_type',
                'shipping_interval_frequency',
                'charge_on_day_of_month',
                'customer_created_at',
                'last_charge_date',
                'next_charge_date',
                'customer_stripe_id',
                'stripe_payment_method_id',
                'paypal_billing_agrement_id',
                'shipping_email',
                'shipping_first_name',
                'shipping_last_name',
                'shipping_address_1',
                'shipping_address_2',
                'shipping_city',
                'shipping_province',
                'shipping_zip',
                'shipping_country',
                'shipping_phone',
                'status'
            ];
            fputcsv($file, $columns);
            $data = [];

            $this->info('Loading Product Information');
            $productIds = $subscriptions->pluck('product.shopify_id')->unique()->mapWithKeys(
                function ($id) use ($shopify) {
                    try {
                        $variantId = $shopify->getVariant($id)?->product_id ?? 0;
                    } catch (\Exception $ex) {
                        $variantId = 0;
                    }
                    return [$id => $variantId];
                }
            )->toArray();

            $this->info('Building CSV');

            $this->withProgressBar($subscriptions, function ($subscription) use ($file, $productIds) {
                $product = $subscription->product;
                $variantId = $product?->shopify_id ?? 0;
                //TODO:Check to make sure product has a shopify id
                $productId = $productIds[$variantId] ?? 0;
                if (!$productId) {
                    $this->info(
                        "No product found for subscription: $subscription->id Product:$product?->id $product?->name $variantId"
                    );
                    return;
                }
                if (!$subscription->user) {
                    $this->info("No user found for subscription: $subscription->id User:$subscription->user_id");
                    return;
                }

                $data[] = [
                    "external_product_id" => $productId,
                    "external_variant_id" => $variantId,
                    "external_product_name" => $product->name,
                    "external_variant_name" => "",
                    "quantity" => 1,
                    "recurring_price" => $subscription->total_price,
                    "charge_interval_unit_type" => $this->getIntervalUnit($subscription),
                    "charge_interval_frequency" => $this->getIntervalCount($subscription),
                    "shipping_interval_unit_type" => $this->getIntervalUnit($subscription),
                    "shipping_interval_frequency" => $this->getIntervalCount($subscription),
                    "charge_on_day_of_month" => "",
                    "customer_created_at" => "",
                    "last_charge_date" => "",
                    "next_charge_date" => $this->getNextChargeDate($subscription),
                    "customer_stripe_id" => $subscription->paymentMethod?->creditCard->external_customer_id ?? "",
                    "stripe_payment_method_id" => $subscription->paymentMethod?->creditCard->external_id ?? "",
                    "paypal_billing_agrement_id" => $subscription->paymentMethod->paypalBillingAgreement?->external_id ?? "",
                    "shipping_email" => $this->getEmailForShopify($subscription->user->email),
                    "shipping_first_name" => $subscription->paymentMethod->address->first_name ?? "",
                    "shipping_last_name" => $subscription->paymentMethod->address->last_name ?? "",
                    "shipping_address_1" => $subscription->paymentMethod->address->street_line_1 ?? "",
                    "shipping_address_2" => $subscription->paymentMethod->address->street_line_2 ?? "",
                    "shipping_city" => $subscription->paymentMethod->address->city ?? "",
                    "shipping_province" => $subscription->paymentMethod->address->region ?? "",
                    "shipping_zip" => $subscription->paymentMethod->address->zip ?? "",
                    "shipping_country" => $subscription->paymentMethod->address->country ?? "",
                    "shipping_phone" => '',
                    "status" => "active"
                ];
                fputcsv($file, array_values($data[0]));
            });
            fclose($file);


//            $export = join(',', array_keys($data[0]));
//            foreach ($data as $d) {
//                $export .= "\n" . join(',', array_values($d));
//            }
//
//            $this->info($export);
        });
    }

    private function getIntervalUnit(Subscription $subscription)
    {
        if ($subscription->interval_type == 'month') {
            return 'month';
        }
        if ($subscription->interval_type == 'year') {
            //Recharge handles years as 12 months, so we need to convert it appropriately
            return 'month';
        }
        throw new \Exception("Not implemented");
    }

    private function getIntervalCount(Subscription $subscription)
    {
        if ($subscription->interval_type == 'month') {
            return $subscription->interval_count;
        }
        if ($subscription->interval_type == 'year') {
            if ($subscription->interval_count == 1) {
                //Recharge handles years as 12 months, so we need to convert it appropriately
                return 12;
            }
        }

        throw new \Exception("Not implemented");
    }


    private function getNextChargeDate(Subscription $subscription)
    {
        $nextInterval = Carbon::parse($subscription->paid_until);
        return $nextInterval->isoFormat('YYYY-MM-DD');
    }

    protected function getIsUsingMask(): bool
    {
        return true;
    }
}
