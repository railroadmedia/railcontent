<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Gateways\RechargeGateway;
use App\Modules\Ecommerce\Models\Product;
use Signifly\Shopify\REST\Resources\WebhookResource;
use Signifly\Shopify\Shopify;

class MigrateRechargeProducts extends Command
{
    protected $signature = 'ecommerce:MigrateRechargeProducts';

    public function handle(Shopify $shopify, RechargeGateway $rechargeGateway)
    {
        $this->withExecutionTime(function () use ($shopify, $rechargeGateway) {
            $plans = $rechargeGateway->call('GET', '/plans', ['limit' => 250]);
            $planLookup = collect($plans->plans)->keyBy(function ($item) {
                return $item->external_product_id->ecommerce;
            })->toArray();

            $subscriptionProducts = Product::query()->whereNotNull('subscription_interval_type')
                ->where('id', '=', '409')->get();

            foreach ($subscriptionProducts as $product) {
                $variant = $shopify->getVariant($product->shopify_id);
                $productId = $variant->product_id;
                if (!isset($planLookup[$productId])) {
                    $this->info("Creating plan for product {$product->name} $productId");
                    try {
                        $rechargeGateway->call(
                            'POST',
                            '/plans',
                            [
                                'channel_settings' => [
                                    'api' => [
                                        'display' => true
                                    ],
                                    'customer_portal' => [
                                        'display' => true
                                    ],
                                    'merchant_portal' => [
                                        'display' => true
                                    ],
                                    'checkout_page' => [
                                        'display' => true
                                    ],
                                ],
                                'discount_amount' => '0',
                                'discount_type' => 'percentage',
                                'external_product_id' => [
                                    'ecommerce' => strval($productId)
                                ],
                                'sort_order' => 1,
                                'subscription_preferences' => [
                                    'charge_interval_frequency' => $this->getIntervalCount($product),
                                    'cutoff_day_of_month' => null,
                                    'cutoff_day_of_week' => null,
                                    'expire_after_specific_number_of_charges' => null,
                                    'order_day_of_month' => null,
                                    'order_day_of_week' => null,
                                    'interval_unit' => $this->getIntervalUnit($product),
                                    'order_interval_frequency' => $this->getIntervalCount($product),
                                ],
                                'title' => $this->getTitle($product),
                                'type' => 'subscription'
                            ]
                        );
                    } catch (\Exception $ex) {
                        $this->error($ex->getMessage());
                        continue;
                    }
                }
            }
        });
    }

    private function getIntervalUnit(Product $product)
    {
        if ($product->subscription_interval_type == 'month') {
            return 'month';
        }
        if ($product->subscription_interval_type == 'year') {
            return 'month';
        }
        throw new \Exception("Not implemented");
    }

    private function getIntervalCount(Product $product)
    {
        if ($product->subscription_interval_type == 'month') {
            if ($product->subscription_interval_count == 1) {
                return 1;
            }
        }
        if ($product->subscription_interval_type == 'year') {
            if ($product->subscription_interval_count == 1) {
                return 12;
            }
        }

        throw new \Exception("Not implemented");
    }

    private function getTitle(Product $product)
    {
        if ($product->subscription_interval_type == 'month') {
            return 'Monthly';
        }
        if ($product->subscription_interval_type == 'year') {
            return 'Yearly';
        }
        throw new \Exception("Not implemented");
    }
}
