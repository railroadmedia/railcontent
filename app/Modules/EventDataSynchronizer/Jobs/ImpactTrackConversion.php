<?php

namespace App\Modules\EventDataSynchronizer\Jobs;

use App\Modules\Ecommerce\Models\Product;
use App\Modules\Ecommerce\Services\ProductService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Railroad\Ecommerce\Services\CartService;
use Railroad\Railanalytics\Tracker;
use Throwable;

class ImpactTrackConversion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private $user,
        private $brand,
        private $order,
        private ProductService $productService) {
    }

    public function handle()
    {

        $promoCodesList = array_map(function($code) {
            return $code['code'];
        }, $this->order['discount_codes']);
        $promoCodesString = implode(',', $promoCodesList);
        $hasZeroCost = intval($this->order['current_total_price']) == 0;
        $products = $this->getAllProducts($this->order['line_items'], $hasZeroCost);
        $orderId = $this->order['id'];
        $email = $this->user->email;
        $userID = $this->user->id;
        $currency = $this->order['currency'];
        $affiliateClickCode = null;

        Log::info('$this->order["note_attributes"] = ' . var_export($this->order['note_attributes'] ?? [], true));

        foreach (($this->order['note_attributes'] ?? []) as $attributeKeyValueArray) {
            if ($attributeKeyValueArray['name'] == '_impact_affiliate_click_tracking_code') {
                $affiliateClickCode = $attributeKeyValueArray['value'];
            }
        }

        Log::info('$affiliateClickCode = ' . $affiliateClickCode);

        try {
            Tracker::queue(
                $this->brand,
                function () use ($products, $promoCodesString, $orderId, $userID, $email, $currency, $affiliateClickCode) {
                    Tracker::trackTransactionAPI(
                        $products,
                        $orderId,
                        $promoCodesString,
                        // hashed email is used here because when the original trial event is triggered, no shopify or musora user account exists, but the email does. Email needs to be hashed for privacy.
                        $userID,
                        $email,
                        currency: $currency,
                        affiliateClickCode: $affiliateClickCode
                    );
                }
        );
        } catch (Throwable $exception) {
            error_log("Error in ImpactTrackConversion with order: $orderId");
            error_log($exception);
        }
    }

    private function getAllProducts(array $lineItems, $hasZeroCost): array
    {
        return collect($lineItems)
            ->map(function ($lineItem) use ($hasZeroCost) {
                return [
                    'id' => $lineItem['product_id'],
                    'name' => $lineItem['name'],
                    'quantity' => $lineItem['quantity'],
                    'sku' => $lineItem['sku'],
                    'brand' =>strtolower( $lineItem['vendor']),
                    // this is a hack to set the price to zero for trials.
                    // So reporting on Impact's side is a bit cleaner.
                    // we're not investing more time in a better solution as we're likely moving away from impact
                    'value' => $hasZeroCost ? '0' : $lineItem['price'],
                    'category' => $this->getProductCategory($lineItem['sku'], $hasZeroCost),
                    'variant_id' => $lineItem['variant_id'],
                    'variant_name' => $lineItem['variant_title']
                ];
            })
            ->toArray();
    }

    private function getProductCategory($sku, $hasZeroCost): string
    {
        $product = $this->productService->getBySku($sku);
        if ($product->isMembershipProduct()) {
            return $hasZeroCost ? "TrialStart" : "TrialConversion";
        } else {
            return "";
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Throwable  $exception
     */
    public function failed(Throwable $exception)
    {
        error_log($exception);
    }

}
