<?php

namespace App\Modules\Ecommerce\Console\Commands;

use App\Console\Commands\Infrastructure\Command;
use App\Modules\Ecommerce\Models\Product;
use Modules\UserManagementSystem\Models\User;
use Signifly\Shopify\Shopify;

class ShopifySyncIds extends Command
{
    protected $signature = 'ecommerce:ShopifySyncIDs {startPageIndex=0}';

    public function handle(Shopify $shopify)
    {
        $this->withExecutionTime(function () use ($shopify) {
            $startPageIndex = intval($this->argument('startPageIndex'));
            if ($startPageIndex == 0) {
                $pages = $shopify->paginateProducts(['limit' => 250]);
                foreach ($pages as $page) {
                    foreach ($page as $product) {
                        $variants = $shopify->getVariants($product->id);
                        foreach ($variants as $variant) {
                            $this->info($variant->id);
                            try {
                                $shopify->getVariantMetafields($variant->id)->each(
                                    function ($metafield) use ($shopify, $variant) {
                                        if ($metafield->key == '_id') {
                                            $product = Product::query()->find($metafield->value) ?? null;
                                            if ($product) {
                                                $product->shopify_id = $variant->id;
                                                $product->saveWithoutUpdatedAt();
                                            }
                                        }
                                    }
                                );
                            } catch
                            (\Exception $e) {
                                $this->error($e->getMessage());
                            }
                        }
                    }
                }
            }


            $pages = $shopify->paginateCustomers(
                [
                    'limit' => 250,
                ]
            );
            $i = 1;

            foreach ($pages as $page) {
                $this->info('Page ' . $i);
                if ($i >= $startPageIndex) {
                    foreach ($page as $customer) {
                        $this->info($customer->id);
                        try {
                            $shopify->getCustomerMetafields($customer->id)->each(
                                function ($metafield) use ($shopify, $customer) {
                                    if ($metafield->key == '_id') {
                                        $user = User::query()->find($metafield->value) ?? null;
                                        if ($user) {
                                            $user->shopify_id = $customer->id;
                                            $user->saveWithoutUpdatedAt();
                                        }
                                    }
                                }
                            );
                        } catch (\Exception $e) {
                            $this->error($e->getMessage());
                        }
                    }
                }
                $i++;
            }
        });
    }
}
