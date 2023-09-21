<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Subscription;
use Carbon\CarbonInterval;
use Signifly\Shopify\Shopify;
use Carbon\Carbon;

class MigrateRechargeSubscriptions extends Command
{
    protected $signature = 'ecommerce:MigrateRechargeSubscriptions';

    public function handle(Shopify $shopify, RechargeGateway $rechargeGateway)
    {
        $this->withExecutionTime(function () use ($shopify, $rechargeGateway) {
            $subscriptions = Subscription::query()
                ->where('user_id', '=', '577652')
                ->where('is_active', 1)
                ->get();

            $data = [];
            foreach ($subscriptions as $subscription) {
                $product = $subscription->product;
                $variantId = $product->shopify_id;
                //TODO:Check to make sure product has a shopify id
                $variant = $shopify->getVariant($variantId);
                $productId = $variant->product_id;

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
                    "customer_stripe_id" => $subscription->paymentMethod?->creditCard->external_customer_id,
                    "stripe_payment_method_id" => $subscription->paymentMethod?->creditCard->external_id,
                    "paypal_billing_agrement_id" => $subscription->paymentMethod->paypal_billing_agreement_id,
                    "shipping_email" => $subscription->user->email,
                    "shipping_first_name" => $subscription->paymentMethod->address->first_name,
                    "shipping_last_name" => $subscription->paymentMethod->address->last_name ?? "N/A",
                    "shipping_address_1" => $subscription->paymentMethod->address->street_line_1 ?? "N/A",
                    "shipping_address_2" => $subscription->paymentMethod->address->street_line_2,
                    "shipping_city" => $subscription->paymentMethod->address->city ?? "N/A",
                    "shipping_province" => "BC",
                    "shipping_zip" => "V2T 6H2",
                    "shipping_country" => "Canada",
                    "shipping_phone" => "",
                    "status" => "active"
                ];
            }


            $export = join(',', array_keys($data[0]));
            foreach ($data as $d) {
                $export .= "\n" . join(',', array_values($d));
            }

            $this->info($export);
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
            if ($subscription->interval_count == 1) {
                return 1;
            }
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
        $interval = CarbonInterval::make($subscription->interval_count.$subscription->interval_type );
        $nextInterval = Carbon::parse($subscription->start_date)->add($interval);
        return $nextInterval->isoFormat('YYYY-MM-DD');
    }
}
