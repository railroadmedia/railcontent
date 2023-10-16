<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Models\Subscription;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Support\Facades\Storage;
use Signifly\Shopify\Shopify;
use Carbon\Carbon;

class MigrateRechargeSubscriptions extends Command
{
    use HandlesMaskedEmailAddress;

    protected $signature = 'ecommerce:MigrateRechargeSubscriptions';

    protected function getClassName(): string
    {
        return "MigrateRechargeSubscriptions";
    }

    protected function appendToFile($filename, string $data)
    {
        if (app()->environment("local", "development")) {
            $storageResult = Storage::append($filename, $data);
        } else {
            $storageResult = Storage::disk('musora_web_platform_s3')->append($filename, $data);
        }

        if (!$storageResult) {
            throw new Exception(sprintf("%s: Failed to write .jsonl file", $this->getClassName()));
        }
    }

    public function handle(Shopify $shopify, RechargeGateway $rechargeGateway)
    {
        $this->withExecutionTime(function () use ($shopify, $rechargeGateway) {
            $fileName = $this->getClassName() . "-" . preg_replace('~\D~', '', microtime(true)) . ".csv";

            $this->info('Loading Subscriptions');
            $subscriptions = Subscription::query()->with('product')
                ->where('is_active', 1)
                ->where('type', 'subscription')
                ->where('paid_until', '>', Carbon::now())
                ->get();

            $count = $subscriptions->count();
            $this->info("Found $count subscriptions");

            $columns = [
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
            $data = implode(',', $columns);
            $this->appendToFile($fileName, $data);

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

            $this->info("Creating csv $fileName");
            $i = 0;
            $chunk = 1000;
            $chunks = $subscriptions->chunk($chunk);
            foreach ($chunks as $subs) {
                $data = "";
                $i2 = $i + $chunk;
                $this->info("Processing chunk $i - $i2");
                foreach ($subs as $subscription) {
                    $product = $subscription->product;
                    $variantId = $product?->shopify_id ?? 0;
                    //TODO:Check to make sure product has a shopify id
                    $productId = $productIds[$variantId] ?? 0;
                    if (!$productId) {
                        $this->info(
                            "No product found for subscription: $subscription->id Product:$product?->id $product?->name $variantId"
                        );
                        continue;
                    }
                    if (!$subscription->user) {
                        $this->info("No user found for subscription: $subscription->id User:$subscription->user_id");
                        continue;
                    }

                    $d = [
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
                        "customer_stripe_id" => !app()->isProduction() ? '' :
                            $subscription->paymentMethod?->creditCard->external_customer_id ?? "",
                        "stripe_payment_method_id" => !app()->isProduction() ? '' :
                            $subscription->paymentMethod?->creditCard->external_id ?? "",
                        "paypal_billing_agrement_id" => !app()->isProduction() ? '' :
                            $subscription->paymentMethod->paypalBillingAgreement?->external_id ?? "",
                        "shipping_email" => $this->getEmailForShopify($subscription->user->email),
                        "shipping_first_name" => $subscription->paymentMethod->address->first_name ?? "",
                        "shipping_last_name" => $subscription->paymentMethod->address->last_name ?? "",
                        "shipping_address_1" => "31265 Wheel Ave",
                        "shipping_address_2" => "#107",
                        "shipping_city" => "Abbotsford",
                        "shipping_province" => "BC",
                        "shipping_zip" => "V2T 6H2",
                        "shipping_country" => "Canada",
                        "shipping_phone" => '',
                        "status" => "active"
                    ];
                    $data .= (!empty($data) ? "\n" : "") . implode(',', $d);
                    $i++;
                }
                $this->appendToFile($fileName, $data);
            }

            $this->info("Created csv $fileName");
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
        return !app()->isProduction();
    }
}
